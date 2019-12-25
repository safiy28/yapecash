@extends('layout.inner-main')
@section('body-content')


            <h1 class="title-text">Service : {{session('service_name')}} (Confirm)</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>
            @include('modules.result_service')
            <div class="leftpan">
                <div class="service_body">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8">
                            @include('modules.invoice')
                            <input type="button" onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';" value="BACK" class="submitbtn">
                        </div>
                    </div>
                </div>

            </div>

@stop
