@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Rate Calculator</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>

            @include('errors.list')
            <div class="leftpan">
                <div class="row">
                <div class="col-md-4">
                    <form action="{{url('rate/calculate')}}" method="post">

                        <div class="panel ammount">
                            <h2>Top-UP</h2>
                            <div class="panelcontent">
                                <div class="topUp-drop-down">
                                    <img src="">

                                    <select name="service" class="form-control" id="service">
                                        @foreach((array)$services['topup'] as $service)
                                            <option class="en" value="{{ $service['id'] }}" data-icon="{{$service['icon']}}">{{ $service['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                <div class="operator-drop-down">
                                    <img src="">
                                    <select name="operator" id="operators" class="form-control">
                                    </select>
                                </div><br>
                                <div class="rate-amount">
                                    <input type="number" name="amount" class="form-control" placeholder="Amount" required>
                                </div><br>
                                <div class="rate-amount">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="_slug" value="top-up">
                                    <input type="submit" name="" value="Calculate" class="submitbtn">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-4">
                    <form action="{{url('rate/calculate')}}" method="post">

                        <div class="panel ammount">
                            <h2>Rate</h2>
                            <div class="panelcontent">
                                <div class="rate-drop-down">

                                    <select name="service" class="form-control" id="services_rate">
                                        @foreach((array)$services['remittance'] as $service)
                                            <option class="en" value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                <div class="country-drop-down">
                                    <select name="country" id="rateCountry" class="form-control">
                                    </select>
                                </div><br>
                                <div class="rate-amount">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="_slug" value="rate_charge">
                                    <input type="submit" name="" value="Calculate" class="submitbtn">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                    <div class="col-md-4">
                        <form action="{{url('rate/calculate')}}" method="post">

                            <div class="panel ammount">
                                <h2>Remittance</h2>
                                <div class="panelcontent">
                                    <div class="remittance-drop-down">
                                        <select name="service" class="form-control" id="service_remittance">
                                            @foreach((array)$services['remittance'] as $service)
                                                <option class="en" value="{{ $service['id'] }}" data-icon="{{$service['icon']}}">{{ $service['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div><br>
                                    <div class="remittanceCountry-drop-down" id="remi_country">
                                        <select name="country" id="ramirranceCountry" class="form-control">
                                        </select>
                                    </div><br>
                                    <div class="rate-amount">
                                        <input type="number" name="amount" class="form-control" placeholder="Amount" required>
                                    </div><br>
                                    <div class="rate-amount">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="_slug" value="remi_charge">
                                        <input type="submit" name="" value="Calculate" class="submitbtn">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
            </div>


@stop

@section('footer-script')
    <script>

        $(document).ready(function() {
            var logo = $('#service').find(':selected').attr('data-icon');
            loadLogo(logo,'topUp');
        });
        let serviceInput = $('#service');
        let operatorsWrapper = $('#operators');
        let current = serviceInput.val();
        operatorsWrapper.html("<label class='label label-default'>Please select a select first</label>");
        loadOperators(current);

        serviceInput.change(function () {
            let id = $(this).val();
            let topUpIcon = $(this).find(':selected').attr('data-icon');
            loadOperators(id,topUpIcon);
        });
        operatorsWrapper.change(function () {
            var logo = $(this).find(':selected').attr('data-icon');
            loadLogo(logo,'operator');
        });
        function loadOperators(id,topUpIcon) {
            operatorsWrapper.html("<label class='label label-info'>Please wait...</label>");
            $(".topUp-drop-down img").attr("src", topUpIcon);
            $.get("{{url('/rate/operators')}}/" + id, function (e) {
                let res = e;
                let innerText = "";
                if ((res !== false) && (res.length > 0)) {
                    res.forEach(function (op, index) {
                        if (index === 0) {
                            $(".operator-drop-down img").attr("src", op.logo);
                            innerText += "<option selected data-icon='" + op.logo + "' value='" + op.keyword + "'>" + op.name + "</option>";
                        } else {
                            innerText += "<option  data-icon='" + op.logo + "' value='" + op.keyword + "'>" + op.name + "</option>";
                        }
                    });
                } else {
                    innerText = "No data found please contact with admin";
                }
                operatorsWrapper.html(innerText);
            });
        }
        function loadLogo(logo,type) {
            if(type=='operator'){
                $(".operator-drop-down img").attr("src", logo);
            }else{
                $(".topUp-drop-down img").attr("src", logo);
            }

        }

        let serviceRateInput = $('#services_rate');
        let countryWrapper = $('#rateCountry');
        let currentService = serviceRateInput.val();
        countryWrapper.html("<label class='label label-default'>Please select a select first</label>");
        loadCountries(currentService);

        serviceRateInput.change(function () {
            let id = $(this).val();
            loadCountries(id);
        });
        function loadCountries(id) {
            countryWrapper.html("<label class='label label-info'>Please wait...</label>");
            $.get("{{url('/rate/country')}}/" + id, function (e) {
                let res = e;
                let innerText = "";
                if ((res !== false) && (res.length > 0)) {
                    res.forEach(function (op, index) {
                        if (index === 0) {
                            innerText += "<option selected value='" + op.keyword + "'>" + op.name + "</option>";
                        } else {
                            innerText += "<option  value='" + op.keyword + "'>" + op.name + "</option>";
                        }
                    });
                } else {
                    innerText = "No data found please contact with admin";
                }
                countryWrapper.html(innerText);
            });
        }

        let serviceRemitanceInput = $('#service_remittance');
        let countryRemiWrapper = $('#ramirranceCountry');
        let currencyRemiWrapper = $('#ramirranceCurrency');
        let currentRemiService = serviceRemitanceInput.val();
        loadRemiCountries(currentRemiService);

        serviceRemitanceInput.change(function () {
            let id = $(this).val();
            loadRemiCountries(id);
        });
        countryRemiWrapper.change(function () {
            let curinnerText = "<option selected value=\"AUD\">AUD</option>";
            var curr = $('#ramirranceCountry').find(':selected').data('curr');
            curinnerText += "<option value='" + curr + "'>" + curr + "</option>";
            currencyRemiWrapper.html(curinnerText);
        });
        function loadRemiCountries(id) {
            countryRemiWrapper.html("<label class='label label-info'>Please wait...</label>");
            $.get("{{url('/rate/remitanceCountry')}}/" + id, function (e) {
                let res = e;
                let innerText = "";
                let curinnerText = "<option selected value=\"AUD\">AUD</option>";
                if ((res !== false) && (res.length > 0)) {
                    res.forEach(function (op, index) {
                        if (index === 0) {
                            innerText += "<option selected data-curr='" + op.currency + "' value='" + op.keyword + "'>" + op.name + "</option>";
                        } else {
                            innerText += "<option data-curr='" + op.currency + "' value='" + op.keyword + "'>" + op.name + "</option>";
                        }

                    });
                } else {
                    innerText = "No data found please contact with admin";
                    curinnerText = "No data found please contact with admin";
                }
                countryRemiWrapper.html(innerText);
                var curr = $('#ramirranceCountry').find(':selected').data('curr');
                curinnerText += "<option value='" + curr + "'>" + curr + "</option>";
                currencyRemiWrapper.html(curinnerText);
            });
        }

        /*let serviceRemitanceModeInput = $('#service_remittance');
        let modeWrapper = $('#transferMode');
        let currentModeService = serviceRemitanceModeInput.val();
        modeWrapper.html("<label class='label label-default'>Please select a select first</label>");
        loadMode(currentModeService);

        serviceRemitanceModeInput.change(function () {
            let id = $(this).val();
            loadMode(id);
        });
        function loadMode(id) {
            modeWrapper.html("<label class='label label-info'>Please wait...</label>");
            $.get("{{url('/rate/transferMode')}}/" + id, function (e) {
                let res = e;
                let innerText = "";

                if ((res !== false) && (res.length > 0)) {
                    res.forEach(function (op, index) {
                        if (index === 0) {
                            innerText += "<option selected value='" + op.keyword + "'>" + op.name + "</option>";
                        } else {
                            innerText += "<option value='" + op.keyword + "'>" + op.name + "</option>";
                        }

                    });
                } else {
                    innerText = "No data found please contact with admin";
                }
                modeWrapper.html(innerText);
            });
        }

        $(function() {
            $('#service_remittance').change(function(){
                if ($(this).find('option:selected').text() == "Bank Transfer" || $(this).find('option:selected').text() == "Cash Pickup")
                {
                    $('#transfer_mode').hide();
                }else
                {
                    $('#transfer_mode').show();
                }
            });
            if ($(this).find('option:selected').text() == "Bank Transfer" || $(this).find('option:selected').text() == "Cash Pickup")
            {
                $('#transfer_mode').show();
            }else
            {
                $('#transfer_mode').hide();
            }
        });*/
    </script>
@stop
