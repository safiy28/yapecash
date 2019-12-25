@extends('layout.inner-main')
@section('body-content')
    <div class="area contentArea">
        <div class="wrapper">
            <h1 class="title-text">Find User Profile</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            <div class="service_body">

                <div class="service_alert danger">
                    <div class="icon">
                        <div class="glyphicon glyphicon-remove"></div>
                    </div>
                    <div class="massages">
                        <div class="alert-title">ERROR</div>
                        <div class="alert-body">
                                <p>{{ $message['text'] }}</p>

                        </div>
                    </div>
                </div>


            </div>

            <br><br>
            <div class="row">
                <a href="{{route('user.informations')}}" class="btn btn-success btn-lg btn-action"> Back</a></div>
        </div>



        </div>

    </div>

@stop
