<?php

namespace App\Http\Controllers\Service;

use App\Facades\HttpClient\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipientServicesController extends Controller
{
    private $page;

    public function __construct()
    {
        $this->middleware('auth');
        $this->page = 'services.recipient';
    }

    public function verify(Request $request) {

        $inputs = $request->except('_token');

        $this->validate($request, [
            'transfer_type' => 'required',
            'amount' => 'required',
            'sender_mobile_number' => 'required',
            'country' => 'required'
        ]);
        $data = [];
        if($inputs['sender_mobile_number'] == 'other'){
            $inputs['sender_mobile_number'] = $inputs['other_mobile_number'];
        }else{
            $inputs['sender_mobile_number'] = $inputs['sender_mobile_number'];
        }
        session(['recipient_inputs' => $inputs]);
        $isStatAvailableInputs = [
            'service_id' => session('service_id'),
            'service_amount' => (double) $inputs['amount'],
            'country' => $inputs['country']
        ];
        $resultInputs = ['user_mobile' => $inputs['sender_mobile_number']];
        $result = Http::get('user',$resultInputs);
        $result = parseApiResponse($result);
        if (!$result['found']) {
            return redirect()->back()->withErrors(['No User found with ' . $inputs['sender_mobile_number'] . ' id']);
        }
        $isStatAvailable = Http::get('stat-check',$isStatAvailableInputs);
        $isStatAvailable = parseApiResponse($isStatAvailable);

        $user = $result;
        $countryInputs = ['service_id' => session('service_id')];
        $countries = Http::get('country',$countryInputs);
        $countries = parseApiResponse($countries);
        $recipientInputs = ['sender_mobile' => $inputs['sender_mobile_number'],
            'transfer_type' => $inputs['transfer_type']
            ];
        $recipients = Http::get('user-recipients',$recipientInputs);
        $recipients = parseApiResponse($recipients);
        //$recipients = $recipients['recipients'];
        //$countries = $countries['countries'];
        $chargeCalculationInputs = [
            'country' => $inputs['country'],
            'service_id' => session('service_id'),
            'service_amount' => (double) $inputs['amount']

        ];
        $charges = Http::get('charge',$chargeCalculationInputs);
        $charges = parseApiResponse($charges);
        $charges['result']['old_amount'] = $inputs['amount'];
        $service_result = $charges['result'];
        $data['user'] = $user;
        $data['countries'] = $countries['countries'];
        $data['recipients'] = $recipients['recipients'];
        $data['charges'] = $service_result;
        $data['isStatAvailable'] = $isStatAvailable;

        session(['recipient_charges' => $service_result]);
        session(['recipient_user' => $user]);

        if(!$isStatAvailable['status']){
            return $this->loadView($this->page.'.verify', $data)->with($inputs)->withErrors([$isStatAvailable['message']]);
        }
        return $this->loadView($this->page.'.verify', $data)->with($inputs);
    }
    public function calculateAuWalletPoint($id,$amount,$transferType)
    {
        $data = [
            'service_id' => $id,
            'service_amount' => $amount,
            'transfer_type' => $transferType
        ];
        $output = Http::get('charge',$data);
        $output = parseApiResponse($output);

        return response()->json($output);

    }

    public function review(Request $request) {

        $inputs = $request->except('_token');
        $this->validate($request, [
            'recipient_id' => 'required'
        ]);
        $data = [];
        $recipient_input = session('recipient_inputs');

        $recipient_input['recipient_id'] = $inputs['recipient_id'];
        $recipientInputs = ['sender_mobile' => $recipient_input['sender_mobile_number'],
            'recipient_id' => $recipient_input['recipient_id']
        ];
        $recipients = Http::get('user-recipient',$recipientInputs);
        $recipients = parseApiResponse($recipients);

        session(['recipient_inputs' => $recipient_input]);

        $data['recipient'] = $recipients['recipient'];
        $data['charges'] = session('recipient_charges');
        return $this->loadView($this->page.'.review', $data)->with($inputs);
    }

    public function confirm(Request $request) {

        $inputs = $request->except('_token');

        $this->validate($request, [
            'pin' => 'required',
            'purpose' => 'required'
        ]);

        $inputs['purpose'] = str_replace(' ', '_', $inputs['purpose']);
        $recipient_inputs = session('recipient_inputs');
        $data = [];

        $data['country'] = $recipient_inputs['country'];
        $data['service_id'] = session('service_id');
        $data['sender_mobile_number'] = $recipient_inputs['sender_mobile_number'];
        $data['transfer_type'] = $recipient_inputs['transfer_type'];
        $data['service_amount'] = (double) $recipient_inputs['amount'];
        $data['recipient_id'] = $recipient_inputs['recipient_id'];
        $data['pin'] = $inputs['pin'];
        $data['purpose'] = $inputs['purpose'];


        $service_result = Http::post('recipient-service-transfer',$data);
        $service_result = parseApiResponse($service_result);

        if ($service_result['message'] === 'Success') {

            $metrorecipient = $service_result['metrorecipient'];
            $service_result = $service_result['result'];
            $input_amount = $recipient_inputs['amount'];

            session()->forget('recipient_inputs');
            session()->forget('recipient_charges');
            session()->forget('recipient_user');
            return $this->loadView($this->page.'.success',compact('service_result', 'input_amount', 'metrorecipient','data'));
        }


        $recipientInputs = ['sender_mobile' => $recipient_inputs['sender_mobile_number'],
            'transfer_type' => $recipient_inputs['transfer_type'],
            'recipient_id' => $recipient_inputs['recipient_id']
        ];
        $recipients = Http::get('user-recipient',$recipientInputs);
        $recipients = parseApiResponse($recipients);

        $data['recipient'] = $recipients['recipient'];
        $data['charges'] = session('recipient_charges');//dd($data);
        return $this->loadView($this->page.'.review', $data)->withErrors($service_result['reason']);
    }

    public function verifyRecipientWalletServices(Request $request){
        $inputs = $request->except('_token');
        $this->validate($request, [
            'transfer_type' => 'required ',
            'amount' => 'required | numeric',
            'sender_mobile_number' => 'required'
        ]);

        $data = [];
        if($inputs['sender_mobile_number'] == 'other'){
            $inputs['sender_mobile_number'] = $inputs['other_mobile_number'];
        }else{
            $inputs['sender_mobile_number'] = $inputs['sender_mobile_number'];
        }
        $inputs['recipient_wallet'] = true;
        session(['recipient_inputs' => $inputs]);
        $isStatAvailableInputs = [
            'service_id' => session('service_id'),
            'service_amount' => (double) $inputs['amount']
        ];
        $resultInputs = ['user_mobile' => $inputs['sender_mobile_number']];
        $result = Http::get('user',$resultInputs);
        $result = parseApiResponse($result);
        if (!$result['found']) {
            return redirect()->back()->withErrors(['No User found with ' . $inputs['sender_mobile_number'] . ' id']);
        }
        $isStatAvailable = Http::get('stat-check',$isStatAvailableInputs);
        $isStatAvailable = parseApiResponse($isStatAvailable);

        $user = $result;
        $modesInputs = ['service_id' => session('service_id'),'transfer_type' => $inputs['transfer_type']];
        $modes = Http::get('transfer-modes',$modesInputs);
        $modes = parseApiResponse($modes);
        $modes = $modes['transfer_modes'];
        //$modes = $backend->connect("/api/transfer-modes?service_id=" . session('service_id'), false, NULL, session('token'));
        $recipientInputs = ['sender_mobile' => $inputs['sender_mobile_number'],
            'transfer_type' => 'wallet'
        ];
        $recipients = Http::get('user-recipients',$recipientInputs);
        $recipients = parseApiResponse($recipients);
        $chargeCalculationInputs = [
            'transfer_type' => $inputs['transfer_type'],
            'service_id' => session('service_id'),
            'service_amount' => (double) $inputs['amount']

        ];
        $charges = Http::get('charge',$chargeCalculationInputs);
        $charges = parseApiResponse($charges);
        $charges['result']['old_amount'] = $inputs['amount'];
        $service_result = $charges['result'];
        $data['user'] = $user;
        $data['transfer_modes'] = $modes;
        $data['recipients'] = $recipients['recipients'];
        $data['charges'] = $service_result;
        $data['isStatAvailable'] = $isStatAvailable;

        session(['transfer_modes' => $modes]);
        session(['recipient_charges' => $service_result]);
        session(['recipient_user' => $user]);

        if(!$isStatAvailable['status']){
            return $this->loadView('services.recipient.recipient_wallet.verify', $data)->with($inputs)->withErrors([$isStatAvailable['message']]);
        }
        return $this->loadView('services.recipient.recipient_wallet.verify', $data)->with($inputs);
    }

    public function reviewRecipientWalletServices(Request $request) {

        $inputs = $request->except('_token');
        $this->validate($request, [
            'recipient_id' => 'required'
        ]);
        $data = [];
        $recipient_input = session('recipient_inputs');

        $recipient_input['recipient_id'] = $inputs['recipient_id'];
        $recipientInputs = ['sender_mobile' => $recipient_input['sender_mobile_number'],
            'recipient_id' => $recipient_input['recipient_id']
        ];
        $recipients = Http::get('user-recipient',$recipientInputs);
        $recipients = parseApiResponse($recipients);

        $purpose_source = Http::get('remittance-purpose-source');
        $purpose_source = parseApiResponse($purpose_source);

        session(['recipient_inputs' => $recipient_input]);

        $data['recipient'] = $recipients['recipient'];
        $data['remittance_purposes'] = $purpose_source['remittance_purpose'];
        $data['fund_sources'] = $purpose_source['fund_source'];
        $data['charges'] = session('recipient_charges');

        return $this->loadView("services.recipient.recipient_wallet.review", $data)->with($inputs);
    }

    public function confirmRecipientWalletServices(Request $request)
    {
        $inputs = $request->except('_token');

        $this->validate($request, [
            'pin' => 'required',
            'purpose' => 'required',
            'wallet_no' => 'required',
            'source_fund' => 'required'
        ]);

        $inputs['purpose'] = str_replace(' ', '_', $inputs['purpose']);
        $inputs['source_fund'] = str_replace(' ', '_', $inputs['source_fund']);
        $recipient_inputs = session('recipient_inputs');
        $data = [];

        //$data['transfer_type'] = $recipient_inputs['transfer_type'];
        $data['service_id'] = session('service_id');
        $data['sender_mobile_number'] = $recipient_inputs['sender_mobile_number'];
        $data['transfer_type'] = $recipient_inputs['transfer_type'];
        $data['service_amount'] = (double) $recipient_inputs['amount'];
        $data['recipient_id'] = $recipient_inputs['recipient_id'];
        $data['pin'] = $inputs['pin'];
        $data['purpose'] = $inputs['purpose'];
        $data['wallet_no'] = $inputs['wallet_no'];
        $data['source_fund'] = $inputs['source_fund'];


        $service_result = Http::post('wallet-service-transfer',$data);
        $service_result = parseApiResponse($service_result);

        if ($service_result['message'] === 'Success') {
            $metrorecipient = $service_result['metrorecipient'];
            $service_result = $service_result['result'];
            $input_amount = $recipient_inputs['amount'];

            session()->forget('recipient_inputs');
            session()->forget('recipient_charges');
            session()->forget('recipient_user');
            session()->forget('recipient_wallet');
            session()->forget('transfer_modes');
            return $this->loadView('services.recipient.recipient_wallet.success', compact('service_result', 'input_amount','data','metrorecipient'))->with($inputs);
        }


        $recipientInputs = ['sender_mobile' => $recipient_inputs['sender_mobile_number'],
            'recipient_id' => $recipient_inputs['recipient_id']
        ];
        $recipients = Http::get('user-recipient',$recipientInputs);
        $recipients = parseApiResponse($recipients);
        $purpose_source = Http::get('remittance-purpose-source');
        $purpose_source = parseApiResponse($purpose_source);
        $data['recipient'] = $recipients['recipient'];
        $data['remittance_purposes'] = $purpose_source['remittance_purpose'];
        $data['fund_sources'] = $purpose_source['fund_source'];
        $data['charges'] = session('recipient_charges');
        return $this->loadView("services.recipient.recipient_wallet.review", $data)->with($inputs)->withErrors($service_result['reason']);


    }
}
