@extends('app')

@section('header')


    <link rel="stylesheet" type="text/css" href="{!!url('/')!!}/css/jquery.datetimepicker.css"/ >

    <script src="{!!url('/')!!}/js/jquery.datetimepicker.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@stop

@section('title')
    <h1>Account TopUp Report</h1>
@stop
@section('content')
    <div class="leftpan">

        <div class="panel">
            <h2>Receiver Details</h2>

            <div class="panelcontent">
                <ul class="review-list">

                    <li><strong>Bank Name :</strong> <?php echo str_replace('_', ' ', $report['operator']); ?></li>
                    <li><strong>Transfer Mode :</strong> <?php echo str_replace('_', ' ', $report['mode']); ?></li>
                    <li><strong>Account Number :</strong> {{$report['receiver_mobile']}}</li>
                    <li><strong>Account Holder Name
                            :</strong> <?php echo str_replace('_', ' ', $report['account_name']); ?></li>
                    <li><strong>Recipient Reference :</strong> <?php echo str_replace('_', ' ', $report['message']); ?>
                    </li>
                </ul>

            </div>

        </div>

        <div class="panel">
            <h2>Sender Details</h2>
            <div class="panelcontent">
                <ul class="review-list">
                    <li><strong> Name :</strong> <?php echo $report['manager']['name']; ?></li>
                    <li><strong>Mobile No :</strong> <?php echo $report['manager']['mobile_number']; ?></li>
                    <li><strong>Passport No :</strong> <?php echo $report['manager']['profile']['id_no']; ?></li>
                    <li><strong>Passport Issue Date
                            :</strong> <?php echo date('d-m-Y', strtotime($report['manager']['profile']['passport_issue_date'])); ?>
                    </li>
                    <li><strong>Passport Expire Date
                            :</strong> <?php echo date('d-m-Y', strtotime($report['manager']['profile']['passport_issue_date'])); ?>
                    </li>
                    <li><strong>Gender :</strong> <?php echo $report['manager']['profile']['gender']; ?></li>
                    <li><strong>Date of Birth
                            :</strong> <?php echo date('d-m-Y', strtotime($report['manager']['profile']['date_of_birth'])); ?>
                    </li>
                    <li><strong>Nationality :</strong> <?php echo $report['manager']['profile']['country']; ?></li>
                    <li><strong>Present Address
                            :</strong> <?php echo $report['manager']['profile']['present_address']; ?></li>
                </ul>
            </div>
        </div>

        <div class="panel"><h2>Amount</h2>
            <div class="panelcontent">
                <ul class="review-list">
                    <li><strong>Given Amount :</strong>{{$report['old_amount']}} {{$report['currency']}}</li>
                    @if($admin=="true")
                        <li><strong>MyCashPoint :</strong> {{round($report['amount'],2)}} Points</li>
                        <li><strong>Charges :</strong> {{$report['charges']}} points</li>
                        <li><strong>Commission :</strong> {{$report['commission']}} points</li>
                        <li><strong>Discount :</strong> {{$report['discount']}} points</li>
                        <li><strong>Total
                                :</strong> {{round($report['amount']+$report['charges']-$report['discount']-$report['commission'],2)}}
                            Points
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        @if($own=='true')
            <a href="{{url('/')}}/account/report/{{$report['id']}}/release" class="submitbtn">Release</a>
        @endif

        @if($successrefund == 'true')

        @else
            <a href="#update" class="open-popup-link submitbtn">Update</a>
    @endif


    <!--    <a href="#test-popup" class="open-popup-link submitbtn">View ID</a>-->

        <div id="update" class="white-popup mfp-hide">
            <form role="form" method="POST" action="{{url('/')}}/account/report/{{$report['id']}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="panel">
                    <h2>Status</h2>
                    <div class="panelcontent">
                        <select class="" name="status">
                            <option value="success">Success</option>
                            <option value="refund">Refund</option>
                        </select>
                    </div>
                </div>
                <div class="panel">
                    <h2>Note</h2>
                    <div class="panelcontent">
                        <input type="textarea" required name="note" class="">
                    </div>
                </div>
                <div class="panel">
                    <h2>Pin Number</h2>
                    <div class="panelcontent">
                        <input type="password" name="pin" required placeholder="Enter Pin Number">
                    </div>
                </div>
                <input type="submit" value="Submit" class="submitbtn">
            </form>
        </div>
    </div>
@stop


@section('footer')

    <script>
        $(document).ready(function () {

            jQuery('#date_timepicker_start').datetimepicker({
                format: 'Y-m-d',
                onShow: function (ct) {
                    this.setOptions({
                        maxDate: jQuery('#date_timepicker_end').val() ? jQuery('#date_timepicker_end').val() : false
                    })
                },
                timepicker: false
            });


            jQuery('#date_timepicker_end').datetimepicker({
                format: 'Y-m-d',
                onShow: function (ct) {
                    this.setOptions({
                        minDate: jQuery('#date_timepicker_start').val() ? jQuery('#date_timepicker_start').val() : false
                    })
                },
                timepicker: false
            });

        });
    </script>


    <script src="{!!url('/')!!}/js/custom.js"></script>
    <script>
        $('.open-popup-link').magnificPopup({
            type: 'inline',
            midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
        });
    </script>
@stop
