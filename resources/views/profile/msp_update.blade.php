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
                        <input type="hidden" name="from_msp" value="true">
                                <div class="panel">
                                    <h2>Name</h2>
                                    <div class="panelcontent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input required autofocus="autofocus" name="fname"  value="{{$user['name'] ?? session('name')}}" placeholder="Name" class="form-control"  type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="panel">
                            <h2>Father Name</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input autofocus="autofocus" name="father_name"  value="{{$profile['father_name'] ?? ''}}" placeholder="Enter Father Name" class="form-control"  type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Mother Name</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input autofocus="autofocus" name="mother_name"  value="{{$profile['mother_name'] ?? ''}}" placeholder="Enter Mother Name" class="form-control"  type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Nationality</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input  required autofocus="autofocus" name="country"  value="{{$profile['country'] ?? ''}}" placeholder="Enter Nationality" class="form-control"  type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Gender</h2>
                            <div class="panelcontent">
                                <div class="row">
                                  <div class="col-md-4">
                                <select id="gender" name="gender" required class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="male" @if($profile['gender'] == 'male') selected @endif>Male</option>
                                    <option value="female" @if($profile['gender'] == 'female') selected @endif>Female</option>
                                </select>
                                  </div>
                                </div>
                            </div>
                        </div>
                            <div class="panel">
                                <h2>Marital Status</h2>
                                <div class="panelcontent">
                                    <div class="row">
                                        <div class="col-md-4">
                                    <select id="marital_status" name="marrital_status" required class="form-control">
                                        <option value="">Select Marital Status</option>
                                        <option value="unmarried" @if($profile['marrital_status'] == 'unmarried') selected @endif>Unmarried</option>
                                        <option value="married" @if($profile['marrital_status'] == 'married') selected @endif>Married</option>
                                    </select>
                                </div>
                            </div>
                                </div>
                            </div>
                                <div class="panel">
                                    <h2>Present Address</h2>
                                    <div class="panelcontent">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input  required autofocus="autofocus" name="present_address"  value="{{$profile['present_address'] ?? ''}}" placeholder="Enter Present Address" class="form-control"  type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <div class="panel">
                            <h2>Permanent Address</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input  required autofocus="autofocus" name="permanent_address"  value="{{$profile['permanent_address'] ?? ''}}" placeholder="Enter Permanent Address" class="form-control"  type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                                <div class="panel">
                                    <h2>Post Code</h2>
                                    <div class="panelcontent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input  required type="text" class="form-control"  name="post_code" value="{{$profile['post_code']}}" placeholder="Enter post code">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel">
                                    <h2>Occupation</h2>
                                    <div class="panelcontent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input  required type="text" class="form-control"  name="occupation" value="{{$profile['occupation']}}" placeholder="Enter occupation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="panel">
                            <h2>Source of Income</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                <input type="text" name="source_of_income" class="form-control" value="{{ $profile['source_of_income'] }}">
                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Date of Birth</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                <input type="text" name="date_of_birth" value="{{ date("Y-m-d", strtotime($profile['date_of_birth'] ))}}" id="birth_date" class="form-control">
                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Id Type</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select id="id_type" name="id_type" class="form-control" required>
                                            <option value="">Select Identification Type</option>
                                            @foreach($idTypes as $id_type)
                                                <option value="{{ $id_type['short_name'] }}" {{trim($profile['id_type']) == trim($id_type['short_name']) ? 'selected' : ""}}>{{ $id_type['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>ID No</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                <input type="text" required name="id_no" class="form-control" value="{{ $profile['id_no'] }}">
                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Passport Issue Date</h2>
                            <div class="panelcontent">
                                <div class="row">
                                    <div class="col-md-4">
                                <input type="text" name="passport_issue_date" class="form-control" value="{{ date("Y-m-d", strtotime($profile['passport_issue_date'] ))}}" id="passport_issue_date">
                            </div>
                        </div>
                            </div>
                        </div>
                                <div class="panel" id="exp_area">
                                    <h2>ID Expire Date</h2>
                                    <div class="panelcontent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" id='expire_date' class="form-control" value="{{ date("Y", strtotime($profile['id_expire_date'])) < 1 ? '' : date("Y-m-d", strtotime($profile['id_expire_date']))}}" name="expire_date"
                                                       placeholder="Expire date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel">
                                    <h2>Upload Profile Photo</h2>
                                    <div class="panelcontent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="file" class="" name="profile_photo" accept="image/*">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel">
                                    <h2>Upload User ID 1</h2>
                                    <div class="panelcontent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="file" class="" name="scan" accept="image/*">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel">
                                    <h2>Upload User ID 2</h2>
                                    <div class="panelcontent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="file" class="" name="scan_one" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="panel">
                                    <h2>Upload UserID 3</h2>
                                    <div class="panelcontent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="file" class="" name="scan_two" accept="image/*">

                                            </div>
                                        </div>
                                    </div>
                                </div>--}}


                            <input type="submit" class="submitbtn" value="submit">

                    </form>
                </div>
            </div>

    </div>

@stop
@section('footer-script')
    <script src="{{url('/js/jquery.datetimepicker.full.min.js')}}"></script>
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
            jQuery('#passport_issue_date').datetimepicker({
                format: 'Y-m-d',
                timepicker: false
            });

        });

        /*$(function() {
            $('#id_type').change(function(){
                if ($("#id_type").val() == "identification_id" || $("#id_type").val() == "social_security")
                {
                    $('#exp_area').hide();
                    $('#expire_date').removeAttr('required');
                }else
                {
                    $('#exp_area').show();
                    $('#expire_date').attr('required','required');
                }
            });
            if ($("#id_type").val() == "identification_id" || $("#id_type").val() == "social_security")
            {
                $('#exp_area').hide();
                $('#expire_date').removeAttr('required');
            }else
            {
                $('#exp_area').show();
                $('#expire_date').attr('required','required');
            }
        });*/
    </script>

@stop

