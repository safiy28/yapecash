@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Edit {{$user['name']}}'s Profile</h2>
            <div class="service_body">
                <div class="service_panel panel panel-default">
                    <div class="panel-heading">Personal Information</div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="{{url("/users/informations/{$user['id']}")}}"
                              accept-charset="UTF-8" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$user['name']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Father Name</label>
                                        <input type="text" name="father_name" class="form-control" value="{{$user['profile']['father_name']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Mother Name</label>
                                        <input type="text" name="mother_name" class="form-control" value="{{$user['profile']['mother_name']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Gender</label>
                                        <input type="text" id="gender" name="gender" class="form-control" value="{{$user['profile']['gender']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Occupation</label>
                                        <input type="text" id="occupation" name="occupation" class="form-control" value="{{$user['profile']['occupation']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Date of birth</label>
                                        <input type="text" name="date_of_birth" id="birth_date"
                                               value="{{$user['profile']['date_of_birth']}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Present Address</label>
                                        <input type="text" name="present_address" class="form-control" value="{{$user['profile']['present_address']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Permanent Address</label>
                                        <input type="text" name="permanent_address" class="form-control" value="{{$user['profile']['permanent_address']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Post Code</label>
                                        <input type="text" id="post_code" name="post_code" class="form-control" value="{{$user['profile']['post_code']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nationality</label>
                                        <input type="text" name="country" value="{{$user['profile']['country']}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Source of Income</label>
                                        <input type="text" id="source_of_income" name="source_of_income"
                                               value="{{$user['profile']['source_of_income']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">ID type</label>
                                        <input type="text" id="id_type" name="id_type" value="{{$user['profile']['id_type']}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Passport / other</label>
                                        <input type="text" name="id_no" value="{{$user['profile']['id_no']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Passport Issue date</label>
                                        <input type="text" id="passport_issue_date" name="passport_issue_date"
                                               value="{{$user['profile']['passport_issue_date']}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Passport Expire Date</label>
                                        <input type="text" id="expire_date" name="id_expire_date"
                                               value="{{$user['profile']['id_expire_date']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload Profile photo (select if want to change)</label>
                                        <input type="file" name="profile_photo" accept="image/*" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upload UserID 1 (select if want to change)</label>
                                        <input type="file" name="scan" accept="image/*" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upload UserID 2 (select if want to change)</label>
                                        <input type="file" name="scan_one" accept="image/*" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upload UserID 3 (select if want to change)</label>
                                        <input type="file" name="scan_two" accept="image/*" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success" type="submit">Update</button>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <strong>Profile Photo</strong><br><br><img src="{{$user['profile']['profile_photo']}}" alt=""
                                                                   width="284" height="269">
                        <ul>
                            <li><strong> Scan ID 1</strong> <img src="{{$user['profile']['scan']}}" alt="" width="540"
                                                                 height="388"></li>
                            <li><strong>Scan ID 2</strong> <img src="{{$user['profile']['scan_one']}}" alt="" width="540"
                                                                height="388"></li>
                            <li><strong> Scan ID 3</strong> <img src="{{$user['profile']['scan_two']}}" alt="" width="540"
                                                                 height="388"></li>
                        </ul>
                    </div>
                </div>
                <div class="service_panel panel panel-default">
                    <div class="panel-heading">Recipients</div>
                    <div class="panel-body">
                        <div class="pull-right" style="margin-bottom:  10px;">
                            <a href="{{url("/users/{$user['id']}/recipient/create")}}" class="btn btn-primary">Add Recipients</a>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Status</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                            @foreach($user['recipients'] as $index => $recipient)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$recipient['name']}}</td>
                                    <td>
                                        @if($recipient['active']==1)
                                            active
                                        @else
                                            inactive
                                        @endif
                                    </td>
                                    <td><a href="{{url('/')}}/users/{{$user['id']}}/recipient/{{$recipient['id']}}/edit">Click</a></td>
                                    <!-- users/4/recipient/1/edit -->
                                    <td><a href="{{url('/')}}/users/{{$user['id']}}/recipient/{{$recipient['id']}}/delete">Click</a>
                                    </td>
                                </tr>

                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer-script')
    <script src="{{url('/vendor/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/vendor/js/data-tables/DT_bootstrap.js')}}"></script>

    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>

    <script>
        $(function () {

            $(function () {

                $('#birth_date').datetimepicker({
                    format: 'Y-m-d',
                    timepicker: false
                });

                $('#expire_date').datetimepicker({
                    format: 'Y-m-d',
                    timepicker: false
                });

                $('#passport_issue_date').datetimepicker({
                    format: 'Y-m-d',
                    timepicker: false
                });

            });

        });
    </script>
@stop