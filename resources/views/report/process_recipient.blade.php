@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Recipient Report</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>


    @include('errors.list')

    <div class="leftpan">
        <div class="panel">
            <h2>Sender Details</h2>

            <div class="panelcontent">
                <ul class="review-list">
                    <li><strong>Name :</strong> {{$report['sender_name']}}</li>
                    <li><strong>Mobile No :</strong> {{$report['sender_mobile']}}</li>
                    <li><strong>Passport No :</strong> {{$sender['profile']['id_no']}}</li>
                    <li><strong>Passport Issue Date:</strong> @if($sender['profile']['passport_issue_date']!='none')
                            {{date('F d, Y', strtotime($sender['profile']['passport_issue_date']))}}

                        @else
                            {{$sender['profile']['passport_issue_date']}}
                        @endif
                    </li>
                    <li><strong>Passport Expire Date
                            :</strong> {{date("Y", strtotime($sender['profile']['id_expire_date'])) < 1 ? '' : date('F d, Y', strtotime($sender['profile']['id_expire_date']))}}</li>
                    <li><strong>Gender:</strong> {{$sender['profile']['gender']}}</li>
                    <li><strong>Date of
                            Birth:</strong> {{date('F d, Y', strtotime($sender['profile']['date_of_birth']))}}</li>
                    <li><strong>Nationality:</strong> {{$sender['profile']['country']}}</li>
                    <li><strong>Present Address:</strong> {{$sender['profile']['present_address']}}</li>
                    <li><strong>Post Code:</strong> {{$sender['profile']['post_code']}}</li>
                    <li><strong>Occupation:</strong> {{$sender['profile']['occupation']}}</li>
                    <li><strong>Source of Income:</strong> {{$sender['profile']['source_of_income']}}</li>
                    <li><strong>Purpose of Remittance:</strong> {{$report['purpose']}}</li>
                </ul>

            </div>

        </div>
        <div class="panel">
            <h2>Receiver Details</h2>

            <div class="panelcontent">
                <ul class="review-list">
                    <li><strong>Name :</strong> {{$report['receiver_name']}}</li>
                    <li><strong>Relationship :</strong> {{$rec['relation']}}</li>
                    <li><strong>Phone Number :</strong> {{$report['receiver_mobile']}}</li>
                    <li><strong>Bank Name</strong> {{$rec['bank_name']}}</li>
                    <li><strong>Bank A/C No :</strong> {{$report['bank_ac_no']}}</li>
                    <li><strong>Branch Name :</strong> {{$rec['branch_name']}}</li>
                    <li><strong>PIN No :</strong> {{$report['note']}}</li>
                    <li><strong>Order ID :</strong> {{$t_report['transaction_no']}}</li>
                    @if(session('admin') === true && $report['transfer_mode'] == 'PIN Transfer')
                        <li><strong>Assisted ID :</strong> {{$t_report['assisted_by']}}</li>
                        <li><strong>Assisted Name :</strong> {{$t_report['assisted_name']}}</li>
                        <li><strong>Send From :</strong> {{$t_report['company_name']}}</li>
                    @elseif(session('admin') == true)
                        <li><strong>Assisted ID :</strong> {{$rec['assisted_id']}}</li>
                    @endif
                </ul>
            </div>

        </div>


        <div class="panel"><h2>Amount</h2>
            <div class="panelcontent">
                <ul class="review-list">
                    <li><strong>Given Amount :</strong>{{$t_report['old_amount']}} {{$t_report['currency']}}</li>
                    @if($admin=='true')
                        <li><strong>MyCashPoint :</strong> {{round($t_report['amount'],2)}} Points</li>
                        <li><strong>Charges :</strong> {{$t_report['charges']}} points</li>
                        <li><strong>Commission :</strong> {{$t_report['commission']}} points</li>
                        <li><strong>Discount :</strong> {{$t_report['discount']}} points</li>
                        <li><strong>Total
                                :</strong> {{round($t_report['amount']+$t_report['charges']-$t_report['discount']-$t_report['commission'],2)}}
                            Points
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        @if($own=='true')
            <a href="{{url('/')}}/recipient/reports/{{$report['id']}}/release" class="submitbtn">Release</a>
        @endif

        @if($successrefund=='true')

        @else
            <a href="#update" class="open-popup-link submitbtn">Update</a>
        @endif


        <a href="#test-popup" class="open-popup-link submitbtn">View ID</a>
        <a href="{{url('/')}}/invoice/{{$report['id']}}/1" target="_blank" id="invoiceprint" class="submitbtn">View Receipt</a>

        @if($assignorder=='true')
            @if($admin=='true')

                <a href="#tagupdate" class="open-popup-link submitbtn" id="assign-order">Assign Order</a>

            @endif
        @endif

        <div id="test-popup" class="white-popup mfp-hide">
            <strong>Profile Photo</strong><br><br><img src="{{$sender['profile']['profile_photo']}}" alt="" width="284"
                                                       height="269">
            <ul>
                <li><strong> Scan ID 1</strong> <img src="{{$sender['profile']['scan']}}" alt="" width="540"
                                                     height="388"></li>
                <li><strong>Scan ID 2</strong> <img src="{{$sender['profile']['scan_one']}}" alt="" width="540"
                                                    height="388"></li>
                <li><strong> Scan ID 3</strong> <img src="{{$sender['profile']['scan_two']}}" alt="" width="540"
                                                     height="388"></li>
            </ul>
        </div>

        <div id="update" class="white-popup mfp-hide">
            <form role="form" method="POST" action="{{url('/')}}/recipient/reports/{{$report['id']}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="panel">
                    <h2>Status</h2>
                    <div class="panelcontent">
                        <select class="" name="status">
                            <option value="success">Success</option>
                            <option value="cancel">Cancel</option>
                        </select>
                    </div>
                </div>
                <div class="panel">
                    <h2>Note</h2>
                    <div class="panelcontent">
                        <input type="textarea" required name="note" class="">
                    </div>
                </div>
                @if(session('admin') == true && $report['transfer_mode'] == 'PIN Transfer')
                    <div class="panel">
                        <h2>Assisted ID</h2>
                        <div class="panelcontent">
                            <input type="textarea" required name="assisted_by" class="">
                        </div>
                    </div>
                    <div class="panel">
                        <h2>Send From</h2>
                        <div class="panelcontent">
                            <select name="company_name">
                                <option value="Probhu Money Transfer">Probhu Money Transfer</option>
                                <option value="CBL Money Transfer">CBL Money Transfer</option>
                                <option value="Agrani Money Transfer">Agrani Money Transfer</option>
                            </select>
                        </div>
                    </div>
                @elseif (session('admin') == true && $report['transfer_mode'] == 'Bank Transfer')
                    <div class="panel">
                        <h2>Assisted ID</h2>
                        <div class="panelcontent">
                            <input type="textarea" name="assisted_by">
                        </div>
                    </div>
                @endif
                <div class="panel">
                    <h2>Pin Number</h2>
                    <div class="panelcontent">
                        <input type="password" name="pin" required placeholder="Enter Pin Number">
                    </div>
                </div>
                <input type="submit" value="Submit" class="submitbtn">
            </form>
        </div>

        <div id="tagupdate" class="white-popup mfp-hide">
            <form id="assign" role="form" method="POST" action="{{url('/')}}/recipient/tag/{{$report['id']}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="panel">
                    <h2>Tag</h2>
                    <div class="panelcontent">
                        <input type="radio" class="tag" name="tag" value="metro" required/> Metro &nbsp
                        <input type="radio" class="tag" name="tag" value="city" required/> City &nbsp
                        <input type="radio" class="tag" name="tag" value="ucash" required/> Ucash &nbsp
                        <input type="radio" class="tag" name="tag" value="bank" required/> Bank &nbsp
                    </div>
                </div>

                <input type="hidden" id="reportId" name="reportId" value="{{$report['id']}}">
                <input type="hidden" id="old_amt" name="old_amt" value="{{$t_report['old_amount']}}">
                <input type="submit" id="btn" value="Submit" class="submitbtn">
            </form>
        </div>
    </div>
@stop


@section('footer-script')

    <script src="{{url('/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

    <script src="{{url('/js/jQuery.print.js')}}"></script>

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

        function closePopup() {
            $.magnificPopup.close();
        }

       $('#btn').click(function(){
           if($('#assign')[0].checkValidity()){
               $.magnificPopup.close();
               $('#assign-order').hide();

           }
        });


    </script>
@stop
