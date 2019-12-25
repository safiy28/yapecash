@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service: {{session('service_name')}}</h2>
            @include('errors.list')
            <div class="service_body">
                <form method="POST" action="{{ url('getdoc_payment/hold') }}">
                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Enter Clinic Name/Code</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="clinic" required class="form-control" placeholder="Clinic Name/Code">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}

                    <a href="{{url('/services')}}" class="btn btn-danger btn-lg btn-action back">Back</a>
                    <button class="btn btn-success btn-lg btn-action forward" type="submit">Next</button>
                </form>
            </div>
        </div>
    </div>
@stop