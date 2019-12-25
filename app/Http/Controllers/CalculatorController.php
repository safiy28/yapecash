<?php namespace App\Http\Controllers;

use App\Backend;
use Illuminate\Http\Request;
use Http;
class CalculatorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $services = Http::get('all-services');
        $services = parseApiResponse($services);
        $newData = [
            'topup' => [],
            'remittance' => []
        ];
        foreach ((array) $services['data'] as $key => $value) {
            if ((strpos($value['name'], 'Topup') !== false) || (strpos($value['type'], 'top_up') !== false)) {
                $newData['topup'][] = $value;
            } elseif (strpos($value['type'], 'rec') !== false) {
                $newData['remittance'][] = $value;
            }

        }
        $data['services'] = $newData;
        return view('rates.calculator.index', $data);
    }

    public function getOperators($id)
    {
        $data = [ 'service_id' => $id ];
        $operators = Http::get('service-operators',$data);
        $operators = parseApiResponse($operators);
        return response()->json($operators['operators']);
    }
    public function getCountry($id)
    {
        $data = [ 'service_id' => $id ];
        $operators = Http::get('service-operators',$data);
        $operators = parseApiResponse($operators);
        return response()->json($operators['countries']);
    }
    public function getRemittanceCountry($id)
    {
        $data = [ 'service_id' => $id ];
        $operators = Http::get('service-operators',$data);
        $operators = parseApiResponse($operators);
        return response()->json($operators['countries']);
    }

    public function getTransferModes($id)
    {
        $data = [ 'service_id' => $id ];
        $operators = Http::get('service-operators',$data);
        $operators = parseApiResponse($operators);
        return response()->json($operators['transfer_modes']);
    }
    public function calculate(Request $request)
{
    $input = $request->all();
    $data = [
        'service_id' => isset($input['service']) ? $input['service'] : '',
        'service_amount' => isset($input['amount']) ? $input['amount'] : ''
    ];

    $service = Http::get('service-details',$data);
    $service = parseApiResponse($service);
    if($input['_slug'] == 'rate_charge')
    {
        $data['country'] =  isset($input['country']) ? $input['country'] : '';
        $data['is_only_country'] = true;
        $output = Http::get('calculate-rate',$data);
        $output = parseApiResponse($output);
    }
    else{
        if ($service['service']['short_code'] == 'money')
        {
            $data['country'] =  isset($input['country']) ? $input['country'] : '';
            $data['is_only_country'] = true;
        }
        else{

            $data['operator'] = isset($input['operator']) ? $input['operator'] : '';
            $data['is_only_operator'] = true;
        }

        $operator = Http::get('service-operators',$data);
        $operator = parseApiResponse($operator);

        $output = Http::get('charge',$data);
        $output = parseApiResponse($output);
    }
    if ((string) $service['message'] === 'success') {
        $service = $service['service'];
    }

    return view('rates.calculator.review', compact('input', 'operator', 'service', 'output'));
}
}
