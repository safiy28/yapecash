@extends('app')
@section('title')
    @include('modules.select_service')
@stop
@section('content')
    @include('errors.list')

    <form role="form" method="POST" action="{{ url('recipient/verify') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="leftpan">

            <div class="panel success">
                <i class="fa fa-check-circle-o fa-5x"></i>
                <strong>Congratulations</strong>, your action has been successfully generate.

                <div class="selectarea radiogroup">
                    <input type="hidden" name="country" value="{{$inputs['country']}}">
                    <input type="hidden" name="mode" value="{{$inputs['mode']}}">
                    <input type="hidden" name="amount" value="{{$inputs['amount']}}">
                    <input type="hidden" name="sender_mobile_number" value="{{$inputs['sender_mobile_number']}}">
                </div>

            </div>
            <input type="submit" value="Proceed" class="submitbtn">
        </div>
    </form>
@stop

@section('footer')
    <script>
        $('#myForm input').on('change', function () {
            var currency = $('input[name=country]:checked', '#myForm').data('currency');
            $('#curnt').html(currency);
        });
    </script>
@stop
