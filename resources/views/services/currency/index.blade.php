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
                    Add Currency
                </header>
                <div class="panel-body">
                    <div class="modal-body">

                        <div class="row">
                            {!! Form::open(['url'=>'services/'.$id.'/add_currency']) !!}
                            <div class="col-xs-6 pull-left">


                                <div class="form-group">
                                    {!! Form::label('rate','Add Rate') !!}
                                    <select name="rate_id">
                                        @foreach($rates as $rate)
                                            <option value="{{$rate->id}}">{{$rate->currency}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <input type="radio" name="enable" checked value=1>enabled<br>
                                    <input type="radio" name="enable" value=0>disabled
                                </div>

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
