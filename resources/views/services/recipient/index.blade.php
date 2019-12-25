@extends('layout.inner-main')
@section('body-content')
    <h1 class="title-text">Service : {{session('service_name')}}</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>

            @include('errors.list')
    <form action="{{ route('bank.transfer.verify') }}"  method="post">
        <div class="leftpan">
            <div class="panel ammount">
                <h2>Select Country</h2>
                <div class="panelcontent">
                    <ul id="radio-option2">
                        @foreach((array)$countries as $index => $country)
                            <li>
                                <div class="selectarea radiogroup">
                                    <input class="operators" <?php if($index==0)$curnt=$country['currency'];?> {{ $index===0 ? 'checked' : '' }} name="country" type="radio" value="{{ $country['keyword'] }}" id="operator-{{ $index }}"
                                           data-currency="{{$country['currency']}}" required/>
                                </div>
                                {{$country['name']}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="panel ammount">
                <h2>TRANSFER MODE</h2>
                <div class="panelcontent">
                    <ul id="radio-option2">
                        @foreach((array)$transfer_modes as $index=>$mode)
                            <li>
                                <div class="selectarea radiogroup">
                                    <input  required {{$index==0?"checked":""}} type="radio" name="transfer_type" value="{{$mode['keyword']}}">
                                </div>
                                {{$mode['name']}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h2>Sending Amount</h2>
                        <div class="panelcontent">
                            <input type="number" required="" name="amount" id="amount" required placeholder="Enter Your Amount">
                            <label for="" class="label label-info" id="curnt">{{$curnt}}</label>
                            <label for="" class="label-charge" id="lbl-point"></label>
                        </div>
                    </div>

                    <div class="panel ammount">
                        <h2>Sender</h2>
                        <div class="panelcontent">
                                <ul id="radio-option2">
                                    <li>
                                        <div class="selectarea radiogroup">
                                            <input required checked type="radio" value="{{session('mobile_number')}}" id="self" name="sender_mobile_number">
                                        </div>
                                        <label for="self">Myself</label>
                                    </li>
                                    <li>
                                        <div class="selectarea radiogroup">
                                            <input type="radio" value="other" id="other" name="sender_mobile_number">
                                        </div>
                                        <label for="other">Others</label>
                                    </li>
                                </ul>

                        </div>
                    </div>

                    <div class="panel" id="other_sender" style="display: none">
                        <h2>Sender Mobile No</h2>
                        <div class="panelcontent">
                            <input type="number" autofocus="autofocus" value="{{getCountryDialingCode('australia')}}" id="other_mobile_number"  name="other_mobile_number" placeholder="Enter Sender Number" autocomplete="off"/>

                        </div>
                    </div>

                </div>
            </div>


            {{ csrf_field() }}
            <input type="hidden" name="hidden_currency" class="hidden_currency" value="{{$curnt}}"/>
            <input type="hidden" name="hidden_serviceID" class="hidden_serviceID" value="{{session('service_id')}}"/>
            <input type="button" onclick="location.href='{{url('/services')}}';"value="BACK" class="submitbtn">
            <input type="submit" value="next" class="submitbtn">
        </div>
    </form>

@stop
@section('footer-script')
    <script>
        $( document ).ready(function() {
            var amount = 0;
        if($('input:radio[name="sender_mobile_number"]:checked').val() == 'other'){
            $('#other_sender').show();
            var num = $('#other_mobile_number').val();
            $('#other_mobile_number').focus().val('').val(num);
        }else{
            $('#other_sender').hide();
        }
        $('#curnt').html($(".hidden_currency").val());
        $('.operators').on('change', function () {
            var currency = $(this).data('currency');
            $('#curnt').html(currency);
            $(".hidden_currency").val(currency);
            loadCalculation();
        });



        $('input:radio[name="sender_mobile_number"]').change(function() {
            if ($(this).val() != 'other') {
                $('#other_sender').hide();
                $('#other_mobile_number').removeAttr('required');
                $('#other_mobile_number').val("61");
            } else {
                $('#other_sender').show();
                $('#other_mobile_number').attr('required','required');
                var num = $('#other_mobile_number').val();
                $('#other_mobile_number').focus().val('').val(num);

            }
        });

        $("#other_mobile_number").keydown(function(e) {
            var oldvalue=$(this).val();
            var field=this;
            var $this = $(this);
            setTimeout(function () {
                if(field.value.indexOf({{getCountryDialingCode('australia')}}) !== 0) {
                    $(field).val(oldvalue);
                }

                if($this.val().length>11){
                    $this.val($this.val().substring(0,11))
                }
            }, 1);
        });

            loadCalculation();
            jQuery('#amount').keyup(function() {
                loadCalculation();
            });

            function loadCalculation() {
                var id = $('.hidden_serviceID').val();
                amount = $('#amount').val();
                if(amount == null || amount == ""){
                    amount = 0;
                }
                var country = $('input:radio[name="country"]:checked').val();
                $.get("{{url('/calculate-au-point')}}/" + id + "/" + amount + "/" + country, function (data) {
                    if (data != null || data != "") {
                        results = data.result;
                        point = amount + " " + results.currency + " = " + results.amount.replace(/,/g, "") +" AUD + Charges";

                        $('#lbl-point').html(point);

                    }
                });
            }

        });


    </script>
@stop