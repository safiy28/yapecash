<div class="invoice">
    {{session()->forget('form_submitted')}}
    @if($service_result['success'])
        <h2>Invoice # {{$service_result['transaction_no']}}</h2>
        <ul>
            <li>Operator: {{isset($service_result['operator_name'])?$service_result['operator_name']:"N/A"}}</li>
            <li><strong>Reload Pin</strong> : <strong>{{$voucher['sReloadPin']}}</strong></li>
            <li>Serial No : {{$voucher['sSerialNumber']}}</li>
            <li><strong>Expiry Date </strong> : <strong>{{$voucher['sExpiryDate']}}</strong></li>
            <li><strong>Description </strong> : <strong>{{$voucher['sDescription']}}</strong></li>
            <li>Number : <strong>{{session('mobile_number')}}</strong></li>
            <li>Amount : <strong>{{$amount}} {{$service_result['currency']}} = {{$service_result['amount']}}
                    points</strong></li>
            <li>Charges : <strong>{{$service_result['charge']}} points</strong></li>
            <li>Commissions : <strong>{{$service_result['commission']}} points</strong></li>
            <li>Discount : <strong>{{$service_result['discount']}} points</strong></li>
            <li>Total : <strong>{{$service_result['total']}} points</strong></li>
            <li>Before Transaction : <strong>{{$service_result['before']}} points</strong></li>
            <li>After Transaction : <strong>{{session('available_points')?session('available_points'):"No"}}
                    points</strong></li>
            <li>Sender Number :
                <strong>{{isset($sender_mobile_number)?$sender_mobile_number:session('mobile_number')}}</strong></li>
            <li>Date/Time : <strong>{{$service_result['date_time']}}</strong>
        </ul>

        <div style="display:none">
            <div id="printable" style="text-align: center;">
                <img src="{!!url('/')!!}/images/mycash-point-logo.png" alt="mycash point"/>
                <br>
                ---------------------------------------------------------------------------
                <br>
                <h3>{{$voucher['sReloadTelco']}}</h3>
                <h3>Top-Up Voucher</h3>
                <h3>* RM {{isset($voucher['sRetailPrice'])?number_format($voucher['sRetailPrice'] , 2, '.', ','):""}}
                    *</h3>
                ----------------------------------------------------------------------------
                <h3>Reload PIN</h3>
                <h3>{{$voucher['sReloadPin']}}</h3>
                <h4>Pin Serial Number</h4>
                <h4>{{$voucher['sSerialNumber']}}</h4>
                {{$voucher['sDescription']}}
                <br>
                Please Call: {{isset($service_result['operator_number'])?$service_result['operator_number']:"N/A"}} for
                enquires and support
                <br>
                ----------------------------------------------------------------------------
                <br>
                Expire Date: {{$voucher['sExpiryDate']}}
                <br>
                {{$voucher['sPurchaseTS']}}  {{$voucher['sPINID']}}
            </div>
        </div>
    @endif
</div>
