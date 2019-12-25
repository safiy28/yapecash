@extends('app')

@section('header')

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css"/>


    <link rel="stylesheet" type="text/css" href="{!!url('/')!!}/css/jquery.datetimepicker.css"/>

    <style>
        #print-table_info {
            display: none;
        }
    </style>
@stop

@section('title')
    <h1>BD TopUp & MB Reload Report</h1>
@stop
@section('content')
    <div class="leftpan">
        @include('errors.list')
        <div class="dates">
            <form action="{{url('/bdtopup/report')}}">
                <div class="date-range">
                    <strong>Start Date</strong>
                    <input id="date_timepicker_start" value="{{$from}}" type="text" name="from"
                           placeholder="Start Date">
                </div>
                <div class="date-range"><strong>End Date</strong>
                    <input id="date_timepicker_end" value="{{$to}}" type="text" name="to" placeholder="End date">
                </div>

                <div class="date-range"><strong>Anything</strong>
                    <input value="{{$word}}" type="text" name="word" placeholder="Any word">
                </div>

                <!--   <input type="text" placeholder="Search" style="width:200px"> -->
                <input type="submit" value="Search" class="submitbtn">
            </form>
        </div>


        <div class="custom_tbl">

            <!--    <div class="tblcon">-->
            <table class="display table table-bordered table-striped" id="print-table">

                <thead>

                <tr>

                    <th>TRX ID</th>
                    <th>Order Date</th>
                    <th>Execution Date</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Deducted BDT Amount</th>
                    <th>Sending BDT Amount</th>
                    <th>Sender No</th>
                    <th>Receiver No</th>
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
                        <td>{{$report['service']['name']}}</td>
                        <td>{{$report['amount']}}</td>
                        <td>{{$report['old_amount']}}</td>
                        <td>{{$report['operator']}}</td>
                        <td>{{$report['sender_mobile']}}</td>
                        <td>{{$report['receiver_mobile']}}</td>

                        <td><?php echo str_replace('_', ' ', $report['note']);?></td>
                        <td>{{$report['manager']?$report['manager']['name']:"None"}}</td>
                        <td><a href="{{url('/bdtopup/report/view/')}}/{{$report['id']}}"
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
                <a href="{{url('/')}}/bdtopup/report?page={{$i}}{{$query}}"
                   class="page {{$page_info['current_page']==$i?"active":"gradient"}}">{{$i}}</a>
            @endfor


        </div>

    </div>

@stop


@section('footer')




    <script src="{!!url('/')!!}/js/custom.js"></script>



    <!--dynamic table-->
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{!!url('/assets/template/')!!}/js/data-tables/DT_bootstrap.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>




    <script>

        $(function () {

            $('#print-table').DataTable({
                dom: 'Brtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                aaSorting: [],
                bPaginate: false

            });
        });

    </script>

    <script src="{!!url('/')!!}/js/jquery.datetimepicker.full.min.js"></script>

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

    </script>
@stop
