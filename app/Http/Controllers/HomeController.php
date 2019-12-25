<?php

namespace App\Http\Controllers;
use App\Facades\HttpClient\Http;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('formSubmitted', [
            'only' => [
                'confirmInternationalTopUpServices',
                'confirmMoneyTransferServices',
                'confirmTopUpServices',
            ],
        ]);

        $this->middleware('purchase.can', [
            'only' => [
                'getPayments',
            ],
        ]);

        $this->middleware('firstTime', ['except' => ['getChangeLogin', 'postChangeLogin']]);
    }
    public function index()
    {
        return $this->loadView('static.welcome');
    }
    public function getTransfer()
    {
        return $this->loadView('transfer.index');
    }

    public function getChangeLogin()
    {
        return $this->loadView('profile.change');
    }
    public function postChangeLogin(Request $request)
    {
        $this->validate($request, [
            'old_pin' => 'required',
        ]);
        $inputs = $request->all();
        if ((string) $inputs['password'] !== '') {
            $data['password'] = $inputs['password'];
        }
        if ((string) $inputs['pin'] !== '') {
            $data['pin'] = $inputs['pin'];
        }
        $data['old_pin'] = $inputs['old_pin'];
        $result = Http::post('change-login',$data);
        $result = parseApiResponse($result);

        if ($result['message'] === 'Success') {
            session()->put('first_time', false);
            return redirect('/services');
        }
        $reason = $result['reason'];
        return redirect()->back()->withErrors($reason);

    }
}
