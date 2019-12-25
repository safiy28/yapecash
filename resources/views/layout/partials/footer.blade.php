<div class="area contact">
    <div class="copyright">All Rights Reserved &copy; 2018 YAPE CASH SDN BHD (1271635-M)</div>
    <ul>
        <li><a href="{{url('/terms')}}">Terms & Conditions</a></li>
        <li><a href="{{url('/privacy')}}">Privacy Policy</a></li>
        <li><a href="{{url('/contact')}}">Contact Us</a></li>
    </ul>
    <div class="adv"><strong>Consumer Advisory</strong> YAPE CASH SDN BHD (1271635-M) the holder of Yape Cash's stored value facility, does not require  the approval of the Monetary Authority of Singapore. Users are advised to read  the&nbsp;<a href="{!!url('/')!!}/terms">terms and conditions</a>&nbsp;carefully.</div>
    <div class="socila">
        <ul>
            <li><a href="https://www.facebook.com/MyCashMy/" target="_blank"><img src="images/facebook-logo-button.png" alt=""/></a></li>
            <li><a href="https://www.youtube.com/c/MyCashOnline" target="_blank"><img src="images/youtube-logotype.png" alt=""/></a></li>
        </ul>
    </div>
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/js/swiper.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/css/swiper.min.css">
<script>
    $('.mobile_nav_btn').click(function () {
        $('.header__top--nav').toggleClass('on');
    });
    $('#expire_date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3d',
        autoclose:true
    });
</script>
<script src="{{url('js/script.js')}}"></script>
<script>
    new WOW().init();

    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        height : 80,
        slidesPerView: 5,
        autoplay: {
            delay: 3000,
        },
        autoplayDisableOnInteraction: false,
        spaceBetween:40,
        breakpoints: {
            1024: {
                slidesPerView: 4,
            },
            768: {
                slidesPerView: 3,
            },
            640: {
                slidesPerView: 2,
            },
            320: {
                slidesPerView: 1,
            }
        }
    });



</script>

</body>
</html>
