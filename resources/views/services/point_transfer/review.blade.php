@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Service: {{session('service_name')}} (Review)</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>

    @include('errors.list')

        <form id="confirm" method="POST" action="{{ url('point_transfer/confirm') }}">
            <div class="leftpan">
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel ammount">
                            <h2>Selected Amount</h2>
                            <div class="panelcontent">
                                        <input name="amount" value="{{$inputs['amount']}}" readonly type="number" required
                                               placeholder="Enter Amount">
                                        <label for="" class="label-info label">Points</label>
                            </div>
                        </div>
                        <div class="panel">
                            <h2>Receiver Mobile Number</h2>
                            <div class="panelcontent">
                                <input type="number"
                                       value="{{$user['mobile_number']}}"
                                       name="receiver_mobile_number" readonly placeholder="Enter Receiver Number">
                            </div>
                        </div>
                                <div class="panel">
                                    <h2>Receiver Name</h2>
                                    <div class="panelcontent">
                                        <input type="text" readonly="" value="{{$user['user_name']}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-4">
                        @include('modules.point_transfer_calculation')
                    </div>
                    <div class="col-md-8">
                        <div class="panel">
                            <h2>PIN</h2>
                            <div class="panelcontent">
                                <input type="password" placeholder="Enter your pin" name="pin" id="pin" required>
                                &nbsp;<span id="errmsg"></span>
                            </div>
                        </div>
                    </div>
                </div>
                {{csrf_field()}}
                <input type="button" onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';" value="BACK" class="submitbtn">
                @if(!$service_result['balance_exceeded'])
                    <input id="btn" type="submit" value="submit" class="submitbtn">
                @endif


            </div>

        </form>


@stop
@section('footer-script')
    <script>
        /*
        $(document).ready(function(){
            $(document).on("keydown", disableF5);
        });*/
        $(document).ready(function(){
        $('#btn').click(function(){
            if($('#confirm')[0].checkValidity()){
                this.form.submit();
                this.disabled=true;
                this.value='Sending…';

            }
        });

        //called when key is pressed in textbox
        $("#pin").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && e.which != 13 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#errmsg").html("Number Only").show().fadeOut("slow");
                return false;
            }
        });
        });
    </script>
@stop
