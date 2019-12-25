@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Wallet Transfer Report</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>


    @include('errors.list')

    <div class="leftpan">
        <div class="panel">
            <h2>Sender Details</h2>

            <div class="panelcontent">
                <ul class="review-list">
                    <li><strong>Name :</strong> {{$sender['name']}}</li>
                    <li><strong>Mobile No :</strong> {{$sender['mobile_number']}}</li>
                    <li><strong>Passport No :</strong> {{$sender['profile']['id_no']}}</li>
                    <li><strong>Passport Issue Date:</strong> @if($sender['profile']['passport_issue_date']!='none')
                            {{date('F d, Y', strtotime($sender['profile']['passport_issue_date']))}}

                        @else
                            {{$sender['profile']['passport_issue_date']}}
                        @endif
                    </li>
                    <li><strong>Passport Expire Date
                            :</strong> {{date('F d, Y', strtotime($sender['profile']['id_expire_date']))}}</li>
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
                    <li><strong>Name :</strong> {{$rec['name']}}</li>
                    <li><strong>Relationship :</strong> {{$rec['recipient_relations']['name']}}</li>
                    <li><strong>Phone Number :</strong> {{$rec['phone']}}</li>
                    <li><strong>Transfer mode</strong> {{$t_report['mode']}}</li>
                    @if(session('admin') === true)
                        <li><strong>Assisted ID :</strong> {{$t_report['assisted_by']}}</li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="panel">
            <h2>Order Details</h2>

            <div class="panelcontent">
                <ul class="review-list">
                    <li><strong>Wallet Account No :</strong> {{$t_report['account_name']}}</li>
                    <li><strong>TRX ID : </strong> {{$t_report['transaction_no']}}</li>
                    <li><strong>ORDER ID : </strong> {{$t_report['response_id']}}</li>
                    <li><strong>ODER DATE : </strong> {{$t_report['created_at']}}</li>
                    <li><strong>Execution Ref: </strong> {{$t_report['message']}}</li>
                    <li><strong>MME Ref: </strong>{{$t_report['note']}}</li>
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
            <a href="{{url('/')}}/recipient/wallet/reports/{{$report['id']}}/release" class="submitbtn">Release</a>
        @endif

        @if($successrefund=='true')

        @else
            <a href="#update" class="open-popup-link submitbtn">Update</a>
        @endif


        <a href="#test-popup" class="open-popup-link submitbtn">View ID</a>
        <a href="{{url('/')}}/invoice/{{$report['id']}}/2" target="_blank" id="invoiceprint" class="submitbtn">View Receipt</a>

        {{--<div style="display:none">
            <div id="metroprintable" style="text-align:center;">
                <img src="https://mycashmy.com/images/mycash-point-logo.png" alt="mycash point"/>
                <br>
                ---------------------------------------------------------------------------
                <div class="details-report">

                    ORDER ID: {{$t_report['transaction_no']}}<br>
                    Order Date: {{$report['created_at']}}<br>

                    <h3>Order Request Slip</h3>
                    <h2>{{$t_report['transaction_no']}}</h2>
                    <h3>PIN No: {{$report['note']}}</h3><br>
                    Sender Name: {{$sender['name']}}<br>
                    Receiver Name: {{$rec['name']}}<br>
                    Given Amount: {{$t_report['old_amount']}} BDT<br>
                    ----------------------------------------------------------- <br>
                    Customer Care Line: <strong>0166421224</strong> <br>

                    This receipt is computer generated and no signature is required. T&C Apply.

                </div>
            </div>
        </div>--}}
            @if($assignorder=='true')
                @if($admin=='true')

                    <a href="#checkvalidation" class="open-popup-link submitbtn" id="get-validation">Tranglo Validation</a>

                @endif
            @endif
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
            <form role="form" method="POST" action="{{url('/')}}/recipient/wallet/report/{{$report['id']}}">
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
                <div class="panel">
                    <h2>Easyrem Response ID</h2>
                    <div class="panelcontent">
                        <input type="text" name="response_id" class="">
                    </div>
                </div>
                <div class="panel">
                    <h2>Assisted ID</h2>
                    <div class="panelcontent">
                        <input type="text" name="assisted_by" class="">
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

        <div id="tagupdate" class="white-popup mfp-hide">
            <form id="assign" role="form" method="POST" action="{{url('/')}}/recipient/wallet/tag/{{$report['id']}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="panel">
                    <h2>Tag</h2>
                    <div class="panelcontent">
                        <input type="radio" class="tag" name="tag" value="easyrem" required/> EasyRem &nbsp
                        <input type="radio" class="tag" name="tag" value="valyou" required/> ValYou &nbsp
                        <input type="radio" class="tag" name="tag" value="tranglo" required/> Tranglo
                    </div>

                </div>
                <div class="panel">
                    <h2>Tranglo Sending Amount</h2>
                    <div class="panelcontent">
                        <table>
                            <tr>
                                <td>Sending Amount</td>
                                <td id="sAmount"> </td>
                            </tr>
                            <tr>
                                <td colspan="2" id="cRate"> </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel">
                    <h2>Tranglo Charge</h2>
                    <div class="panelcontent">
                        <table>
                            <tr>
                                <td>Tranglo Charge</td>
                                <td id="charge"> </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel">
                    <h2>Total</h2>
                    <div class="panelcontent">
                        <table>
                            <tr>
                                <td>Total Amount</td>
                                <td id="total"> </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <input type="hidden" id="reportId" name="reportId" value="{{$report['id']}}">
                <input type="hidden" id="old_amt" name="old_amt" value="{{$t_report['old_amount']}}">
                <input type="submit" id="btn" value="Submit" class="submitbtn">
            </form>
        </div>
        <div id="checkvalidation" class="white-popup mfp-hide">
            <form>
                <div class="panel">
                    <h2>Tranglo Validation Status</h2>
                    <div class="panelcontent">
                        <table>
                            <tr>
                                <td>Status Code </td>
                                <td>&nbsp:&nbsp</td>
                                <td id="vStCode"> </td>
                            </tr>
                            <tr>
                                <td>Transaction ID </td>
                                <td>&nbsp:&nbsp</td>
                                <td id="trxId"> </td>
                            </tr>
                            <tr>
                                <td>Beneficiary Name </td>
                                <td>&nbsp:&nbsp</td>
                                <td id="bName"> </td>
                            </tr>
                            <tr>
                                <td>Status </td>
                                <td>&nbsp:&nbsp</td>
                                <td id="vStatus"> </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button type="button" onClick="closePopup();">Close</button>
            </form>
        </div>
    </div>
