@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Profile | {{session('name')}}</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>
            @include('errors.list')
            <div class="leftpan">
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

                <div class="panel service_panel panel-default">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name :</th>
                                <td>{{session('name')}}</td>
                            </tr>

                            <tr>
                                <th>Address :</th>
                                <td>{{$profile['present_address']}}</td>
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
                                <th>Gender :</th>
                                <td>{{$profile['gender']}}</td>
                            </tr>
                            <tr>
                                <th>ID No :</th>
                                <td>{{$profile['id_no']}}</td>
                            </tr>
                            <tr>
                                <th>Expire date :</th>
                                <td>{{date('d/m/Y', strtotime($profile['id_expire_date']))}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth :</th>
                                <td> {{date('d/m/Y', strtotime($profile['date_of_birth']))}}</td>
                            </tr>
                            <tr>
                                <th>Profile photo :</th>
                                <td><img src="{{$profile['profile_photo']}}" alt="" width="250"/></td>
                            </tr>
                            <tr>
                                <th>UserID 1 :</th>
                                <td><img src="{{$profile['scan']}}" alt="" width="250"/></td>
                            </tr>
                            <tr>
                                <th>UserID 2 :</th>
                                <td><img src="{{$profile['scan_one']}}" alt="" width="250"/></td>
                            </tr>

                        </table>
                    </div>
                </div>
                <input type="button" onclick="location.href='{{  route('services') }}';" value="Back" class="submitbtn">

            </div>


@stop
