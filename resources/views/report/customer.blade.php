@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Customer Report</h2>
            <div class="service_body">
                <div class="service_panel panel panel-body">
                    <form action="{{url('/customer/reports')}}" class="row range_serch">
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

                            <th>Transaction ID</th>
                            <th>User Name : Number</th>
                            <th>Service Name</th>
                            <th>Receiver Number</th>
                            <th>Amount</th>
                            <th>Deducted/Refunded</th>
                            <th>Status</th>
                            <th>Response ID</th>
                            <th>Created Date</th>
                            <th>details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $index=>$report)
                            <tr>

                                <td><strong>{{$report['transaction_no']}}</strong></td>
                                <td><strong>{{$report['user_name']}} : {{$report['sender_mobile']}}</strong></td>

                                <td><strong>{{$report['service_name']}}</strong></td>

                                <td><strong>{{$report['receiver_mobile']}}</strong></td>

                                <td>{{$report['amount']}}</td>

                                <td>{{$report['deducted']}}</td>

                                <td>{{$report['status']}}</td>

                                <td><strong>{{$report['response_id']}}</strong></td>

                                <td><strong>{{$report['date']}}</strong></td>
                                <td><a href="{!!url('/')!!}/customer/reports/{{$report['id']}}">Link</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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

        });
    </script>
    @if(!$from && !$to && !$word)
        <script>
            window.setInterval(function () {

                $.get("{{url('/')}}/customer/reports/dynamic", function (data) {
                    console.log(data);
                    var rows = '';
                    $.each(data, function (index, item) {

                        var row = '<tr>';

                        row += '<td><strong>' + item.transaction_no + '</strong></td>';
                        row += '<td><strong>' + item.user_name + ': ' + item.sender_mobile + '</strong></td>';
                        row += '<td><strong>' + item.service_name + '</strong></td>';
                        row += '<td><strong>' + item.receiver_mobile + '</strong></td>';
                        row += '<td><strong>' + item.amount + '</strong></td>';
                        row += '<td><strong>' + item.deducted + '</strong></td>';
                        row += '<td><strong>' + item.status + '</strong></td>';
                        row += '<td><strong>' + item.response_id + '</strong></td>';
                        row += '<td><strong>' + item.date + '</strong></td>';
                        row += '<td><strong>' + '<a href="{!!url('/')!!}/customer/reports/' + item.id + '">link</a>' + '</strong></td>';
                        rows += row + '<tr>';
                    });
                    $("#print-table tbody").find("tr:gt(0)").remove();
                    $('#print-table tbody tr:last').after(rows);
                });
            }, 5000);
        </script>
    @endif
@stop