@stop


@section('footer-script')

    <script src="{{url('/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

    <script src="https://mycashmy.com/js/jQuery.print.js"></script>
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
    </script>--}}

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

            $('#assign-order').click(function () {
                var value=$('#reportId').val();
                var amount=$('#old_amt').val();
                $.get( "{{url('/')}}/wallet-tranglo-rate?id="+value, function(data)
                {   //console.log(data);
                    if (data != null || data != "") {
                        rate = data.forex_rate;
                        fee = data.trx_fee;
                        sAmount = " = "+amount + " " +  rate.CurrTo +" = " + rate.sending_amount + " " + rate.CurrFrom;
                        cRate = "(1 " + rate.CurrFrom + " = " +  rate.CurrRate +" " + rate.CurrTo + ")";
                        charge = " = "+ fee.TrxFee + " " +  fee.CurrencyCode;
                        total = " = "+ rate.totalAmt + " " +  fee.CurrencyCode;
                        $('#sAmount').html(sAmount);
                        $('#cRate').html(cRate);
                        $('#charge').html(charge);
                        $('#total').html(total);
                    }
                });
            });

            $('#get-validation').click(function () {
                var value=$('#reportId').val();
                $.get( "{{url('/')}}/tranglo-validation?id="+value+"&report_type=2", function(data)
                {   //console.log(rate);
                    if (data != null || data != "") {
                        validation = data.validation;
                        vStCode = validation.ValidateStatus;
                        trxId = validation.transID;
                        bName = validation.BeneficiaryName;
                        vStatus = validation.Description;
                        $('#vStCode').html(vStCode);
                        $('#trxId').html(trxId);
                        $('#bName').html(bName);
                        $('#vStatus').html(vStatus);
                    }
                });
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
