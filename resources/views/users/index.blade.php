@extends('app')

@section('header')
    <style>
        .littleUp {
            margin-bottom: 2%;
        }
    </style>


@stop

@section('content')
    <?php $canEdit = $logged_user_group->hasPermission("user.edit");
    $canManageGroup = $logged_user_group->hasPermission("groups.manage");
    $canManagePoints = $logged_user_group->hasPermission("points.manage");
    ?>
    @include('success.list')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Users

                </header>
                <div class="panel-body">
                    @if($canEdit)
                        <a class="btn btn-primary pull-right littleUp" data-toggle="modal" data-target="#createUser">Add
                            User</a>
                    @endif
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Available Point</th>
                            <th>Assign Point</th>
                            <th>Reset Password</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($users as  $index=>$user)

                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$user->name}} <a href="/users/{{$user->id}}/profile">(show profile)</a></td>
                                <td>{{$user->mobile_number}}</td>
                                <td>{{$user->groups->first()?$user->groups->first()->name:"Not assigned yet"}}
                                    @if($canManageGroup)
                                        <a href="{{url('users')}}/{{$user->id}}/assign">(change)</a>
                                    @endif
                                </td>
                                <td><a href="{{url('users')}}/{{$user->id}}/{{$user->active?"banned":"active"}}">
                                        <div class="btn btn-{{$user->active?"success":"danger"}}">{{$user->active?"Active":"Banned/Not Active Yet"}}</div>
                                    </a></td>
                                <td>{{$user->point?$user->point->available:"User Don't have point"}}</td>
                                <td>
                                    @if($canManagePoints)
                                        <a href="{{url('users')}}/{{$user->id}}/point">Assign Point</a>
                                    @else
                                        Not Permitted
                                    @endif
                                </td>
                                <td>@if($canEdit)
                                        <a href="{{url('users')}}/{{$user->id}}/reset">Reset</a>
                                    @endif
                                </td>
                                @if($canEdit)
                                    <td>

                                        <a href="{{url('users')}}/{{$user->id}}/edit"><i class="fa fa-pencil fa-lg"></i></a>

                                        <a href="{{url('users')}}/{{$user->id}}/destroy"><i
                                                    class="fa fa-times-circle fa-lg"></i></a>


                                    </td>
                                @else
                                    <td>Not Permitted</td>
                                @endif

                            </tr>

                        @endforeach

                        </tbody>
                    </table>

                </div>
                @include('errors.list')

            </section>
        </div>
    </div>

@stop

@section('modal')

    @if($canEdit)
        <!-- Modal -->
        <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Admin </h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url'=>'users','files'=>true]) !!}


                        <div class="form-group">
                            {!! Form::label('name','Name') !!}
                            {!! Form::text('name','',['class'=>'form-control','id'=>'myInput' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('father_name',"Father's Name") !!}
                            {!! Form::text('father_name','',['class'=>'form-control'])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('mother_name',"Mother's Name") !!}
                            {!! Form::text('mother_name','',['class'=>'form-control' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('present_address','Present Address') !!}
                            {!! Form::text('present_address','',['class'=>'form-control' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('permanent_address','Permanent Address') !!}
                            {!! Form::text('permanent_address','',['class'=>'form-control' ])!!}
                        </div>


                        <div class="form-group">
                            {!! Form::label('id_type','ID Type') !!}

                            <select name="id_type" id="">
                                <option value="nid">NID</option>
                                <option value="student_id">Student ID</option>
                                <option value="passport">Passport</option>
                                <option value="driving_licence">Driving Licence</option>
                            </select>
                        </div>

                        <div class="form-group">
                            {!! Form::label('id_no','ID No') !!}
                            {!! Form::input('number','id_no','',['class'=>'form-control' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('id_expire_date','ID Expire Date') !!}
                            {!! Form::input('date','id_expire_date','',['class'=>'form-control' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('scan','Scan of ID') !!}
                            {!! Form::file('scan','',['class'=>'form-control'])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('date_of_birth','Date of Birth') !!}
                            {!! Form::input('date','date_of_birth','',['class'=>'form-control' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('country','Country') !!}
                            {!! Form::text('country','',['class'=>'form-control' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('mobile_number','Mobile Number') !!}
                            {!! Form::input('number','mobile_number','',['class'=>'form-control' ])!!}
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            {!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
@stop


@section('footer')

    <script>
        setTimeout(function () {
            $("#successMessage").slideUp();
        }, 3000);
    </script>

    <script>
        $('#createUser').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });

        $('#checkBox').change(function () {
            $('#msg').toggle();
        });

        $(function () {
            $('body').delegate('a.modal-image-link', 'click', function () {

                $('#modal-image-content').attr("src", $(this).attr('data-image'));
            })
        });
    </script>

    <!--dynamic table-->
    <script type="text/javascript" language="javascript"
            src="{!!url('/assets/template/')!!}/js/advanced-datatable/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="{!!url('/assets/template/')!!}/js/data-tables/DT_bootstrap.js"></script>

    <!--dynamic table initialization -->
    <script src="{!!url('/assets/template/')!!}/js/dynamic_table_init.js"></script>


@stop
