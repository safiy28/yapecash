@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Profile | {{session('name')}}</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="leftpan">
                <form role="form" method="POST" action="{{route('change-pin') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="panel ammount">
                        <h2>Current Pin</h2>
                        <div class="panelcontent">
                            <div class="col-md-5">
                                <input required type="password" name="current_pin" id="current_pin" placeholder="Enter Current Pin Number">
                                &nbsp;<span id="errmsg1"></span>
                            </div>
                        </div>
                    </div>

                    <div class="panel ammount">
                        <h2>New Pin</h2>
                        <div class="panelcontent">
                            <div class="col-md-5">
                                <input required type="password" name="pin" id="pin" placeholder="Enter New Pin Number">
                                &nbsp;<span id="errmsg"></span>
                            </div>
                        </div>
                    </div>

                    <div class="panel ammount">
                        <h2>Confirm New Pin</h2>
                        <div class="panelcontent">
                            <div class="col-md-5">
                                <input required type="password" name="pin_confirmation" id="pin_confirmation" placeholder="Re-enter new pin">
                                &nbsp;<span id="errmsg2"></span>
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

            $("#current_pin").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && e.which != 13 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg1").html("Number Only").show().fadeOut("slow");
                    return false;
                }
            });

            $("#pin_confirmation").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && e.which != 13 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg2").html("Number Only").show().fadeOut("slow");
                    return false;
                }
            });
        });
    </script>
@stop
