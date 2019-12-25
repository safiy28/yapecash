@extends('app')

@section('header')

@stop

@section('title')
    <h1>Today's Rate</h1>
@stop
@section('content')

    <div class="section">
        <div>
            <div class="country-rate">
                <h2>Metro Rates</h2>
                <ul>
                    @foreach($metrorates as $metrorate)
                        @if($metrorate['logo']!="null")
                            <li><img src="{{$metrorate['logo']}}" alt=""/>{{$metrorate['name']}} 1 Points :
                                <strong> {{$metrorate['rate']}} {{$metrorate['currency']}} </strong></li>
                        @else
                            <li><img src="" alt=""/>{{$metrorate['name']}} 1 Points :
                                <strong> {{$metrorate['rate']}} {{$metrorate['currency']}} </strong></li>
                        @endif
                    @endforeach
                </ul>

                <h2>Cash Pickup Rates</h2>
                <ul>
                    @foreach($cityrates as $cityrate)
                        @if($cityrate['logo']!="null")
                            <li><img src="{{$cityrate['logo']}}" alt=""/>{{$cityrate['name']}} 1 Points :
                                <strong> {{$cityrate['rate']}} {{$cityrate['currency']}} </strong></li>
                        @else
                            <li><img src="" alt=""/>{{$cityrate['name']}} 1 Points :
                                <strong> {{$cityrate['rate']}} {{$cityrate['currency']}} </strong></li>
                        @endif
                    @endforeach
                </ul>

                <h2>Ucash Rates</h2>
                <ul>
                    @foreach($ucashrates as $ucashrate)
                        @if($ucashrate['logo']!="null")
                            <li><img src="{{$ucashrate['logo']}}" alt=""/>{{$ucashrate['name']}} 1 Points :
                                <strong> {{$ucashrate['rate']}} {{$ucashrate['currency']}} </strong></li>
                        @else
                            <li><img src="" alt=""/>{{$ucashrate['name']}} 1 Points :
                                <strong> {{$ucashrate['rate']}} {{$ucashrate['currency']}} </strong></li>
                        @endif
                    @endforeach
                </ul>

                <h2>Topup Rates</h2>
                <ul>

                    @foreach($rates as $rate)
                        <li><img src="{{$rate['logo']}}" alt=""/>{{$rate['country']}} 1 Points :
                            <strong> {{$rate['rate_per_rm']}} {{$rate['currency']}} </strong></li>
                    @endforeach
                </ul>

            </div>

            <div class="commision-rate">
                <h2>Commission</h2>
                <ul>
                    <li style="background-color: #E83242;color: #fff;font-size: 18px;">Malaysia Top Up</li>
                    @foreach($stats as $stat)
                        @if($stat['local_operator_name']!=null && $stat['discount']!=="0" && $stat['service']['type']=="local_top_up")
                            <li><img src="{{$stat['local_operator_logo']}}" alt="">{{$stat['local_operator_name']}} :
                                <strong> {{$stat['discount']}} </strong></li>
                        @endif
                    @endforeach


                    <li style="background-color: #E83242;color: #fff;font-size: 18px;"><b>Voucher</b></li>
                    @foreach($stats as $stat)
                        @if($stat['local_operator_name']!=null && $stat['discount']!=="0" && $stat['service']['type']=="voucher" )
                            <li><img src="{{$stat['local_operator_logo']}}" alt="">{{$stat['local_operator_name']}} :
                                <strong> {{$stat['discount']}} </strong></li>
                        @endif
                    @endforeach

                </ul>
            </div>
            <div class="country-rate charges">
                <h2>Charges</h2>
                <ul>
                    @foreach($stats as $stat)
                        @if($stat['local_operator_name']==null && $stat['country_id']=="0")
                            <li><img src="images/butterfly-sm-{{$stat['service_color']}}.png"
                                     alt=""/>{{$stat['service_name']}} <strong>{{$stat['charge']}} Points</strong></li>
                        @endif
                    @endforeach
                    {{--<li><img src="images/butterfly-sm-cyan.png" alt=""/>Gift to Bangladesh <strong>0.35 Points</strong> </li>--}}
                    {{--<li><img src="images/butterfly-sm-green.png" alt=""/>Gift to Bangladesh <strong>0.35 Points</strong> </li>--}}
                </ul>


                <ul>
                    <?php $i = 0; $j = 0; $k = 0; $l = 0; ?>

                    @foreach($stats as $stat)

                        @if($stat['local_operator_name']==null && $stat['country_id']!="0")

                            <?php if ($stat['service']['short_code'] == 'metro') {
                            ?>
                            <?php if($i == 0) { ?><h2>Metro Charges</h2><?php } ?>
                            <li><img src="images/butterfly-sm-{{$stat['service_color']}}.png"
                                     alt=""/>{{$stat['country']}} ({{$stat['lower_limit']}} Points
                                -{{$stat['higher_limit']}} Points)
                                :<strong>{{$stat['charge']}} Points</strong></li>
                            <?php $i++;
                            }
                            ?>
                            <?php if ($stat['service']['short_code'] == 'city') {
                            ?>
                            <?php if ($j == 0) { ?><h2>Cash Pickup Charges</h2><?php } ?>
                            <li><img src="images/butterfly-sm-{{$stat['service_color']}}.png"
                                     alt=""/>{{$stat['country']}} ({{$stat['lower_limit']}} Points
                                -{{$stat['higher_limit']}} Points)
                                :<strong>{{$stat['charge']}} Points</strong></li>
                            <?php $j++;
                            }
                            ?>
                            <?php if ($stat['service']['short_code'] == 'ucash') {
                            ?>
                            <?php if ($k == 0) { ?><h2>MME Ucash Charges</h2><?php } ?>
                            <li><img src="images/butterfly-sm-{{$stat['service_color']}}.png"
                                     alt=""/>{{$stat['country']}} ({{$stat['lower_limit']}} Points
                                -{{$stat['higher_limit']}} Points)
                                :<strong>{{$stat['charge']}} Points</strong></li>
                            <?php $k++;
                            }?>
                            <?php if ($stat['service']['short_code'] == 'bank') {  ?>
                            <?php if ($l == 0) { ?><h2>MME Bank Transfer Charges</h2><?php } ?>
                            <li><img src="images/butterfly-sm-{{$stat['service_color']}}.png"
                                     alt=""/>{{$stat['country']}} ({{$stat['lower_limit']}} Points
                                -{{$stat['higher_limit']}} Points)
                                :<strong>{{$stat['charge']}} Points</strong></li>
                            <?php $l++;
                            }?>

                        @endif
                    @endforeach
                    {{--<li><img src="images/butterfly-sm-cyan.png" alt=""/>Gift to Bangladesh <strong>RM 0.35</strong> </li>--}}
                    {{--<li><img src="images/butterfly-sm-green.png" alt=""/>Gift to Bangladesh <strong>RM 0.35</strong> </li>--}}
                </ul>
            </div>

        </div>
    </div>

@stop
@section('footer')
    <script type="text/javascript"></script>
@stop
