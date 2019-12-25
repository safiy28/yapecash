
    <div class="panel">
        <h2>Calculation</h2>
        <div class="panelcontent">
            <table class="table table-striped">
                <tr>
                    <td>Given Amount</td>
                    <td>:</td>
                    <td>{{ isset($charges['amount']) ? str_replace(',', '', $charges['amount']) : 0}} {{$charges['currency']}}</td>
                </tr>
                <tr>
                    <td>Charges</td>
                    <td>:</td>
                    <td>{{ isset($charges['charge']) ? str_replace(',', '', $charges['charge']) : 0}} Points</td>
                </tr>
                <tr>
                    <td>Fixed Charges</td>
                    <td>:</td>
                    <td>{{ isset($charges['charge']) ? str_replace(',', '', $charges['cardCharge']) : 0}} Points</td>
                </tr>
                <tr>
                    <td>Commission</td>
                    <td>:</td>
                    <td>{{ isset($charges['commission']) ? str_replace(',', '', $charges['commission']) : 0}} Points</td>
                </tr>
                <tr>
                    <td>Discount</td>
                    <td>:</td>
                    <td>{{ isset($charges['discount']) ? str_replace(',', '', $charges['discount']) : 0}} Points</td>
                </tr>


                <tr class="info">
                    <th>Total</th>
                    <td>:</td>
                    <th>{{isset($charges['total']) ? str_replace(',', '', $charges['deducted']) :  0}} points</th>
                </tr>

            </table>
        </div>


    @php session(['form_submitted' => 1]) @endphp
</div>
