<?php namespace App\Http\Controllers;

use App\Backend;
use Illuminate\Http\Request;

class MerchantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('merchant');
    }

    public function payRequest()
    {
        return $this->loadView('merchants.payrequest');
    }

    public function postPayRequest(Request $request, Backend $backend)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
        ]);
        $inputs = $request->all();

        if (!isset($inputs['reference'])) {
            $inputs['reference'] = 'No+reference';
        }

        $service_result = $backend->connect('/api/pay-request?amount=' . $inputs['amount'] . '&reference=' . $inputs['reference'], false, null, session('authtoken'));

        if ($service_result['message'] === 'Success') {
            return $this->loadView('merchants.success');
        }

        return redirect()->back()->withErrors($service_result['reason']);
    }
}
