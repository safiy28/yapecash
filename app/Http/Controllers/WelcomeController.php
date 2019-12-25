<?php namespace App\Http\Controllers;

use App\Facades\HttpClient\Curl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Facades\HttpClient\Http;
use GuzzleHttp\Client;
class WelcomeController extends Controller
{
    public function index()
    {
        $brands = Http::get('brands');
        $brands = parseApiResponse($brands);
        $brands = $brands['brands'];

        $result = Http::get('all-services-home');
        $result = parseApiResponse($result);
        $services = [
            'remittance' => []
        ];
        foreach ((array) $result['data'] as $key => $value) {
            if (strpos($value['type'], 'rec') !== false) {
                $services['remittance'][] = $value;
            }

        }
        //dd($services);
        return view('static.home',compact('brands','services'));
    }

    public function login()
    {
        $support = Http::get('support');
        return view('auth.login', compact('support'));
    }

    public function about()
    {
        return view('static.about');
    }

    public function contact()
    {
        return view('static.contact');
    }

    public function terms()
    {
        return view('static.terms');
    }

    public function privacy()
    {
        return view('static.privacy');
    }

    public function faq()
    {
        return view('static.faq');
    }

    public function services()
    {
        return view('static.our-services');
    }

    public function registration()
    {
        $support = Http::get('support');

        return view('static.registration', compact('support'));
    }

    public function userSearch(Request $request)
    {
        $inputs = $request->all();
        $inputs['isFrontend'] = true;
        $v = Validator::make($request->all(), [
            'mobile_number' => 'required|numeric',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors(['Only valid mobile numbers are allowed']);
        }
        $result = Http::post('user-search',$inputs);
        $result = parseApiResponse($result);

        $id_type = Http::get('user-id_type');
        $id_types = parseApiResponse($id_type);

        if (! $result['user_found']) {
            $support = Http::get('support');
            $result['mobile_number'] = $inputs['mobile_number'];
            $idTypes = $id_types['id_type'];
            return view('static.registration-information', compact('result', 'support','idTypes'));
        }
        return redirect()->back()->withErrors(['Error! User already exists']);
    }

    public function showUserInformationFrom()
    {
        $support = Http::get('support');
        $oldData = [
            'mobile_number' => session()->get('mobile_number'),
            'user_name' => session()->get('user_name'),
            'id_no' => session()->get('id_no'),
            'expire_date' => session()->get('expire_date'),
        ];
        return view('static.registration-information', compact('support', 'oldData'));
    }
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function postUserInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|numeric',
            'name' => 'required',
            'id_no' => 'required',
            'expire_date' => 'required',
            'date_of_birth' => 'required'
        ]);
        session()->put('mobile_number',$request->mobile_number);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator) ->withInput();
        }

        $inputs = $request->all();
        $new_user = [];
        $new_user['mobile_number'] = trim($inputs['mobile_number']);
        $new_user['name'] = trim($inputs['name']);
        $new_user['id_no'] = trim($inputs['id_no']);
        $new_user['id_expire_date'] = trim($inputs['expire_date']);
        $new_user['date_of_birth'] = trim($inputs['date_of_birth']);


        $service_result = Curl::create()->post('new-user-registration',$new_user,["Content-Type" => "multipart/form-data"]);
        $service_result = json_decode($service_result->contents,true);

        if ($service_result['message'] !== 'Success') {
            Session::flash('message', $service_result['reason']);
            Session::flash('alert-class', 'danger');
            return redirect()->back()->withInput();
        }
        Session::flash('registration-message', 'Please check your SMS inbox to get password');

        return redirect()->route('login');
    }
    public function showUserScanInformationFrom()
    {

        $rndvalue = session('rndValue');
        $imgList = session('rndimges');
        return view('static.registration-verification', compact('rndvalue','imgList'));
    }
    public function postScan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_photo' => 'required',
            'address' => 'required',
            'post_code' => 'required|numeric',
            'occupation' => 'required',
            'scan' => 'required',
            'date_of_birth' => 'required',
            'country' => 'required',
            'gender' => 'required',
            'marrital_status' => 'required',
            'state' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator) ->withInput();
        }
        $inputs = $request->all();
        $new_user = [];
        $new_user['post_code'] = $inputs['post_code'];
        $new_user['occupation'] = $inputs['occupation'];
        $new_user['date_of_birth'] = $inputs['date_of_birth'];
        $new_user['present_address'] = $inputs['address'];
        $new_user['mobile_number'] = $inputs['mobile_number'];
        $new_user['name'] = $inputs['user_name'];
        $new_user['fname'] = $inputs['fname'];
        $new_user['lname'] = $inputs['lname'];
        $new_user['father_name'] = 'Not Set';
        $new_user['mother_name'] = 'Not Set';
        $new_user['permanent_address'] = 'Not Set';
        $new_user['id_type'] = $inputs['id_type'];
        $new_user['id_no'] = $inputs['id_no'];
        $new_user['id_expire_date'] = $inputs['expire_date'] ?? 0;
        $new_user['country'] = $inputs['country'];
        $new_user['date_of_birth'] = $inputs['date_of_birth'] ?? '';
        $new_user['gender'] = $inputs['gender'];
        $new_user['marrital_status'] = $inputs['marrital_status'];
        $new_user['state'] = $inputs['state'];
        $new_user['active'] = 1;

        $new_user['profile_photo'] = uploadDocuments($request->file('profile_photo'),'profile_photo',$new_user['mobile_number']);
        $new_user['scan'] = uploadDocuments($request->file('scan'),'scan',$new_user['mobile_number']);
        if (isset($inputs['scan_one'])) {
            $new_user['scan_one'] = uploadDocuments($request->file('scan_one'),'scan_one',$new_user['mobile_number']);
        } else {
            $new_user['scan_one'] = '';
        }
        $service_result = Curl::create()->post('new-user-registration',$new_user,["Content-Type" => "multipart/form-data"]);
        $service_result = json_decode($service_result->contents,true);

        if ($service_result['message'] !== 'Success') {
            Session::flash('message', $service_result['reason']);
            Session::flash('alert-class', 'danger');
            return redirect()->back()->withInput();
        }
        \File::delete($new_user['profile_photo']->postname);
        \File::delete($new_user['profile_photo']->postname);
        if (isset($inputs['scan_one'])) {
            \File::delete($new_user['scan_one']->postname);
        }

        Session::flash('registration-message', 'Please check your SMS inbox to get password');

        return redirect()->route('login');

    }

    public function getRemittanceCourrency($id)
    {
        $data = [ 'service_id' => $id ];
        $operators = Http::get('service-rem-currency',$data);
        $operators = parseApiResponse($operators);
        return response()->json($operators['countries']);
    }

    public function calculateRem($id,$amount,$country)
    {
        //$input = $request->all();dd($input);
        $data = [
            'service_id' => $id,
            'service_amount' => $amount,
            'country' =>  $country
        ];
        $output = Http::get('get-rem-charge',$data);
        $output = parseApiResponse($output);

        return response()->json($output);

    }
    public function getReportStatus($id)
    {
        $data = [ 'transId' => $id ];
        $result = Http::get('trans-status',$data);
        $result = parseApiResponse($result);
        return response()->json($result);
    }
}
