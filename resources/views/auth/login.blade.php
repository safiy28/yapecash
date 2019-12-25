@include('layout.partials.login-page-header')
<div class="loginarea">
    <div class="form">
        @if($errors->any())

            <div class="service_alert danger">
                <div class="icon">
                    <div class="glyphicon glyphicon-remove-circle"></div>
                </div>
                <div class="massages">
                    <div class="alert-title">Sorry</div>
                    <div class="alert-body">
                        @foreach($errors->all() as $error)
                            <p> {{$error}}</p>
                        @endforeach
                    </div>
                </div>
            </div>

        @endif

        @if(Session::has('registration-message'))
            <div class="service_alert success">
                <div class="icon">
                    <div class="glyphicon glyphicon-ok-circle"></div>
                </div>
                <div class="massages">
                    <div class="alert-title">Registration Successful!</div>
                    <div class="alert-body">
                        Please check your SMS inbox to get password.
                    </div>
                </div>
            </div>

        @endif

        <ul class="tab-group">
            <li class="tab active"><a href="#login">Log in</a></li>
            <li class="tab"><a href="#signup">Sign Up</a></li>
        </ul>
        <div class="tab-content">
            <div id="login">
                <form action="{{url('/login')}}" method="post">
                    {{csrf_field()}}
                    <div class="field-wrap">
                        <label>Your Phone Number<span class="req">*</span>
                        </label>
                        <input autofocus="autofocus" id="mobile_number" value="" required type="number" name="mobile_number" autocomplete="off"/>
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
                <form action="{{route('user.search')}}" method="post">
                    {{csrf_field()}}
                    <div class="field-wrap">
                        <label> Insert mobile number<span class="req">*</span> </label>
                        <input  id="mobile_number_reg" autofocus="autofocus" type="text" required name="mobile_number" value=""
                               placeholder="Enter mobile number" autocomplete="off"/>
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

    $('.tab a').on('click', function (e) {

        e.preventDefault();

        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');

        target = $(this).attr('href');

        $('.tab-content > div').not(target).hide();

        $(target).fadeIn(600);

    });
    $(".service_alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".service_alert").slideUp(1500);
    });
</script>