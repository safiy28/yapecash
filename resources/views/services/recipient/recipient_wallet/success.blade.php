@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}} ( Confirm )</h2>

            @include('modules.result_service')

            <div class="leftpan row">
                    <div class="col-md-offset-2 col-md-8">
                        @include('modules.invoice')
                        <a href="{{url('/')}}/services/{{session('service_id')}}" class="submitbtn">BACK</a>
                        <a href="{{url('/')}}/invoice/{{$metrorecipient['id']}}/2" target="_blank" id="invoiceprint" class="submitbtn">PRINT</a>
                    </div>
            </div>
        </div>
    </div>

    {{--<div style="display:none">
        <div id="metroprintable" style="text-align:center;">
            <img src="https://mycashmy.com/images/mycash-point-logo.png" alt="mycash point"/>
            <br>
            ---------------------------------------------------------------------------
            <div class="details-report">

                ORDER ID: {{$metrorecipient['transaction_no']}}<br>
                Order Date : {{$service_result['date_time']}}<br><br>
                <h3>Order Request Slip</h3>
                (Customer Copy) <br>
                <h2>{{$metrorecipient['transaction_no']}}</h2>
                <h3>Message :  {{$metrorecipient['note']}} </h3><br>
                Sender Name : {{$metrorecipient['sender_name']}} <br>
                Sender ID : {{$metrorecipient['sender_mobile']}} <br><br>
                Receiver Name : {{$metrorecipient['receiver_name']}} <br>
                Transaction Type : {{$metrorecipient['mode']}} <br><br>
                Receiving Amount : {{$metrorecipient['currency']}} {{$metrorecipient['old_amount']}} <br>
                <b>Sending Amount : {{round($metrorecipient['deducted'] + $metrorecipient['commission'] + $metrorecipient['discount'],2)}} points</b><br>
                ----------------------------------------------------------- <br>
                Customer Care Line : <strong>0166421224</strong> <br>

                This receipt is computer generated and no signature is required. T&C Apply.

            </div>

        </div>
    </div>--}}
@stop
@section('footer-script')
    <script src="{{url('/js/jQuery.print.js')}}"></script>
    {{--<script type="text/javascript">
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
        });
    </script>--}}
@stop