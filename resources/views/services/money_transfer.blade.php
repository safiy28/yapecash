@extends('app')
@section('title')
    <h1>Service: Bkash Money</h1>
@stop
@section('content')


    <form role="form" method="POST" action="{{ url('/review_money_transfer') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="leftpan">
            <div class="panel ammount">
                <h2>Select Currency</h2>
                <div class="panelcontent">
                    <ul>
                        <li>
                            <div class="selectarea radiogroup">
                                <input type="radio" name="amount">
                            </div>
                            BDT
                        </li>
                        <li>
                            <div class="selectarea radiogroup">
                                <input type="radio" name="amount">
                            </div>
                            RM
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel ammount">
                <h2>Select Amount</h2>
                <div class="panelcontent">
                    <input type="number" required placeholder="Enter Amount">
                </div>
            </div>
            <div class="panel">
                <h2>Mobile Number</h2>
                <div class="panelcontent">
                    <input type="number" required placeholder="Enter Mobile Number">
                </div>
            </div>

            <input onclick="location.href='{!!url('/')!!}/services';" type="submit" value="BACK" class="submitbtn">
            <input type="submit" value="next" class="submitbtn">
        </div>
    </form>



@stop
