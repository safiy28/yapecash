
@extends('layout.inner-main')
@section('header')
    <link href="{!!url('/')!!}/css/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
    <script src="{!!url('/')!!}/js/jquery.datetimepicker.full.min.js"></script>
@stop
@section('body-content')

            <h1 class="title-text">User Registration</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>
            @if($errors->any())
                <div class="service_alert danger">
                    <div class="massages">
                        <div class="alert-title">ERROR</div>
                        <div class="alert-body">
                            @foreach($errors->all() as $error => $value)
                                <p> {{strstr(preg_replace('/[^a-zA-Z0-9_ -]/s','',$value)," ")}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="leftpan">
                <div class="panel">
                    <div class="panelcontent">
                        <table class="table table-bordered">
                            <tr>
                                <th>Mobile No : </th>
                                <td>{{session('user_registration')['mobile_number']}}</td>
                            </tr>
                            <tr>
                                <th>Name :</th>
                                <td>{{session('user_registration')['name']}}</td>
                            </tr>
                            <tr>
                                <th>Email :</th>
                                <td>{{session('user_registration')['email']}}</td>
                            </tr>
                            <tr>
                                <th>ID Type</th>
                                <td> {{session('user_registration')['id_type']}}</td>
                            </tr>
                            <tr>
                                <th>ID No</th>
                                <td> {{session('user_registration')['id_no']}}</td>
                            </tr>
                            <tr>
                                <th>Expire Date :</th>
                                <td>{{session('user_registration')['id_expire_date']}}</td>
                            </tr>
                        </table>
                    </div>
                </div>




                <div class="row">
                    <form class="col-md-12" action="{{url('/user/scan')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="panel">
                            <h2>Address</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                           <textarea autofocus="autofocus" rows="3" cols="50" class="form-control" required name="present_address"
                                                     placeholder="Enter Address">{{old('present_address')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <h2>State</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select id="state" name="state" class="form-control" required>
                                            <option value="">Select State</option>
                                            <option value="NSW">NSW</option>
                                            <option value="VIC">VIC</option>
                                            <option value="QLD">QLD</option>
                                            <option value="SA">SA</option>
                                            <option value="WA">WA</option>
                                            <option value="TAS">TAS</option>
                                            <option value="ACT">ACT</option>
                                            <option value="NT">NT</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <h2>Post Code</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" required name="post_code" value="{{old('post_code')}}" placeholder="Enter post code" maxlength="4" minlength="4"></div>
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
                    <h2>Date of Birth</h2>
                    <div class="panelcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" id='date_of_birth' class="form-control" name="date_of_birth"
                                       placeholder="Date of Birth" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h2>Nationality</h2>
                    <div class="panelcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" required name="country" value="{{old('country')}}" placeholder="Enter Nationality">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h2>Marital Status</h2>
                    <div class="panelcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <select id="marrital_status" name="marrital_status" class="form-control" required>
                                    <option value="">Select Marital Status</option>
                                    <option value="married">Married</option>
                                    <option value="unmarried">Unmarried</option>
                                    <option value="divorced">Divorced</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h2>Gender</h2>
                    <div class="panelcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h2>Selfie (Required)</h2>
                    <div class="panelcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <input required type="file" class="" name="profile_photo" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <h2>Passport/Driving License (Required)</h2>
                    <div class="panelcontent">
                        <div class="row">
                            <div class="col-md-12">
                                <input required type="file" class="" name="scan" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <h2>Copy of Utility Bill</h2>
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





@stop
@section('footer-script')
      <script src="{{url('/js/jquery.datetimepicker.full.min.js')}}"></script>

    <script>
        $('#expire_date').datetimepicker({
            timepicker: false,
            format: 'Y-m-d'
        });

        $('#date_of_birth').datetimepicker({
            format: 'Y-m-d',
            autoclose:true,
            timepicker: false,
            maxDate: 0
        });
    </script>

@stop




