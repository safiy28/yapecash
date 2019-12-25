@extends('static')
@section('content')
    <div class="section banner">
        <ul class="slidebanner">
            <li><img src="{!!url('/')!!}/images/banner-bd.jpg" alt=""/</li>
            <li><img src="{!!url('/')!!}/images/banner-my.jpg" alt=""/</li>
            <li><img src="{!!url('/')!!}/images/banner-sg.jpg" alt=""/</li>
            <li><img src="{!!url('/')!!}/images/banner-id.jpg" alt=""/</li>
            <li><img src="{!!url('/')!!}/images/banner-np.jpg" alt=""/</li>
            <li><img src="{!!url('/')!!}/images/banner-mm.jpg" alt=""/</li>
        </ul>
    </div>
    <div class="section steparea">
        <div class="wapper">
            <h2>MyCash Online: e-Marketplace for Migrants!</h2>
            <h3>My Cash Online provides end to end online services in 3 easy steps. Be that Bus Ticket, Air Ticket,
                Mobile Top up, International reload or bill payment, we provide you all of these services online and
                also ensure an easy, secure, accurate and convenient service delivery.</h3>
            <div class="steps">
                <ul class="bxslider">
                    <li>
                        <div class="stepincon"><img src="{!!url('/')!!}/images/step-1.png" alt=""/></div>
                        <strong>Step 1</strong>Choose & fill up your order.
                    </li>
                    <li>
                        <div class="stepincon"><img src="{!!url('/')!!}/images/step-2.png" alt=""/></div>
                        <strong>Step 2</strong>Review & confirm your order.
                    </li>
                    <li>
                        <div class="stepincon"><img src="{!!url('/')!!}/images/step-3.png" alt=""/></div>
                        <strong>Step 3</strong>Instant service delivery confirmation.
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section servicearea">
        <div class="wapper">
            <div>
                <h2>Our Services</h2>
                <h3>MyCash Online: e-Marketplace for Migrants. Our services includes:</h3>
            </div>
            <div class="flip-container">
                <div class="front-side"><span></span>International Mobile Top-Up</div>
                <div class="back-side">
                    <p>Using MyCash Online now you can reload any mobile phone in Bangladesh, Nepal, Indonesia &
                        Myanmar.</p>
                </div>
            </div>
            <div class="flip-container">
                <div class="front-side"><span></span>Malaysian Mobile Top-Up</div>
                <div class="back-side">
                    <p>Now we provide a simple and easy way to top-up your Malaysian mobile phone in just a minute using
                        our online service.</p>
                </div>
            </div>
            <div class="flip-container">
                <div class="front-side"><span></span>Bus Ticket Online</div>
                <div class="back-side">
                    <p>Need to buy bus tickets? Just use our online bus ticket booking service and buy tickets instantly
                        for any destination in Malaysia.</p>
                </div>
            </div>
            <div class="flip-container">
                <div class="front-side"><span></span>Malaysian Bill Payment</div>
                <div class="back-side">
                    <p>Now you can pay your TNB Bill, TM Internet Bill, ASTRO bill or even any post-paid mobile bill
                        using our platform.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="section whyarea">
        <div class="wapper">
            <div class="latest-news">
                <h2>Latest News</h2>
                <a href="{{$latestNews['link']}}" target="_blank"><img src="{{$latestNews['img']}}" alt=""/>
                    <h3> {{$latestNews['title']}} </h3>
                    {{$latestNews['description']}}
                </a>
            </div>
            <div class="newsarea">
                <h2>News & Events</h2>
                <ul>
                    @foreach($newsevents['data'] as $newsevent)
                        <li><a href="{{$newsevent['link']}}" target="_blank"><img src="{{$newsevent['img']}}" alt=""/>
                                <h3>{{$newsevent['title']}}</h3>
                                {{ str_limit($newsevent['description'], $limit = 90, $end = '...') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <ul class="paging">
                    <?php $page_number = $newsevents['last_page'];  ?>
                    @for( $i = 1; $i<=$page_number; $i++ )
                        <a href="{{url('/')}}?page={{$i}}"
                           class="page {{$newsevents['current_page']==$i?"active":"gradient"}}">{{$i}}</a>
                @endfor
                <!-- <a href="{{url('/')}}?page=" class="page">&raquo;</a> -->

                </ul>
            </div>
        </div>
    </div>
    <div class="section threecol">
        <div class="wapper">
            <div class="partners">
                <h3>Partners</h3>
                <ul>
                    @foreach($brands as $brand)
                        @if($brand['type']=="partners")
                            <li><a href="{{$brand['link']}}"><img src="{{$brand['logo']}}" target="_blank"
                                                                  alt="{{$brand['name']}}"/></a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="achievements">
                <h3>Achievements</h3>
                <ul>
                    @foreach($brands as $brand)
                        @if($brand['type']=="achievements")
                            <li><a href="{{$brand['link']}}"><img src="{{$brand['logo']}}" target="_blank"
                                                                  alt="{{$brand['name']}}"/></a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="media">
                <h3>Media</h3>
                <ul>
                    @foreach($brands as $brand)
                        @if($brand['type']=="media")
                            <li><a href="{{$brand['link']}}"><img src="{{$brand['logo']}}" target="_blank"
                                                                  alt="{{$brand['name']}}"/></a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@stop
