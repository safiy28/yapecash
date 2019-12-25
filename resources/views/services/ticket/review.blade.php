@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}} ( Review )</h2>

            @include('errors.list')

            {{--Don't know what the meaning of this code--}}
            @foreach($inputs as $index => $input)
                <input type="hidden" name="{{$index}}" value="{{$input}}">
            @endforeach
            {{--Don't know what the meaning of this code--}}

            <div class="service_body">
                @if(!$service_result['balance_exceeded'])
                <form method="POST" action="{{ url('/bus_ticket/result') }}">
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Depart Journey</div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <tr>
                                        <td><strong>Trip</strong></td>
                                        <td>{{$inputs['from']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Departure Date</strong></td>
                                        <td>{{preg_replace(['/T/','/Z/'],[' ',''], $inputs['departPickupTime'])}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Departing From</strong></td>
                                        <td>{{$inputs['departPickupPoint']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Arriving At</strong></td>
                                        <td>{{$inputs['departDropoffPoint']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Coach</strong></td>
                                        <td> {{$inputs['departOperatorName']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Seat(s)</strong></td>
                                        <td>{{$inputs['pax']}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Notes</strong>
                                            <br>
                                            For single trip only. Free seating on the bus. No cancellation allowed.
                                            Change of booking is possible subjected to approval. Kindly email to sales@catchthatbus.com to
                                            raise the request. For enquiry, please call our Customer Service Hotline: 03-9212 1818.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Ticket Price</strong></td>
                                        <td>RM {{$inputs['fare']}} x {{$inputs['pax']}} = {{$service_result['amount']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>charge Price</strong></td>
                                        <td>RM {{$service_result['charge']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Commission Price</strong></td>
                                        <td>RM {{$service_result['commission']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>discount Price</strong></td>
                                        <td>RM {{$service_result['discount']}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Price</strong> RM </td>
                                        <td><b @if($service_result['balance_exceeded']) style="color: #ff0000;" @endif>{{$service_result['total']}}</b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">PIN</div>
                            <div class="panel-body">
                                <input type="password" placeholder="Enter Your pin" name="pin" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Enter Phone No</div>
                            <div class="panel-body">
                                <input type="text" required name="contactNumber" placeholder="Phone Number" class="form-control">
                            </div>
                        </div>
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Enter Passenger's Name</div>
                            <div class="panel-body">
                                @for( $i = 0; $i<$inputs['pax']; $i++ )
                                    <div class="form-group">
                                        <input required placeholder=" #{{$i+1}} Passengers Name" type="text" name="name_details[]" class="form-control"/>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                {{csrf_field()}}
                <a href="javascript:void(0)" class="btn btn-info btn-lg btn-action back" onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';">Back</a>
                @if(!$service_result['balance_exceeded'])
                <button class="btn btn-success btn-lg btn-action forward">Submit</button>
                @endif
                </form>
            </div>
        </div>
    </div>
@stop