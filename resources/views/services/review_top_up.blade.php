@extends('app')
@section('title')
    <h1>Review Top Up Request</h1>
@stop
@section('content')
    <form role="form" method="POST" action="{{ url('/confirm_top_up') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="leftpan">
            <div class="panel operator">
                <h2>Select Operator</h2>
                <div class="panelcontent">
                    <ul>
                        @foreach($operators as $operator)
                            <li>

                                <div class="selectarea radiogroup">
                                    <input type="radio" value="{{$operator['name']}}" name="operator">
                                </div>
                                <img src="{{$operator['logo']}}" alt=""/>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="panel ammount">
                <h2>Select Amount</h2>
                <div class="panelcontent">
                    <ul>
                        <li>
                            <div class="selectarea radiogroup">
                                <input type="radio" name="amount">
                            </div>
                            RM 10
                        </li>
                        <li>
                            <div class="selectarea radiogroup">
                                <input type="radio" name="amount">
                            </div>
                            RM 20
                        </li>
                        <li>
                            <div class="selectarea radiogroup">
                                <input type="radio" name="amount">
                            </div>
                            RM 30
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel">
                <h2>Mobile Number</h2>
                <div class="panelcontent">
                    <input type="number" required placeholder="Enter Mobile Number">
                </div>
            </div>
            <div class="panel">
                <h2>PIN</h2>
                <div class="panelcontent">
                    <input type="number" required placeholder="Enter PIN Number">
                </div>
            </div>
            <input onclick="location.href='{!!url('/')!!}/services';" type="button" value="BACK" class="submitbtn">
            <input type="submit" value="submit" class="submitbtn">
        </div>
    </form>


@stop
