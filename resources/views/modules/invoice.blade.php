@php session()->forget('form_submitted') @endphp
<div class="service_panel panel panel-default">
    <div class="panel-heading">Invoice # {{ $service_result['transaction_no'] }}</div>
    <div class="panel-body">
        <table class="table table-striped">
            @if(isset($data['wallet_no']))
                <td>Wallet Number</td>
                <td>:</td>
                <td><strong>{{$data['wallet_no']}}</strong></td>
            @else
            <tr>
                <td>Mobile Number</td>
                <td>:</td>
                <td><strong>{{$data['receiver_mobile'] ?? session('mobile_number')}}</strong></td>
            </tr>
            @endif
            @if(isset($input_amount))
                <tr>
                    <td>Amount</td>
                    <td>:</td>
                    <td>
                        <strong>
                            {{$input_amount}} {{$service_result['currency']}}
                            = {{ $service_result['amount'] }} points
                        </strong>
                    </td>
                </tr>
            @else
                <tr>
                    <td>Amount</td>
                    <td>:</td>
                    <td>{{ $service_result['amount'] }} points</td>
                </tr>
            @endif
            <tr>
                <td>Charges</td>
                <td>:</td>
                <td>{{ $service_result['charge']}} points</td>
            </tr>
            <tr>
                <td>Commissions</td>
                <td>:</td>
                <td>{{  $service_result['commission']}} points</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td>:</td>
                <td>{{$service_result['discount'] }} points</td>
            </tr>
            <tr>
                <td>Deducted Amount</td>
                <td>:</td>
                <td>
                    <strong>
                        {{  $service_result['deducted'] }} points
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td>:</td>
                <td>
                    <strong>
                        {{  $service_result['total']}} points
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Before Transaction</td>
                <td>:</td>
                <td>
                    <strong>
                        {{ $service_result['before'] }} points
                    </strong>
                </td>
            </tr>
            <tr>
                <td>After Transaction</td>
                <td>:</td>
                <td>
                    <strong>
                        {{ $service_result['after'] ?: 'No' }} points
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Sender Number</td>
                <td>:</td>
                <td><strong>{{ $sender_mobile_number ?? session('mobile_number') }}</strong></td>
            </tr>
            <tr>
                <td>Date/Time</td>
                <td>:</td>
                <td><strong>{{ $service_result['date_time'] }}</strong></td>
            </tr>
        </table>
    </div>
</div>
