<?php namespace App\Http\Controllers;

use App\Backend;
use Illuminate\Http\Request;

class GetDocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Backend $backend)
    {
        $inputs = $request->all();

        $clinics = $backend->connect('/api/getdoc/clinics?keyword=' . $inputs['clinic'], false, null, session('authtoken'));
        if (empty($clinics['result'])) {
            return redirect()->back()->withErrors(['No Clinics Found']);
        }

        return $this->loadView('services.service_payment.result', compact('clinics'));
    }

    public function getDocReview(Request $request, Backend $backend)
    {
        $this->validate($request, [
            'clinic_id' => 'required',
            'amount' => 'required',
            'patient_first_name' => 'required',
            'patient_last_name' => 'required',
            'patient_id_number' => 'required',
            'patient_number' => 'required',
        ]);

        $inputs = $request->all();

        $charges = $backend->connect('/api/charges?service_id=' . session('service_id') . '&service_amount=' . $inputs['amount'],
            false, null, session('authtoken'));

        if (isset($charges['result'])) {
            $charges = $charges['result'];
            $clinic_info = explode('|', $inputs['clinic_id']);
            $inputs['clinic_id'] = $clinic_info[0];
            $inputs['clinic_name'] = $clinic_info[1];

            return $this->loadView('services.service_payment.review', compact('inputs', 'charges'));
        }

        return redirect('/services/' . session('service_id'))->withErrors(['Charges are not set']);
    }

    public function getDocConfirm(Request $request, Backend $backend)
    {
        $inputs = $request->all();
        $result = $backend->connect('/api/getdoc/order?' . http_build_query($request->all()), false, null,
            session('authtoken'));

        $data = [
            'pin' => $inputs['pin'],
            'service_id' => session('service_id'),
            'receiver_mobile' => $inputs['patient_number'],
            'service_amount' => $inputs['amount'],
            'clinic_id' => $inputs['clinic_id'],
            'clinic_name' => $inputs['clinic_name'],
            'own_reference_id' => $result['result']['own_reference_id'],
            'transaction_code' => $result['result']['transaction_reference'],
        ];

        if ($result['message'] === 'Success') {
            $service_result = $backend->connect('/api/getdoc/transaction?' . http_build_query($data), false, null,
                session('authtoken'));

            $error_message = $service_result['error_message'] ?? 'Please go back and try again.';
            $service_result = $service_result['result'];

            return $this->loadView('services.service_payment.success', compact('service_result', 'result', 'error_message'));
        }

        return redirect('/services/' . session('service_id'))->withErrors($result['reason']);
    }
}
