@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Service Menu</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>
            @if (session()->has('message'))
                <div class="service_alert success">
                    <div class="icon">
                        <div class="glyphicon glyphicon-ok-circle"></div>
                    </div>
                    <div class="massages">
                        <div class="alert-title">SUCCESS</div>
                        <div class="alert-body">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="services">

                <ul>
                    @foreach($services as $service)

                            <li><a href="{{url("/services/{$service['id']}")}}"><img src="{{$service['icon']}}" alt=""/><strong>{{$service['name']}}</strong></a></li>

                    @endforeach


                </ul>
            </div>

@stop
