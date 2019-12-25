@extends('layout.inner-main')
@section('body-content')
    <h1 class="title-text">Service: {{session('service_name')}} (Review)</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>

    @include('errors.list')

    <form id="confirm" method="POST" action="{{ route('recipient.wallet.confirm') }}">
        <div class="leftpan">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel ammount">
                        <h2>Sender Details</h2>
                        <div class="panelcontent">
                            <table class="table table-striped">
                                <tr>
                                    <td>Name</td><td>:</td>
                                    <td><strong>{{session('recipient_user')['user_name']}}</strong></td>
                                </tr>
                                <tr>
                                    <td>Mobile No</td><td>:</td>
                                    <td><strong>{{session('recipient_user')['mobile_number']}}</strong></td>
                                </tr>
                                <tr>
                                    <td>Address</td><td>:</td>
                                    <td><strong>{{session('recipient_user')['address']}}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel ammount">
                        <h2>Reciver Details</h2>
                        <div class="panelcontent">
                            <table class="table table-striped">
                                <tr><td><strong>Name</strong></td> <td>:</td><td>{{$recipient['name']}}</td></tr>
                                <tr><td><strong>Mobile No</strong></td><td>:</td> <td>{{$recipient['phone']}}</td></tr>
                                <tr><td><strong>Bank Name</strong></td> <td>:</td><td>{{session('transfer_modes')[0]['name']}}</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('modules.calculation')
                </div>
                <div class="col-md-8">
                <div class="panel">
                    <h2>Enter Personal Wallet No</h2>
                    <div class="panelcontent">
                        <input type="number" name="wallet_no" required placeholder="Enter Personal Wallet No">
                        <lebel style="padding-left: 3px">(Please enter receiver bkash & Rocket Number here.)</lebel>
                    </div>

                </div>
                <div class="panel">
                    <h2>Purpose of Remittance (You must fill this field)</h2>
                    <div class="panelcontent">
                        <select id="purpose" name="purpose" class="form-control" required>
                            <option value="">Select Purpose of Remittance</option>
                            @foreach($remittance_purposes as $remittance_purpose)
                                <option value="{{ $remittance_purpose['short_name'] }}">{{ $remittance_purpose['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                    <div class="panel">
                        <h2>Source of Fund (You must fill this field)</h2>
                        <div class="panelcontent">
                            <select id="source_fund" name="source_fund" class="form-control" required>
                                <option value="">Select Source of Fund</option>
                                @foreach($fund_sources as $fund_source)
                                    <option value="{{ $fund_source['short_name'] }}">{{ $fund_source['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <div class="panel">
                    <h2>Pin Number</h2>
                    <div class="panelcontent">
                        <input type="password" value="{{isset($pin)?$pin:""}}" name="pin" id="pin" required placeholder="Enter Pin Number">
                        &nbsp;<span id="errmsg"></span>
                    </div>
                </div>
                </div>
            </div>

            {{csrf_field()}}
            <input type="button" href="javascript:void(0)" onclick="window.history.back(-1)" value="BACK" class="submitbtn">
            {{--<a href="javascript:void(0)" class="btn btn-danger btn-lg btn-action back" onclick="window.history.back(-1)">Back</a>--}}
            @if(!session('recipient_charges')['balance_exceeded'])
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
        $(document).ready(function () {
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