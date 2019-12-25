<?php

namespace App\Http\Controllers;

use App\Facades\HttpClient\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipientController extends Controller
{
    private $page;

    public function __construct()
    {
        $this->middleware('auth');
        $this->page = 'users.recipients';
    }

    public function createInsideRecipient($user_id)
    {
        //return $this->page.'.insidecreate';
        $data['user_id'] = $user_id;
       return $this->loadView($this->page.'.insidecreate',$data);
    }
    public function getRecipienrBank(Request $request) {

        $input = $request->only('country');
        $data = [];
        $data['country'] = $input['country'];
        $result = Http::get('recipient-bank',$data);
        return $result = parseApiResponse($result);//dd($result);
    }
    public function getRecipienrBankBranch(Request $request) {

        $input = $request->only('bank');
        $data = [];
        $data['bank'] = $input['bank'];
        $result = Http::get('recipient-bank-branch',$data);
        return $result = parseApiResponse($result);//dd($result);
    }
    public function postInsideRecipient($user_id,Request $request)
    {
        $data = [];
        $inputs = $request->except('_token');
        if ($request->input('transfer_type') == 'bank'){
            $this->validate($request,[
                'name'=>'required|string|min:1|max:255',
                'relation'=>'required',
                'phone'=>'required',
                'country'=>'required',
                'bank_name'=>'required',
                'bank_ac_no'=>'required',
                'branch_name'=>'required',
                'transfer_type' => 'required',
                'active'=>'required'
            ]);
            $data['bank_name'] = $inputs['bank_name'];
            $data['bank_ac_no'] = $inputs['bank_ac_no'];
            $data['branch_name'] = $inputs['branch_name'];
        } elseif ($request->input('transfer_type') == 'cash'){
            $this->validate($request,[
                'name'=>'required|string|min:1|max:255',
                'relation'=>'required',
                'country'=>'required',
                'phone'=>'required',
                'transfer_type' => 'required',
                'active'=>'required'
            ]);
            $data['bank_name'] = '';
            $data['bank_ac_no'] = '';
            $data['branch_name'] = '';
        }
        $data['name'] = $inputs['name'];
        $data['relation'] = $inputs['relation'];
        $data['phone'] = str_replace('+', '', $inputs['phone']);
        $data['transfer_type'] = $inputs['transfer_type'];
        $data['country'] = $inputs['country'];
        $data['bank_type'] = $inputs['bank_type'];
        $data['active'] = $inputs['active'];
        $data['user_id'] = $user_id;
        $service_result = Http::post('create-recipients',$data);
        $service_result = parseApiResponse($service_result);

        if($service_result['message']=="Success")
        {
            return redirect('users/recipientaddsuccess');
        }
        else {
            return redirect()->back()->withErrors($service_result['reason']);
        }
    }

    public function recipientaddsuccess()
    {
        $data = [];
        $inputs = session('recipient_inputs');
        $data['inputs'] = $inputs;
        if(isset($inputs['recipient_wallet'])){

            return $this->loadView('services.recipient.recipient_wallet.addsuccess',$data);

        }
        return $this->loadView('services.recipient.addsuccess',$data);

    }

    public function createRecipient($user_id)
    {
        $data['user_id'] = $user_id;
        return $this->loadView($this->page.'.create',$data);
        //return view('users.recipients.create',compact('user_id'));
    }

    public function postRecipient($user_id, Request $request)
    {
        $data = [];
        $inputs = $request->except('_token');
        if ($request->input('transfer_type') == 'bank'){
            $this->validate($request,[
                'name'=>'required|string|min:1|max:255',
                'relation'=>'required',
                'phone'=>'required',
                'country'=>'required',
                'bank_name'=>'required',
                'bank_ac_no'=>'required',
                'branch_name'=>'required',
                'transfer_type' => 'required',
                'active'=>'required'
            ]);
            $data['bank_name'] = $inputs['bank_name'];
            $data['bank_ac_no'] = $inputs['bank_ac_no'];
            $data['branch_name'] = $inputs['branch_name'];

        } elseif ($request->input('transfer_type') == 'cash' || $request->input('transfer_type') == 'wallet'){
            $this->validate($request,[
                'name'=>'required|string|min:1|max:255',
                'relation'=>'required',
                'country'=>'required',
                'phone'=>'required',
                'transfer_type' => 'required',
                'active'=>'required'
            ]);
            $data['bank_name'] = '';
            $data['bank_ac_no'] = '';
            $data['branch_name'] = '';
        }

        $data['name'] = $inputs['name'];
        $data['relation'] = $inputs['relation'];
        $data['phone'] = str_replace('+', '', $inputs['phone']);
        $data['transfer_type'] = $inputs['transfer_type'];
        $data['country'] = $inputs['country'];
        $data['bank_type'] = $inputs['bank_type'];
        $data['active'] = $inputs['active'];
        $data['user_id'] = $user_id;

        $service_result = Http::post('create-recipients',$data);
        $service_result = parseApiResponse($service_result);

        if ($service_result['message'] === 'Success') {
                return redirect('/profile/recipients');

        }

        return redirect()->back()->withErrors($service_result['reason']);
    }

    public function getRecipient($user_id,$recip_id)
    {
        $data = [];
        $data['user_id'] = $user_id;
        $data['recip_id'] = $recip_id;
        $service_result = Http::get('recipient',$data);
        $service_result = parseApiResponse($service_result);

        if ($service_result['message'] === 'Success') {
            $result['recipient'] = $service_result['recipient'];
            return $this->loadView($this->page.'.edit',$result);
            //return view('users.recipients.edit',compact('recipient'));
        }

        return redirect()->back();
    }

    public function updateRecipient($user_id, $recip_id, Request $request)
    {
        $data = [];
        $inputs = $request->except('_token');
        if ($request->input('transfer_type') == 'bank'){
            $this->validate($request,[
                'name'=>'required|string|min:1|max:255',
                'relation'=>'required',
                'phone'=>'required',
                'country'=>'required',
                'bank_name'=>'required',
                'bank_ac_no'=>'required',
                'branch_name'=>'required',
                'transfer_type' => 'required',
                'active'=>'required'
            ]);
            $data['bank_name'] = $inputs['bank_name'];
            $data['bank_ac_no'] = $inputs['bank_ac_no'];
            $data['branch_name'] = $inputs['branch_name'];
        } elseif ($request->input('transfer_type') == 'cash'){
            $this->validate($request,[
                'name'=>'required|string|min:1|max:255',
                'relation'=>'required',
                'country'=>'required',
                'phone'=>'required',
                'transfer_type' => 'required',
                'active'=>'required'
            ]);
            $data['bank_name'] = '';
            $data['bank_ac_no'] = '';
            $data['branch_name'] = '';
        }
        $data['name'] = $inputs['name'];
        $data['relation'] = $inputs['relation'];
        $data['phone'] = str_replace('+', '', $inputs['phone']);
        $data['transfer_type'] = $inputs['transfer_type'];
        $data['country'] = $inputs['country'];
        $data['bank_type'] = $inputs['bank_type'];
        $data['active'] = $inputs['active'];
        $data['user_id'] = $user_id;
        $data['recip_id'] = $recip_id;

        $service_result = Http::post('edit-recipient',$data);
        $service_result = parseApiResponse($service_result);

        if ($service_result['message'] === 'Success') {
            return redirect('/profile/recipients');

        }

        return redirect()->back()->withErrors($service_result['reasons']);
    }

    public function deleteRecipient($user_id, $recip_id)
    {
        $data = [];
        $data['user_id'] = $user_id;
        $data['recip_id'] = $recip_id;
        $service_result = Http::get('delete-recipient',$data);
        $service_result = parseApiResponse($service_result);
        if ($service_result['message'] === 'Success') {
            return redirect()->back();

        }
        return redirect()->back()->withErrors($service_result['reasons']);
    }
}
