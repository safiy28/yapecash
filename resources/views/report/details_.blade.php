@extends('app')

@section('header')

@stop

@section('title')
    <h1>Details Order Statement</h1>
@stop
@section('content')

    <div class="clearfix"></div>
    <div class="details-report">
        <ul>
            <li class="highlight"><span>Transaction No: </span> <strong>{{$report['transaction_no']}}</strong></li>
            <li><span>Ref No: </span> <strong>{{$report['response_id']}}</strong></li>
            <li><span>Service Name: </span> <strong>{{$report['service_name']}}</strong></li>
            <li><span>Receiver Mobile No: </span> <strong>{{$report['receiver_mobile']}}</strong></li>
            <li><span>Sender Mobile No: </span> <strong>{{$report['sender_mobile']}}</strong></li>
            <li><span>MyCash Point Amount: </span> <strong>{{str_replace(',', '', $report['amount'])}}</strong></li>
            <li><span>Given Amount: </span> <strong>{{str_replace(',', '', $report['old_amount'])}}</strong></li>
            <li><span>Deducted Amount: </span> <strong>{{str_replace(',', '', $report['deducted'])}}</strong></li>
            <li><span>Total Amount: </span>
                <strong>{{str_replace(',', '', $report['amount']) + $report['charges']}}</strong></li>
            <li><span>Charges: </span> <strong>{{$report['charges']}}</strong></li>
            <li><span>Commission: </span> <strong>{{$report['commission']}}</strong></li>
            <li><span>Discount: </span> <strong>{{$report['discount']}}</strong></li>
            <li><span>After Transaction: </span> <strong> {{str_replace(',', '', $report['after'])}}</strong></li>
            <li><span>Before Transaction: </span> <strong>{{str_replace(',', '', $report['before'])}}</strong></li>
            <li><span>Status: </span> <strong> {{$report['status']}}</strong></li>
            <li><span>Message: </span> <strong> {{str_replace('mycash1Re', ' ', $report['message'])}}</strong></li>
            <li><span>Date & Time: </span> <strong> {{$report['date']}}</strong></li>
        </ul>
    </div>
    <div class="clearfix"></div>



    <div class="btnarea">
        <a href="{{url('/')}}/report" class="submitbtn">Back</a>

        @if($report['service']['type'] == 'recipient')
            <a href="#" id="metroprint" class="submitbtn">RePrint</a>
        @endif

        @if($report['service']['name'] == 'Air Ticket')
            <a href="#" id="metroprint" class="submitbtn">RePrint</a>
        @endif

        @if($voucher)
        <!--    <input type="submit" id="print" value="Re-Print" class="submitbtn">-->
            <a href="#" id="print" class="submitbtn">RePrint</a>
        @endif

    </div>

    @if($report['service']['type'] == 'recipient')

        <div style="display:none">
            <div id="metroprintable" style="text-align:center;">
                <img src="{!!url('/')!!}/images/mycash-point-logo.png" alt="mycash point"/>
                <br>
                ---------------------------------------------------------------------------
                <div class="details-report">

                    MSP ID: {{$report['msp_id']}}<br>
                    Order Date : {{$report['date']}} <br>

                    <h3>Order Request Slip</h3>
                    (Customer Copy) <br>
                    <h2>{{$report['transaction_no']}}</h2>
                    <h3>Message : {{$report['note']}} </h3><br>
                    Sender Name : {{$report['sender_name']}} <br>
                    Sender ID : {{$report['sender_mobile']}} <br><br>
                    Receiver Name : {{$report['receiver_name']}} <br>
                    Transaction Type : {{$report['transaction_type']}} <br><br>
                    Receiving Amount : {{$report['currency']}} {{$report['old_amount']}} <br>
                    <strong>Sending Amount
                        : {{str_replace(',', '', $report['amount']) + $report['charges']}}</strong><br>
                    ----------------------------------------------------------- <br>
                    Customer Care Line : <strong>0166421224</strong> <br>
                    @if($report['service_name'] == 'MME Wallet Remittance')
                        Bangladesh Support Office: <strong>01551816395</strong> <br>
                    @endif

                    This receipt is computer generated and no signature is required. T&C Apply.

                </div>

            </div>
        </div>
    @endif

    @if($report['service']['name'] == 'Air Ticket')
        <div style="display:none">
            <div id="metroprintable" style="text-align:center;">
                <img src="{!!url('/')!!}/images/mycash-point-logo.png" alt="mycash point"/>
                <br>
                ---------------------------------------------------------------------------
                <div class="details-report">
                    <h3>Air Ticket Confirmation </h3>
                    (Customer Copy) <br>

                    <?php
                    $print_str = explode('mycash1Re', $report['message']);

                    $p_name = explode(':', $print_str[0]);
                    $trip = explode(':', $print_str[2]);
                    $air_line = explode(':', $print_str[3]);
                    $out_departure = explode(':', $print_str[4]);
                    $out_arrival = explode(':', $print_str[5]);

                    if ($print_str[6]) {

                        $inbound_departure = explode(':', $print_str[6]);
                        $inbound_arrival = explode(':', $print_str[7]);
                        //print_r($inbound_departure);
                    }



                    ?>


                    Passenger Name : {{$p_name[1]}}<br>


                    <h3>Air Ticket Confirmation </h3>
                    (Customer Copy) <br>
                    <h2>{{$print_str[1]}}</h2>


                    Trip : {{$trip[1]}} <br>
                    Airline : {{$air_line[1]}} <br><br>


                    <h2>Outbound Flight</h2>
                    Departure Date & Time : {{$out_departure[1]}} <br><br>
                    Arrival Date & Time : {{$out_arrival[1]}} <br>


                    <?php if ($print_str[6]) { ?>

                    <h2>Inbound Flight</h2>

                    Departure Date & Time : {{$inbound_departure[1]}} <br><br>
                    Arrival Date & Time : {{$inbound_arrival[1]}} <br>

                    <?php } ?>

                    ----------------------------------------------------------- <br>
                    Customer Care Line : <strong>0166421224</strong> <br>

                    This receipt is computer generated and no signature is required. T&C Apply.

                </div>

            </div>
        </div>

    @endif

    @if($voucher)
        <!--<input type="submit" id="print" value="Re-Print" class="submitbtn">-->

        <div style="display:none">
            <div id="printable" style="text-align: center;">
                <img src="{!!url('/')!!}/images/mycash-point-logo.png" alt="mycash point"/>
                <br>
                ---------------------------------------------------------------------------
                <br>
                <h3>{{$voucher->sReloadTelco}}</h3>
                <h3>Top-Up Voucher</h3>
                <h3>* RM {{isset($voucher->sRetailPrice )?round($voucher->sRetailPrice,2):""}} *</h3>
                ----------------------------------------------------------------------------
                <h3>Reload PIN</h3>
                <h3>{{$voucher->sReloadPin }}</h3>
                <h4>Pin Serial Number</h4>
                <h4>{{$voucher->sSerialNumber }}</h4>

                {{$voucher->sDescription }}
                <br>
                Please Call: {{isset($report['message'])?$report['message']:"N/A"}} for enquires and support
                <br>
                ----------------------------------------------------------------------------
                <br>
                Expire Date: {{$voucher->sExpiryDate }}
                <br>
                <br>
                {{$voucher->sPurchaseTS }}  {{$voucher->sPINID }}

            </div>
        </div>
    @endif
