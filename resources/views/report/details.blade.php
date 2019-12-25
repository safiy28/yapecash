@extends('layout.inner-main')
@section('body-content')
    <div class="area contentArea">
        <div class="wrapper">
            <h1 class="title-text"> Details Order Statement</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>

            @include('errors.list')

            <div class="service_body">
                <div class="service_panel panel panel-default">
                    <div class="panel-heading">Select Operator</div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <tr class="warning">
                                <th>Transaction No:</th>
                                <td>{{$report['transaction_no']}}</td>
                            </tr>
                            <tr>
                                <th>Ref No:</th>
                                <td>{{$report['response_id']}}</td>
                            </tr>
                            <tr>
                                <th>Service Name:</th>
                                <td>{{$report['service_name']}}</td>
                            </tr>
                            <tr>
                                <th>Receiver Mobile No:</th>
                                <td>{{$report['receiver_mobile']}}</td>
                            </tr>
                            <tr>
                                <th>Sender Mobile No:</th>
                                <td>{{$report['sender_mobile']}}</td>
                            </tr>
                            <tr>
                                <th>MyCash Point Amount:</th>
                                <td>{{number_format(str_replace(',', '', $report['amount']), 3)}}</td>
                            </tr>
                            <tr>
                                <th>Given Amount:</th>
                                <td>{{number_format(str_replace(',', '', $report['old_amount']), 3)}}</td>
                            </tr>
                            <tr>
                                <th>Deducted Amount:</th>
                                <td>{{number_format(str_replace(',', '', $report['deducted']), 3)}}</td>
                            </tr>
                            <tr>
                                <th>Total Amount:</th>
                                <td>{{number_format(str_replace(',', '', $report['amount']) + $report['charges'], 3)}}</td>
                            </tr>
                            <tr>
                                <th>Charges:</th>
                                <td>{{number_format($report['charges'], 3)}}</td>
                            </tr>
                            <tr>
                                <th>Commission:</th>
                                <td>{{number_format($report['commission'], 3)}}</td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td>{{number_format($report['discount'], 3)}}</td>
                            </tr>
                            <tr>
                                <th>After Transaction:</th>
                                <td> {{number_format(str_replace(',', '', $report['after']), 3)}}</td>
                            </tr>
                            <tr>
                                <th>Before Transaction:</th>
                                <td>{{number_format(str_replace(',', '', $report['before']), 3)}}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td> {{$report['status']}}</td>
                            </tr>
                            <tr>
                                <th>Message:</th>
                                <td> {{str_replace('mycash1Re', ' ', $report['message'])}}</td>
                            </tr>
                            <tr>
                                <th>Date & Time:</th>
                                <td> {{$report['date']}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="button_area">
                    <a href="{{url('/report')}}" class="btn btn-lg btn-action btn-warning">Back</a>

                    @if($report['service']['type'] == 'recipient')
                        <a href="{{url('/')}}/invoice/{{$report['id']}}/3" id="metroprint" target="_blank" class="btn btn-lg btn-action btn-danger">Re Print</a>
                    @endif

                    @if($report['service']['name'] == 'Air Ticket')
                        <a href="#" id="metroprint" class="btn btn-lg btn-action btn-danger">Re Print</a>
                    @endif

                    @if($voucher)
                    <!--    <input type="submit" id="print" value="Re-Print" class="submitbtn">-->
                        <a href="#" id="print" class="btn btn-lg btn-action btn-danger">Re Print</a>
                    @endif
                </div>
            </div>

        </div>

    </div>
@stop

@section('footer-script')
    <script>

    </script>
@stop
