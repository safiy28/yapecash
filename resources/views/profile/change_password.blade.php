@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Profile | {{session('name')}}</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="leftpan">
                <form role="form" method="POST" action="{{route('change-password') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="panel ammount">
                        <h2>Current Password</h2>
                        <div class="panelcontent">
                            <div class="col-md-5">
                                <input required type="password" name="current_password" placeholder="Enter Current Password">
                            </div>
                        </div>
                    </div>


                    <div class="panel ammount">
                        <h2>New Password</h2>
                        <div class="panelcontent">
                            <div class="col-md-5">
                                <input required type="password" name="password" placeholder="Enter New Password">
                            </div>
                        </div>
                    </div>



                    <div class="panel ammount">
                        <h2>CONFIRM NEW PASSWORD</h2>
                        <div class="panelcontent">
                            <div class="col-md-5">
                                <input type="password" name="password_confirmation" placeholder="Re-enter new password">
                            </div>
                        </div>
                    </div>


                    <input type="submit" class="submitbtn" value="submit">

                </form>
            </div>


@stop
