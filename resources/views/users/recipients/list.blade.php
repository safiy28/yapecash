@extends('app')

@section('header')


    <link rel="stylesheet" type="text/css" href="{!!url('/')!!}/css/jquery.datetimepicker.css"/ >

    <script src="{!!url('/')!!}/js/jquery.datetimepicker.full.min.js"></script>

    <link rel="stylesheet" href="{!!url('/')!!}/dynatable/jquery.dynatable.css"/>

    <script src="{!!url('/')!!}/dynatable/jquery.dynatable.js"></script>

    <style>
        .tblcon tr:first-child td {
            background-color: #F4F4F4;
            border: 0px solid #bfbfbf;
            text-align: center;
            border-width: 0px 0px 1px 1px;
            font-size: 100%;
            font-weight: normal;
            color: black;
        }

        .tblcon thead th {
            background-color: #464646;
            border: 0px solid #bfbfbf;
            text-align: center;
            padding: 7px;
            border-width: 0px 0px 1px 1px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
        }
    </style>
@stop

@section('title')
    <h1>User List</h1>
@stop
@section('content')
    <div class="leftpan">

    @if(Session::has('flash_message'))
        <!--    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>-->

            <div class="panel success">
                <i class="fa fa-check-circle-o fa-5x"></i>
                <strong>Congratulations</strong>, your action has been successfully generate.
            </div>

        @endif
        <?php //echo "<pre>"; print_r($recipients_lists); echo "<pre>"; exit(); ?>
        <div class="tblcon">

            <table id="my-table">
                <thead>
                <tr>
                    <th>Bnf Name</th>
                    <th>Bnf Mobile No</th>
                    <th>Bnf Bank Name</th>
                    <th>Bnf Account No</th>
                    <th>Assisted ID</th>
                    <th>Sender Name</th>
                    <th>Sender Mobile No</th>
                    <th>Edit Information</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recipients_lists as $user)
                <tr>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['phone']}}</td>
                    <td>{{$user['bank_name']}}</td>
                    <td>{{$user['bank_ac_no']}}</td>
                    <td>{{$user['assisted_id']}}</td>
                    <td>{{$user['parent_name']}}</td>
                    <td>{{$user['mobile_number']}}</td>
                    <td><a href="{!!url('/')!!}/users/recipientinfo/{{$user['id']}}">Edit</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="clearfix"></div>

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

            $('#my-table').dynatable();
        });
    </script>
    <script src="{!!url('/')!!}/js/custom.js"></script>

    @stop
