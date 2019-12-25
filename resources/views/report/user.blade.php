@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">User Report</h2>
            <div class="service_body">
                <div class="service_panel panel panel-body">
                    <form action="{{url("/user/reports/{$id}")}}" class="row range_serch">
                        <div class="col-md-4">
                            <div class="date-range">
                                <strong>Start Date</strong>
                                <div class="inpptus">
                                    <input id="date_timepicker_start" class="form-control" value="{{$from}}" type="text"
                                           name="from" placeholder="Start Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="date-range">
                                <strong>End Date</strong>
                                <div class="inpptus">
                                    <input id="date_timepicker_end" value="{{$to}}" class="form-control" type="text"
                                           name="to" placeholder="End date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                <div class="service_panel panel panel-body">
                    {{-- class="display table table-bordered table-striped" id="print-table" --}}
                    <table class="display table table-bordered table-striped" id="print-table">
                        <thead>
                        <tr>
                            <th>Date of Execution</th>
                            <th>Transfer In</th>
                            <th>Transfer Out</th>
                            <th>Gift to Bangladesh (Excuted)</th>
                            <th>Gift to Bangladesh (Charges)</th>
                            <th>Local Top (Success)</th>
                            <th>Bangladesh Top (Success)</th>
                            <th>Nepal Top (Success)</th>
                            <th>Total Used</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $reports as $index => $amount )
                            <tr>
                                <td>{{$index}}</td>

                                <td>{{isset($amount["Point Transfer"]["Received"])?$amount["Point Transfer"]["Received"]:0}} </td>
                                <td>{{isset($amount["Point Transfer"]["Success"])?$amount["Point Transfer"]["Success"]:0}} </td>
                                <td>{{isset($amount["Gift to Bangladesh"]["Executed"])?$amount["Gift to Bangladesh"]["Executed"]:0}} </td>


                                <td>{{isset($amount["Gift to Bangladesh"]["charges"])?$amount["Gift to Bangladesh"]["charges"]:0}} </td>

                                <td>{{isset($amount["Malaysia Top Up"]["Success"])?$amount["Malaysia Top Up"]["Success"]:0}} </td>

                                <td>{{isset($amount["Bangladesh Topup"]["Success"])?$amount["Bangladesh Topup"]["Success"]:0}} </td>

                                <td>{{isset($amount["Nepal Topup"]["Success"])?$amount["Nepal Topup"]["Success"]:0}} </td>
                                <td>{{(isset($amount["Gift to Bangladesh"]["Executed"])?$amount["Gift to Bangladesh"]["Executed"]:0)+(isset($amount["Malaysia Top Up"]["Success"])?$amount["Malaysia Top Up"]["Success"]:0)+(isset($amount["Bangladesh Topup"]["Success"])?$amount["Bangladesh Topup"]["Success"]:0)+(isset($amount["Nepal Topup"]["Success"])?$amount["Nepal Topup"]["Success"]:0)}}</td>

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
@stop
