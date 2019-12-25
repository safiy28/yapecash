@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Profile |  {{$result['user']['name']}}</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="leftpan">
                <div class="panel service_panel panel-default">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name :</th>
                                <td>{{$result['user']['name']}}</td>
                            </tr>
                            <tr>
                                <th>Present Address :</th>
                                <td>{{$result['user']['profile']['present_address']}}</td>
                            </tr>
                            <tr>
                                <th>Permanent Address :</th>
                                <td>{{$result['user']['profile']['permanent_address']}}</td>
                            </tr>
                            <tr>
                                <th>Post Code :</th>
                                <td>{{$result['user']['profile']['post_code']}}</td>
                            </tr>
                            <tr>
                                <th>Occupation :</th>
                                <td>{{$result['user']['profile']['occupation']}}</td>
                            </tr>
                            <tr>
                                <th>Nationality :</th>
                                <td>{{$result['user']['profile']['country']}}</td>
                            </tr>
                            <tr>
                                <th>Gender :</th>
                                <td>{{$result['user']['profile']['gender']}}</td>
                            </tr>
                            <tr>
                                <th>Marital Status :</th>
                                <td>{{$result['user']['profile']['marrital_status']}}</td>
                            </tr>
                            <tr>
                                <th>ID Type :</th>
                                <td>{{$result['user']['profile']['id_type']}}</td>
                            </tr>
                            <tr>
                                <th>ID No :</th>
                                <td>{{$result['user']['profile']['id_no']}}</td>
                            </tr>
                            <tr>
                                <th>Expire date :</th>
                                <td>{{date('Y-m-d', strtotime($result['user']['profile']['id_expire_date']))}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth :</th>
                                <td> {{date('Y-m-d', strtotime($result['user']['profile']['date_of_birth']))}}</td>
                            </tr>
                            <tr>
                                <th>Profile Picture :</th>
                                <td><img src="{{asset($result['user']['profile']['profile_photo'])}}" width="200"></td>
                            </tr>
                            <tr>
                                <th>Scan of ID :</th>
                                <td><img src="{{asset($result['user']['profile']['scan'])}}" width="200"></td>
                            </tr>
                            <tr>
                                <th>Scan of ID 2 :</th>
                                <td><img src="{{asset($result['user']['profile']['scan_one'])}}" width="200"> </td>
                            </tr>
                            <tr>
                                <th>Scan of ID 3 :</th>
                                <td><img src="{{asset($result['user']['profile']['scan_two'])}}" width="200"> </td>
                            </tr>
                        </table>
                    </div>
                </div>

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
                    <form class="col-md-12" action="{{route('user.informations.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$result['user']['id']}}">


                        <div class="panel">
                            <h2>Upload Profile Photo</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="file" class="" name="profile_photo" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>


                            <div class="panel">
                                <h2>Upload User ID 1</h2>
                                <div class="panelcontent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="file" class="" name="scan" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <h2>Upload User ID 2</h2>
                                <div class="panelcontent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="file" class="" name="scan_one" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <h2>Upload UserID 3</h2>
                                <div class="panelcontent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="file" class="" name="scan_two" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <input type="submit"  value="Submit" class="submitbtn">

                    </form>
                </div>


            </div>



@stop


