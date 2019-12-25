@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Mobile Sales Person</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>
            @include('errors.list')

            <div id="ajaxResponseMessage">

            </div>
            <div class="leftpan">
                <div class="panel">
                    <h2>Basic Information</h2>
                    <div class="panelcontent">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>MSP Name:</th>
                                        <td> {{$user['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile No:</th>
                                        <td> {{$user['mobile_number']}}</td>
                                    </tr>
                                    <tr>
                                        <th>MSP Type:</th>
                                        <td> {{$group['name']}}</td>
                                    </tr>

                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            <span class="status-text"><span id="statusTextlabel"></span></span>
                                            <span class="status-button">
                                                    <button data-backdrop="false" data-toggle="modal" data-target="#statusChangeBtn" type="button" class="{{$user['active']!=1 ? "btn btn-sm btn-danger": "btn btn-sm btn-success"}}" id="statusBtn"><span id="statusButtonLabel">{{$user['active']==1 ? "Active" : "Inactive"}}</span></button>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Profile Risk Status:</th>
                                        <td>
                                            <span class="status-button">
                                                    <button data-backdrop="false" data-toggle="modal" data-target="#riskChangeBtn" type="button" class="btn btn-sm btn-risk" style="background-color: {{$user['risk_profile_settings'][$user['risk_status']]}}" id="riskBtn"><span id="riskButtonLabel">{{ucfirst($user['risk_status'])}}</span></button>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Parent Name:</th>
                                        <td>{{$parent['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Area:</th>
                                        <td> {{$profile['present_address']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Account Open Date:</th>
                                        <td> {{$user['created_at']}} </td>
                                    </tr>
                                    <tr>
                                        <th>Available
                                            Point:
                                        </th>
                                        <td> {{$point['available']?number_format((float)$point['available'], 2, '.', ','):0}}</td>
                                    </tr>

                                    <tr>
                                        <th>Reset Password and PIN:</th>
                                        <td>
                                            <span class="status-button">
                                                    <button data-backdrop="false" data-toggle="modal" data-target="#passwordChangeBtn" type="button" class="btn btn-sm btn-info">Click Here</button>
                                            </span>
                                            <div class="text-success text-center" id="successResponse"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Profile Picture :</th>
                                        <td><img src="{{asset($profile['profile_photo'])}}" width="200"></td>
                                    </tr>
                                    <tr>
                                        <th>Scan of ID :</th>
                                        <td><img src="{{asset($profile['scan'])}}" width="200"></td>
                                    </tr>
                                    <tr>
                                        <th>Scan of ID 2 :</th>
                                        <td><img src="{{asset($profile['scan_one'])}}" width="200"> </td>
                                    </tr>
                                    <tr>
                                        <th>Scan of ID 3 :</th>
                                        <td><img src="{{asset($profile['scan_two'])}}" width="200"> </td>
                                    </tr>
                                    <tr>
                                        <th>Last Login Time:</th>
                                        <td> {{$logininfo['updated_at']}}</td>
                                    </tr>



                                    <tr>
                                        <td colspan="2"> <a href=" {{ url('user/update/'.$user['id']) }}" class="btn btn-sm btn-success text-center">Edit Profile</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3">
                                <img src="{{$user['photo']}}" alt="" width="300" height="300"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h2>Banking Statements</h2>
                    <div class="panelcontent">
                        <table class="display table table-bordered table-striped" id="print-table">
                            <thead>
                            <tr class="danger">
                                <th><strong>Payment No</strong></th>
                                <th><strong>Response ID</strong></th>
                                <th><strong>Type</strong></th>
                                <th><strong>Ref No</strong></th>
                                <th><strong>Amount Received</strong></th>
                                <th><strong>Previous Amount</strong></th>
                                <th><strong>Current Amount</strong></th>
                                <th><strong>Status</strong></th>
                                <th><strong>Date</strong></th>
                                <th><strong>Attachment</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td><strong>{{$report['payment_no']}}</strong></td>
                                    <td><strong>{{$report['response_id']}}</strong></td>
                                    <td><strong>{{$report['type']}}</strong></td>
                                    <td><strong>{{$report['reference_no']}}</strong></td>
                                    <td><strong>{{$report['amount']}}</strong></td>

                                    <td>{{$report['before']?number_format((float)$report['before'],2,'.',','):0}}</td>
                                    <td>{{$report['after']?number_format((float)$report['after'],2,'.',','):0}}</td>
                                    <td>{{$report['status']}}</td>
                                    <td><strong>{{$report['payment_time_date']}} </strong></td>
                                    <td>
                                        @if($report['slip'] && !empty($report['slip']))
                                            <a href="{{$report['slip']}}" data-lightbox="roadtrip" class="btn btn-primary btn-xs">Click</a>
                                        @else
                                            Attachment is not required for this transaction
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel">
                    <h2>Transaction Statements</h2>
                    <div class="panelcontent">
                        <table class="display table table-bordered table-striped" id="print-table1">
                            <thead>
                            <tr class="danger">
                                <th><strong>TRX No</strong></th>
                                <th><strong>REF No</strong></th>
                                <th><strong>Service Name</strong></th>
                                <th><strong>Receiver No</strong></th>
                                <th><strong>Send Amount</strong></th>
                                <th><strong>Receiveing Amount</strong></th>
                                <th><strong>New Balance</strong></th>
                                <th><strong>Status</strong></th>
                                <th><strong>Message</strong></th>
                                <th><strong>Date</strong></th>
                                <th><strong>Details</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td><strong>{{$transaction['transaction_no']}}</strong></td>
                                    <td><strong>{{$transaction['response_id']}}</strong></td>
                                    <td><strong>{{$transaction['service_name']}}</strong></td>
                                    <td>{{$transaction['receiver_mobile']}}</td>
                                    <td>{{ number_format((float)$transaction['amount'],2) }}</td>
                                    <td>{{$transaction['old_amount']?$transaction['old_amount']:"Not Given"}}</td>
                                    <td>{{ number_format((float)$transaction['after'],2) }}</td>
                                    <td>{{$transaction['status']}}</td>
                                    <td>{{substr($transaction['message'], 0, 13)}}</td>
                                    <td><strong>{{$transaction['updated_at']}}</strong></td>
                                    <td><a href="{!!url('/')!!}/report/{{$transaction['id']}}" class="btn btn-primary btn-xs" target="_blank">Link</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="statusChangeBtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="vertical-alignment-helper">
                    <div class="modal-dialog vertical-align-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                                </button>
                                <h4 class="modal-title" id="myModalLabel"> Change MSP Status to {{$user['active']==1 ? "Inactive" : "Active"}} </h4>

                            </div>
                            <div class="modal-body">

                                <form id="statusUpdateForm">
                                    {{csrf_field()}}
                                    <input name="user_id" value="{{$user['id']}}" type="hidden">
                                    <div class="service_panel panel panel-default">
                                        <div id="errorResponse"></div>
                                        <div class="panel-heading">PIN</div>
                                        <div class="panel-body">
                                            <div class="form-group clearfix">
                                                <input placeholder="Enter your pin" class="form-control" id="pin" name="pin" required="" type="password">
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="button" id="StatusUpdateConfirm" class="btn btn-success">Update Status</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="passwordChangeBtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="vertical-alignment-helper">
                    <div class="modal-dialog vertical-align-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                                </button>
                                <h4 class="modal-title" id="myModalLabel"> Reset MSP Password </h4>

                            </div>
                            <div class="modal-body">

                                <form id="passwordUpdateForm">
                                    {{csrf_field()}}
                                    <input name="user_id" value="{{$user['id']}}" type="hidden">
                                    <div class="service_panel panel panel-default">


                                        <div id="errorResponse2"></div>
                                        <div class="panel-heading">PIN</div>
                                        <div class="panel-body">
                                            <div class="form-group clearfix">
                                                <input placeholder="Enter your pin" class="form-control" id="pin" name="pin" required="" type="password">
                                            </div>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="button" id="passwordChangeConfirm" class="btn btn-success">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="riskChangeBtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="vertical-alignment-helper">
                    <div class="modal-dialog vertical-align-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                                </button>
                                <h4 class="modal-title" id="myModalLabel"> Update MSP Profile Risk Status </h4>

                            </div>
                            <div class="modal-body">

                                <form id="riskUpdateForm">
                                    {{csrf_field()}}
                                    <input name="user_id" value="{{$user['id']}}" type="hidden">
                                    <div class="service_panel panel panel-default">


                                        <div id="errorResponseRiskProfiling"></div>

                                        <div class="panel-heading">Risk Profile</div>
                                        <div class="panel-body">
                                            <div class="form-group clearfix">
                                                <select class="form-control" id="risk_type" name="risk_type" required="">

                                                    <option value="normal" {{$user['risk_status'] =='normal' ? 'selected' : ''}}>
                                                        Normal
                                                    </option>
                                                    <option value="moderate" {{$user['risk_status'] =='moderate' ? 'selected' : ''}}>
                                                        Moderate
                                                    </option>
                                                    <option value="high" {{$user['risk_status'] =='high' ? 'selected' : ''}}>
                                                        High
                                                    </option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="panel-heading">PIN</div>
                                        <div class="panel-body">
                                            <div class="form-group clearfix">
                                                <input placeholder="Enter your pin" class="form-control" id="pin" name="pin" required="" type="password">
                                            </div>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="button" id="riskUpdateConfirm" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@stop
@section('footer-script')
    <script src="{{url('/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/js/data-tables/DT_bootstrap.js')}}"></script>

    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
    <script>
        $('#print-table').DataTable({
            dom: 'Brtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            aaSorting: [],
            iDisplayLength: 10,
            pagingType: 'numbers'
        });
        $('#print-table1').DataTable({
            dom: 'Brtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            aaSorting: [],
            iDisplayLength: 10,
            pagingType: 'numbers'
        });
        $(function() {
            $('#StatusUpdateConfirm').click( function() {
                $.post( "{{route('msp.status.update')}}", $('form#statusUpdateForm').serialize(), function(data) {
                    if(data.status == "Success"){
                        var statusLabel = data.statusResponse == 1 ? "Active" : "Inactive";
                        var btnClass    = statusLabel == 'Inactive' ? "btn btn-sm btn-danger": "btn btn-sm btn-success";
                        $('#errorResponse').empty();
                        $('#statusChangeBtn').modal('toggle');
                        $('#statusButtonLabel').empty();
                        $('#statusButtonLabel').text(statusLabel);
                        $("#statusBtn").removeClass().addClass(btnClass);
                        var successMessage = '<div class="service_alert success">\n' +
                            '                    <div class="icon">\n' +
                            '                        <div class="glyphicon glyphicon-ok-circle"></div>\n' +
                            '                    </div>\n' +
                            '                    <div class="massages">\n' +
                            '                        <div class="alert-title">Success</div>\n' +
                            '                        <div class="alert-body">\n' +
                            '                            <strong>Congratulations</strong>, Msp status has been successfully updated.\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>';

                        $('#ajaxResponseMessage').empty();
                        $('#ajaxResponseMessage').append(successMessage);
                    }
                    else{
                        $('#ajaxResponseMessage').empty();
                        $('#errorResponse').empty();
                        var errorMessage = '<div class="alert alert-danger">\n' +
                            '<strong>Error!</strong> '+data.message+'\n' +
                            '</div>';

                        $('#errorResponse').append(errorMessage);
                    }
                },"json");
            });
            $('#passwordChangeConfirm').click( function() {
                $.post( "{{route('msp.password.reset')}}", $('form#passwordUpdateForm').serialize(), function(data) {
                    if(data.status == "Success"){
                        $('#passwordChangeBtn').modal('toggle');

                        var successMessage = '<div class="service_alert success">\n' +
                            '                    <div class="icon">\n' +
                            '                        <div class="glyphicon glyphicon-ok-circle"></div>\n' +
                            '                    </div>\n' +
                            '                    <div class="massages">\n' +
                            '                        <div class="alert-title">Success</div>\n' +
                            '                        <div class="alert-body">\n' +
                            '                            <strong>Congratulations</strong>, Msp password has been successfully reset.\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>';

                        $('#ajaxResponseMessage').empty();
                        $('#ajaxResponseMessage').append(successMessage);

                    }
                    else{
                        $('#ajaxResponseMessage').empty();
                        $('#errorResponse2').empty();
                        var errorMessage = '<div class="alert alert-danger">\n' +
                            '<strong>Error!</strong> '+data.message+'\n' +
                            '</div>';
                        $('#errorResponse2').append(errorMessage);
                    }
                },"json");
            });
            $('#riskUpdateConfirm').click( function() {
                $.post( "{{route('msp.risk.update')}}", $('form#riskUpdateForm').serialize(), function(data) {
                    if(data.status == "Success"){
                        var riskLabel = data.statusResponse;
                        $('#errorResponse').empty();
                        $('#riskChangeBtn').modal('toggle');
                        $('#riskButtonLabel').empty();
                        $('#riskButtonLabel').text(riskLabel);
                        $("#riskBtn").css("background-color",data.risk_profile_color);

                        var successMessage = '<div class="service_alert success">\n' +
                            '                    <div class="icon">\n' +
                            '                        <div class="glyphicon glyphicon-ok-circle"></div>\n' +
                            '                    </div>\n' +
                            '                    <div class="massages">\n' +
                            '                        <div class="alert-title">Success</div>\n' +
                            '                        <div class="alert-body">\n' +
                            '                            <strong>Congratulations</strong>, Msp profile risk status has been successfully updated.\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>';

                        $('#ajaxResponseMessage').empty();
                        $('#ajaxResponseMessage').append(successMessage);
                    }
                    else{
                        $('#ajaxResponseMessage').empty();
                        $('#errorResponseRiskProfiling').empty();
                        var errorMessage = '<div class="alert alert-danger">\n' +
                            '<strong>Error!</strong> '+data.message+'\n' +
                            '</div>';

                        $('#errorResponseRiskProfiling').append(errorMessage);
                    }
                },"json");
            });
        });
    </script>
@stop