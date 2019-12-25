@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">User Registration</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>

            <div class="leftpan">

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


                <div class="row">
                    <form class="col-md-12" action="{{route('user.register')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel">
                            <h2>Mobile Number</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" required readonly name="mobile_number"
                                               value="{{session('user_registration')['mobile_number']}}"
                                               placeholder="Enter mobile number">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <h2>Name</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input autofocus="autofocus" type="text" name="name" required
                                               placeholder="Name" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Passport/IC/Business reg no.</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" required name="id_no"
                                               placeholder="ID No" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel" id="exp_area">
                            <h2>Expire Date</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" id='expire_date' class="form-control" name="expire_date"
                                               placeholder="Expire date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel" id="exp_area">
                            <h2>Date of birth</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" id='dob' class="form-control" name="date_of_birth"
                                               placeholder="Expire date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Address</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                           <textarea rows="3" cols="50" class="form-control" required name="present_address"
                                                     placeholder="Enter Address">{{old('present_address')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Post Code</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" required name="post_code" value="{{old('post_code')}}" placeholder="Enter post code"
                                               maxlength="4" minlength="4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Occupation</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" required name="occupation" value="{{old('occupation')}}" placeholder="Enter occupation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Upload Profile photo (requried)</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input required type="file" class="" name="profile_photo" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <h2>Upload UserID 1 (requried)</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input required type="file" class="" name="scan" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <h2>Upload UserID 2</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="file" class="" name="scan_one" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="submitbtn" value="Submit">
                    </form>
                </div>
                </form>
            </div>


@stop
@section('footer-script')
    <script src="{{url('/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#expire_date').datetimepicker({
                format: 'Y-m-d',
                autoclose:true,
                timepicker: false,
                minDate: 0
            });

        });

        $(document).ready(function () {

            $('#dob').datetimepicker({
                format: 'Y-m-d',
                autoclose:true,
                timepicker: false
            });

        });
    </script>

@stop
