@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Service Verify</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="leftpan">

                <input type="button" href="javascript:void(0)" onclick="window.history.back(-1)" value="BACK" class="submitbtn">
            </div>



@stop

