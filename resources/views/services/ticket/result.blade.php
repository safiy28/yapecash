@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}} ( Review )</h2>

            @include('errors.list')

            {{--Don't know what the meaning of this code--}}
            @foreach($inputs as $index=>$input)
                <input type="hidden" name="{{$index}}" value="{{$input}}">
            @endforeach
            {{--Don't know what the meaning of this code--}}

            <div class="service_body">
                <div class="panel-default">
                    <div class="panel-body">
                        <table class="table-striped table">
                            <tbody>
                            <tr>
                                <th>Operator</th>
                                <th>Departure Time</th>
                                <th>Pickup/Dropoff</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            @foreach($onwardTrips as $trip)
                                <tr>
                                    <td>{{$trip['operatorName']}}</td>
                                    <td>{{$trip['departTime']}}</td>
                                    <td>
                                        <div><strong>Pickup : </strong>{{$trip['pickupPointDetails'][0]['pickupPointName']}}</div>
                                        <div><strong>Dropoff :</strong>{{$trip['dropoffPointDetails'][0]['dropOffPointName']}}</div>
                                    </td>
                                    <td>RM {{$trip['currencyVsFareDetails']['MYR']['adultFare']}}</td>
                                    <?php
                                    // $arr=explode(" ", $trip['departTime']);
                                    // $trip['departTime']=date('Y-m-d\TH:i:s+08:00', strtotime($trip['departTime']));
                                    $departDate = date('Y-m-d', strtotime($trip['departTime']));
                                    $trip['departTime'] = preg_replace('/\ /', '+', $trip['departTime']);

                                    // $departDate=preg_replace('/\ /', '+', $departDate);
                                    // $depart_time=$arr[0];
                                    $returnDate = "";
                                    $returnPickupTime = '';
                                    $returnOperatorCode = "";
                                    $returnTripId = "";
                                    $returnDropoffTime = "";
                                    $returnPickupPoint = "";
                                    $returnPickupPointCode = "";
                                    $returnDropoffPointCode = "";
                                    $returnDropoffPoint = "";
                                    $from = preg_replace('/\ /', '+', $trip['fromCity']);
                                    $to = preg_replace('/\ /', '+', $trip['toCity']);
                                    // $trip['dropoffPointDetails'][0]['arrivalTime']=date('Y-m-d\TH:i:s+08:00', strtotime($trip['dropoffPointDetails'][0]['arrivalTime']));
                                    $trip['dropoffPointDetails'][0]['arrivalTime'] = preg_replace('/\ /', '+', $trip['dropoffPointDetails'][0]['arrivalTime']);
                                    // $departDropoffTime=$arr[0];
                                    // $depart_drop_date=$arr[0];
                                    $departPickupPoint = preg_replace(['/\ /', '/#/'], ['+', ''], $trip['pickupPointDetails'][0]['pickupPointName']);
                                    $departPickupPoint = str_replace('&', 'and', $departPickupPoint);
                                    $departDropoffPoint = preg_replace(['/\ /', '/#/'], ['+', ''], $trip['dropoffPointDetails'][0]['dropOffPointName']);
                                    $departDropoffPoint = str_replace('&', 'and', $departDropoffPoint);
                                    ?>
                                    <td>
                                        <a href="{!!url('/')!!}/bus_ticket/review?pax={{$pax}}&fare={{$trip['currencyVsFareDetails']['MYR']['adultFare']}}&departDate={{$departDate}}&returnPickupTime={{$returnPickupTime}}&returnDate={{$returnDate}}&departOperatorName={{preg_replace('/\ /', '+', $trip['operatorName'])}}&departPickupPointCode={{$trip['pickupPointDetails'][0]['pickupPointId']}}&departOperatorCode={{$trip['operatorCode']}}&returnOperatorCode={{$returnOperatorCode}}&departPickupTime={{$trip['departTime']}}&from={{$from}}&to={{$to}}&departDropoffTime={{$trip['dropoffPointDetails'][0]['arrivalTime']}}&departDropoffDate={{$trip['dropoffPointDetails'][0]['arrivalTime']}}&departTripId={{$trip['tripId']}}&returnTripId={{$returnTripId}}&returnDropoffTime={{$returnDropoffTime}}&fromCityId={{$from_id}}&toCityId={{$to_id}}&departPickupPoint={{$departPickupPoint}}&departDropoffPoint={{$departDropoffPoint}}&departDropoffPointCode={{$trip['dropoffPointDetails'][0]['dropOffPointId']}}&returnPickupPoint={{$returnPickupPoint}}&returnPickupPointCode={{$returnPickupPointCode}}&returnDropoffPointCode={{$returnDropoffPointCode}}&returnDropoffPoint={{$returnDropoffPoint}}&departBookingStatus=0&returnBookingStatus=0"
                                           class="btn">Select</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop