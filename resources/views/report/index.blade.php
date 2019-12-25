@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Order Statement</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="leftpan">
                <div class="service_panel panel panel-body">
                    <form action="{{url('/report')}}" class="row range_serch">
                        <div class="col-md-3">
                            <div class="date-range">
                                <strong>Start Date</strong>
                                <div class="inpptus">
                                    <input id="date_timepicker_start" class="form-control" value="{{$from}}" type="text" name="from" placeholder="Start Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="date-range">
                                <strong>End Date</strong>
                                <div class="inpptus">
                                    <input id="date_timepicker_end" value="{{$to}}" class="form-control" type="text" name="to" placeholder="End date">
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
                        </br>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                <div class="service_panel panel panel-body">
                    <table class="display table table-bordered table-striped" id="print-table">
                        <thead>
                        <tr>
                            <th>TRX NO</th>
                            <th>REF ID</th>
                            <th>Service Name</th>
                            <th>Receiver No</th>
                            <th>Send Amount</th>
                            <th>Receiving Amount</th>
                            <th>New Balance</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td><strong>{{$report['transaction_no']}}</strong></td>
                                <td><strong>{{$report['response_id']}}</strong></td>
                                <td><strong>{{$report['service_name']}}</strong></td>
                                <td>{{$report['receiver_mobile']}}</td>
                                <td>{{$report['amount']}}</td>
                                <td>{{$report['old_amount']?$report['old_amount']:"Not Given"}}</td>
                                <td>{{$report['after']}}</td>
                                <td>{{$report['status']}}</td>
                                <td>{{substr($report['message'], 0, 13)}}</td>
                                <td><strong>{{$report['date']}}</strong></td>
                                <td><a href="{!!url('/')!!}/report/{{$report['id']}}" class="btn btn-sm btn-primary">Link</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
