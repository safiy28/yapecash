@include('layout.partials.login-page-header')
    <div class="loginarea">
    <div class="form">
        @if($errors->any())
            <div class="service_alert danger">
                <div class="massages">
                    <div class="alert-title">ERROR</div>
                    <div class="alert-body">
                        @foreach($errors->all() as $error)
                            <p> {{$error}}</p>
                        @endforeach
                    </div>
                </div>
            </div>

        @endif

        @if(Session::has('message'))
            <div class="service_alert danger">
                <div class="icon">
                    <div class="glyphicon glyphicon-ban-circle"></div>
                </div>
                <div class="massages">
                    <div class="alert-title">Error</div>
                    <div class="alert-body">
                        {{Session::get('message')}}
                    </div>
                </div>
            </div>
        @endif

        <ul class="tab-group">
            <li class="tab"><a href="#login">Log in</a></li>
            <li class="tab active"><a href="#signup">Sign Up</a></li>
        </ul>
        <div class="tab-content">
            <div id="login">
                <form id="login" action="{{url('/login')}}" method="post">
                    {{csrf_field()}}
                    <div class="field-wrap">
                        <label>Your Phone Number<span class="req">*</span>
                        </label>
                        <input id="mobile_number" autofocus="autofocus" value="" required type="number" name="mobile_number" autocomplete="off"/>
                    </div>
                    <div class="field-wrap">
                        <label>Your Password<span class="req">*</span> </label>
                        <input required type="password" name="password" autocomplete="off"/>
                    </div>

                    <button type="submit" class="button button-block"/>
                    Login
                    </button>
                    <strong>Forgot Password? Call us at +601126156616</strong>
                </form>
            </div>
            <div id="signup">
                <form id="registration" action="{{route('user.information')}}" method="post">
                    {{csrf_field()}}
                    <div class="field-wrap">
                        <label> Mobile number<span class="req">*</span> </label>
                        <input id="mobile_number_reg" type="number" required readonly name="mobile_number"
                               value="{{ $result['mobile_number'] ?? old('mobile_number') ?? session()->get('mobile_number')}}"
                               placeholder="Enter mobile number"/>
                    </div>
                    <div class="field-wrap">
                        <label>Name<span class="req">*</span> </label>
                        <input autofocus="autofocus" type="text" name="name" required placeholder="Name" class="form-control" value="{{$oldData['name'] ?? old('name')}}"/>
                    </div>
                    <div class="field-wrap">
                        <label id="id_type_heading"> Passport/IC/Business reg no.<span class="req">*</span> </label>
                        <input type="text" required name="id_no" placeholder="Id Number" class="form-control" value="{{$oldData['id_no'] ?? old('id_no')}}"/>
                    </div>
                    <div class="field-wrap" id="exp_area">
                        <label> Expire date<span class="req">*</span> </label>
                        <input type="text" id='expire_date' class="form-control" name="expire_date" placeholder="Expire date"
                               value="{{$oldData['expire_date'] ?? old('expire_date')}}"/>
                    </div>

                    <div class="field-wrap" id="exp_area">
                        <label> Date of birth<span class="req">*</span> </label>
                        <input type="text" id='dob' class="form-control" name="date_of_birth" placeholder="Date of birth"
                               value="{{$oldData['date_of_birth'] ?? old('date_of_birth')}}"/>
                    </div>

                    <button class="button button-block"/>
                    Submit
                    </button>
                    <strong>Forgot Password? Call us at +601126156616</strong>
                </form>
            </div>
        </div>
    </div>
    <div class="subtext">
        <a href="https://www.facebook.com/yapecash/" target="_blank"><img src="images/Capa 1-2.png" width="58" height="57" alt=""/></a>
        <a href="https://api.whatsapp.com/send?phone=60168111139" target="_blank"><img src="images/Capa 1.png" width="58" height="57" alt=""/></a>
        <a href="#" target="_blank"><img src="images/Capa 1-1.png" width="58" height="57" alt=""/></a>
    </div>
</div>


<script>

    $('.form').find('input, textarea').on('keyup blur focus', function (e) {

        var $this = $(this),
            label = $this.prev('label');

        if (e.type === 'keyup') {
            if ($this.val() === '') {
                label.removeClass('active highlight');
            } else {
                label.addClass('active highlight');
            }
        } else if (e.type === 'blur') {
            if( $this.val() === '' ) {
                label.removeClass('active highlight');
            } else {
                label.removeClass('highlight');
            }
        } else if (e.type === 'focus') {

            if( $this.val() === '' ) {
                label.removeClass('highlight');
            }
            else if( $this.val() !== '' ) {
                label.addClass('highlight');
            }
        }

    });
    $(function() {
        var target =  $('.tab.active a').attr('href');
        $('.tab-content > div').not(target).hide();
        $(target).fadeIn(600);
    });
    $('.tab a').on('click', function (e) {

        e.preventDefault();

        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');

        target = $(this).attr('href');

        $('.tab-content > div').not(target).hide();

        $(target).fadeIn(600);

    });

    $('#expire_date').datepicker({
        dateFormat: 'yy-mm-dd',
        startDate: '-3d',
        autoclose:true,
        minDate: 0
    });

    $('#dob').datepicker({
        dateFormat: 'yy-mm-dd',
        startDate: '-3d',
        autoclose:true
    });

</script>
