@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Service : {{session('service_name')}}</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>
            @include('errors.list')

            <form action="{{ route('nepal.reload.review') }}"  method="post">
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
                    <div class="panel ammount">
                        <h2>Select Amount</h2>
                        <div class="panelcontent">
                            <ul id="radio-option2">
                                @foreach((array)$amounts as $index => $amount)
                                    <li>
                                        <div class="selectarea radiogroup">
                                            <input {{0 === $index? 'checked' : ''}} name="amount" type="radio" value="{{ $amount['amount'] }}" id="rate-{{ $index }}" required/>

                                        </div>
                                        NPR {{$amount['amount']}}
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="panel">
                        <h2>Receiver Mobile Number</h2>
                        <div class="panelcontent">
                            <input type="number" required="" name="receiver_mobile_number" value="{{getCountryDialingCode('nepal')}}" placeholder="Enter Receiver Number">
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
        $("#receiver_mobile_number").keydown(function(e) {
            var oldvalue=$(this).val();
            var field=this;
            setTimeout(function () {
                if(field.value.indexOf({{getCountryDialingCode('nepal')}}) !== 0) {
                    $(field).val(oldvalue);
                }
            }, 1);
        });
    </script>
@stop
