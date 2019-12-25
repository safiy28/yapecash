@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Account Reload</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            <div class="leftpan">
                @if (session()->has('message'))
                    <div class="service_alert success">
                        <div class="icon">
                            <div class="glyphicon glyphicon-ok-circle"></div>
                        </div>
                        <div class="massages">
                            <div class="alert-title">Success</div>
                            <div class="alert-body">
                                <strong>Congratulations</strong>, your action has been successfully generated.
                            </div>
                        </div>
                    </div>
                @endif

                <div class="panel purchase-box">
                    <h2>Select Payment Method</h2>
                    <div class="panelcontent">
                        <ul class="list-radio" id="radio-option">
                            @foreach($payments as $purchase)
                                <li class="list-radio-item imgsize">
                                    <a href="{!!url('purchase')!!}/{{$purchase['id']}}"><img src="{{$purchase['icon']}}" alt="{{$purchase['name']}}" height="83px"/></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>


@stop
