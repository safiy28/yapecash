@extends('layout.inner-main')
@section('body-content')
    <style>
        .panel-body {
            overflow-x: auto !important;
        }
    </style>

            <h1 class="title-text">Sales Reports</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')
            <div class="leftpan">
                <div class="service_panel panel panel-body">
                    <form action="{{url('/user/reports/sales')}}" class="row range_serch">
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
                <div class="service_panel panel panel-default">
                    <div class="panel-body">
                        <table class="display table table-bordered" id="print-table">
                            <tbody>
                            <tr class="warning">
                                <th>
                                    Executions Date
                                </th>
                                @foreach( $names as $index => $amount )
                                    <th>{{$index}} Success</th>
                                    <th>{{$index}} Profit</th>
                                @endforeach
                                <th>
                                    Total Success
                                </th>
                                <th>
                                    Total Profit
                                </th>
                            </tr>
                            <?php $total_profit = 0; $total_success = 0; $count = 0; ?>
                            @foreach( $reports as $index => $amount )
                                <tr>
                                    <td>{{$index}}</td>
                                    @foreach( $names as $name => $value )
                                        <td>{{isset($amount[$name]["success"])?$amount[$name]["success"]:0}}</td>
                                        <td>{{isset($amount[$name]["profit"])?$amount[$name]["profit"]:0}}</td>
                                        <?php
                                        $count += 1;
                                        $total_profit += (isset($amount[$name]["profit"]) ? $amount[$name]["profit"] : 0);
                                        $total_success += (isset($amount[$name]["success"]) ? $amount[$name]["success"] : 0);
                                        ?>
                                    @endforeach


                                    <td>
                                        {{isset($totals[$index]["success"])?$totals[$index]["success"]:0}}
                                    </td>
                                    <td>
                                        {{isset($totals[$index]["profit"])?$totals[$index]["profit"]:0}}
                                    </td>

                                </tr>
                            @endforeach
                            <tr style="background-color: #caecfd;">
                                <td colspan="12"></td>
                                <td>
                                    <b>Total</b>
                                </td>
                                <td>
                                    {{$total_success}}
                                </td>
                                <td>
                                    {{$total_profit}}
                                </td>
                            </tr>

                            </tbody>
                        </table>
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
