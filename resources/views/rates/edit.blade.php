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
                    Edit Service
                </header>
                <div class="panel-body">
                    <div class="modal-body">

                        <div class="row">
                            {!! Form::model($rate,['method'=>'Patch','route'=>['rates.update',$rate->id], 'files'=>true]) !!}
                            <div class="col-xs-6 pull-left">


                                <div class="form-group">
                                    {!! Form::label('country','Country') !!}
                                    {!! Form::text('country',null,['class'=>'form-control' ])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('currency','Currency') !!}
                                    {!! Form::text('currency',null,['class'=>'form-control' ])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('rate_per_rm','Rate per RM') !!}
                                    {!! Form::text('rate_per_rm',null,['class'=>'form-control' ])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('new_logo','Logo of Country(select if change needed)') !!}
                                    {!! Form::file('new_logo','',['class'=>'form-control'])!!}
                                </div>

                                <div class="form-group">
                                    <input type="radio" name="active" {{$rate->active?"checked":""}} value=1>enabled<br>
                                    <input type="radio" name="active" {{!$rate->active?"checked":""}} value=0>disabled
                                </div>

                                <div>
                                    {!! Form::label('pin','Pin') !!}
                                    {!! Form::text('pin',null,['class'=>'form-control' ])!!}
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
