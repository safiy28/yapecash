@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Payment Report</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="leftpan">
                <div class="service_panel panel panel-body">
                    <form action="{{url('/payment/reports')}}" class="row range_serch">
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
                            <th>Payment NO</th>
                            <th>Response ID</th>

                            <th>Type</th>
                            <th>REF No</th>
                            <th>Amount Received</th>

                            <th>Previous Amount</th>
                            <th>Current Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Attachment</th>

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

                                <td>{{$report['before']?number_format($report['before'],2,'.',','):0}}</td>
                                <td>{{$report['after']?number_format($report['after'],2,'.',','):0}}</td>
                                <td>{{$report['status']}}</td>
                                <td><strong>{{$report['payment_time_date']}} </strong></td>
                                <td>
                                    <a href="{{$report['slip']}}" data-lightbox="roadtrip">Click</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <ul class="pagination">

                        <?php $page_number = $page_info['last_page'];
                        $query = "";
                        if ($to) {
                            $query = "&to=" . $to;
                        }
                        if ($from) {
                            $query = $query . "&from=" . $from;
                        }
                        ?>

                        @for( $i = 1; $i<=$page_number; $i++ )
                            <li>
                                <a href="{{url('/')}}/payment/reports?page={{$i}}{{$query}}"
                                   class="page {{$page_info['current_page']==$i?"active":"gradient"}}">{{$i}}</a>
                            </li>
                        @endfor
                    </ul>
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
