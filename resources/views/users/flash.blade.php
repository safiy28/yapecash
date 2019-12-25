@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Profile | {{session('name')}}</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>


    @include('errors.list')

    <div class="leftpan">
        @if(Session::has('message'))
            <div class="service_alert fsuccess">
                <div class="icon">
                        <div class="glyphicon glyphicon-ok-circle"></div>

                </div>
                <div class="massages">
                    <div class="alert-title">
                            Success

                    </div>
                    <div class="alert-body">
                        <strong>{{Session::get('message')}}</strong>
                    </div>
                </div>
            </div>
        @endif
    </div>

{{session::flush()}}
@stop
<script type="text/javascript">

    setTimeout(function () {
        window.location.href = "{{url('/login') }}"; //will redirect to your blog page (an ex: blog.html)
    }, 5000); //will call the function after 2 secs.
</script>