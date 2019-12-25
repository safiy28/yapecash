<?php namespace App\Http\Controllers;

use App\Facades\HttpClient\Curl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Http;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_info.manage', ['only' => ['getInformations', 'getUserInformation', 'getRecipient']]);
    }

    public function index(){
        return view('users.landing');
    }
    public function flashZone(){
        return view('users.flash');
    }
    public function userSearchView(){
        $mobile_number = null;
        $result = null;
        return $this->loadView('users.search', compact('mobile_number', 'result'));
    }
    public function userSearch(Request $request)
    {
        $inputs = $request->all();
        $v = Validator::make($inputs, [
            'mobile_number' => 'numeric'
        ]);
        if ($v->fails()) {
            return redirect()->route('user-search')->withErrors(['Only Numbers']);
        }
        $result = Http::post('user-search',$inputs);
        $result = parseApiResponse($result);
        if (!$result['user_found']) {
            $new_user['mobile_number'] = $inputs['mobile_number'];
            session(['user_registration' => $new_user]);
        }
        return $this->loadView('users.search', compact('mobile_number', 'result'));
    }
    public function userRegister()
    {
        $id_type = Http::get('user-id_type');
        $id_types = parseApiResponse($id_type);
        $idTypes = $id_types['id_type'];
        if (session('user_registration')) {
            return $this->loadView('users.register',compact('idTypes'));
        }
        return redirect('/user/search');
    }
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'profile_photo' => 'required',
            'scan' => 'required',
            'date_of_birth' => 'required|date',
            'present_address' => 'required',
            'occupation' => 'required',
            'post_code' => 'required|numeric',
            'id_no' => 'required',
            'expire_date' => 'required|date',
            'name' => 'required',
        ]);

        $inputs = $request->all();
        //$new_user['id'] = $inputs['id'];
        $new_user['name'] = $inputs['name'];
        $new_user['mobile_number'] = $inputs['mobile_number'];
        $new_user['father_name'] = 'Not Set';
        $new_user['mother_name'] = 'Not Set';
        $new_user['permanent_address'] = 'Not Set';
        $new_user['id_no'] = trim($inputs['id_no']);
        $new_user['id_expire_date'] = date("Y-m-d", strtotime($inputs['expire_date'])) ?? '';
        $new_user['present_address'] = $inputs['present_address'];
        $new_user['occupation'] = trim($inputs['occupation']);
        $new_user['post_code'] = $inputs['post_code'];
        $new_user['date_of_birth'] = date("Y-m-d", strtotime($inputs['date_of_birth']));

        $new_user['profile_photo'] = uploadDocuments($request->file('profile_photo'),'profile_photo',$new_user['mobile_number']);
        $new_user['scan'] = uploadDocuments($request->file('scan'),'scan',$new_user['mobile_number']);
        if (isset($inputs['scan_one'])) {
            $new_user['scan_one'] = uploadDocuments($request->file('scan_one'),'scan_one',$new_user['mobile_number']);
        } else {
            $new_user['scan_one'] = '';
        }

        $service_result = Curl::create()->post('register-user',$new_user,["Content-Type" => "multipart/form-data"]);
        $service_result = json_decode($service_result->contents,true);
        $service_result['flg'] = 1;
        if ($service_result['message'] !== 'Success') {
            return redirect()->back()->withErrors($service_result['reason']);
        }
        session()->forget('user_registration');
        \File::delete($new_user['profile_photo']->postname);
        \File::delete($new_user['profile_photo']->postname);
        if (isset($inputs['scan_one'])) {
            \File::delete($new_user['scan_one']->postname);
        }
        return $this->loadView('users.result', compact('service_result'));

    }
    public function userInformationUpdatePost(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);
        $inputs = $request->all();
        $inputs['id_expire_date'] = $inputs['expire_date'] ?? 0;
        $id = $inputs['id'];
        if (isset($inputs['profile_photo'])) {
            $inputs['profile_photo'] = uploadDocuments($request->file('profile_photo'),'scan_one',$id);
        }
        if (isset($inputs['scan'])) {
            $inputs['scan'] = uploadDocuments($request->file('scan'),'scan_two',$id);
        }
        if (isset($inputs['scan_one'])) {
            $inputs['scan_one'] = uploadDocuments($request->file('scan_one'),'scan_one',$id);
        }
        /*if (isset($inputs['scan_two'])) {
            $inputs['scan_two'] = uploadDocuments($request->file('scan_two'),'scan_two',$id);
        }*/
        $service_result = Curl::create()->post('update-user-profile',$inputs,["Content-Type" => "multipart/form-data"]);
        $service_result = json_decode($service_result->contents,true);


        if (isset($inputs['profile_photo'])) {
            \File::delete($inputs['profile_photo']->postname);
        }
        if (isset($inputs['scan'])) {
            \File::delete($inputs['scan']->postname);
        }
        if (isset($inputs['scan_one'])) {
            \File::delete($inputs['scan_one']->postname);
        }
        if (isset($inputs['scan_two'])) {
            \File::delete($inputs['scan_two']->postname);
        }
        if ($service_result['message'] === 'Success') {
            Session::flash('message', 'Successfully Updated.');
            $service_result['isMsp'] ? $route = 'msp' : $route = 'profile';
            return redirect(route($route));
        }
        return redirect()->back()->withErrors($service_result['reason']);
    }
    public function getProfile()
    {
        $profile = Http::get('profile');
        $profile = parseApiResponse($profile);
        if ($profile['message'] === 'success') {
            $profile = $profile['profile'];
            if ($profile !== null) {
                return $this->loadView('profile.index', compact('profile'));
            }
            return redirect()->back();
        }
        return redirect('/logout');
    }
    public function getChangePassword()
    {
        return $this->loadView('profile.change_password');
    }
    public function postChangePassword(Request $request)
    {

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);
        $inputs = $request->all();
        $result = Http::post('change-password',$inputs);
        $result = parseApiResponse($result);
        if ($result['message'] === 'Success') {
            Session::flash('message', 'Password Successfully Updated.');
            return redirect(route('flash.zone'));
        }
        return redirect()->back()->withErrors([$result['reason']]);
    }
    public function getChangePin()
    {
        return $this->loadView('profile.change_pin');
    }
    public function postChangePin(Request $request)
    {
        $messages = [
            'pin_confirmation.same' => 'The NEW PIN and CONFIRMATION PIN should be same',

        ];
        $this->validate($request, [
            'current_pin' => 'required',
            'pin' => 'required|min:5',
            'pin_confirmation' => 'required|same:pin'
        ],$messages);

        $inputs = $request->all();
        $result = Http::post('change-pin',$inputs);
        $result = parseApiResponse($result);
        if ($result['message'] === 'Success') {
            session()->put('first_time', false);
            Session::flash('message', 'Pin Successfully Updated.');
            return redirect('/services');
        }
        return redirect()->back()->withErrors([$result['reason']]);
    }
    public function updateProfile($id = null){
        $isVerified = session('is_verified');
        if($isVerified){
            Session::flash('type', 'warning');
            Session::flash('message', 'You can\'t update this profile! Profile already verified.');
            return $this->loadView('users.landing');
        } else {
            $input = [
                'id' => $id
            ];
            $profile = Http::get('profile',$input);
            $profile = parseApiResponse($profile);
            $id_type = Http::get('user-id_type');
            $id_types = parseApiResponse($id_type);
            if ($profile['message'] === 'success') {
                $user    = $profile['user'] ?? null;
                $profile = $profile['profile'];
                $idTypes = $id_types['id_type'];
                $view = !empty($id) ? 'profile.msp_update' : 'profile.update';
                if ($profile !== null) {
                    return $this->loadView($view, compact('profile','user','idTypes'));
                }
                return redirect()->back();
            }
            return redirect()->back();
        }
    }
    public function removeCard(Request $request){
        $messages = [
            'card_no.required' => 'Card number invalid',
        ];
        $validator = Validator::make($request->all(),[
            'card_no' => 'required',
        ],$messages);
        if($validator->fails()){
            $errors = $validator->errors();
            $response =[
                'status' => 'failed',
                'response' => $errors->first(),
            ];
            return json_encode($response);
        }
        $inputs = $request->all();
        $result = Http::post('remove-card',$inputs);
        $result = parseApiResponse($result);
        if($result['message'] === 'Success') {
            $response =[
                'status' => 'Success',
                'response' => $result['card'],
            ];
            return json_encode($response);
        }else{
            $response =[
                'status' => 'failed',
                'response' => $result['reason'],
            ];
            return json_encode($response);
        }
    }
    public function addCard(Request $request){
        $messages = [
            'credit_card_number.required' => 'Card number invalid',
            'credit_card_number.numeric' => 'Card number invalid',
            'credit_card_number.digits_between' => 'Card number invalid',
            'agreement.required' => 'Agreement not accepted.Please check bellow agreement checkbox',
        ];
        $validator = Validator::make($request->all(),[
                'credit_card_number' => 'required|numeric|digits_between:16,16',
                'card_name' => 'required',
                'agreement' => 'required',
                'month' => 'required|numeric|min:1|max:12|digits_between:1,2',
                'year' => 'required|numeric|min:'.date('Y'),
                'ccv' => 'required|numeric|digits_between:1,3'
            ],$messages);
            if($validator->fails()){
                $errors = $validator->errors();
                $response =[
                    'status' => 'failed',
                    'response' => $errors->first(),
                ];
                return json_encode($response);
            }
            $inputs = $request->all();
            if($request->has('agreement') && $inputs['agreement'] == '1'){
                session()->forget('card');
                $result = Http::post('new-card',$inputs);
                $result = parseApiResponse($result);
                if($result['message'] === 'Success') {
                    $response =[
                        'status' => 'Success',
                        'response' => $result['card'],
                    ];
                    return json_encode($response);
                }else{
                    $response =[
                        'status' => 'failed',
                        'response' => $result['reason'],
                    ];
                    return json_encode($response);
                }
            }else{
                $response =[
                    'status' => 'failed',
                    'response' => 'Agreement not checked',
                ];
                return json_encode($response);
/*                session()->forget('card');
                $card = customEncryptDecrypt($request->n1.$request->n2.$request->n3.$request->n4);
                $cvc  = customEncryptDecrypt($request->ccv);
                session()->put('card',['card'=>$card,'cvc'=>$cvc]);

                $default ='xxxxxxxxxxxx';
                $response =[
                    'status' => 'Success',
                    'response' => $default.substr(customEncryptDecrypt($card,'decrypt'),-4),
                ];
                return json_encode($response);*/
            }

    }

    public function getProfileRecipient(Request $request){
        /*session(['add_from_profile' => true]);*/

        $profile = Http::get('profile-recipient');
        $profile = parseApiResponse($profile);
        $recipients = $profile['data'];
        $user = $profile['user'];
        if($request->has('type')){
            $recipients = array_filter($recipients,function ($ele) use ($request){
                return $ele['transfer_type'] == $request->input('type');
            });
        }
        return $this->loadView('profile.recipients',compact('recipients','user'));
    }
}
