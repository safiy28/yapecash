@extends('app')
@section('title')
    @include('modules.select_service')
@stop
@section('content')

    <form role="form" method="POST" action="{{ url('money_transfer/review') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="leftpan">
            <div class="panel ammount">
                <h2>Select Currency</h2>
                <div class="panelcontent">
                    <ul>

                        @foreach($currencies  as $index=>$currency)
                            <li>
                                <div class="selectarea radiogroup">
                                    <input {{$index==0?"checked":""}} required type="radio" name="currency"
                                           value="{{$currency['rate_id']}}">
                                </div>
                                {{$currency['name']}} </li>
                        @endforeach

                    </ul>
                </div>
            </div>


            <div class="panel ammount">
                <h2>Select Amount</h2>
                <div class="panelcontent">
                    <input name="amount" type="number" required placeholder="Enter Amount">
                </div>
            </div>
            <div class="panel">
                <h2>Receiver Mobile Number</h2>
                <div class="panelcontent">
                    <input type="number" name="receiver_mobile_number" required placeholder="Enter Receiver Number">
                </div>
            </div>

            <div class="panel">
                <h2>Receiver's Name</h2>
                <div class="panelcontent">
                    <input type="text" name="receiver_name" required placeholder="Enter Receiver's Name">
                </div>
            </div>

            <div class="panel">
                <h2>Sender's Mobile Number</h2>
                <div class="panelcontent">
                    <input type="text" name="sender_mobile_number" required placeholder="Enter Sender's Number">
                </div>
            </div>

            <div class="clearfix"></div>
            <input onclick="location.href='{!!url('/')!!}/services';" type="button" value="BACK" class="submitbtn">
            <input type="submit" value="submit" class="submitbtn">

        </div>
    </form>

@stop
