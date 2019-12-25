@extends('layout.inner-main')
@section('body-content')
            <h1 class="title-text">Service : {{session('service_name')}}</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')


            <form action="{{ url('point_transfer/review') }}"  method="post" class="col-md-8 col-md-offset-2">
                <div class="leftpan">
                    <div class="panel">
                        <h2>Amount</h2>
                        <div class="panelcontent">
                            <input name="amount" type="number" required placeholder="Enter Amount">
                            <label for="" class="label-info label">Points</label>
                        </div>
                    </div>

                    <div class="panel">
                        <h2>Receiver Mobile Number</h2>
                        <div class="panelcontent">
                            <input type="number" autofocus="autofocus" value="" required="" id="receiver_mobile_number" name="receiver_mobile_number" placeholder="Enter Receiver Number" autocomplete="off"/>
                            <label for="" class="label label-default"></label>
                        </div>
                    </div>
                    {{ csrf_field() }}

                    <input type="button" onclick="location.href='{{url('/services')}}';"value="BACK" class="submitbtn">
                    <input type="submit" value="submit" class="submitbtn">
                </div>
            </form>

@stop

@section('footer-script')

@stop