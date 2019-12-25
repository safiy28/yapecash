@php session()->forget('form_submitted') @endphp
<div class="service_panel panel panel-default">
    <div class="panel-heading">Invoice # {{ $service_result['payment_no'] }}</div>
    <div class="panel-body">
        <table class="table table-striped">
            <tr>
                <td>Payment Slip No</td>
                <td>:</td>
                <td>{{ $service_result['payment_no'] }}</td>
            </tr>
            <tr>
                <td>Transaction Reference</td>
                <td>:</td>
                <td>{{ $service_result['stripe']['balance_transaction'] }}</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>:</td>
                <td>{{ (double) number_format(str_replace(',', '', $service_result['payment']['amount']), 3) }} points</td>
            </tr>
            <tr>
                <td>Charges</td>
                <td>:</td>
                <td>{{ (double) number_format(str_replace(',', '', $service_result['charges']['charge']), 3) }} points</td>
            </tr>
            <tr>
                <td>Commissions</td>
                <td>:</td>
                <td>{{ (double) number_format(str_replace(',', '', $service_result['charges']['commission']), 3) }} points</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td>:</td>
                <td>{{ (double) number_format(str_replace(',', '', $service_result['charges']['discount']), 3) }} points</td>
            </tr>
            <tr>
                <td>Deducted Amount</td>
                <td>:</td>
                <td>
                    <strong>
                        {{ (double) number_format(str_replace(',', '', $service_result['charges']['deducted']), 3) }} points
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td>:</td>
                <td>
                    <strong>
                        {{ (double) number_format(str_replace(',', '', $service_result['charges']['total']), 3) }} points
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Before Transaction</td>
                <td>:</td>
                <td>
                    <strong>
                        {{ $service_result['charges']['before'] }} points
                    </strong>
                </td>
            </tr>
            <tr>
                <td>After Transaction</td>
                <td>:</td>
                <td>
                    <strong>
                        {{ $service_result['charges']['after'] ?: 'No' }} points
                    </strong>
                </td>
            </tr>
            <tr>
                <td>Date/Time</td>
                <td>:</td>
                <td><strong>{{ $service_result['charges']['date_time'] }}</strong></td>
            </tr>
        </table>
    </div>
</div>
