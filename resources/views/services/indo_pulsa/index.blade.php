@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Service : {{session('service_name')}}</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>
    @include('errors.list')


    <form action="{{ route('indo.reload.review') }}"  method="post">
        <div class="leftpan">
            <div class="panel operator">
                <h2>Select Operator</h2>
                <div class="panelcontent">
                    <ul>
                        @foreach((array)$operators as $index => $operator)
                            <li>
                                <div class="selectarea radiogroup">
                                    <input {{ $index===0 ? 'checked' : '' }} name="operator" type="radio" value="{{ $operator['keyword'] }}" id="operator-{{ $index }}"
                                           required/>
                                </div>
                                <img  class="operator-logo" src="{{ $operator['logo'] }}" alt="{{ $operator['name'] }}"/>

                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            {{--<div class="panel ammount">
                <h2>Select Amount</h2>
                <div class="panelcontent">
                    <ul id="radio-option2">


                    </ul>
                </div>
            </div>--}}
            <div class="panel ammount">
                <h2>Select Amount</h2>
                <div class="panelcontent">
                    <ul id="radio-option2">
                        @foreach((array)$amounts as $index => $amount)
                            <li>
                                <div class="selectarea radiogroup">
                                    <input {{0 === $index? 'checked' : ''}} name="amount" type="radio" value="{{ $amount['amount'] }}" id="rate-{{ $index }}" required/>

                                </div>
                                {{$amount['amount']}}
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="panel">
                <h2>Receiver Mobile Number</h2>
                <div class="panelcontent">
                    <input type="number" required="" name="receiver_mobile_number" value="{{getCountryDialingCode('indonesia')}}" placeholder="Enter Receiver Number">
                </div>
            </div>
            {{ csrf_field() }}

            <input type="button" onclick="location.href='{{url('/services')}}';"value="BACK" class="submitbtn">
            <input type="submit" value="submit" class="submitbtn">
        </div>
    </form>



@stop

@section('footer-script')
    <script>

        /*$("#receiver_mobile_number").keydown(function(e) {
            var oldvalue=$(this).val();
            var field=this;
            setTimeout(function () {
                if(field.value.indexOf({{getCountryDialingCode('indonesia')}}) !== 0) {
                    $(field).val(oldvalue);
                }
            }, 1);
        });


        let operatorInput = $('input[name=operator]');
        let rateWrapper = $('#radio-option2');
        let current = operatorInput.val();

        rateWrapper.html("<label class='label label-default'>Please select an operator first</label>");
        loadPulsaRate(current);

        operatorInput.change(function () {
            let keyword = $(this).val();
            loadPulsaRate(keyword);
        });

        function loadPulsaRate($keyword) {
            rateWrapper.html("<label class='label label-info'>Please wait...</label>");
            var url = '{{ route("indo.package", ":keyword") }}';
            url = url.replace(':keyword', $keyword);
            $.get(url, function (e) {
                let res = e;
                let innerText = "";

                if ((res.data !== false) && (res.data.length > 0)) {
                    let data = res.data.sort(function (a, b) {
                        return a.pulsa_nominal - b.pulsa_nominal;
                    });

                    data.forEach(function (tm, index) {
                        innerText += "<li class='list-radio-item'><div class='selectarea radiogroup'>";
                        if (index === 0) {
                            innerText += "<input type='radio' checked id='rate-" + index + "' value='" + tm.pulsa_code + ":" + tm.pulsa_nominal + "' required name='amount'>";
                        } else {
                            innerText += "<input type='radio' id='rate-" + index + "' value='" + tm.pulsa_code + ":" + tm.pulsa_nominal + "' required name='amount'>";
                        }
                        innerText += "</div><label for='rate-" + index + "'>" + Number(tm.pulsa_nominal).toLocaleString() + " IDR</label>";
                        innerText += "</li>";
                    });
                } else {
                    innerText = "No data found please contact with admin";
                }
                rateWrapper.html(innerText);
            });
        }*/
    </script>
@stop
