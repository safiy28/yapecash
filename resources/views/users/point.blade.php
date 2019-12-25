@extends('app')

@section('header')
    <style>
        .border {
            border: 1px solid green;
        }

        img {
            max-height: 200px;
            border-radius: 20px;
        }

    </style>
@stop


@section('content')

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Assign Group

                </header>
                <div class="panel-body">
                    <div class="modal-body">
                        <div class="row">
                            {!! Form::open(['url'=>'users/point']) !!}

                            <input type="hidden" name="user_id" value="{{$user->id}}"/>

                            <div class="form-group">
                                {!! Form::label('point','point') !!}
                                {!! Form::input('number','point','',['class'=>'form-control' ])!!}
                            </div>

                        </div>


                        <div class="col-xs-12">
                            <div class="form-group col-xs-2">
                                {!! Form::submit('Assign',['class'=>'btn btn-warning form-control'])!!}
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
