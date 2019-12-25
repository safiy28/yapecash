@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Account Reload: Bank</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="leftpan">
                <form method="POST" action="{{ url('/payment/bank/review')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="panel ammounts">
                        <h2>Select Bank</h2>
                        <div class="panelcontent">
                            <ul>
                            @foreach($banks as $index => $bank)
                                <li>

                                    <img src="{{$bank['logo']}}"  alt="" style="max-width: 161px;"/>


                                    <label for="operator-{{$index}}" class="purchase-label">
                                            <span class="detail-area">
                                                <p><strong>A/C No: {{$bank['account_no']}}</strong></p>
                                            </span>
                                    </label>
                                    <div class="bankarea radiogroup">
                                        <input required {{$index=== 0? 'checked':''}} type="radio" data-accountno="{{$bank['account_no']}}" value="{{$bank['id']}}.{{$bank['name']}}" id="operator-{{$index}}" name="bank" class="operators">

                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="panel ammount">
                        <h2>Deposited Amount</h2>
                        <div class="panelcontent">
                            <input type="number" required placeholder="Amount"
                                   name="amount">
                            <label for="" class="label label-info" id="curnt">MYR</label>
                        </div>
                    </div>

                    <div class="panel ammount">
                        <h2>Screenshot</h2>
                        <i style="font-size: 12px;padding-left: 8px">(Please upload a screenshot of your payment to our bank)</i>
                        <div class="panelcontent" style="padding-top: 7px;">
                            <input type="file" required name="slip">
                        </div>
                    </div>

                    <input type="hidden" value="{{$banks[0]['account_no']}}" name="account_no" class="hidden_account_no"/>
                    <input class="submitbtn" type="submit" value="Next">
                </form>
            </div>
@stop
@section('footer-script')
    <script>

        $('.operators').on('change', function () {
            var accountNo = $(this).data('accountno');
            $(".hidden_account_no").val(accountNo);
        });


    </script>
@stop
