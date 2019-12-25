@extends('layout.inner-main')

@section('header')


    <link rel="stylesheet" type="text/css" href="{!!url('/')!!}/css/jquery.datetimepicker.css"/ >

    <script src="{!!url('/')!!}/js/jquery.datetimepicker.full.min.js"></script>

@stop
@section('body-content')
<div class="area contentArea">
    <div class="wrapper">
        <h1 class="title-text">Mobile Sales Person</h1>
        @include('layout.partials.point-table')
        <div class="clearfix"></div>


        <div class="service_body">
            <div class="leftpan">


                <div class="panel failed">
                    <i class="fa fa-times-circle-o fa-5x"></i>
                    <strong>Failed</strong><br><br>This person is not registered as MSP.
                </div>

                <a href="{{ url('msp') }}" class="submitbtn">Back</a>
            </div>
        </div>


    </div>

</div>

@stop
@section('footer')
    <script>
        $(document).ready(function () {

            jQuery('#date_timepicker_start').datetimepicker({
                format: 'Y-m-d',
                onShow: function (ct) {
                    this.setOptions({
                        maxDate: jQuery('#date_timepicker_end').val() ? jQuery('#date_timepicker_end').val() : false
                    })
                },
                timepicker: false
            });


            jQuery('#date_timepicker_end').datetimepicker({
                format: 'Y-m-d',
                onShow: function (ct) {
                    this.setOptions({
                        minDate: jQuery('#date_timepicker_start').val() ? jQuery('#date_timepicker_start').val() : false
                    })
                },
                timepicker: false
            });
        });
    </script>
    <script src="{!!url('/')!!}/js/custom.js"></script>

@stop
