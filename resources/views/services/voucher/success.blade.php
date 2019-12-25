@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}} ( Confirm )</h2>

            @include('modules.result_service')

            <div class="service_body">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        @include('modules.invoice')
                        <button class="btn btn-danger btn-lg btn-action back" onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop