@extends('app')

@section('header')
    <style>
        .littleUp {
            margin-bottom: 2%;
        }

    </style>
@stop


@section('content')
    <?php $canEditLogin = $logged_user_group->hasPermission("login.edit"); ?>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit User
                    @if($canEditLogin)
                        <a class="btn btn-danger pull-right littleUp" href="/users/{{$user->id}}/login">Change Login
                            Informations </a>
                    @endif
                </header>
                <div class="panel-body">
                    <div class="modal-body">

                        <div class="row">
                            {!! Form::model($profile,['method'=>'Patch','route'=>['users.update',$user->id], 'files'=>true]) !!}
                            <div class="col-xs-6 pull-left">


                                <div class="form-group">
                                    {!! Form::label('father_name',"Father's Name") !!}
                                    {!! Form::text('father_name',null,['class'=>'form-control'])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('mother_name',"Mother's Name") !!}
                                    {!! Form::text('mother_name',null,['class'=>'form-control' ])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('present_address','Present Address') !!}
                                    {!! Form::text('present_address',null,['class'=>'form-control' ])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('permanent_address','Permanent Address') !!}
                                    {!! Form::text('permanent_address',null,['class'=>'form-control' ])!!}
                                </div>


                                <div class="form-group">
                                    {!! Form::label('id_type','ID Type') !!}

                                    <select name="id_type" id="">
                                        <option @if($profile->id_type=="nid"){{"selected"}}@endif value="nid">NID
                                        </option>
                                        <option @if($profile->id_type=="student_id"){{"selected"}}@endif value="student_id">
                                            Student ID
                                        </option>
                                        <option @if($profile->id_type=="passport"){{"selected"}}@endif value="passport">
                                            Passport
                                        </option>
                                        <option @if($profile->id_type=="driving_licence"){{"selected"}}@endif value="driving_licence">
                                            Driving Licence
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('id_no','ID No') !!}
                                    {!! Form::input('number','id_no',null,['class'=>'form-control' ])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('id_expire_date','ID Expire Date') !!}
                                    {!! Form::input('date','id_expire_date',$profile->id_expire_date->todatestring(),['class'=>'form-control' ])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('new_scan','Scan of ID (if want to change)') !!}
                                    {!! Form::file('new_scan','',['class'=>'form-control'])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('date_of_birth','Date of Birth') !!}
                                    {!! Form::input('date','date_of_birth',$profile->date_of_birth->todatestring(),['class'=>'form-control' ])!!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('country','Country') !!}
                                    {!! Form::text('country',null,['class'=>'form-control' ])!!}
                                </div>


                            </div>

                            <div class="col-xs-4  pull-right">
                                <img class="img img-responsive" src="{{URL::to("files" . $profile->scan)}}"/>
                                Scan: {{$profile->id_type}}


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
