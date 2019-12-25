@extends('app')
@section('title')
    <h1>Point Transfer</h1>
@stop
@section('content')
    <div class="leftpan">

        <div class="panel ammount">
            <h2>Amount</h2>
            <div class="panelcontent">
                <input type="number" required placeholder="Enter Amount"></div>
        </div>
        <div class="panel operator">
            <h2>Mobile Number</h2>

            <div class="panelcontent">
                <input type="number" required placeholder="Enter Mobile Number">
            </div>

        </div>
        <input type="submit" value="BACK" class="submitbtn">
        <input type="submit" value="next" class="submitbtn">
    </div>
    </div>
@stop
