@extends('app')
@section('title')
    <h1>Money Transfer:Success</h1>
@stop
@section('content')
    <div class="leftpan">

        <div class="panel success">
            <i class="fa fa-check-circle-o fa-5x"></i>
            <strong>Congratulations</strong>, your action has been successfully generate.
        </div>
        <div class="invoice">
            <h2>Invoice # TP 4578</h2>
            <ul>
                <li>Number : <strong>012 325 3658</strong></li>
                <li>Amount : <strong>RM 10</strong></li>
                <li>Date/Time : <strong>20th January 2015 - 22:20</strong>
                <li>ID No : <strong>016 162288 950</strong></li>
            </ul>
        </div>
        <input type="submit" value="print" class="submitbtn">
        <input type="submit" value="BACK" class="submitbtn">
    </div>

@stop
