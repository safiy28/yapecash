@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}}</h2>
            <div class="service_body">
                <form action="{{ url('voucher/review') }}" method="post">
                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Select Operator</div>
                        <div class="panel-body">
                            <ul class="list-radio" id="radio-option">
                                @foreach($operators as $index => $operator)
                                <li class="list-radio-item">
                                    <input {{$index==0?"checked":""}}
                                           type="radio" value="{{$operator['keyword']}}"
                                           id="operator-{{$index}}" required name="operator" class="operators">

                                    <label for="operator-{{$index}}">{{$operator['name']}}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Select Packages</div>
                        <div class="panel-body">
                            <ul class="list-radio package_list" id="radio-option2">
                                @if(session('service_code') == 'local')
                                    @foreach($rates as $index => $rate)
                                        <li class="list-radio-item">
                                            <input {{$index==0?"checked":""}} type="radio"
                                                   value="{{$rate}}" id="rate-{{$index}}"
                                                   required name="amount">
                                            <label for="rate-{{$index}}">{{session('service_code')=="indo_flexi"?"KRP":"SGD"}} {{$rate}}</label>
                                        </li>
                                    @endforeach
                                @else
                                    @foreach($amounts as $index => $rate)
                                        <li class="list-radio-item">
                                            <input {{$index==0?"checked":""}} type="radio"
                                                   value="{{$rate}}" id="rate-{{$index}}"
                                                   required name="amount">
                                            <label for="rate-{{$index}}">{{session('service_code')=="indo_flexi"?"KRP":"SGD"}} {{$rate}}</label>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Receiver Mobile No</div>
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <input type="text" placeholder="Receiver Mobile No" class="form-control" name="receiver_mobile_number">
                                        <label for="" class="label label-default">01724058171</label>
                                    </div>
                                </div>
                            </div>
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
    <script type="text/javascript">
        var operators = $('.operators');
        operators.change( function () {
            var keyword = $(this).val();
            $.get("{{url('/')}}/operator-rates?keyword=" + keyword, function (data) {
                var rateList = $('.package_list');

                rateList.empty();
                $.each(data, function (index, value) {
                    var checked = "";
                    if (index === 0) {
                        checked = "checked";
                    }

                    rateList.append(
                        "<li class='list-radio-item'> " +
                        "<input " + checked + " type=\"radio\" id='rate-"+index+"' " +
                        "value=\"" + value + "\" required name=\"amount\"> " +
                        "<label for='rate-"+index+"'>SGD " + value + "</label>" +
                        " </li>"
                    );
                });
            });
        });
    </script>
@stop