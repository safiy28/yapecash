@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}} ( Confirm )</h2>

            @include('modules.result_service')

            <div class="service_body">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        {{session()->forget('form_submitted')}}
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Invoice # {{$service_result['transaction_no']}}</div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Number :</td>
                                        <td><strong>{{isset($receiver_mobile_number)?$receiver_mobile_number:session('mobile_number')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Given Contact</td>
                                        <td><strong>{{$contact_number}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>PNR</td>
                                        <td><strong>{{isset($service_result['pnr'])?$service_result['pnr']:""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Trip Id</td>
                                        <td><strong>{{isset($service_result['tripId'])?$service_result['tripId']:""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>From</td>
                                        <td><strong>{{isset($service_result['from'])?$service_result['from']:""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>To</td>
                                        <td>
                                            <strong>{{isset($service_result['to'])?$service_result['to']:""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Pickup Point</td>
                                        <td><strong>{{isset($service_result['pickupPoint'])?$service_result['pickupPoint']:""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Operator</td>
                                        <td><strong>{{isset($service_result['operator'])?$service_result['operator']:""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Travel Date</td>
                                        <td><strong>{{isset($service_result['travelDate'])?$service_result['travelDate']:""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Pickup Time</td>
                                        <td><strong>{{isset($service_result['pickupTime'])?$service_result['pickupTime']:""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Drop off Time</td>
                                        <td><strong>{{isset($service_result['dropoffTime'])?$service_result['dropoffTime']:""}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Amount</td>
                                        <td><strong>{{isset($service_result['amount'])?$service_result['amount']:""}} {{isset($service_result['currency'])?$service_result['currency']:""}}
                                            = {{isset($service_result['amount'])?$service_result['amount']:""}} points</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Charges </td>
                                        <td><strong>{{isset($service_result['charge'])?$service_result['charge']:""}} points</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Commissions</td>
                                        <td><strong>{{isset($service_result['commission'])?$service_result['commission']:""}}
                                            points</strong></td>
                                    </tr>
                                    <tr><td>Discount </td>
                                        <td><strong>{{isset($service_result['discount'])?$service_result['discount']:""}}
                                            points</strong></td>
                                    </tr>
                                    <tr><td>Total</td>
                                        <td><strong>{{isset($service_result['total'])?$service_result['total']:""}} points</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Before Transaction </td>
                                        <td><strong>{{isset($service_result['before'])?$service_result['before']:""}}
                                            points</strong></td>
                                    </tr>
                                    <tr>
                                        <td>After Transaction</td>
                                        <td><strong>{{session('available_points')?session('available_points'):"No"}}
                                            points</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Sender Number</td>
                                        <td><strong>{{isset($sender_mobile_number)?$sender_mobile_number:session('mobile_number')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Sender Number</td>
                                        <td><strong>{{isset($sender_mobile_number)?$sender_mobile_number:session('mobile_number')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Date/Time </td>
                                        <td><strong>{{isset($service_result['date_time'])?$service_result['date_time']:""}}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <button class="btn btn-danger btn-lg btn-action back" onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop