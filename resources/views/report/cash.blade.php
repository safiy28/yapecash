@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Cash Pickup Report</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>


    @include('errors.list')

    <div class="leftpan">
        <div class="service_panel panel panel-body">
            <form action="{{url('/cash/reports')}}" class="row range_serch">
                <div class="col-md-3">
                    <div class="date-range">
                        <strong>Start Date</strong>
                        <div class="inpptus">
                            <input id="date_timepicker_start" class="form-control" value="{{$from}}" type="text"
                                   name="from" placeholder="Start Date">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="date-range">
                        <strong>End Date</strong>
                        <div class="inpptus">
                            <input id="date_timepicker_end" value="{{$to}}" class="form-control" type="text"
                                   name="to" placeholder="End date">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="date-range">
                        <strong>Anything</strong>
                        <div class="inpptus">
                            <input value="{{$word}}" type="text" name="word" placeholder="Any word" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <br>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            </form>
        </div>
        <div class="service_panel panel panel-body">
            <table  class="display table table-bordered table-striped" id="print-table">
                <thead>
                <tr>
                    <th>TRX ID</th>
                    <th>Report Type</th>
                    <th>Txn info</th>
                    <th>Response ID</th>
                    <th>Order Date</th>
                    <th>Execution Date</th>
                    <th>Country</th>
                    <th>Amount <br> (BDT)</th>
                    <th>Amount <br> (AUD)</th>
                    <th>Mode</th>
                    <th>MSP Name</th>
                    <th>MSP ID</th>
                    <th>Sender Name</th>
                    <th>Sender Mobile</th>
                    <th>Receiver Name</th>
                    <th>Managed By</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
                @foreach($reports as $report)

                    <?php if ($report['tag'] == 'metro') { ?>

                    @if(session('extra_permissions')['metroreport_view'] == 1)

                        <tr class="{{$report['risk']}}">

                            <td>{{$report['transaction_id']}}</td>
                            <td>{{$report['tag']}}</td>
                            <td>{{$report['note']}}</td>
                            <td>{{$report['response_id']}}</td>
                            <td><?php echo date('d-m-Y', strtotime($report['created_at'])); ?></td>
                            <td><?php
                                if ($report['status'] != 'Pending') {
                                    echo date('d-m-Y', strtotime($report['updated_at']));
                                }
                                ?></td>
                            <td>{{$report['country']}}</td>
                            <td>{{$report['amount']}}</td>
                            <td>{{$report['myr_amount']}}</td>
                            <td>{{$report['transfer_mode']}}</td>
                            <td>{{$report['msp_name']}}</td>
                            <td>{{$report['msp_id']}}</td>
                            <td>{{$report['sender_name']}}</td>
                            <td>{{$report['sender_mobile']}}</td>
                            <td>{{$report['receiver_name']}}</td>
                            <td>{{$report['manager']?$report['manager']['name']:"None"}}</td>
                            <td><a href="{{url('/')}}/recipient/reports/{{$report['id']}}"class="status-btn {{strtolower($report['status'])}}-color">{{$report['status']}}</a></td>
                        </tr>
                    @endif
                    <?php
                    }

                    if ($report['tag'] == 'city') {
                    ?>

                    @if(session('extra_permissions')['cityreport_view'] == 1)
                        <tr class="{{$report['risk']}}">

                            <td>{{$report['transaction_id']}}</td>
                            <td>{{$report['tag']}}</td>
                            <td>{{$report['note']}}</td>
                            <td>{{$report['response_id']}}</td>
                            <td><?php echo date('d-m-Y', strtotime($report['created_at'])); ?></td>
                            <td><?php
                                if ($report['status'] != 'Pending') {
                                    echo date('d-m-Y', strtotime($report['updated_at']));
                                }
                                ?></td>
                            <td>{{$report['country']}}</td>
                            <td>{{$report['amount']}}</td>
                            <td>{{$report['myr_amount']}}</td>
                            <td>{{$report['transfer_mode']}}</td>
                            <td>{{$report['msp_name']}}</td>
                            <td>{{$report['msp_id']}}</td>
                            <td>{{$report['sender_name']}}</td>
                            <td>{{$report['sender_mobile']}}</td>
                            <td>{{$report['receiver_name']}}</td>
                            <td>{{$report['manager']?$report['manager']['name']:"None"}}</td>
                            <td><a href="{{url('/')}}/recipient/reports/{{$report['id']}}"class="status-btn {{strtolower($report['status'])}}-color">{{$report['status']}}</a></td>
                        </tr>
                    @endif
                    <?php
                    }
                    if ($report['tag'] == 'ucash') {
                    ?>

                    @if(session('extra_permissions')['mmeucashreport_view'] == 1)
                        <tr class="{{$report['risk']}}">

                            <td>{{$report['transaction_id']}}</td>
                            <td>{{$report['tag']}}</td>
                            <td>{{$report['note']}}</td>
                            <td>{{$report['response_id']}}</td>
                            <td><?php echo date('d-m-Y', strtotime($report['created_at'])); ?></td>
                            <td><?php
                                if ($report['status'] != 'Pending') {
                                    echo date('d-m-Y', strtotime($report['updated_at']));
                                }
                                ?></td>
                            <td>{{$report['country']}}</td>
                            <td>{{$report['amount']}}</td>
                            <td>{{$report['myr_amount']}}</td>
                            <td>{{$report['transfer_mode']}}</td>
                            <td>{{$report['msp_name']}}</td>
                            <td>{{$report['msp_id']}}</td>
                            <td>{{$report['sender_name']}}</td>
                            <td>{{$report['sender_mobile']}}</td>
                            <td>{{$report['receiver_name']}}</td>
                            <td>{{$report['manager']?$report['manager']['name']:"None"}}</td>
                            <td><a href="{{url('/')}}/recipient/reports/{{$report['id']}}"class="status-btn {{strtolower($report['status'])}}-color">{{$report['status']}}</a></td>
                        </tr>
                    @endif
                    <?php
                    }

                    if ($report['tag'] == 'bank') {
                    ?>

                    @if(session('extra_permissions')['mmeucashpickupreport_view'] == 1)
                        <tr class="{{$report['risk']}}">

                            <td>{{$report['transaction_id']}}</td>
                            <td>{{$report['tag']}}</td>
                            <td>{{$report['note']}}</td>
                            <td>{{$report['response_id']}}</td>
                            <td><?php echo date('d-m-Y', strtotime($report['created_at'])); ?></td>
                            <td><?php
                                if ($report['status'] != 'Pending') {
                                    echo date('d-m-Y', strtotime($report['updated_at']));
                                }
                                ?></td>
                            <td>{{$report['country']}}</td>
                            <td>{{$report['amount']}}</td>
                            <td>{{$report['myr_amount']}}</td>
                            <td>{{$report['transfer_mode']}}</td>
                            <td>{{$report['msp_name']}}</td>
                            <td>{{$report['msp_id']}}</td>
                            <td>{{$report['sender_name']}}</td>
                            <td>{{$report['sender_mobile']}}</td>
                            <td>{{$report['receiver_name']}}</td>
                            <td>{{$report['manager']?$report['manager']['name']:"None"}}</td>
                            <td><a href="{{url('/')}}/recipient/reports/{{$report['id']}}"class="status-btn {{strtolower($report['status'])}}-color">{{$report['status']}}</a></td>
                        </tr>
                    @endif
                    <?php }
                    if ($report['tag'] == 'notag' || $report['tag'] == 'tranglo' || $report['tag'] == '') {

                    ?>
                    @if(session('extra_permissions')['notag_view'] == 1)
                        <tr class="{{$report['risk']}}">

                            <td>{{$report['transaction_id']}}</td>
                            <td>{{$report['tag']}}</td>
                            <td>{{$report['note']}}</td>
                            <td>{{$report['response_id']}}</td>
                            <td><?php echo date('d-m-Y', strtotime($report['created_at'])); ?></td>
                            <td><?php
                                if ($report['status'] != 'Pending') {
                                    echo date('d-m-Y', strtotime($report['updated_at']));
                                }
                                ?></td>
                            <td>{{$report['country']}}</td>
                            <td>{{$report['amount']}}</td>
                            <td>{{$report['myr_amount']}}</td>
                            <td>{{$report['transfer_mode']}}</td>
                            <td>{{$report['msp_name']}}</td>
                            <td>{{$report['msp_id']}}</td>
                            <td>{{$report['sender_name']}}</td>
                            <td>{{$report['sender_mobile']}}</td>
                            <td>{{$report['receiver_name']}}</td>
                            <td>{{$report['manager']?$report['manager']['name']:"None"}}</td>
                            <td><a href="{{url('/')}}/recipient/reports/{{$report['id']}}"class="status-btn {{strtolower($report['status'])}}-color">{{$report['status']}}</a></td>
                        </tr>
                    @endif
                    <?php  }    ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('footer-script')
<style>
    .normal {
        color: #3c763d;
        border-color: #d6e9c6;
    }

    .high {
        color: #ff2800;
        border-color: #ebccd1;
    }

    .moderate {
        color: #8a6d3b;
        border-color: #faebcc;
    }
</style>
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

        $(function () {
            $('#print-table').DataTable({
                dom: 'Brtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                aaSorting: [],
                iDisplayLength: 10,
                pagingType: 'numbers'
            });
        });
    </script>
@stop
