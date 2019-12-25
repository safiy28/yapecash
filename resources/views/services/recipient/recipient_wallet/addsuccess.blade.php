@extends('layout.inner-main')
@section('body-content')
    <h1 class="title-text">Service: {{session('service_name')}} (Review)</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>

    @include('errors.list')

    <form method="POST" action="{{ route('recipient.wallet.verify') }}">

        <div class="leftpan">

            <div class="panel success">
                <i class="fa fa-check-circle-o fa-5x"></i>
                <strong>Congratulations</strong>, your action has been successfully generate.

                <div class="selectarea radiogroup">
                    <input type="hidden" name="transfer_type" value="{{$inputs['transfer_type']}}">
                    <input type="hidden" name="amount" value="{{$inputs['amount']}}">
                    <input type="hidden" name="sender_mobile_number" value="{{$inputs['sender_mobile_number']}}">
                </div>

            </div>
            {{csrf_field()}}
            <input type="submit" value="Proceed" class="submitbtn">
        </div>
    </form>
@stop


