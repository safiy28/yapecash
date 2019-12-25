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
                    Edit User's Logins

                </header>
                <div class="panel-body">
                    <div class="modal-body">
                        <div class="row">
                            {!! Form::model($user,['method'=>'Patch','route'=>['users.login.update',$user->id]]) !!}

                            <div class="col-xs-6 pull-left">
                                <div class="form-group">
                                    {!! Form::label('name','Name') !!}
                                    {!! Form::text('name',null,['class'=>'form-control'])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('mobile_number','Mobile Number') !!}
                                    {!! Form::input('number','mobile_number',null,['class'=>'form-control' ])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password','Password(leave blank if no change)') !!}
                                    {!! Form::password('password',null,['class'=>'form-control' ])!!}
                                </div>


                            </div>


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
