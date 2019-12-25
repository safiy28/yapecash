@extends('app')
@section('title')
    @include('modules.review_service')
@stop
@section('content')

    @if(!$service_result['balance_exceeded'])
        <form role="form" method="POST" action="{{ url('money_transfer/confirm') }}">
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="leftpan">
                @include('errors.list')
                <div class="panel ammount">
                    <h2>Select Currency</h2>
                    <div class="panelcontent">
                        <ul>
                            @foreach($currencies  as $currency_ar)
                                @if($currency_ar['rate_id']==$currency)
                                    <li>
                                        <div class="selectarea radiogroup">
                                            <input {{$currency_ar['rate_id']==$currency?"checked":"disabled"}}  type="radio"
                                                   name="currency" value="{{$currency_ar['rate_id']}}">
                                        </div>
                                        {{$currency_ar['name']}} </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>


                <div class="panel ammount">
                    <h2>Select Amount</h2>
                    <div class="panelcontent">
                        <input name="amount" value="{{isset($amount)?$amount:""}}" readonly type="number" required
                               placeholder="Enter Amount">
                    </div>
                </div>

                @include('modules.calculation')

                <div class="panel">
                    <h2>Receiver Mobile Number</h2>
                    <div class="panelcontent">
                        <input type="number" readonly
                               value="{{isset($receiver_mobile_number)?$receiver_mobile_number:""}}"
                               name="receiver_mobile_number" required placeholder="Enter Receiver Number">
                    </div>
                </div>

                <div class="panel">
                    <h2>Receiver's Name</h2>
                    <div class="panelcontent">
                        <input type="text" name="receiver_name" readonly
                               value="{{isset($receiver_name)?$receiver_name:""}}" placeholder="Enter Receiver's Name">
                    </div>
                </div>

                <div class="panel">
                    <h2>Sender Mobile Number</h2>
                    <div class="panelcontent">
                        <input type="number" readonly value="{{isset($sender_mobile_number)?$sender_mobile_number:""}}"
                               name="sender_mobile_number" required placeholder="Enter Sender Number">
                    </div>
                </div>

                <div class="panel">
                    <h2>Pin Number</h2>
                    <div class="panelcontent">
                        <input type="password" value="{{isset($pin)?$pin:""}}" name="pin" required
                               placeholder="Enter Pin Number">
                    </div>
                </div>
                <div class="clearfix"></div>
                <input onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';" type="button"
                       value="BACK" class="submitbtn">
                @if(!$service_result['balance_exceeded'])
                    <input type="submit" value="submit" class="submitbtn">
                @endif
            </div>
        </form>



@stop
