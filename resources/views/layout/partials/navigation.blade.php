<div class="section nav">
  <div class="wapper">
    <div class="logo"><div class="mobmenu">
            <a href="#menu" class="mobmenu">Menu</a></div>
        <img src="{{url('/images/yape-logo-big.png')}}" alt="mycash point"/></div>
    <ul>
      <li><a href="{{url('/services')}}">Services</a></li>
        <li class="dropdown">
            <a href="#">Profile</a>
            <ul >
                <li><a href="{{url('/profile')}}">My Info</a></li>
                <li><a href="{{route('recipients')}}">My Recipient</a></li>
                <li><a href="{{route('change-password')}}">Change Password</a></li>
                <li><a href="{{route('change-pin')}}">Change Pin</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#">Report</a>
            <ul >
                <li><a href="{!!url('/')!!}/report">Transaction Report</a></li>
                <li><a href="{!!url('/')!!}/user/reports/sales">Sales Reports</a></li>
                @if(isset(session('extra_permissions')['purchase'], session('extra_permissions')['purchase']))
                    <li><a href="{!!url('/')!!}/payment/reports">Payment Reports</a></li>
                @endif

            </ul>
        </li>

        @if(isset(session('extra_permissions')['adminmenu_view']) && session('extra_permissions')['adminmenu_view'])
            <li class="dropdown">
                <a href="#">Admin Menu</a>
                <ul >
                    {{--@if(session('extra_permissions')['recipient_service_manage'] || session('extra_permissions')['city_recipient_manage'] || session('extra_permissions')['mmeucash_manage'] || session('extra_permissions')['mmeucashpickup_manage'])
                        <li><a href="{!!url('/')!!}/recipient/reports">Remittances Report</a></li>
                    @endif--}}
                    @if(session('extra_permissions')['msp_view'])
                        <li><a href="{!!url('/')!!}/msp">MSP Report</a></li>
                    @endif
                    {{--@if(isset(session('extra_permissions')['accounttopupreport_view'], session('extra_permissions')['accounttopupreport_view']))
                        <li><a href="{!!url('/')!!}/account">Account Topup Report</a></li>
                    @endif--}}
                    @if(session('extra_permissions')['recipient_service_manage'] || session('extra_permissions')['city_recipient_manage'] || session('extra_permissions')['mmeucash_manage'] || session('extra_permissions')['mmeucashpickup_manage'])
                    <!-- <li><a href="{!!url('/')!!}/recipient/reports">Remittances Report</a></li> -->
                        <li><a href="{!!url('/')!!}/bank/reports">Bank Transfer Report</a></li>
                        <li><a href="{!!url('/')!!}/cash/reports">Cash Pickup Report</a></li>
                        <li><a href="{!!url('/')!!}/tranglo-tracker">Tranglo Tracker</a></li>
                    @endif
                    @if(session('extra_permissions')['wallettransferreport_view'] || session('extra_permissions')['wallettransfer_manage'])
                        <li><a href="{!!url('/')!!}/recipient/wallet/reports">Wallet Transfer Report</a></li>
                    @endif
                </ul>
            </li>
        @endif

        @if(session('extra_permissions')['rates_view'])
            <li><a href="{{url('rate/calculate')}}">Rates</a></li>
        @endif

        @if(session('extra_permissions')['purchase'])
            <li><a href="{!!url('/')!!}/purchase">Reload</a></li>
        @endif

        @if(session('extra_permissions')['merchant'])
            <li><a href="{!!url('/')!!}/merchant/pay-request">Pay Request</a></li>
        @endif

        @if(session('extra_permissions')['menuregistration_show'])
            <li><a href="{{route('user-search')}}">Register</a></li>
        @endif

        <li><a href="{!!url('/')!!}/logout">Logout</a></li>
    </ul>
  </div>
</div>
<div id="mobmenu">
    <div id="menu">
        <ul>
            <li><a href="{{url('/services')}}">Services</a></li>
            <li class="dropdown">
                <a href="#">Profile</a>
                <ul >
                    <li><a href="{{url('/profile')}}">My Info</a></li>
                    <li><a href="{{route('recipients')}}">My Recipient</a></li>
                    <li><a href="{{route('change-password')}}">Change Password</a></li>
                    <li><a href="{{route('change-pin')}}">Change Pin</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#">Report</a>
                <ul >
                    <li><a href="{!!url('/')!!}/report">Transaction Report</a></li>
                    <li><a href="{!!url('/')!!}/user/reports/sales">Sales Reports</a></li>
                    @if(isset(session('extra_permissions')['purchase'], session('extra_permissions')['purchase']))
                        <li><a href="{!!url('/')!!}/payment/reports">Payment Reports</a></li>
                    @endif
                </ul>
            </li>

            @if(isset(session('extra_permissions')['adminmenu_view']) && session('extra_permissions')['adminmenu_view'])
                <li class="dropdown">
                    <a href="#">Admin Menu</a>
                    <ul >
                        {{--@if(session('extra_permissions')['recipient_service_manage'] || session('extra_permissions')['city_recipient_manage'] || session('extra_permissions')['mmeucash_manage'] || session('extra_permissions')['mmeucashpickup_manage'])
                        <li><a href="{!!url('/')!!}/recipient/reports">Remittances Report</a></li>
                    @endif--}}
                        @if(session('extra_permissions')['msp_view'])
                            <li><a href="{!!url('/')!!}/msp">MSP Report</a></li>
                        @endif
                        {{--@if(isset(session('extra_permissions')['accounttopupreport_view'], session('extra_permissions')['accounttopupreport_view']))
                            <li><a href="{!!url('/')!!}/account">Account Topup Report</a></li>
                        @endif--}}
                        @if(session('extra_permissions')['recipient_service_manage'] || session('extra_permissions')['city_recipient_manage'] || session('extra_permissions')['mmeucash_manage'] || session('extra_permissions')['mmeucashpickup_manage'])
                        <!-- <li><a href="{!!url('/')!!}/recipient/reports">Remittances Report</a></li> -->
                            <li><a href="{!!url('/')!!}/bank/reports">Bank Transfer Report</a></li>
                            <li><a href="{!!url('/')!!}/cash/reports">Cash Pickup Report</a></li>
                        @endif
                        @if(session('extra_permissions')['wallettransferreport_view'] || session('extra_permissions')['wallettransfer_manage'])
                            <li><a href="{!!url('/')!!}/recipient/wallet/reports">Wallet Transfer Report</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(session('extra_permissions')['rates_view'])
                <li><a href="{{url('rate/calculate')}}">Rates</a></li>
            @endif

            @if(session('extra_permissions')['purchase'])
                <li><a href="{!!url('/')!!}/purchase">Reload</a></li>
            @endif

            @if(session('extra_permissions')['merchant'])
                <li><a href="{!!url('/')!!}/merchant/pay-request">Pay Request</a></li>
            @endif
            @if(session('extra_permissions')['menuregistration_show'])
                <li><a href="{{route('user-search')}}">New User</a></li>
            @endif
            <li><a href="{!!url('/')!!}/logout">Logout</a></li>
        </ul>
    </div>
</div>