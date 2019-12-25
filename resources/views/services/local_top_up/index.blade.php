@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service: {{session('service_name')}}</h2>
            <div class="service_body">
                <form action="{{ url('top_up/review') }}" method="post">
                    <div class="service_panel panel panel-default">
                        <div class="panel-heading">Select Operator</div>
                        <div class="panel-body">
                            <ul class="list-radio" id="radio-option">
                                @foreach($operators as $index => $operator)
                                    <li class="list-radio-item">
                                        <input {{$index===0?'checked':''}}
                                               type="radio" value="{{$operator['keyword']}}"
                                               id="operator-{{$index}}" required name="operator" class="operators">

                                        <label for="operator-{{$index}}">{{$operator['name']}}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Amount</div>
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <input type="number" name="amount" required
                                               placeholder="Amount" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="service_panel panel panel-default">
                                <div class="panel-heading">Receiver Mobile No</div>
                                <div class="panel-body">
                                    <div class="form-group clearfix">
                                        <input type="text" placeholder="Receiver Mobile No" class="form-control" name="receiver_mobile_number">
                                        <label for="" class="label label-default">83987569</label>
                                    </div>
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

@section('footer-script')
    <script type="text/javascript">
    @if(session('service_code')=="indo_pulsa")
        var rateWrapper = $('#radio-option2');
        rateWrapper.html("<label class='label label-default'>Please select an operator first</label>");
        var current = $('input[name=operator]').val();
        loadPulsaRate(current);
        $('input[name=operator]').change(function () {
            var keyword = $(this).val();
            loadPulsaRate(keyword);
        });

        function loadPulsaRate($keyword) {
            rateWrapper.html("<label class='label label-info'>Please wait ...... </label>");
            $.get("{{url('/pulsa/package')}}/" + $keyword, function (e) {
                var res = e;
                var innerText = "";
                if ((res.data != false) && (res.data.length > 0)) {
                    var data = res.data.sort(function (a, b) {
                        return a.pulsa_nominal - b.pulsa_nominal;
                    });
                    data.forEach(function (tm, index) {
                        innerText += "<li class='list-radio-item'>";
                        if (index == 0) {
                            innerText += "<input type='radio' checked id='rate-" + index + "' value='" + tm.pulsa_code + ":" + tm.pulsa_nominal + "' required name='amount'>";
                        } else {
                            innerText += "<input type='radio' id='rate-" + index + "' value='" + tm.pulsa_code + ":" + tm.pulsa_nominal + "' required name='amount'>";
                        }
                        innerText += "<label for='rate-" + index + "'>" + Number(tm.pulsa_nominal).toLocaleString() + " IDR</label>";
                        innerText += "</li>";
                    });
                } else {
                    innerText = "No data found please contact with admin";
                }
                rateWrapper.html(innerText);
            });
        }

    @else
        var operators = $('.operators');

        operators.change(function () {
            var keyword = $(this).val();
            $.get("{{url('/')}}/operator-rates?keyword=" + keyword, function (data) {
                var rateList = $('.package_list');

                rateList.empty();
                $.each(data, function (index, value) {
                    var checked = "";
                    if (index === 0) {
                        checked = "checked";
                    }

                    rateList.append(
                        "<li class='list-radio-item'> " +
                        "<input " + checked + " type=\"radio\" id='rate-" + index + "' " +
                        "value=\"" + value + "\" required name=\"amount\"> " +
                        "<label for='rate-" + index + "'>RM " + value + "</label>" +
                        " </li>"
                    );
                });
            });

        });
    @endif
    </script>
@stop
