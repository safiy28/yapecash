<?php

namespace App\Http\Controllers\Service;

use App\Backend;
use App\Facades\HttpClient\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndoPulsaController extends Controller
{
    private $page;

    public function __construct()
    {
        $this->middleware('auth');
        $this->page = 'services.indo_pulsa';
    }

    public function review(Request $request)
    {
        $this->validate($request, [
            'operator' => 'required',
            'amount' => 'required',
            'receiver_mobile_number' => 'required',
        ]);

        $data = [];
        $inputs = $request->except('_token');
        $inputs['receiver_mobile_number'] = removeDialingCode($inputs['receiver_mobile_number'],'indonesia');

        $operators = Http::get('service-operators',['service_id' => session('service_id')]);
        $operators = parseApiResponse($operators);
        $data['operators'] = $operators['operators'];
        /*$pulsa = explode(':', $inputs['amount']);
        $inputs['amount'] = $pulsa[1];
        $inputs['pulsa_code'] = $pulsa[0];
        session(['pulsa_code' => $inputs['pulsa_code']]);*/
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
        $inputs = $request->except('_token');

        //$inputs['pulsa_code'] = session('pulsa_code');
        $data = [];
        $data['service_id'] = session('service_id');
        $data['service_amount'] = (double) $inputs['amount'];
        $data['receiver_mobile'] = $inputs['receiver_mobile_number'];
        $data['operator'] = $inputs['operator'];
        //$data['pulsa_code'] = $inputs['pulsa_code'];
        $data['pin'] = $inputs['pin'];
        $service_result = Http::post('pulsa-topup',$data);
        $service_result = parseApiResponse($service_result);
        if ($service_result['message'] === 'Success') {
            $service_result = $service_result['result'];
            $input_amount = (double) $inputs['amount'];
            return $this->loadView($this->page.'.success', compact('service_result', 'input_amount', 'data'));
        }


        $operators = Http::get('service-operators',['service_id' => session('service_id')]);
        $operators = parseApiResponse($operators);
        $data['operators'] = $operators['operators'];
        //$inputs['pulsa_code'] = session(['pulsa_code']);
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
        return $this->loadView($this->page.'.review', $data)->with($request->input())->withErrors($service_result['reason']);

        //return redirect('/services/'.session('service_id'))->withErrors($service_result['reason']);
    }
}
