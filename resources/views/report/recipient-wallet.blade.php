@extends('layout.inner-main')
@section('body-content')
    <div class="area contentArea">
        <div class="wrapper">
            <h1 class="title-text">Wallet Remittance Report</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="service_body">
                <div class="service_panel panel panel-body">
                    <form action="{{url('/recipient/wallet/reports')}}" class="row range_serch">
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
                </div>
                <div class="service_panel panel panel-body">
                    {{-- class="display table table-bordered table-striped" id="print-table" --}}
                    <table class="display table table-bordered table-striped" id="print-table">
                        <thead>
                        <tr>
                            <th>TRX ID</th>
                            <th>Tag</th>
                            <th>EasyRem ID</th>
                            <th>Reference</th>
                            <th>Order Date</th>
                            <th>Execution Date</th>
                            <th>Amount</th>
                            <th>BDT Amount</th>
                            <th>Mode</th>
                            <th>Sender Name</th>
                            <th>Sender Mobile</th>
                            <th>Receiver Name</th>
                            <th>Wallet No</th>
                            <th>Managed By</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($reports as $report)
                            @if((session('extra_permissions')['wallettransferreport_view'] == 1) || (session('extra_permissions')['wallettransferreport_view'] == 1))
                                <tr class="{{$report['risk']}}">
                                    <td>{{$report['transaction_no']}}</td>
                                    <td>{{$report['tag']}}</td>
                                    <td>{{$report['response_id']}}</td>
                                    <td>{{$report['message'] or $report['note']}}</td>
                                    <td><?php echo date('d-m-Y', strtotime($report['created_at'])); ?></td>
                                    <td><?php
                                        if ($report['status'] != 'Pending') {
                                            echo date('d-m-Y', strtotime($report['updated_at']));
                                        }
                                        ?>
                                    </td>
                                    <td>{{number_format($report['amount'],2)}}</td>
                                    <td>{{number_format($report['old_amount'],2)}}</td>
                                    <td>{{$report['mode']}}</td>
                                    <td>{{$report['sender']['name']}}</td>
                                    <td>{{$report['sender']['mobile_number']}}</td>
                                    <td>{{$report['recepient']['name']}}</td>
                                    <td>{{$report['account_name']}}</td>
                                    <td>
                                        @if($report['manage_by'] !== 0)
                                            {{$report['manager']['name'] or ''}}
                                        @endif
                                    </td>
                                    <td><a href="{{url('/')}}/recipient/wallet/report/{{$report['id']}}" class="status-btn {{strtolower($report['status'])}}-color">{{$report['status']}}</a></td>
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

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
        $(function () {

            $('#date_timepicker_start').datetimepicker({
                format: 'Y-m-d',
                onShow: function (ct) {
                    this.setOptions({
                        maxDate: $('#date_timepicker_end').val() ? $('#date_timepicker_end').val() : false
                    });
                },
                timepicker: false
            });


            $('#date_timepicker_end').datetimepicker({
                format: 'Y-m-d',
                onShow: function (ct) {
                    this.setOptions({
                        minDate: $('#date_timepicker_start').val() ? $('#date_timepicker_start').val() : false
                    });
                },
                timepicker: false
            });

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
