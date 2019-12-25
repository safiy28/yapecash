@extends('static')
@section('content')
    <div class="section">
        <div class="wapper">
            <h1>FAQs</h1>
            <div id="accordion-container" class="section commonarea">
                <h2 class="accordion-header">Definitions</h2>
                <div class="accordion-content">
                    <p>
                    <li><b>MyCash Account:</b> It's a virtual storage of MyCash points. After registration, your mobile
                        number will be your MyCah Account number.
                    </li>
                    <li><b>Point-in:</b> Buying MyCash Point using MyCash Website or MyCash Point.</li>
                    <li><b>Point-out:</b> Selling points from your Account. You can Point Out from any MyCash Point.
                    </li>
                    <li><b>Point Transfer:</b> Transferring points from one MyCash Account to another MyCash Account.
                    </li>
                    <li><b>Mobile Reload:</b> Reload your mobile phone (local & international) using MyCash Point.</li>
                    <li><b>MyCash PIN:</b> This is a secret number like a password to secure your MyCash Account.</li>
                    <li><b>Order ID:</b> A system generated unique reference number against each order that is preserved
                        as identification.
                    </li>
                    <li><b>Reference:</b> Mentioning the purpose of the transaction for your own record.</i>
                        </p>
                </div>
                <h2 class="accordion-header">Can I use MyCash Point 24X7?</h2>
                <div class="accordion-content">
                    <p>Yes, You can.</p>
                </div>
                <h2 class="accordion-header">Do I need to open an MyCash account to use this service?</h2>
                <div class="accordion-content">
                    <p>Yes, You need to open a MyCash account. </p>
                </div>
                <h2 class="accordion-header"> Who can open an account? </h2>
                <div class="accordion-content">
                    <p>Any one, who is above 18 years old and have a valid Passport & Visa to work in Malaysia. </p>
                </div>
                <h2 class="accordion-header">Is there any charge for opening an account?</h2>
                <div class="accordion-content">
                    <p>No, account opening is completely FREE.</p>
                </div>
                <h2 class="accordion-header">Where shall I go to open an account?</h2>
                <div class="accordion-content">
                    <p> To any MyCash Point near you. </p>
                </div>
                <h2 class="accordion-header">Do I need to have a mobile phone to avail this service?</h2>
                <div class="accordion-content">
                    <p>Yes, you need a mobile phone to register and avail this service.</p>
                </div>
                <h2 class="accordion-header">Do I need to buy a new SIM card to open account?</h2>
                <div class="accordion-content">
                    <p> No, you can use any Malaysian Local Mobile Phone number to open an account. </p>
                </div>
                <h2 class="accordion-header">Do I need to have a bank account to use MyCash? </h2>
                <div class="accordion-content">
                    <p> No, there is NO need to have a bank account to use MyCash. <br/>
                    </p>
                </div>
                <h2 class="accordion-header">Are my MyCash PIN and SIM card PIN is same ?</h2>
                <div class="accordion-content">
                    <p> No, they are not same. </p>
                </div>
                <h2 class="accordion-header">What shall I do if I forgot my PIN?</h2>
                <div class="accordion-content">
                    <p> Call MyCash Helpline at +601120029004. </p>
                </div>
            </div>

        </div>
    </div>

@stop

@section('footer')

    <script>
        jQuery(document).ready(function ($) {
            $('.accordion-header').toggleClass('inactive-header');

            //Set The Accordion Content Width
            var contentwidth = $('.accordion-header').width();
            $('.accordion-content').css({'width': contentwidth});

            //Open The First Accordion Section When Page Loads
            //$('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
            //$('.accordion-content').first().slideDown().toggleClass('open-content');

            // The Accordion Effect
            $('.accordion-header').click(function () {
                if ($(this).is('.inactive-header')) {
                    $('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
                    $(this).toggleClass('active-header').toggleClass('inactive-header');
                    $(this).next().slideToggle().toggleClass('open-content');
                }

                else {
                    $(this).toggleClass('active-header').toggleClass('inactive-header');
                    $(this).next().slideToggle().toggleClass('open-content');
                }
            });

            return false;


        });
    </script>
@stop
