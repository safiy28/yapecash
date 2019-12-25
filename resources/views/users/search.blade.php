@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">User Registration</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>


            @include('errors.list')

            <div class="leftpan">
                <div class="row">
                    @if($result)
                        @if($result['user_found'])
                            <div class="service_alert danger">
                                <div class="icon">
                                    <div class="glyphicon glyphicon-remove-circle"></div>
                                </div>
                                <div class="massages">
                                    <div class="alert-title">Sorry</div>
                                    <div class="alert-body">
                                        User already exist with this number. Please try with another number. TQ
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-action btn-lg btn-danger" href="{{url('/user/search')}}">Back</a>
                        @else
                            <div class="service_alert success">
                                <div class="icon">
                                    <div class="glyphicon glyphicon-ok-circle"></div>
                                </div>
                                <div class="massages">
                                    <div class="alert-title">Success</div>
                                    <div class="alert-body">
                                        <strong>Congratulations</strong> You Can Register Now click Next.
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-action btn-lg btn-success" href={{route('user.register')}}>Next</a>
                        @endif
                    @else
                        <form class="col-md-12" action="{{route('user-search')}}" method="post">
                            {{csrf_field()}}
                            <div class="panel">
                                <h2>Insert Mobile Number</h2>
                                <div class="panelcontent">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="number" id="mobile_number" class="form-control" value="" autofocus="autofocus" required name="mobile_number"
                                                   autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit"  value="Submit" class="submitbtn">
                        </form>
                    @endif
                </div>
                </form>
            </div>
            <script>

            </script>

@stop


