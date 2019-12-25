@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Tranglo Status Tracker</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>
            @include('errors.list')
            <div class="leftpan">
            <form action="{{ route('tranglo.status') }}"  method="get">
                <div class="panel">
                    <h2>Enter Transaction Number</h2>
                    <div class="panelcontent">
                        <input type="text"  name="gtn" required placeholder="Enter GTN">
                    </div>
                </div>
                <div class="panel">
                    <h2>Tranglo Available Balance</h2>
                    <div class="panelcontent">
                        <label>{{$result['balance']['LastBal']}} USD</label>
                    </div>
                </div>
                <input type="submit" value="submit" class="submitbtn">

            </form>
            </div>

@stop
