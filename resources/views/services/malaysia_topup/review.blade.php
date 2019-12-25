@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Service: {{session('service_name')}} (Review)</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>

    @include('errors.list')

    <form method="POST" action="{{ route('malaysia.topup.confirm') }}">
        <div class="leftpan">
            <div class="row">
                <div class="col-md-8">

                    <div class="panel operator">
                        <h2>Select Operator</h2>
                        <div class="panelcontent">
                            <ul>
                                @foreach((array)$operators as $index => $_operator)
                                    @if($_operator['keyword'] === $operator)
                                        <li>
                                            <div class="selectarea radiogroup">
                                                <input {{$_operator['keyword'] === $operator?'checked':'disabled'}}
                                                       type="radio" value="{{$_operator['keyword']}}"
                                                       id="operator-{{$index}}" required
                                                       name="operator" class="operators">
                                            </div>
                                                <img  class="operator-logo" src="{{$_operator['logo']}}" alt="{{$_operator['name']}}"/>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <div class="panel ammount">
                        <h2>Select Amount</h2>
                        <div class="panelcontent">
                            <input type="number" value="{{$amount ?? ''}}" name="amount" required placeholder="Enter Your Amount" readonly>
                            <span for="" class="label-info label">MYR</span>

                        </div>
                    </div>


                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div class="panel">
                                <h2>Receiver Mobile Number</h2>
                                <div class="panelcontent">
                                    <input type="number"
                                           value="{{$receiver_mobile_number ?? session('receiver_mobile_number')}}"
                                           name="receiver_mobile_number" readonly placeholder="Enter Receiver Number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel">
                                <h2>PIN</h2>
                                <div class="panelcontent">
                                    <input type="password" placeholder="Enter your pin" class="form-control" name="pin" required>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    @include('modules.calculation')
                </div>
            </div>
            {{csrf_field()}}
            <input type="button" onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';" value="BACK" class="submitbtn">
            <input type="submit" value="submit" class="submitbtn">

        </div>

    </form>

@stop
