<?php namespace App\Http\Controllers;

use App\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Facades\HttpClient\Http;
class AuthenticationController extends Controller
{
    public function attemptLogin(Request $request)
    {
        $inputs = $request->all();
        $inputs['ip'] = \Request::ip();
        $this->validate($request, [
            'mobile_number' => 'required|numeric',
            'password' => 'required',
        ]);

        $result = Http::post('login',$inputs);
        $result = parseApiResponse($result);
        if ($result['message'] === 'success') {
            session([
                'mobile_number' => $result['user']['mobile_number'],
                'first_time' => $result['user']['first_time'],
                'name' => $result['user']['name'],
                'authtoken' => $result['token'],
                'total_points' => $result['total_points'],
                'available_points' => $result['available_points'],
                'is_verified' => $result['user']['is_verified'],
            ]);
            session([
                'extra_permissions' => $result['extra_permissions'],
            ]);

            return redirect()->route('services');
        }
        return redirect()->back()->withErrors([$result['reason']]);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
