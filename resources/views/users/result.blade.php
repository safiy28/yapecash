@extends('layout.inner-main')
@section('body-content')
    <div class="area contentArea">
        <div class="wrapper">
            <h1 class="title-text">User Registration</h1>
            <div class="clearfix"></div>

            <div class="service_body">

                <div class="leftpan">


                    @if($service_result['message']=="Success")
                        <div class="service_alert success">
                            <div class="icon">
                                <div class="glyphicon glyphicon-ok-circle"></div>
                            </div>
                            <div class="massages">
                                <div class="alert-title">Success</div>
                                <div class="alert-body">
                                    <strong>Congratulations</strong>, your action has been successfully generate.
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="service_alert danger">
                            <div class="icon">
                                <div class="glyphicon glyphicon-remove-circle"></div>
                            </div>
                            <div class="massages">
                                <div class="alert-title">Sorry</div>
                                <div class="alert-body">
                                    <strong>Failed</strong><br><br>Please go back and check your...
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>



        </div>

    </div>

@stop


