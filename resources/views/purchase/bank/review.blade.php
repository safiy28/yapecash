@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">   Account Reload: Bank(Review)</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="leftpan">
                <form id="confirm" role="form" method="POST" action="{{ url('payment/bank') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" value="{{$list[0] ?? $banks[0]['id']}}" name="bank"/>
                    <input type="hidden" value="{{$inputs['amount'] ?? old('amount')}}" name="amount"/>
                    <input type="hidden" value="{{$img ?? $inputs['slip']}}" name="slip"/>

                            <div class="panel">
                                <h2>Details</h2>
                                <div class="panelcontent">
                                    <table class="table table-striped" style="margin-bottom: 0px">
                                        <tr>
                                            <td>Bank Name</td>
                                            <td>:</td>
                                            <td>{{ $list[1] ?? $banks[0]['name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Amount</td>
                                            <td>:</td>
                                            <td>MYR  {{  $inputs['amount'] ?? old('amount') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Slip</td>
                                            <td>:</td>
                                            <td><img src="{{ $img ?? $inputs['slip']}}" width="200" height="100"/></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="panel ammount">
                                <h2>PIN</h2>
                                <div class="panelcontent">
                                    <div class="form-group clearfix">
                                        <input type="password" placeholder="Enter your pin" name="pin" id="pin" required>
                                        &nbsp;<span id="errmsg"></span>
                                    </div>
                                </div>
                            </div>
                    <input type="button" onclick="window.history.back(-1);"value="Back" class="submitbtn">
                    <input id="btn" type="submit" class="submitbtn" value="Submit">
                </form>
            </div>


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