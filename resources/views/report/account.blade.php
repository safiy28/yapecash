@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Account TopUp Report</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>


    @include('errors.list')

    <div class="leftpan">
        <div class="service_panel panel panel-body">
            <form action="{{url('/account')}}" class="row range_serch">
                <div class="col-md-4">
                    <div class="date-range">
                        <strong>Start Date</strong>
                        <div class="inpptus">
                            <input id="date_timepicker_start" class="form-control" value="{{$from}}" type="text" name="from" placeholder="Start Date">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="date-range">
                        <strong>End Date</strong>
                        <div class="inpptus">
                            <input id="date_timepicker_end" value="{{$to}}" class="form-control" type="text" name="to" placeholder="End date">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="service_panel panel panel-body">
            <table class="display table table-bordered table-striped" id="print-table">
                <thead>
                <tr>
                    <th>TRX ID</th>
                    <th>Order Date</th>
                    <th>Execution Date</th>
                    <th>Bank Name</th>
                    <th>Mode</th>
                    <th>Amount</th>
                    <th>Account No.</th>
                    <th>Note</th>
                    <th>Managed By</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{$report['transaction_no']}}</td>
                        <td><?php echo date('d-m-Y', strtotime($report['created_at'])); ?></td>
                        <td><?php
                            if ($report['status'] != 'Pending') {
                                echo date('d-m-Y', strtotime($report['updated_at']));
                            }
                            ?></td>
                        <td><?php echo str_replace('_', ' ', $report['operator']);?></td>

                        <td><?php echo str_replace('_', ' ', $report['mode']);?></td>
                        <td>{{$report['amount']}}</td>
                        <td>{{$report['receiver_mobile']}}</td>

                        <td><?php echo str_replace('_', ' ', $report['note']);?></td>
                        <td>{{$report['manager']?$report['manager']['name']:"None"}}</td>
                        <td><a href="{{url('/')}}/account/report/{{$report['id']}}"
                               class="status-btn {{strtolower($report['status'])}}-color">{{$report['status']}}</a></td>
                    <!--                        <td>{{$report['status']}}</td>-->
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div>

        <div class="pagination">
            <?php
            $page_number = $page_info['last_page'];
            $query = "";
            if ($to) {
                $query = "&to=" . $to;
            }
            if ($from) {
                $query = $query . "&from=" . $from;
            }
            ?>
            @for( $i = 1; $i<=$page_number; $i++ )
                <a href="{{url('/')}}/recipient/reports?page={{$i}}{{$query}}"
                   class="page {{$page_info['current_page']==$i?"active":"gradient"}}">{{$i}}</a>
            @endfor


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
