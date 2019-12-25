@include('layout.partials.page-header')


<div class="area small-header">
    <div class="wrapper">
        <div class="logo"><a href="/"><img src="images/logo.png"  class="wow fadeInDown" alt=""/></a></div>
        <div class="btn-area">
            @if (Session()->has('is_verified'))
                <a href="{!!url('/')!!}/services">Dashboard</a>
            @else
                <a href="/">Home</a>
                <a href="{!!url('/')!!}/login">Login</a>
            @endif
        </div>
    </div>
</div>

<div class="area contentArea">
    <div class="wrapper">
        <h1 class="title-text">Contact Us</h1>
        <div class="half conInfo">
            <h3>MYCASH ONLINE (SG) PTE. LTD.</h3>
            <ul>
                <li class="conicon address">No. 16, Purvis St, Singapore 188595</li>
                <li class="conicon phone">+6583987569</li>
                <li class="conicon email"><a href="mailto:info@mycashmy.com">info@mycashmy.com</a></li>
                <li class="conicon map"><a href="https://www.google.com/maps/place/PlusConcept/@1.2963428,103.8532667,17z/data=!4m5!3m4!1s0x31da19a5714bffc7:0x8de706dcbe6505d!8m2!3d1.2963374!4d103.8554554" target="_blank">Location Map</a></li>
            </ul>
        </div>
        <div class="half conInfo">
            <h3> MC ONLINE SDN. BHD.</h3>
            <ul>
                <li class="conicon address">C3-28-13A, CBD PERDANA 3, Cyberjaya, 63000 Selangor, Malaysia</li>
                <li class="conicon phone">+60149644031</li>
                <li class="conicon email"><a href="mailto:info@mycashmy.com">info@mycashmy.com</a></li>
                <li class="conicon map"><a href="https://www.google.com/maps/place/Centrus+SoHo/@2.9257915,101.6475865,17z/data=!3m1!4b1!4m5!3m4!1s0x31cdb6e5537ad8d9:0x8da3c4dacc9604b9!8m2!3d2.9257861!4d101.6497752" target="_blank">Location Map</a></li>
            </ul>
        </div>
        <div class="half conInfo">
            <h3> YAPE CASH SDN. BHD.</h3>
            <ul>
                <li class="conicon address">No. 12, Taman Perindustrian Prima Jaya, 91000 Tawau, Malaysia</li>
                <li class="conicon phone">+601126156616</li>
                <li class="conicon email"><a href="mailto:info@mycashmy.com">info@mycashmy.com</a></li>
                <li class="conicon map"><a href="https://www.google.com/maps/place/Yape+Sdn.+Bhd./@4.2771159,117.8971443,17z/data=!4m8!1m2!2m1!1sTaman+Perindustrian+Prima+Jaya,+91000+Tawau!3m4!1s0x0:0xc90a254e48429f6c!8m2!3d4.2770183!4d117.8998668" target="_blank">Location Map</a></li>
            </ul>
        </div>
        <div class="half conInfo">
            <h3> MYCASH ONLINE (AU) PTY. LTD.</h3>
            <ul>
                <li class="conicon address">22 Shelley Street, Redbank Plains, QLD 4301, Australia</li>
                <li class="conicon phone">+61420277000</li>
                <li class="conicon email"><a href="mailto:info@mycashmy.com">info@mycashmy.com</a></li>
                <li class="conicon map"><a href="https://www.google.com/maps/place/22+Schelley+St,+Redbank+Plains+QLD+4301,+Australia/@-27.6666024,152.8432864,17z/data=!3m1!4b1!4m5!3m4!1s0x6b914abf26b67781:0x5b3bd248f06ba1b1!8m2!3d-27.6666072!4d152.8454751" target="_blank">Location Map</a></li>
            </ul>
        </div>
    </div>
    <div class="mapArea">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15955.188423033915!2d103.8554018!3d1.2963696!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8de706dcbe6505d!2sPlusConcept+%7C+SPACE%E2%84%A2+No.+16+Purvis+%5BMAIN%5D!5e0!3m2!1sen!2s!4v1465864837715" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>

@include('layout.partials.footer')