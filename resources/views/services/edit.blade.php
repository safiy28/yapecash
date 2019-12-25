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
                            {!! Form::model($available_service,['method'=>'Patch','route'=>['services.update',$available_service->id]]) !!}
                            <div class="col-xs-6 pull-left">


                                <div class="form-group">
                                    {!! Form::label('name','Name') !!}
                                    {!! Form::text('name',null,['class'=>'form-control','id'=>'myInput' ])!!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('short_code','ShortCode') !!}
                                    {!! Form::text('short_code',null,['class'=>'form-control'])!!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('type','Service Type:') !!}
                                    <select name="type" id="">
                                        @foreach($types as $type)
                                            <option value="{{$type->value}}" {{$type->value==$available_service->type?"selected":""}}>{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('name','Name') !!}
                                    <select name="color" id="">
                                        @foreach($colors as $color)
                                            <option value="{{$color->value}}" {{$color->value==$available_service->color?"selected":""}}>{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="radio" name="enable"
                                           {{$available_service->enable?"checked":""}} value=1>enabled<br>
                                    <input type="radio" name="enable"
                                           {{!$available_service->enable?"checked":""}} value=0>disabled
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
