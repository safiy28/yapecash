<?php

namespace App\Http\Controllers\Service;

use App\Backend;
use App\Facades\HttpClient\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MalaysiaTopupController extends Controller
{
    private $page;

    public function __construct()
    {
        $this->middleware('auth');
        $this->page = 'services.malaysia_topup';
    }

    public function review(Request $request)
    {
        $this->validate($request, [
            'operator' => 'required',
            'amount' => 'required|numeric',
            'receiver_mobile_number' => 'required_unless:self_number,1',
        ]);

        $data = [];
        $inputs = $request->except('_token');
        $inputs['receiver_mobile_number'] = removeDialingCode($inputs['receiver_mobile_number'],'malaysia');
        if($request->has('self_number')){
            $receiver_mobile_number = session('mobile_number') ;
            session()->put('receiver_mobile_number', $receiver_mobile_number);
        }else{
            session()->forget('receiver_mobile_number');
        }

        $operators = Http::get('service-operators',['service_id' => session('service_id')]);
        $operators = parseApiResponse($operators);
        $data['operators'] = $operators['operators'];

        $chargeCalculationInputs = [
            'service_id' => session('service_id'),
            'receiver_mobile' => session('receiver_mobile_number'),
            'service_amount' => (double) $inputs['amount'],
            'operator' => $inputs['operator']
        ];
        $charges = Http::get('charge',$chargeCalculationInputs);
        $charges = parseApiResponse($charges);
        $charges['result']['old_amount'] = $inputs['amount'];
        $data['charges'] = $charges['result'];

        if ($charges['result']['balance_exceeded'] === true) {
            return redirect()->back()->withErrors('You do not have enough Available Points');
        }
        return $this->loadView($this->page.'.review', $data)->with($inputs);
    }

    public function confirm(Request $request)
    {
        $this->validate($request, [
            'operator' => 'required',
            'amount' => 'required',
            'receiver_mobile_number' => 'required',
            'pin' => 'required',
        ]);
        $data = [];
        $input_amount = (double) $request->input('amount');
        $data['service_id'] = session('service_id');
        $data['service_amount'] = (double) $request->input('amount');
        $data['receiver_mobile'] = $request->input('receiver_mobile_number');
        $data['operator'] = $request->input('operator');
        $data['pin'] = $request->input('pin');
        $service_result = Http::post('malaysia-topup',$data);
        $service_result = parseApiResponse($service_result);
        if ($service_result['message'] === 'Success') {
            $service_result = $service_result['result'];
            return $this->loadView($this->page . '.success', compact('service_result', 'input_amount', 'data'));
        }

        $operators = Http::get('service-operators',['service_id' => session('service_id')]);
        $operators = parseApiResponse($operators);
        $data['operators'] = $operators['operators'];

        $chargeCalculationInputs = [
            'service_id' => session('service_id'),
            'receiver_mobile' => session('receiver_mobile_number'),
            'service_amount' =>  $input_amount,
            'operator' => $request->input('operator')
        ];
        $charges = Http::get('charge',$chargeCalculationInputs);
        $charges = parseApiResponse($charges);
        $charges['result']['old_amount'] = $input_amount;
        $data['charges'] = $charges['result'];

        return $this->loadView($this->page.'.review', $data)->with($request->input())->withErrors($service_result['reason']);

        //return redirect('/services/' . session('service_id'))->withErrors($service_result['reason']);
    }
}
