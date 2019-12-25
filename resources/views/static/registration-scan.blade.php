@include('layout.partials.login-page-header')
<style>
    #signup>form input, textarea,select{
        font-size: 14px;
    }
    .service_alert{
        width: 615px !important;
        max-width: 616px !important;
    }
    /* Smartphones (portrait and landscape) ----------- */
    @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    /* Smartphones (landscape) ----------- */
    @media only screen and (min-width : 321px) {
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    /* Smartphones (portrait) ----------- */
    @media only screen and (max-width : 320px) {
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    /* iPads (portrait and landscape) ----------- */
    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
        /* Styles */
        .form{
            max-width: 616px !important;
        }
    }

    /* iPads (landscape) ----------- */
    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
        /* Styles */
        .form{
            max-width: 616px !important;
        }
    }

    /* iPads (portrait) ----------- */
    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) {
        /* Styles */
        .form{
            max-width: 616px !important;
        }
    }
    /**********
    iPad 3
    **********/
    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio : 2) {
        /* Styles */
        .form{
            max-width: 616px !important;
        }
    }

    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio : 2) {
        /* Styles */
        .form{
            max-width: 616px !important;
        }
    }
    /* Desktops and laptops ----------- */
    @media only screen  and (min-width : 1224px) {
        /* Styles */
        .form{
            max-width: 616px !important;
        }
    }

    /* Large screens ----------- */
    @media only screen  and (min-width : 1824px) {
        /* Styles */
        .form{
            max-width: 616px !important;
        }
    }

    /* iPhone 4 ----------- */
    @media only screen and (min-device-width : 320px) and (max-device-width : 480px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio : 2) {
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    @media only screen and (min-device-width : 320px) and (max-device-width : 480px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio : 2) {
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    /* iPhone 5 ----------- */
    @media only screen and (min-device-width: 320px) and (max-device-height: 568px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 2){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    @media only screen and (min-device-width: 320px) and (max-device-height: 568px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 2){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    /* iPhone 6 ----------- */
    @media only screen and (min-device-width: 375px) and (max-device-height: 667px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 2){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    @media only screen and (min-device-width: 375px) and (max-device-height: 667px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 2){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    /* iPhone 6+ ----------- */
    @media only screen and (min-device-width: 414px) and (max-device-height: 736px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 2){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    @media only screen and (min-device-width: 414px) and (max-device-height: 736px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 2){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    /* Samsung Galaxy S3 ----------- */
    @media only screen and (min-device-width: 320px) and (max-device-height: 640px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 2){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    @media only screen and (min-device-width: 320px) and (max-device-height: 640px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 2){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    /* Samsung Galaxy S4 ----------- */
    @media only screen and (min-device-width: 320px) and (max-device-height: 640px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 3){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    @media only screen and (min-device-width: 320px) and (max-device-height: 640px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 3){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    /* Samsung Galaxy S5 ----------- */
    @media only screen and (min-device-width: 360px) and (max-device-height: 640px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 3){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }

    @media only screen and (min-device-width: 360px) and (max-device-height: 640px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 3){
        /* Styles */
        .form{
            max-width: 400px !important;
        }
    }


</style>
<div class="loginarea">
    <div class="form">
        @if($errors->any())
            <div class="service_alert danger">
                <div class="massages">
                    <div class="alert-title">ERROR</div>
                    <div class="alert-body">
                        @foreach($errors->all() as $error => $value)
                            <p> {{strstr(preg_replace('/[^a-zA-Z0-9_ -]/s','',$value)," ")}}</p>
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
                <form action="{{url('/login')}}" method="post">
                    <div class="field-wrap">
                        <label>Your Phone Number<span class="req">*</span>
                        </label>
                        <input autofocus="autofocus" id="mobile_number" required type="number" name="mobile_number" value="{{getCountryDialingCode('australia')}}" autocomplete="off"/>
                    </div>
                    <div class="field-wrap">
                        <label>Your Password<span class="req">*</span> </label>
                        <input required type="password" name="password" autocomplete="off"/>
                    </div>

                    <button type="submit" class="button button-block"/>
                    Login
                    </button>
                    <strong>Forgot Password? WhatsApp Us <a href="https://api.whatsapp.com/send?phone=6583987569" target="_blank">+6583987569</a></strong>
                </form>
            </div>
            <div id="signup">
                <form action="{{route('registration.submission')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="mobile_number" value="{{$new_user['mobile'] ?? $oldData['mobile_number']}}">
                    <input type="hidden" name="user_name" value="{{$new_user['name'] ?? $oldData['name']}}">
                    <input type="hidden" name="fname" value="{{$new_user['fname']}}">
                    <input type="hidden" name="lname" value="{{$new_user['lname']}}">
                    <input type="hidden" name="id_no" value="{{$new_user['id_no'] ?? $oldData['id_no']}}">
                    @if($new_user['id_expire_date'])
                    <input type="hidden" name="expire_date" value="{{$new_user['id_expire_date'] ?? $oldData['id_expire_date']}}">
                    @endif
                    <input type="hidden" name="id_type" value="{{$new_user['id_type'] ?? $oldData['id_type']}}">

                    <div class="section group">
                        <div class="col span_1_of_2">
                        <div class="field-wrap">
                            <label> Mobile No: {{$new_user['mobile'] ?? $oldData['mobile_number']}} </label>
                        </div>
                        <div class="field-wrap">
                            <label> Name: {{$new_user['name'] ?? $oldData['user_name']}} </label>
                        </div>
                        </div>
                        <div class="col span_1_of_2">
                        <div class="field-wrap">
                            <label>Id. No: {{$new_user['id_no'] ?? $oldData['id_no']}} </label>
                        </div>
                        @if($new_user['id_expire_date'])
                        <div class="field-wrap">
                            <label> Expire Date: {{$new_user['id_expire_date'] ?? $oldData['id_expire_date']}} </label>
                        </div>
                        @endif
                        </div>
                    </div>

                    <div class="section group">
                        <div class="col span_1_of_2">
                            <div class="field-wrap">
                                <label>Present Address<span class="req">*</span> </label>
                                <textarea autofocus="autofocus" required rows="5" cols="20" class="form-control" required name="address" placeholder="Enter address"> {{$oldData['address'] ?? old('address')}}</textarea>
                            </div>
                            <div class="field-wrap">
                                <label> Post Code<span class="req">*</span> </label>
                                <input type="text" class="form-control" required name="post_code" value="{{$oldData['post_code'] ?? old('post_code')}}" placeholder="Enter Postcode">
                            </div>

                            <div class="field-wrap">
                                <label> Occupation<span class="req">*</span> </label>
                                <input type="text" class="form-control" required name="occupation" value="{{$oldData['occupation'] ?? old('occupation')}}" placeholder="Enter occupation">
                            </div>
                            <div class="field-wrap">
                                <label> Date of Birth<span class="req">*</span> </label>
                                <input type="text" id="birth_date" class="form-control" required name="date_of_birth" value="{{$oldData['date_of_birth'] ?? old('date_of_birth')}}" placeholder="Date of Birth">
                            </div>
                            <div class="field-wrap">
                                <label> Gender<span class="req">*</span> </label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col span_1_of_2">
                            <div class="field-wrap">
                                <label> Nationality<span class="req">*</span> </label>
                                <input type="text" class="form-control" required name="country" value="{{$oldData['country'] ?? old('country')}}" placeholder="Enter country">
                            </div>
                            <div class="field-wrap">
                                <label> Marital Status<span class="req">*</span> </label>
                                <select id="marrital_status" name="marrital_status" class="form-control" required>
                                    <option value="">Select Marital Status</option>
                                    <option value="married">Married</option>
                                    <option value="unmarried">Unmarried</option>
                                    <option value="divorced">Divorced</option>
                                </select>
                            </div>
                            <div class="field-wrap">
                                <label> Upload Profile Photo<span class="req">*</span> </label>
                                <input required type="file" class="" name="profile_photo" accept="image/*">                        </div>
                            <div class="field-wrap">
                                <label> Upload User ID 1<span class="req">*</span> </label>
                                <input required type="file" class="" name="scan" accept="image/*">
                            </div>
                            <div class="field-wrap">
                                <label> Upload User ID 2 </label>
                                <input type="file" class="" name="scan_one" accept="image/*">
                            </div>
                            <div class="field-wrap">
                                <label> Upload UserID 3</label>
                                <input type="file" class="" name="scan_two" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                    <div id="row">
                        <button class="button button-block"/>
                        Submit
                        </button>
                    </div>
                    <strong>Forgot Password? WhatsApp Us <a href="https://api.whatsapp.com/send?phone=61433772566" target="_blank">+61433772566</a></strong>
                </form>
            </div>
        </div>
    </div>
    <div class="subtext">

        <a href="https://www.facebook.com/mycashsg/" target="_blank"><img src="images/Capa 1-2.png" width="58" height="57"
                                                                          alt=""/></a>
        <a href="https://api.whatsapp.com/send?phone=6583987569" target="_blank"><img src="images/Capa 1.png" width="58"
                                                                                       height="57" alt=""/></a>
        <a href="https://www.youtube.com/c/MyCashOnline" target="_blank"><img src="images/Capa 1-1.png" width="58"
                                                                              height="57" alt=""/></a></div>
</div>

<div class="infoarea">
    <div class="mycashinfo">
        <div class="inside"><img src="images/logo-white.png" width="246" height="122" alt=""/>
            <p> MyCash Online is a Reliable, Secure & Convenient online marketplace for the unbanked migrants to purchase products & services online without any bank account or credit card. Using MyCash Platform migrant workers can top up their mobile phone, pay utility bills, purchase ecommerce products, bus ticket, air ticket, gift voucher. </p>

        </div>
    </div>
    <div class="othersite">
        <div class="inside">
            <ul>
                <li><a href="https://mycashmy.com/" target="_blank"><img src="images/logo-small.png" width="160" height="71"
                                                                         alt=""/><strong>Malaysia</strong></a></li>
                <li><a href="https://mycashsg.com/"><img src="images/logo-small.png" width="160" height="71"
                                                         alt=""/><strong>Singapore</strong></a></li>
                <li class="yap"><a href="http://yapecash.com/" target="_blank"><img src="images/logo-yap.png" width="51"
                                                                                    height="58" alt=""/><strong>Yape
                            Cash</strong></a></li>
                <li><a href="http://mycashau.com/" target="_blank"><img src="images/logo-small.png" width="160" height="71"
                                                                        alt=""/><strong>Australia</strong></a></li>
            </ul>
        </div>
    </div>
</div>

<script>
    var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
        isMobile = true;
    }

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
        if(target !="#login" && !isMobile){
            $('.form').css('width', '616', 'important');
            $('.form').css('margin-top', '65px', 'important');
        }
        $('.tab-content > div').not(target).hide();
        $(target).fadeIn(600);
    });
    $("#mobile_number").keydown(function(e) {
        var oldvalue=$(this).val();
        var field=this;
        var $this = $(this);
        setTimeout(function () {
            if(field.value.indexOf({{getCountryDialingCode('australia')}}) !== 0) {
                $(field).val(oldvalue);
            }

            if($this.val().length>11){
                $this.val($this.val().substring(0,11))
            }
        }, 1);
    });
    $('.tab a').on('click', function (e) {

        e.preventDefault();

        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');

        target = $(this).attr('href');
        if(!isMobile){
            if(target =="#login"){
                $('.form').css('width', '400', 'important');
                $(".form").css({ 'margin-top' : ''});
            }
            else{
                $('.form').css('width', '616', 'important');
                $('.form').css('margin-top', '65px', 'important');
            }
        }

        $('.tab-content > div').not(target).hide();

        $(target).fadeIn(600);

    });
    $(".service_alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".service_alert").slideUp(1500);
    });

    $('#birth_date').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose:true
    });
</script>
