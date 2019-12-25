
    <div class="panel">
        <h2>Calculation</h2>
        <div class="panelcontent">
            <table class="table table-striped">
                <tr>
                    <td>Given Amount</td>
                    <td>:</td>
                    <td>{{ isset($charges['old_amount']) ? number_format((double)str_replace(',', '', $charges['old_amount']), 3) : 0}} {{$charges['currency']}}</td>
                </tr>
                <tr>
                    <td>MyCash Point</td>
                    <td>:</td>
                    <td>{{ isset($charges['amount']) ? number_format((double)str_replace(',', '', $charges['amount']), 3) : $service_result['amount']}} Points</td>
                </tr>
                <tr>
                    <td>Charges</td>
                    <td>:</td>
                    <td>{{ isset($charges['charge']) ? number_format((double)str_replace(',', '', $charges['charge']), 3) : $service_result['charge']}} Points</td>
                </tr>
                <tr>
                    <td>Commission</td>
                    <td>:</td>
                    <td>{{ isset($charges['commission']) ? number_format((double)str_replace(',', '', $charges['commission']), 3) : $service_result['commission']}} Points</td>
                </tr>
                <tr>
                    <td>Discount</td>
                    <td>:</td>
                    <td>{{ isset($charges['discount']) ? number_format((double)str_replace(',', '', $charges['discount']), 3) : $service_result['discount']}} Points</td>
                </tr>

                @if(isset($charges['balance_exceeded']) && $charges['balance_exceeded'] )
                    <tr class="danger">
                        <th>Total</th>
                        <td>:</td>
                        <th style="color:red">Available balance exceed</th>
                    </tr>
                @else

                    <tr class="info">
                        <th>Total</th>
                        <td>:</td>
                        <th>{{isset($charges['deducted']) ? number_format((double)str_replace(',', '', $charges['deducted']), 3) :  0}} points</th>
                    </tr>
                @endif
            </table>
        </div>


    @php session(['form_submitted' => 1]) @endphp
</div>
