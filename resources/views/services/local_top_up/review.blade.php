@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}} ( Review )</h2>

            @include('errors.list')

            <div class="service_body">
                @if(!$service_result['balance_exceeded'])
                <form method="POST" action="{{ url('top_up/confirm') }}">
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Select Operator</div>
                            <div class="panel-body">
                                <ul class="list-radio" id="radio-option">
                                    @foreach($operators as $operatorr)
                                        @if($operatorr['keyword']==$operator)

                                            <li class="list-radio-item">
                                                <input {{$operatorr['keyword']==$operator?"checked":"disabled"}}
                                                       value="{{$operatorr['keyword']}}"
                                                       type="radio" checked id="operator-{{$operatorr['keyword']}}" name="operator">
                                                <label for="operator0">{{$operatorr['name']}}</label>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Select Packages</div>
                            <div class="panel-body">
                                <ul class="list-radio" id="radio-option2">
                                    @if(session('service_code')=='local' || session('service_code')=='my')
                                        @foreach($rates as $index=>$rate)
                                            @if($rate==$amount)
                                                <li class="list-radio-item">
                                                    <input type="radio" checked value="{{$rate}}" id="rate-{{$index}}" name="amount">
                                                    <label for="rate-{{$index}}">{{session('service_code')=="indo_flexi"?"KRP":"SGD"}} {{$rate}}</label>
                                                </li>
                                            @endif
                                        @endforeach
                                    @elseif(session('service_code')=="indo_pulsa")
                                        <li class="list-radio-item">
                                            <input type="radio" checked value="{{$amount}}:{{$pulsa_code}}" id="pulda-da" name="amount">
                                            <label for="pulda-da">{{number_format($amount)}} IDR</label>
                                        </li>
                                    @else
                                        @foreach($amounts as $amountt)
                                            @if($amountt['amount']==$amount)
                                                <li class="list-radio-item">
                                                    <input type="radio" {{$amountt['amount']==$amount?"checked":"disabled"}} value="{{$amountt['amount']}}" id="rate-{{$amountt['amount']}}" name="amount">
                                                    <label for="rate-{{$amountt['amount']}}">{{session('service_code')=="indo_flexi"?"RP":"SGD"}} {{$amountt['amount']}}</label>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @include('modules.calculation')
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Receiver Mobile No</div>
                            <div class="panel-body">
                                <div class="form-group clearfix">
                                    <input type="number"
                                           value="{{isset($receiver_mobile_number)?$receiver_mobile_number:""}}"
                                           name="receiver_mobile_number" required placeholder="Enter Receiver Number" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">PIN</div>
                            <div class="panel-body">
                                <div class="form-group clearfix">
                                    <input type="password" placeholder="Enter your pin" class="form-control" name="pin" required>
                                </div>
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