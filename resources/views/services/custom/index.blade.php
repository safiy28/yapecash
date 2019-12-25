@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}}</h2>
            <div class="service_body">
                <form action="{{ url('custom/review') }}" method="post">
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
                        <div class="panel-heading">Select Amount</div>
                        <div class="panel-body">
                            <ul class="list-radio package_list" id="radio-option2">
                                @foreach($amounts as $index => $amount)
                                    <li class="list-radio-item">
                                        <input {{$index==0?"checked":""}} type="radio"
                                                   value="{{$amount['amount']}}" id="rate-{{$index}}"
                                                   required name="amount">
                                        <label for="rate-{{$index}}">{{$currencies[0]['name']}} {{$amount['amount']}}</label>
                                    </li>
                                @endforeach
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
                                        <label for="" class="label label-default">{{session('service_code')=="nepal_reload"?" 9860346661 ":""}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="currency" value="{{$currencies[0]['rate_id']}}">
                    {{ csrf_field() }}
                    <a href="{{url('/services')}}" class="btn btn-danger btn-lg btn-action back">Back</a>
                    <button class="btn btn-success btn-lg btn-action forward" type="submit">Next</button>
                </form>
            </div>
        </div>
    </div>
@stop