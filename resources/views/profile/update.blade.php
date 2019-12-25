@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Profile | {{$user['name'] ?? session('name')}}</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            <div class="leftpan">
                <div class="row">

                    @if($errors->any())
                        <div class="service_alert danger">
                            <div class="icon">
                                <div class="glyphicon glyphicon-remove"></div>
                            </div>
                            <div class="massages">
                                <div class="alert-title">ERROR</div>
                                <div class="alert-body">
                                    @foreach((array)$errors->all() as $error)
                                        <p>   {{$error}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('message'))
                        <div class="service_alert success">
                            <div class="icon">
                                <div class="glyphicon glyphicon-ok-circle"></div>
                            </div>
                            <div class="massages">
                                <div class="alert-title">SUCCESS</div>
                                <div class="alert-body">
                                    {{ session('message') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <form class="col-md-12" action="{{route('user.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$profile['user_id']}}">
                        <div class="col-md-12">
                            <div class=" service_panel panel-default panel ammount">
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name :</th>
                                            <td>{{$user['name'] ?? session('name')}}</td>
                                        </tr>
                                        <tr>
                                            <th>Permanent Address :</th>
                                            <td>{{$profile['permanent_address']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Post Code :</th>
                                            <td>{{$profile['post_code']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Occupation :</th>
                                            <td>{{$profile['occupation']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nationality :</th>
                                            <td>{{$profile['country']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender :</th>
                                            <td>{{$profile['gender']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Marital Status :</th>
                                            <td>{{$profile['marrital_status']}}</td>
                                        </tr>
                                        <tr>
                                            <th>ID Type :</th>
                                            <td>{{$profile['id_type']}}</td>
                                        </tr>
                                        <tr>
                                            <th>ID No :</th>
                                            <td>{{$profile['id_no']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Expire date :</th>
                                            <td>{{date('Y-m-d', strtotime($profile['id_expire_date']))}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birth :</th>
                                            <td> {{date('Y-m-d', strtotime($profile['date_of_birth']))}}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="panel-heading">Upload Profile Photo</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="file" class="" name="profile_photo" accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class=" service_panel panel-default panel ammount">
                                    <div class="panel-heading">Upload User ID 1</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="file" class="" name="scan" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" service_panel panel-default panel ammount">
                                    <div class="panel-heading">Upload User ID 2</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="file" class="" name="scan_one" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" service_panel panel-default panel ammount">
                                    <div class="panel-heading">Upload UserID 3</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="file" class="" name="scan_two" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="submitbtn" value="submit">
                        </div>
                    </form>
                </div>
            </div>

    </div>

        @stop
        @section('footer-script')
            <script src="{{url('/vendor/js/jquery.datetimepicker.full.min.js')}}"></script>

            <script>
                $(document).ready(function () {

                    $('#birth_date').datetimepicker({
                        format: 'Y-m-d',

                        timepicker: false
                    });

                    $('#expire_date').datetimepicker({
                        format: 'Y-m-d',

                        timepicker: false
                    });

                });
            </script>

@stop
