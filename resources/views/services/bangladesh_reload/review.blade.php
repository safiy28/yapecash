@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Service: {{session('service_name')}} (Review)</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>

    @include('errors.list')

    <form id="confirm" method="POST" action="{{ route('bangladesh.topup.confirm') }}">
        <div class="leftpan">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel operator">
                        <h2>Select Operator</h2>
                        <div class="panelcontent">
                            <ul>
                                @foreach((array)$operators as $index => $_operator)
                                    @if($_operator['keyword'] === $operator)
                                        <li>
                                            <div class="selectarea radiogroup">
                                                <input {{$_operator['keyword'] === $operator?'checked':'disabled'}}
                                                       type="radio" value="{{$_operator['keyword']}}"
                                                       id="operator-{{$index}}" required
                                                       name="operator" class="operators">
                                            </div>
                                            <img  class="operator-logo" src="{{$_operator['logo']}}" alt="{{$_operator['name']}}"/>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <div class="panel ammount">
                        <h2>Select Type</h2>
                        <div class="panelcontent">
                            <ul id="radio-option2">
                                @if($type === 'prepaid')
                                    <li>
                                        <div class="selectarea radiogroup">
                                            <input checked type="radio" value="prepaid" required name="type" id="rate-prepaid">
                                        </div>
                                        Pre-paid
                                    </li>
                                @else


                                    <li>
                                        <div class="selectarea radiogroup">
                                            <input checked type="radio" value="postpaid" required name="type" id="rate-postpaid">
                                        </div>
                                        Post-paid
                                    </li>
                                @endif


                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <h2>Amount</h2>
                                <div class="panelcontent">
                                        <input type="number" value="{{$amount ?? ''}}" name="amount" required placeholder="Enter Your Amount" readonly >
                                        <label for="amount" class="label label-info">BDT</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('modules.calculation')
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel">
                                <h2>Receiver Mobile Number</h2>
                                <div class="panelcontent">
                                    <input type="number"
                                           value="{{$receiver_mobile_number ?? ''}}"
                                           name="receiver_mobile_number" readonly placeholder="Enter Receiver Number">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <h2>PIN</h2>
                                <div class="panelcontent">
                                    <input type="password" placeholder="Enter your pin" name="pin" id="pin" required>
                                    &nbsp;<span id="errmsg"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{csrf_field()}}
            <input type="button" onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';" value="BACK" class="submitbtn">
            <input id="btn" type="submit" value="submit" class="submitbtn">

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
