@extends('app')

@section('header')
    <style>
        .littleUp {
            margin-bottom: 2%;
        }

    </style>
@stop


@section('content')

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Operator
                </header>
                <div class="panel-body">
                    <div class="modal-body">

                        <div class="row">
                            {!! Form::open(['url'=>'services/'.$id.'/add_operator','files'=>true]) !!}
                            <div class="col-xs-6 pull-left">


                                <div class="form-group">
                                    {!! Form::label('name','Name') !!}
                                    {!! Form::text('name',null,['class'=>'form-control','id'=>'myInput' ])!!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('keyword','Keyword') !!}
                                    {!! Form::text('keyword',null,['class'=>'form-control','id'=>'myInput' ])!!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('logo','Logo of Operator') !!}
                                    {!! Form::file('logo','',['class'=>'form-control'])!!}
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="enable" checked value=1>enabled<br>
                                    <input type="radio" name="enable" value=0>disabled
                                </div>

                            </div>
                            <div class="col-xs-4  pull-right">


                            </div>

                            <br/>

                            <div class="col-xs-12">
                                <div class="form-group col-xs-2">
                                    {!! Form::submit('Update',['class'=>'btn btn-primary form-control'])!!}
                                </div>
                            </div>

                        </div>

                        {!!Form::close() !!}
                    </div>
                </div>
                @include('errors.list')
            </section>
        </div>
    </div>

@stop
