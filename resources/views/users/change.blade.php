@extends('app')

@section('header')
    <style>
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
                    Assign Group to {{$user->name}}

                </header>
                <div class="panel-body">
                    <div class="modal-body">
                        <div class="row">
                            {!! Form::open(['url'=>'users/assign']) !!}


                            <input type="hidden" name="user_id" value="{{$user->id}}"/>

                            <div class="form-group">
                                {!! Form::label('groups','Group') !!}
                                <select name="group_id">
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
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
