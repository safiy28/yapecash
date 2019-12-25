@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service
                : {{session('service_name')}}</h2>
            <div class="service_body">
                <form action="{{ url('international_top_up/review') }}" method="post">
                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Select Operator</div>
                        <div class="panel-body">
                            <ul class="list-radio" id="radio-option">
                                @foreach($operators as $index => $operator)
                                    <li class="list-radio-item">
                                        <input {{$index==0?"checked":""}}
                                               type="radio" value="{{$operator['keyword']}}"
                                               id="operator-{{$index}}" required name="operator" class="operators">

                                        <label for="operator-{{$index}}"><img src="{{$operator['logo']}}" alt=""/></label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Select Type</div>
                        <div class="panel-body">
                            <ul class="list-radio package_list" id="radio-option2">
                                <li class="list-radio-item">
                                    <input checked type="radio"
                                           value="prepaid" id="rate-prepaid"
                                           required name="type">
                                    <label for="rate-prepaid">Pre-paid</label>
                                </li>
                                <li class="list-radio-item">
                                    <input type="radio"
                                           value="postpaid" id="rate-prepaid"
                                           required name="type">
                                    <label for="rate-postpaid">Post-paid</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Amount</div>
                                <div class="panel-body">
                                    <input type="hidden" name="currency" value="{{$currencies[0]['rate_id']}}">

                                    <input type="number" name="amount" required
                                           placeholder="Enter Your Amount" class="form-control">
                                    <label for="" class="label label-info">{{$currencies[0]['name']}}</label>
                                </div>
                            </div>

                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Receiver Mobile No</div>
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <input type="text" placeholder="Receiver Mobile No" class="form-control"
                                               name="receiver_mobile_number">
                                        <label for="" class="label label-default">01551816395</label>
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
