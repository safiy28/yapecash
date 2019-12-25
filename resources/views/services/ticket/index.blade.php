@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}}</h2>
            @include('errors.list')
            <div class="service_body row">
                <form action="{{ url('/bus_ticket/hold') }}" method="post">
                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Journey City Name</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <select name="from" id="" class="cities form-control">
                                        <option value="">Select Departure City Name</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city['cityId']}}">{{$city['cityName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="to" id="destinations" class="destinations form-control">
                                        <option value="">Select Arrival City Name (Departure first)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Journey Date</div>
                        <div class="panel-body">
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input id="departure-date" name="departed_date" type="text" placeholder="Departure Date"
                                               class="datepicker form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Passenger</div>
                        <div class="panel-body">
                            <ul class="list-radio passenger_list" id="radio-option2">

                            </ul>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <a href="{{url('/services')}}" class="btn btn-danger btn-lg btn-action back">Back</a>
                    <button class="btn btn-success btn-lg btn-action forward" type="submit">Next</button>
                </form>
            </div>
        </div>
    </div>
@stop
@section('footer-script')
    <script src="{{url('vendor/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script>
        $(function () {

            $('#departure-date').datetimepicker({
                minDate: new Date(),
                timepicker: false,
                format: 'Y-m-d'
            });

            (function loadPassengerList() {
                var passengerLimit = 7;
                var checked = " ";
                for (var i =1; i < passengerLimit; ++i){
                    if ( i == 1 ){
                        checked = " checked "
                    }else {
                        checked = " "
                    }
                    $('.passenger_list').append("" +
                        "<li class=\"list-radio-item\">" +
                        "<input "+checked+" type=\"radio\" value=\""+i+"\" id=\"molla-"+i+"\" name=\"pax\">" +
                        "<label for=\"molla-"+i+"\">"+i+"</label>" +
                        "</li>" +
                        "");
                }
            })();

            (function bindChangeCity() {
                $('.cities').change(function () {
                    var id = $(this).val();

                    $.get("{{url('/')}}/bus-destination/" + id, function (data) {
                        var destinations = $('#destinations');
                        destinations.empty();
                        $.each(data, function (index, value) {
                            destinations.append($('<option>', {
                                value: value.cityId,
                                text: value.cityName
                            }));
                        });
                    });

                });
            })();
        });
    </script>
@stop