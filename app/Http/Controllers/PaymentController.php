<?php namespace App\Http\Controllers;

use App\Facades\Logger\Log;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('purchase.can', ['only' => ['getPayments']]);
    }

    public function getPayments()
    {
        $payments = Http::get('payments');
        $payments = parseApiResponse($payments);
        if ($payments['message'] === 'success') {
            $payments = $payments['payments'];
            return $this->loadView('purchase.index', compact('payments'));
        }
        return redirect('/logout');
    }

    public function getPayment($id)
    {
        $input = ['payment_id' => $id];
        $banks = Http::get('banks',$input);
        $banks = parseApiResponse($banks);
        $payment = Http::get('payment-details',$input);
        $payment = parseApiResponse($payment);
        $payment = $payment['payment'];
        if ($payment['type'] === 'bank') {
            $banks = $banks['banks'];
        }


        session(['payment_id' => $id]);
        $page = 'purchase.'.$payment['type'];
        return $this->loadView($page.'.index', compact('banks'));
    }

    public function reviewBankPayment(Request $request)
    {
        $inputs = $request->all();

        $this->validate($request, [
            'bank' => 'required',
            'amount' => 'required',
            'slip' => 'required| mimes:jpeg,bmp,png',
        ]);

        $list = explode('.', $inputs['bank']);
        $slip = 'slip-'.date('YmdHis').'.'.$request->file('slip')->getClientOriginalExtension();
        $destination = base_path().'/public/files/uploaded/payment_slips/'.date('Y').'/'.date('F').'/';
        $request->file('slip')->move($destination, $slip);
        $img = url('files'.'/uploaded/payment_slips/'.date('Y').'/'.date('F').'/'.$slip);
        return $this->loadView('purchase.bank.review', compact('inputs', 'img', 'list'));
    }
    public function confirmBankPayment( Request $request)
    {
        $inputs = $request->all();
        $this->validate($request, [
            'bank' => 'required',
            'amount' => 'required',
            'pin' => 'required',
            'slip' => 'required',
        ]);

        $inputs['reference_no'] = session('mobile_number');
        $data = [
            'payment_id' => session('payment_id'),
            'bank_id' => $inputs['bank'],
            'payment_amount' => $inputs['amount'],
            'reference_no' => $inputs['reference_no'],
            'payment_slip' => $inputs['slip'],
            'pin' => $inputs['pin']
        ];

        $service_result = Http::post('payment-confirm',$data);
        $service_result = parseApiResponse($service_result);
        if ($service_result['message'] === 'Success') {
            Session::flash('message', 'your action has been successfully generated.');
            return redirect(route('purchase'));
        }
        $input = ['payment_id' => session('payment_id')];
        $banks = Http::get('banks',$input);
        $banks = parseApiResponse($banks);
        $banks = $banks['banks'];
        $reason = $service_result['reason'];
        return $this->loadView('purchase.bank.review', compact('banks','inputs'))->withErrors($reason);
    }
}
