@include('layout.partials.page-header')
<style>
    .btn-area {
        margin-left: 9px;
    }

    </style>
<div class="area header header-sabah">
    <div class="wrapper">
        <div class="logo"><img src="images/yape-logo-big.png" class="wow fadeInDown" alt=""/></div>
        @if(session()->has('mobile_number'))
            <div class="btn-area"><a href="{{ route('services') }}">Dashboard</a></div>
        @else
            <div class="btn-area"><a href="{{ route('login') }}">Login </a></div>
            <div class="btn-area"><a href="{{ route('registration') }}">SignUp</a></div>
        @endif
    </div>
</div>
<div class="area aboutus bpb bspace">
    <div class="wrapper">
        <div class="one-third">
            <h2 class="wow fadeInDown">What is Yape Cash</h2>
            <p>Yape Cash is a Tylor made online store for the migrants. We are committed to full fill all of their needs in 3 easy steps. Be that Bus Tickets, Air Tickets, Mobile Top up, International reload, bill payment or Mobile Remittance, we provide all this services in our marketplace.</p>
            <p>&nbsp;</p>
            <img src="images/video-thumb.jpg" alt=""/> </div>

        <div class="why">
            <ul>
                <li class="wow fadeInUp">
                    <h3>Easy</h3>
                    All of our services are individually screened & customized for optimal quality. Our customers will able to full fill their needs within minutes from the comfort of their home. </li>
                <li class="wow fadeInUp">
                    <h3>Secure</h3>
                    To ensure the best possible security, we use dedicated server hosted in the best data centre of Kuala Lumpur. Our server is monitored 24X7 for the best optimal performance.</li>
                <li class="wow fadeInUp">
                    <h3>Accurate</h3>
                    We want to provide accurate services to our customers. As they are very much sensitive about the rates and service charges, we try our best to provides the best possible exchange rate for any of our services with a small convenience fees.</li>
                <li class="wow fadeInUp">
                    <h3>Convenient</h3>
                    We bring convenience to our user’s fingertips. They can access our services 24x7 using our website, WAP and Mobile App from anywhere.</li>
            </ul>
        </div>
    </div>
</div>
<div class="area services bpb">
    <div class="wrapper">
        <h2 class="wow fadeInDown">Our Services</h2>

        <div>
            <figure class="snip1194 wow fadeInUp">
                <div class="box-cover s-1">Mobile<br>
                    Top-Up</div>
                <figcaption>
                    <p>Using Yape Cash now you can reload any mobile phone in Bangladesh, Nepal, Indonesia & Myanmar.</p>
                </figcaption>
                <a href="#"></a> </figure>
            <figure class="snip1194 wow fadeInUp" data-wow-delay="0.2s">
                <div class="box-cover s-2">Bill<br>
                    Payment</div>
                <figcaption>
                    <p>Using Yape Cashe now you can reload any mobile phone in Bangladesh, Nepal, Indonesia & Myanmar.</p>
                </figcaption>
                <a href="#"></a> </figure>
            <figure class="snip1194 wow fadeInUp" data-wow-delay="0.4s">
                <div class="box-cover s-3">Gift<br>
                    Voucher</div>
                <figcaption>
                    <p>Using Yape Cash now you can reload any mobile phone in Bangladesh, Nepal, Indonesia & Myanmar.</p>
                </figcaption>
                <a href="#"></a> </figure>
            <figure class="snip1194 wow fadeInUp">
                <div class="box-cover s-4">Bus<br>
                    Ticket</div>
                <figcaption>
                    <p>Using Yape Cash now you can reload any mobile phone in Bangladesh, Nepal, Indonesia & Myanmar.</p>
                </figcaption>
                <a href="#"></a> </figure>
            <figure class="snip1194 wow fadeInUp" data-wow-delay="0.2s">
                <div class="box-cover s-5">Air<br>
                    Ticket</div>
                <figcaption>
                    <p>Using Yape Cash now you can reload any mobile phone in Bangladesh, Nepal, Indonesia & Myanmar.</p>
                </figcaption>
                <a href="#"></a> </figure>
            <figure class="snip1194 wow fadeInUp" data-wow-delay="0.4s">
                <div class="box-cover s-6">Mobile<br>
                    Remittance</div>
                <figcaption>
                    <p>Using Yape Cash now you can reload any mobile phone in Bangladesh, Nepal, Indonesia & Myanmar.</p>
                </figcaption>
                <a href="#"></a> </figure>
        </div>
    </div>
</div>
<div class="area app-download">
    <div class="wrapper">
        <div class="apptext">
            <h2 class="wow fadeInDown">Use Yape Cash<br>
                Anywhere. Anytime.</h2>
            <div class="appbtn"> <a href="#" class="wow fadeInUp"><img src="images/google-play-btn.png" alt=""/></a></div>
        </div>

    </div>
</div>
{{--<div class="area seen bpb">
    <div class="wrapper">
        <h2 class="wow fadeInDown">As Featured On</h2>
        <br><br>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($brands as $brand)
                    @if($brand['type']=="partners")
                        <div class="swiper-slide">
                            <a href="{{$brand['link']}}" target="_blank">
                                <img src="{{$brand['logo']}}" alt=""/></a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>--}}
@include('layout.partials.footer')

