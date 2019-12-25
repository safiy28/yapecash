@extends('app')
@section('title')
    @include('modules.result_service')
@stop
@section('content')
    <div class="leftpan">

    @include('modules.status')

    @include('modules.invoice')

    <!-- <input type="submit" value="print" class="submitbtn"> -->
        <input onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';" type="button" value="BACK"
               class="submitbtn">

    </div>

@stop
