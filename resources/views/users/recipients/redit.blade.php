@extends('app')

@section('header')


    <link rel="stylesheet" type="text/css" href="{!!url('/')!!}/css/jquery.datetimepicker.css"/ >

    <script src="{!!url('/')!!}/js/jquery.datetimepicker.full.min.js"></script>
    <style media="screen">
        .submitbtn {

            font-size: 15px;

            padding: 04px 3rem;
        }
    </style>
@stop

@section('title')
    <h1>Edit Recipient {{$recpt['name']}}'s profile </h1>
@stop
@section('content')
    <div class="leftpan">
        <div class="user-info">


            <form role="form" method="POST" action="{{ url('/')}}/users/recipientinfo/{{$recpt['id']}}"
                  accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <ul>
                    <li>
                        <label for="name">Bnf Name</label>
                        <input type="text" name="name" value="{{$recpt['name']}}">
                    </li>
                    <li>
                        <label for="name">Bnf Relation</label>
                        <input type="text" name="relation" value="{{$recpt['relation']}}">
                    </li>

                    <li>
                        <label for="country">Bnf Country</label>
                        <input type="text" name="country" value="{{$recpt['country']}}">
                    </li>

                    <li>
                        <label for="name">Bnf Phone</label>
                        <input type="text" name="phone" value="{{$recpt['phone']}}">
                    </li>
                    <li>
                        <label for="name">Bnf Bank Name</label>
                        <input type="text" id="bank_name" name="bank_name" value="{{$recpt['bank_name']}}">
                    </li>
                    <li>
                        <label for="name">Bnf Branch Name</label>
                        <input type="text" id="branch_name" name="branch_name" value="{{$recpt['branch_name']}}">
                    </li>
                    <li>
                        <label for="name">Bnf Bank Account No</label>
                        <input type="text" name="bank_ac_no" id="bank_ac_no" value="{{$recpt['bank_ac_no']}}">
                    </li>
                    <li>
                        <label for="name">Assisted ID</label>
                        <input type="text" name="assisted_id" id="assisted_id" value="{{$recpt['assisted_id']}}">
                    </li>


                    <input type="submit" name="" value="Update">

                </ul>
            </form>

        </div>
        <div class="clearfix"></div>

    </div>
@stop

@if ($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif

@section('footer')
    <script>


    </script>
    <script src="{!!url('/')!!}/js/custom.js"></script>



@stop
