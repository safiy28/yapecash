@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">
                Service: {{session('service_name')}}</h2>
            @include('errors.list')
            <div class="service_body">
                <form method="POST" action="{{ url('getdoc_payment/review') }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <div class="tblcon air-rate-table">
                                        <table class="onward table-bordered table" border="0" cellspacing="0"
                                               cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td>Clinic</td>
                                                <td>Code</td>
                                                <td>Address</td>
                                                <td>Phone Number</td>
                                            </tr>

                                            @foreach($clinics['result'] as $clinic)
                                                <tr>
                                                    <td>
                                                        <span class="selectarea radiogroup">
                                                        <input type="radio" class="selectarea radiogroup"
                                                               name="clinic_id"
                                                               value="{{ $clinic['id'] .'|'. $clinic['name']}}"
                                                               required>
                                                        </span>
                                                        {{ $clinic['name'] }}
                                                    </td>
                                                    <td>{{ $clinic['code'] }}</td>
                                                    <td>{{ $clinic['address'] }}</td>
                                                    <td>{{ $clinic['phone_number'] }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default service_panel">
                                <div class="panel-heading">Enter Amount</div>
                                <div class="panel-body">
                                    <input type="number" class="form-control" name="amount" required placeholder="Enter Amount">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default service_panel">
                                <div class="panel-heading">Enter Patient First Name</div>
                                <div class="panel-body">
                                    <input type="text" name="patient_first_name" required
                                           placeholder="Enter Patient First Name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default service_panel">
                                <div class="panel-heading">Enter Patient Last Name</div>
                                <div class="panel-body">
                                    <input type="text" name="patient_last_name" required
                                           placeholder="Enter Patient Last Name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default service_panel">
                                <div class="panel-heading">Enter Patient ID</div>
                                <div class="panel-body">
                                    <input type="text" name="patient_id_number" required
                                           placeholder="Enter NRIC or Passport number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default service_panel">
                                <div class="panel-heading">Enter Patient Mobile Number</div>
                                <div class="panel-body">
                                    <input class="form-control" type="text" name="patient_number" required placeholder="Enter Mobile Number">
                                </div>
                            </div>
                        </div>

                    </div>
                    {{ csrf_field() }}

                    <a href="{{url('/services')}}" class="btn btn-danger btn-lg btn-action back">Back</a>
                    <button class="btn btn-success btn-lg btn-action forward" type="submit">Next</button>
                </form>
            </div>
        </div>
    </div>
@stop