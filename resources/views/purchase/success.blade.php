@extends('layout.inner-main')
@section('body-content')

            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            <div class="leftpan">
                <div class="container">
                    <div class="service_alert success">
                        <div class="icon">
                            <div class="glyphicon glyphicon-ok-circle"></div>
                        </div>
                        <div class="massages">
                            <div class="alert-title">Success</div>
                            <div class="alert-body">
                                <strong>Congratulations</strong>, your action has been successfully generated.
                            </div>
                        </div>
                    </div>
                </div>
            </div>



@stop
