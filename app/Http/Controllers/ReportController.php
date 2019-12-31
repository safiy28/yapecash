<?php namespace App\Http\Controllers;

use App\Backend;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Facades\HttpClient\Http;
use Illuminate\Support\Facades\Validator;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('purchase.can', [
            'only' => [
                'getPaymentReport',
            ]
        ]);
    }

    public function getReport(Request $request)
    {
        $inputs = $request->all();
        $from = $inputs['from'] ?? Carbon::now()->subDays(30)->toDateString();
        $to = $inputs['to'] ?? Carbon::now()->toDateString();
        $page = $inputs['page'] ?? null;
        $word = $inputs['word'] ?? null;
        $data = [
            'page' => $page,
            'to'    => $to,
            'from' => $from,
            'word' => $word
        ];
        $result = Http::post('user-reports',$data);
        $reports = parseApiResponse($result);

        $page_info['last_page'] = $reports['last_page'];
        $page_info['current_page'] = $reports['current_page'];
        $page_info['next_page'] = null !== $reports['next_page_url'];
        $page_info['prev_page'] = null !== $reports['prev_page_url'];
        $reports = $reports['data'] ? $reports['data'] : [];

        return $this->loadView('report.index', compact('reports', 'page_info', 'to', 'from', 'word'));
    }

    public function getAccountReport(Request $request)
    {
        $inputs = $request->all();
        $from = $inputs['from'] ?? Carbon::now()->toDateString();
        $to = $inputs['to'] ?? Carbon::now()->toDateString();
        $page = $inputs['page'] ?? null;
        $word = $inputs['word'] ?? null;
        $query = '';

        if ($page) {
            $query = $query . 'page=' . $page . '&';
        }
        if ($to) {
            $query = $query . 'to=' . $to . '&';
        }
        if ($from) {
            $query = $query . 'from=' . $from . '&';
        }
        if ($word) {
            $query = $query . 'word=' . $word;
        }
        $result = Http::post('account-top-up-reports',$query);
        $reports = parseApiResponse($result);
        $page_info['last_page'] = $reports['last_page'] ?? 0;
        $page_info['current_page'] = $reports['current_page'] ?? 0;
        $page_info['next_page'] = $reports['next_page_url'] ?? null;
        $page_info['prev_page'] = $reports['prev_page_url'] ?? null;
        $reports = $reports['data'] ?? [];
        return $this->loadView('report.account', compact('reports', 'page_info', 'to', 'from', 'word'));
    }


    public function msp()
    {
        return $this->loadView('report.msp.index');
    }

    public function postMsp(Request $request)
    {
        if (session('extra_permissions')['msp_view']) {
            $inputs = $request->all();
            $mobile = $inputs['mobile'];
            $result = Http::post('msp-reports',$inputs);
            $result = parseApiResponse($result);
            if ($result['message'] === 'Success') {
                $user = $result['user'];
                $point = $result['point'];
                $profile = $result['profile'];
                $group = $result['group'];
                $logininfo = $result['login_info'];
                $reports = $result['bank'];
                $transactions = $result['transaction'];

                foreach ($transactions as $transaction) {
                    $transaction['amount'] = $float = (float)$transaction['amount'];
                    $transaction['after'] = $float = (float)$transaction['after'];
                }
                $parent = $result['parent'];
                return $this->loadView('report.msp.details', compact('mobile', 'user', 'point', 'profile', 'logininfo', 'reports', 'transactions', 'parent', 'group'));
            }
            return $this->loadView('report.msp.error');
        }
        return redirect()->back();
    }
    public function mspRiskProfileUpdate(Request $request){
        $data = [];
        if (session('extra_permissions')['msp_update']) {
            $inputs = $request->all();
            $result = Http::post('msp-risk-update',$inputs);
            $result = parseApiResponse($result);
            if ($result['message'] === 'Success') {
                $data['status'] = "Success";
                $data['message'] = "Success";
                $data['statusResponse'] = $result['status'];
                $data['risk_profile_color'] = $result['risk_profile_color'];

            }
            else{
                $data['status'] = "Failed";
                $data['message'] = $result['reason'];
            }
            return response()->json($data);
        }
        $data['status'] = "failed";
        $data['message'] = "You have not enough permission to update MSP risk profile.";
        return response()->json($data);
    }
    public function mspStatusUpdate(Request $request){
        $data = [];
        if (session('extra_permissions')['msp_update']) {
            $inputs = $request->all();
            $result = Http::post('msp-status-update',$inputs);
            $result = parseApiResponse($result);
            if ($result['message'] === 'Success') {
                $data['status'] = "Success";
                $data['message'] = "Success";
                $data['statusResponse'] = $result['status'];
            }
            else{
                $data['status'] = "Failed";
                $data['message'] = $result['reason'];
            }
            return response()->json($data);
        }
        $data['status'] = "failed";
        $data['message'] = "You have not enough permission to update MSP status.";
        return response()->json($data);
    }
    public function mspPasswordReset(Request $request){
        $validation = Validator::make($request->all(), [
            'pin' => 'bail|required',
        ]);
        if($validation->fails()){
            $error =  $validation->errors()->getMessageBag()->first();
            $data['status'] = "Failed";
            $data['message'] = $error;
            return response()->json($data);
        }
        $data = [];
        if (session('extra_permissions')['msp_update']) {
            $inputs = $request->all();
            $result = Http::post('msp-password-reset',$inputs);
            $result = parseApiResponse($result);
            if ($result['message'] === 'Success') {
                $data['status'] = "Success";
                $data['message'] = "Success";
            }
            else{
                $data['status'] = "Failed";
                $data['message'] = $result['reason'];
            }
            return response()->json($data);
        }
        $data['status'] = "Failed";
        $data['message'] = "You have not enough permission to update MSP password.";
        return response()->json($data);
    }
    public function mspPasswordUpdate(Request $request){
        $validation = Validator::make($request->all(), [
            'pin' => 'bail|required',
            'password' => 'required|confirmed|min:6',
        ]);
        if($validation->fails()){
            $error =  $validation->errors()->getMessageBag()->first();
            $data['status'] = "Failed";
            $data['message'] = $error;
            return response()->json($data);
        }
        $data = [];
        if (session('extra_permissions')['msp_update']) {
            $inputs = $request->all();
            $result = Http::post('msp-password-update',$inputs);
            $result = parseApiResponse($result);
            if ($result['message'] === 'Success') {
                $data['status'] = "Success";
                $data['message'] = "Success";
            }
            else{
                $data['status'] = "Failed";
                $data['message'] = $result['reason'];
            }
            return response()->json($data);
        }
        $data['status'] = "Failed";
        $data['message'] = "You have not enough permission to update MSP password.";
        return response()->json($data);
    }
    public function userSalesReport(Request $request)
    {
        $inputs = $request->all();
        $from = $inputs['from'] ?? null;
        $to = $inputs['to'] ?? null;
        $query = '';
        if ($to) {
            $query = $query . 'to=' . $to . '&';
        }
        if ($from) {
            $query = $query . 'from=' . $from . '&';
        }
        $reports = Http::post('user-sales-report',$query);
        $reports = parseApiResponse($reports);
        if ($reports['message'] === 'Success') {
            $names = $reports['service_names'];
            $totals = $reports['service_totals'];
            $reports = $reports['sales_report'];
            return $this->loadView('report.sales', compact('reports', 'from', 'to', 'names', 'totals'));
        }
        return redirect()->back()->withErrors($reports['reason']);
    }
    public function getPaymentReport(Request $request)
    {
        $inputs = $request->all();
        $from = $inputs['from'] ?? Carbon::now()->subDays(30)->toDateString();
        $to = $inputs['to'] ?? Carbon::now()->toDateString();
        $page = $inputs['page'] ?? null;
        $word = $inputs['word'] ?? null;
        $data = [
            'page' => $page,
            'to'    => $to,
            'from' => $from,
            'word' => $word
        ];

        $reports = Http::post('payment-reports',$data);
        $reports = parseApiResponse($reports);
        $page_info['last_page'] = $reports['last_page'];
        $page_info['current_page'] = $reports['current_page'];
        $page_info['next_page'] = null !== $reports['next_page_url'];
        $page_info['prev_page'] = null !== $reports['prev_page_url'];
        $reports = $reports['data'] ?: [];
        return $this->loadView('report.payment', compact('reports', 'page_info', 'to', 'from', 'word'));
    }

    public function getReportDetails($id)
    {
        $data = [
            'report_id' => $id
        ];
        $report = Http::post('user-reports-details',$data);
        $report = parseApiResponse($report);
        $report = $report['report'];
        $voucher = null;
        if ($report['service_type'] === 'voucher') {
            $response = $report['note'];
            $response1 = str_replace('<soap:Body>', '', $response);
            $response2 = str_replace('</soap:Body>', '', $response1);
            $parser = simplexml_load_string($response2);
            $voucher = $parser->GetReloadPINResponse;
        }
        return $this->loadView('report.details', compact('report', 'voucher'));
    }

    public function bankReport(Request $request) {

        $inputs = $request->all();
        $from = $inputs['from'] ?? Carbon::now()->toDateString();
        $to = $inputs['to'] ?? Carbon::now()->toDateString();
        $page = $inputs['page'] ?? null;
        $word = $inputs['word'] ?? null;
        $data = [
            'page' => $page,
            'to'    => $to,
            'from' => $from,
            'word' => $word
        ];
        $reports = Http::get('bank-report',$data);//dd($reports);
        $reports = parseApiResponse($reports);
        $page_info['last_page'] = $reports['last_page'];
        $page_info['current_page'] = $reports['current_page'];
        $page_info['next_page'] = null !== $reports['next_page_url'];
        $page_info['prev_page'] = null !== $reports['prev_page_url'];
        $reports = $reports['data'] ?: [];//dd($reports);
        return $this->loadView('report.recipient', compact('reports','page_info', 'to', 'from', 'word'));
    }

    public function recipientReportProcess($id) {

        $data = [
            'id' => $id
        ];

        $report = Http::get('process-recipient-report',$data);
        $report = parseApiResponse($report);//dd($report);
        if ($report['message'] == "Success") {
            $successrefund = $report['successorrefund'];
            $assignorder = $report['assign_order'];
            $own = $report['own'];
            $admin = $report['admin'];
            $t_report = $report['transaction_report'];
            $sender = $report['sender'];
            $rec = $report['rec'];
            $report = $report['report'];
            $report['purpose'] = str_replace('_', ' ', $report['purpose']);

            return $this->loadView('report.process_recipient', compact('report', 'sender', 't_report', 'rec', 'successrefund','assignorder', 'own', 'admin'));
        } else {
            return redirect()->back()->withErrors($report['reason']);
        }
    }

    public function tranglotracker()
    {
        $result = Http::get('tranglo-balance');
        $result = parseApiResponse($result);
        return $this->loadView('report.tranglo_tracker.index', compact('result'));
    }
    public function getTrangloStatus(Request $request) {

        $input = $request->only('gtn');
        $data = [];
        $data['gtn'] = $input['gtn'];
        $result = Http::get('tranglo-status',$data);
        $result = parseApiResponse($result);//dd($result);

        if ($result['status'] == "Success") {
            $trx_status = $result['trx_status'];
            $reports = $result['report'];
            //$rec_report = $result['rec_report'];
            $receiver = $result['receiver'];

            return $this->loadView('report.tranglo_tracker.review', compact('reports','trx_status','receiver'));
        } else {
            return redirect()->back()->withErrors($result['reason']);
        }
    }
    public function getwalletTrangloRate(Request $request) {

        $input = $request->only('id');
        $data = [];
        $data['id'] = $input['id'];
        $result = Http::get('wallet-tranglo-rate',$data);
        return $result = parseApiResponse($result);//dd($result);
    }
    public function recipientReportUpdate($id,Request $request) {

        $this->validate($request, [
            'pin' => 'required',
            'status' => 'required',
            'note' => 'required'
        ]);
        $inputs = $request->all();

        $data = [
            'id' => $id,
            'status' => $inputs['status'],
            'note' => $inputs['note'],
            'assisted_by' => $inputs['assisted_by'],
            'pin' => $inputs['pin']
        ];
        $result = Http::post('update-recipient-report',$data);
        $result = parseApiResponse($result);

        if ($result['message'] == "Success") {
            $redirect = $result['recip_rep']['transfer_mode'] === 'PIN Transfer' ? 'cash' : 'bank';

            return redirect('/' . $redirect . '/reports');
        } else {
            return redirect()->back()->withErrors($result['reason']);
        }
    }

    public function recipientReportRelease($id) {
        $data = [
            'id' => $id
        ];
        $report = Http::get('release-recipient-report',$data);
        $report = parseApiResponse($report);
        $redirect = $report['recip_rep']['transfer_mode'] === 'PIN Transfer' ? 'cash' : 'bank';

        return redirect('/' . $redirect . '/reports');
    }

    public function recipientReportTagUpdate($id, Request $request) {

        $this->validate($request, [
            'tag' => 'required'
        ]);
        $inputs = $request->all();

        $data = [
            'id' => $id,
            'tag' => $inputs['tag']
        ];
        $result = Http::post('tag-update-recipient-report',$data);
        $result = parseApiResponse($result);

        if ($result['message'] == "Success") {
            $redirect = $result['recip_rep']['transfer_mode'] === 'PIN Transfer' ? 'cash' : 'bank';

            return redirect('/' . $redirect . '/reports');
        } else {
            return redirect()->back()->withErrors($result['reason']);
        }
    }

    public function cashReport(Request $request) {

        $inputs = $request->all();
        $from = $inputs['from'] ?? Carbon::now()->toDateString();
        $to = $inputs['to'] ?? Carbon::now()->toDateString();
        $page = $inputs['page'] ?? null;
        $word = $inputs['word'] ?? null;
        $data = [
            'page' => $page,
            'to'    => $to,
            'from' => $from,
            'word' => $word
        ];
        $reports = Http::get('cash-report',$data);
        $reports = parseApiResponse($reports);
        $page_info['last_page'] = $reports['last_page'];
        $page_info['current_page'] = $reports['current_page'];
        $page_info['next_page'] = null !== $reports['next_page_url'];
        $page_info['prev_page'] = null !== $reports['prev_page_url'];
        $reports = $reports['data'] ?: [];
        return $this->loadView('report.cash', compact('reports','page_info', 'to', 'from', 'word'));
    }

    public function recipientWalletReport(Request $request) {

        $inputs = $request->all();
        $from = $inputs['from'] ?? Carbon::now()->toDateString();
        $to = $inputs['to'] ?? Carbon::now()->toDateString();
        $page = $inputs['page'] ?? null;
        $word = $inputs['word'] ?? null;
        $data = [
            'page' => $page,
            'to'    => $to,
            'from' => $from,
            'word' => $word
        ];

        $reports = Http::get('wallet-report',$data);
        $reports = parseApiResponse($reports);
        //dd($reports);
        $page_info['last_page'] = $reports['last_page'];
        $page_info['current_page'] = $reports['current_page'];
        $page_info['next_page'] = null !== $reports['next_page_url'];
        $page_info['prev_page'] = null !== $reports['prev_page_url'];
        $reports = $reports['data'] ?: [];

        return $this->loadView('report.recipient-wallet', compact('reports', 'page_info', 'to', 'from', 'word'));
    }

    public function recipientWalletReportProcess($id) {
        $data = [
            'id' => $id
        ];
        $report = Http::get('process-wallet-report',$data);
        $report = parseApiResponse($report);//dd($report);
        if ($report['message'] == "Success") {
            $successrefund = $report['successorrefund'];
            $assignorder = $report['assign_order'];
            $own = $report['own'];
            $admin = $report['admin'];
            $t_report = $report['transaction_report'];
            $sender = $report['sender'];
            $rec = $report['rec'];
            $report = $report['report'];
            $report['purpose'] = str_replace('_', ' ', $report['purpose']);

            return $this->loadView('report.process-recipient-wallet', compact('report', 'sender', 't_report', 'rec', 'successrefund','assignorder', 'own', 'admin'));
        } else {
            return redirect()->back()->withErrors($report['reason']);
        }
    }

    public function recipientWalletReportUpdate($id,Request $request) {

        $this->validate($request, [
            'pin' => 'required',
            'status' => 'required',
            'note' => 'required'
        ]);
        $inputs = $request->all();

        $data = [
            'id' => $id,
            'status' => $inputs['status'],
            'note' => $inputs['note'],
            'assisted_by' => $inputs['assisted_by'],
            'response_id' => $inputs['response_id'],
            'pin' => $inputs['pin']
        ];
        $result = Http::post('update-wallet-report',$data);
        $result = parseApiResponse($result);

        if ($result['message'] == "Success") {

            return redirect('/recipient/wallet/reports');

        } else {

            return redirect()->back()->withErrors($result['reason']);

        }
    }

    public function recipientWalletReportTagUpdate($id, Request $request) {

        $this->validate($request, [
            'tag' => 'required'
        ]);
        $inputs = $request->all();

        $data = [
            'id' => $id,
            'tag' => $inputs['tag']
        ];
        $result = Http::post('tag-update-wallet-report',$data);
        $result = parseApiResponse($result);

        if ($result['message'] == "Success") {
            return redirect('/recipient/wallet/reports');
        } else {
            return redirect()->back()->withErrors($result['reason']);
        }
    }

    public function recipientWalletReportRelease($id) {

        $data = [
            'id' => $id
        ];
        $report = Http::get('release-wallet-report',$data);
        $report = parseApiResponse($report);

        return redirect('/recipient/wallet/reports');
    }
    public function generateInvoicePrint($id,$flg){
        $data = [
            'id' => $id,
            'flg' => $flg
        ];
        $report = Http::get('get-invoice',$data);
        $report = parseApiResponse($report);//dd($report);
        if ($report['message'] == "Success") {
            $t_report = $report['transaction_report'];
            $sender = $report['sender'];
            $rec = $report['rec'];
            $report = $report['report'];

            return $this->loadView('report.invoice', compact('report', 'sender', 't_report', 'rec'));
        } else {
            return redirect()->back()->withErrors($report['reason']);
        }

    }
}
