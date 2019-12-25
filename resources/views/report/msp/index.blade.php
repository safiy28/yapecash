@extends('layout.inner-main')
@section('body-content')

<h1 class="title-text">Mobile Sales Person</h1>
@include('layout.partials.point-table')
<div class="clearfix"></div>
@if (session()->has('message'))
    <div class="service_alert success">
        <div class="icon">
            <div class="glyphicon glyphicon-ok-circle"></div>
        </div>
        <div class="massages">
            <div class="alert-title">SUCCESS</div>
            <div class="alert-body">
                {{ session('message') }}
            </div>
        </div>
    </div>
@endif

<div class="leftpan">
    <form action="{{url('msp')}}" method="POST">
        <div class="panel ammount">
            <h2>User Mobile Number</h2>
            <div class="panelcontent">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" id="mobile_number" name="mobile" required="" placeholder="Enter Mobile Number" class="form-control" value="" autofocus="autofocus" autocomplete="off"/>
                    </div>
                </div>
            </div>
        </div>


        {{csrf_field()}}
        <input type="submit" value="submit" class="submitbtn">
    </form>
</div>

@stop