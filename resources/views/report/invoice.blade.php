<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'/>
    <title></title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <style>
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }


    </style>
</head>
<body onload="window.print()">
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2><img width="250px" src="https://mycashmy.com/images/mycash-point-logo.png" alt="mycash point"/></h2>
                <h4 align="right" class="pull-right">Transaction ID: {{$t_report['transaction_no']}}
                    <br>{{Carbon\Carbon::parse($t_report['created_at'])->format('M d, Y h:m:s ')}}AUT
                </h4><hr>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" style="margin-bottom: 0px">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>TRANSACTION DETAILS</strong></h3>
                </div>
                <div class="panel-body" style="padding: 0px 15px 0px 15px">
                        <table class="table table-condensed" style="margin-bottom: 2px">
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <tr>
                                <td style="width: 25%"><strong>Sending Amount</strong></td>
                                <td style="width: 30%">{{number_format((double)str_replace(',', '', $t_report['old_amount']), 3)}} {{$t_report['currency']}}</td>
                                <td style="width: 19%"><strong>MyCash Point</strong></td>
                                <td style="width: 26%">{{number_format((double)str_replace(',', '', $t_report['amount']), 3)}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Charges</strong></td>
                                <td style="width: 30%">{{number_format((double)str_replace(',', '', $t_report['charges']), 3)}}</td>
                                <td style="width: 19%"><strong>Commission</strong></td>
                                <td style="width: 26%">{{number_format((double)str_replace(',', '', $t_report['commission']), 3)}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Discount</strong></td>
                                <td style="width: 30%">{{number_format((double)str_replace(',', '', $t_report['discount']), 3)}}</td>
                                <td style="width: 19%"><strong>GST</strong></td>
                                <td style="width: 26%"></td>

                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Deducted Amount</strong></td>
                                <td style="width: 30%">{{number_format((double)str_replace(',', '', $t_report['deducted']), 3)}}</td>
                                <td style="width: 19%"><strong>Total Amount</strong></td>
                                <td style="width: 26%">{{round($t_report['amount'] + $t_report['charges'],3)}}</td>

                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Pin</strong></td>
                                @if($t_report['service_id'] == 9)
                                <td style="width: 30%">{{str_replace('Pin:','',$t_report['note'])}}</td>
                                @else
                                    <td></td>
                                @endif
                                <td style="width: 19%"><strong>Exchange Rate</strong></td>
                                @if($t_report['service_id'] == 10)
                                    <td style="width: 30%"></td>
                                @else
                                    <td style="width: 26%">{{$report['rate']}}</td>
                                @endif

                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="panel panel-default" style="margin-bottom: 0px">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>SENDER DETAILS</strong></h3>
                </div>
                <div class="panel-body" style="padding: 0px 15px 0px 15px">
                        <table class="table table-condensed" style="margin-bottom: 2px">
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <tr>
                                <td style="width: 25%"><strong>Sender Name</strong></td>
                                <td style="width: 30%">{{$sender['name']}}</td>
                                <td style="width: 19%"><strong>Sender ID</strong></td>
                                <td style="width: 26%">{{$sender['mobile_number']}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Date of Birth</strong></td>
                                <td style="width: 30%">{{Carbon\Carbon::parse($sender['profile']['date_of_birth'])->format('F d, Y')}}</td>
                                <td style="width: 19%"><strong>Occupation</strong></td>
                                <td style="width: 26%">{{$sender['profile']['occupation']}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Passport Number</strong></td>
                                <td style="width: 30%">{{$sender['profile']['id_no']}}</td>
                                <td style="width: 19%"><strong>ID Expiry Date</strong></td>
                                <td style="width: 26%">{{date("Y", strtotime($sender['profile']['id_expire_date'])) < 1 ? '' : Carbon\Carbon::parse($sender['profile']['id_expire_date'])->format('F d, Y')}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Address</strong></td>
                                <td style="width: 30%">{{$sender['profile']['present_address']}}</td>
                                <td style="width: 19%"><strong>Postal</strong></td>
                                <td style="width: 26%">{{$sender['profile']['post_code']}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Country</strong></td>
                                <td style="width: 30%">{{$sender['profile']['p_country']}}</td>
                                <td style="width: 19%"><strong></strong></td>
                                <td style="width: 26%"></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>BENEFICIARY DETAILS</strong></h3>
                </div>
                <div class="panel-body" style="padding: 0px 15px 0px 15px">
                        <table class="table table-condensed" style="margin-bottom: 2px">
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <tr>
                                <td style="width: 25%"><strong>Beneficiary Name</strong></td>
                                <td style="width: 30%">{{$rec['name']}}</td>
                                <td style="width: 19%"><strong>Bank Name</strong></td>
                                <td style="width: 26%">{{$rec['recipient_banks']['name']}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Branch Name</strong></td>
                                <td style="width: 30%">{{$rec['recipient_bank_branch']['name']}}</td>
                                <td style="width: 19%"><strong>Account No</strong></td>
                                @if($t_report['service_id'] == 10)
                                    <td style="width: 26%">{{$t_report['account_name']}}</td>
                                @else
                                    <td style="width: 26%">{{$rec['bank_ac_no']}}</td>
                                @endif
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Receiving Country</strong></td>
                                <td style="width: 30%">{{$rec['country']}}</td>
                                <td style="width: 19%"><strong>Mobile No</strong></td>
                                <td style="width: 26%">{{$rec['phone']}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Payment Type</strong></td>
                                @if($t_report['service_id'] == 10)
                                    <td style="width: 30%">Wallet Remittance </td>
                                @else
                                    <td style="width: 30%">{{$report['transfer_mode']}}</td>
                                @endif
                                <td style="width: 19%"><strong>Relationship</strong></td>
                                <td style="width: 26%">{{$rec['recipient_relations']['name']}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><strong>Purpose of Remittance</strong></td>
                                @if($t_report['service_id'] == 10)
                                    <td style="width: 30%">{{$t_report['remittance_purpose']['name']}}</td>
                                @else
                                    <td style="width: 30%">{{$report['remittance_purpose']['name']}}</td>
                                @endif
                                <td style="width: 19%"><strong></strong></td>
                                <td style="width: 26%"></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ./wrapper -->
</body>
</html>

