@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">User</h2>
            <div class="service_body">
                <div class="row">
                    @if(Session::has('message'))
                        <div class="service_alert {{Session::get('type') == 'success' ? 'success' : 'danger'}}">
                            <div class="icon">
                                @if(Session::get('type') == 'success')
                                    <div class="glyphicon glyphicon-ok-circle"></div>
                                @else
                                    <div class="glyphicon glyphicon-ban-circle"></div>
                                @endif
                            </div>
                            <div class="massages">
                                <div class="alert-title">
                                    @if(Session::get('type') == 'success')
                                        Success
                                    @else
                                        Warning
                                    @endif
                                </div>
                                <div class="alert-body">
                                    <strong>{{Session::get('message')}}</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                  {{-- <div class="box-area">
                        <div class="box-btn red">
                            <a href="{!!url('/')!!}/user/search">New User</a>
                        </div>
                        <div class="box-btn green">
                            <a href="{{route('user.update')}}">Update User</a>
                        </div>
                       </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

