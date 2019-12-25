@include('layout.partials.page-header')


<div class="area small-header">
    <div class="wrapper">
        <div class="logo"><a href="/"><img src="images/logo.png"  class="wow fadeInDown" alt=""/></a></div>
        <div class="btn-area">
            @if (Session()->has('is_verified'))
                <a href="{{route('services')}}">Dashboard</a>
            @else
                <a href="/">Home</a>
                <a href="{{ route('login') }}">Login</a>
            @endif
        </div>
    </div>
</div>

<div class="area contentArea">
    <div class="wrapper">
        <h1 class="title-text">Privacy Policy</h1>
        <div class="tram">
            <p>MyCash Online is committed to protecting the privacy of our customers, including you. We value your trust and have a long-standing commitment towards protecting your personal data. This Privacy Policy describes and explains how we process, treat and secure your data. By using this website www.mycashsg.com (“Website”), you consent unconditionally to the terms of this Privacy Policy.  <br>
                <br>
            </p>
            <h3>What Information Do We Collect About You?</h3>
            <p>
                The information we collect are those provided by you upon your registration for use of the website together with information we learn from your use of the Website. This information may include your personal identification details such as your name, contact number and other information which identifies you. We also collect information about you when you contact us whether by way of email, telephone or other means of communication including social media.  <br>
            </p>
            <br>
            <h3>How Do We Use the Information?</h3>
            <p>
                We do not sell or disclose your information in an unauthorised manner to any third parties. Your information is used strictly for the following purposes mentioned herein –

            <ul> to provide our services to you; </ul>
            <ul> to communicate with you;</ul>
            <ul> to verify your identity for purposes of receiving our products and services;</ul>
            <ul> to notify you of any changes to our terms and conditions or the products and services offered to you;</ul>
            <ul> for customer research purposes to better improve our services;</ul>
            <ul>to inform you of products and services which may be of interest to you including information about products and services offered by our affiliated companies and selected third-party partners;</ul>
            <ul>and to maintain records as part of our business or other purposes in so far as is permitted by the law.</ul>
            <br>
            </p>
            <h3>Disclosure and Safeguarding the Information</h3>
            <p>All information collected by MyCash will be kept confidential and used internally by MyCash. MyCash may however, provide or disclose the information to our subsidiary, associated or related companies or third-party service providers for the purposes mentioned herein. Disclosure of the information may also be made in compliance with applicable laws and to generally protect the rights and property of MyCash.
                <br>
                You may choose not to give or to limit or to withdraw your consent for us to process and retain your information by writing in to us at info@mycashmy.com. This may result in MyCash being unable to offer to you the products and services in the ordinary course of our business or to provide any promotional information and materials that may be of interest to you.
                <br>
                Your patronage is important to us and we make all reasonable efforts towards safeguarding the information by reviewing our internal policies and keeping our Privacy Policy under regular review. You may log on to this Website for a copy of our updated Privacy Policy which we may amend from time to time.
                <br>
                <br>
            </p>
            <h3>Right to Access and Correction of Personal Data</h3>
            <p>We want to ensure that the information we have is accurate and up to date for us to provide the best possible service to you. All users of the Websites, including you, have the right to access, update or correct any information by updating your registration details on the Website or writing to us at info@mycashmy.com.
                <br>
                If you have any queries, complaints or otherwise relating to the misuse or suspected misuse of your information, you may contact us at the above-mentioned email address.
                <br>
            </p>

        </div>
    </div>

</div>

@include('layout.partials.footer')