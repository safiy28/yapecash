<?php

namespace App\Http\Controllers\Service;

use App\Facades\HttpClient\Http;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PointTransferController extends Controller
{
    private $page;

    public function __construct()
    {
        $this->middleware('auth');
        $this->page = 'services.point_transfer';
    }

    public function review(Request $request)
    {
        $inputs = $request->all();

        $this->validate($request, [
            'amount' => 'required',
            'receiver_mobile_number' => 'required',
        ]);

        $input = [
            'user_mobile' => $inputs['receiver_mobile_number'],
            'service_id' => session('service_id'),
            'receiver_mobile' => $inputs['receiver_mobile_number'],
            'service_amount' => (double) $inputs['amount']
        ];
        $user = Http::get('user',$input);
        $user = parseApiResponse($user);
        if(!$user['found']){
            return redirect('services/'.session('service_id'))->withErrors([$user['user_name']]);
        }
        $input['receiver_group_id'] = $user['group']['id'];
        $service_result = Http::get('charge',$input);
        $service_result = parseApiResponse($service_result);
        $service_result = $service_result['result'];
        return $this->loadView('services.point_transfer.review', compact('service_result', 'user','inputs'))->with($inputs);

    }
    public function confirm(Request $request)
    {
        $inputs = $request->all();

        $this->validate($request, [
            'amount' => 'required',
            'receiver_mobile_number' => 'required',
            'pin' => 'required',
        ]);
        $data = [];
        $data['service_id'] = session('service_id');
        $data['service_amount'] = $inputs['amount'];
        $data['receiver_mobile'] = $inputs['receiver_mobile_number'];
        $data['pin'] = $inputs['pin'];
        $result = Http::post('point-transfer',$data);
        $result = parseApiResponse($result);
        if ($result['message'] === 'Success') {
            $service_result = $result['result'];
            $service_result['success'] = true;

            $input_amount = (double) $request->input('amount');
            return $this->loadView($this->page . '.success', compact('service_result', 'input_amount', 'data'));
        }
        $input = [
            'user_mobile' => $inputs['receiver_mobile_number'],
            'service_id' => session('service_id'),
            'receiver_mobile' => $inputs['receiver_mobile_number'],
            'service_amount' => $inputs['amount']
        ];
        $user = Http::get('user',$input);
        $user = parseApiResponse($user);
        if(!$user['found']){
            return redirect('services/'.session('service_id'))->withErrors([$user['user_name']]);
        }
        $input['receiver_group_id'] = $user['group']['id'];
        $service_result = Http::get('charge',$input);
        $service_result = parseApiResponse($service_result);
        $service_result = $service_result['result'];
        return $this->loadView('services.point_transfer.review', compact('service_result', 'user','inputs'))->withErrors($result['reason']);
    }
}
