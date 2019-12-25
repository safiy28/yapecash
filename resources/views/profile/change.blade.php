@extends('layout.inner-main')
@section('body-content')

            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Profile | {{session('name')}}</h2>
            @include('errors.list')
            <div class="leftpan">
                <form role="form" method="POST" action="{{ url('/profile/changeLogin') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="panel panel-default service_panel">
                        <div class="panel-heading">New Pin (If want to change or else keep empty)</div>
                        <div class="panel-body">
                            <div class="col-md-5">
                                <input type="password" name="pin" id="pin" placeholder="Enter New Pin Number">
                                &nbsp;<span id="errmsg"></span>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default service_panel">
                        <div class="panel-heading">New Password (If want to change or else keep empty)</div>
                        <div class="panel-body">
                            <div class="col-md-5">
                                <input type="password" name="password" placeholder="Enter New Password">
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default service_panel">
                        <div class="panel-heading">Old Pin</div>
                        <div class="panel-body">
                            <div class="col-md-5">
                                <input required type="password" name="old_pin" id="old_pin" placeholder="Enter Old Pin Number">
                                &nbsp;<span id="errmsg1"></span>
                            </div>
                        </div>
                    </div>


                    <input type="submit" class="submitbtn" value="submit">

                </form>
            </div>

@stop
@section('footer-script')
    <script>
        $(document).ready(function () {
            //called when key is pressed in textbox
            $("#pin").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && e.which != 13 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg").html("Number Only").show().fadeOut("slow");
                    return false;
                }
            });

            $("#old_pin").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && e.which != 13 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg1").html("Number Only").show().fadeOut("slow");
                    return false;
                }
            });

        });
    </script>
@stop
