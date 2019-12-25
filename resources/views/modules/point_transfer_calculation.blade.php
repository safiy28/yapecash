<div class="panel">
    <h2>Calculation</h2>
    <div class="panelcontent">
        <table class="table table-striped">

            <tr>
                <td>Given Amount</td>
                <td>:</td>
                <td>{{ str_replace(',', '', $service_result['amount'])}} Points</td>
            </tr>
            <tr>
                <td>MyCash Point</td>
                <td>:</td>
                <td>{{ str_replace(',', '', $service_result['amount'])}} Points</td>
            </tr>
            <tr>
                <td>Charges</td>
                <td>:</td>
                <td>{{ str_replace(',', '', $service_result['charge'])}} Points</td>
            </tr>
            <tr>
                <td>Commission</td>
                <td>:</td>
                <td>{{ str_replace(',', '', $service_result['commission'])}} Points</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td>:</td>
                <td>{{ str_replace(',', '', $service_result['discount'])}} Points</td>
            </tr>

            @if(isset($service_result['balance_exceeded']) && $service_result['balance_exceeded'] )
                <tr class="danger">
                    <th>Total</th>
                    <td>:</td>
                    <th style="color:red">Available balance exceed</th>
                </tr>
            @else
                <tr class="info">
                    <th>Total</th>
                    <td>:</td>
                    <th>{{$service_result['deducted']}} points</th>
                </tr>
            @endif
        </table>
    </div>
    @php session(['form_submitted' => 1]) @endphp
</div>