@stop

@section('footer')

    <script src="{!!url('/')!!}/js/jQuery.print.js"></script>
    <script type="text/javascript">
        $(function () {

            $("#metroprint").on('click', function () {

                $("#metroprintable").print({
                    // Use Global styles
                    globalStyles: false,
                    // Add link with attrbute media=print
                    mediaPrint: false,
                    //Custom stylesheet
                    stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
                    //Print in a hidden iframe
                    iframe: false,
                    // Don't print this
                    noPrintSelector: ".avoid-this",
                    // Manually add form values
                    manuallyCopyFormValues: true,
                    // resolves after print and restructure the code for better maintainability
                    deferred: $.Deferred(),
                    // timeout
                    timeout: 250,
                    // Custom title
                    title: null,
                    // Custom document type
                    doctype: '<!doctype html>'

                });
            });

            $("#print").on('click', function () {

                $("#printable").print({
                    // Use Global styles
                    globalStyles: false,
                    // Add link with attrbute media=print
                    mediaPrint: false,
                    //Custom stylesheet
                    stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
                    //Print in a hidden iframe
                    iframe: false,
                    // Don't print this
                    noPrintSelector: ".avoid-this",
                    // Manually add form values
                    manuallyCopyFormValues: true,
                    // resolves after print and restructure the code for better maintainability
                    deferred: $.Deferred(),
                    // timeout
                    timeout: 250,
                    // Custom title
                    title: null,
                    // Custom document type
                    doctype: '<!doctype html>'

                });
            });

        });
    </script>
@stop
