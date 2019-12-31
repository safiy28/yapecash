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
                        </div>
                    </div>

                    <div class="panel">
                        <h2>Sender Mobile No</h2>
                        <div class="panelcontent">
                            <input type="number" value="" id="sender_mobile_number"  name="sender_mobile_number" placeholder="Enter Sender Number" autocomplete="off"/>

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

        $('#curnt').html($(".hidden_currency").val());
        $('.operators').on('change', function () {
            var currency = $(this).data('currency');
            $('#curnt').html(currency);
            $(".hidden_currency").val(currency);
        });
        });


    </script>
@stop