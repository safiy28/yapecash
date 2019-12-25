@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service: {{session('service_name')}}</h2>
            @include('errors.list')
            <div class="service_body">
                <form method="POST" action="{{ url('account_topup/review') }}">
                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Select Bank</div>
                        <div class="panel-body">
                            <ul class="list-radio" id="radio-option">
                                @foreach( $countries as $index => $country )
                                    <li class="list-radio-item">
                                        <input required
                                               <?php if ($index == 0) $curnt = $country['name'];?>
                                               {{$index==0?"checked":""}}
                                               type="radio" value="{{$country['keyword']}}"
                                               id="operator-{{$index}}" name="bank" class="operators">

                                        <label for="operator-{{$index}}">{{$country['name']}}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Select Type</div>
                        <div class="panel-body">
                            <ul class="list-radio package_list" id="radio-option2">
                                @foreach( $modes as $index=>$mode )
                                    <li class="list-radio-item">
                                        <input {{$index==0?"checked":""}} type="radio" value="{{$mode['keyword']}}"
                                               id="op-type-{{$index}}" required name="mode">
                                        <label for="op-type-{{$index}}">{{$mode['name']}}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Receiver Account Number</div>
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <input type="number" name="receiver_account_number" required
                                               placeholder="Account No" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Account Holder Name</div>
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <input type="text" required placeholder="Name of account holder" class="form-control"
                                               name="account_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Sender Mobile No</div>
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <input type="number" name="sender_mobile_number" required
                                               placeholder="Account No" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Amount</div>
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <input type="number" name="amount" required
                                               placeholder="Amount" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Receiver Reference</div>
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <input type="text" required placeholder="Type Reference" size="40" class="form-control"
                                               name="purpose">
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