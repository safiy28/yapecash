@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Rate Calculator</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>

            @include('errors.list')

            <div class="leftpan row">
                <div class="col-md-8 col-lg-offset-2">
                <table class="table table-bordered table-striped" width="100%">
                    <tr class="hg">
                        <td>Service:</td>
                        <td>
                             <strong>{{$service['name']}}</strong>
                        </td>
                    </tr>
                    @if($input['_slug'] == 'rate_charge')
                        <tr class="hg">
                            <td>Country:</td>
                            <td>
                                <strong>{{$output['result']['name']}}</strong>
                            </td>
                        </tr>
                        <tr class="hg">
                            <td colspan="2"> Today’s Rate 1 MYR = <strong>{{$output['result']['rate']}} {{$output['result']['currency']}}</strong> </td>
                        </tr>
                    @else
                    @if($service['short_code'] == 'money')
                        <tr class="hg">
                            <td>Country:</td>
                            <td>
                                <strong>{{$operator['countries']['name']}}</strong>
                            </td>
                        </tr>
                    @else
                        <tr class="hg">
                            <td>Operator:</td>
                            <td>
                                <img src="{{$operator['operators']['logo']}}" alt="{{$operator['operators']['name']}}">
                            </td>
                        </tr>
                    @endif
                    @if($input['_slug'] == 'top-up')
                     <tr>
                        <td>Given Amount:</td>
                        <td> {{$input['amount']}} {{$output['result']['currency']}}</td>
                     </tr>
                    @else
                    <tr>
                        <td>Given Amount:</td>
                        <td> {{number_format($output['result']['given-amount'],2)}} {{$output['result']['currency']}}</td>
                    </tr>
                    <tr>
                        <td>Rate 1 RM:</td>
                        <td> {{$output['result']['current-rate']}} {{$output['result']['currency']}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>MyCash Points:</td>
                        <td> {{$output['result']['amount']}} points</td>
                    </tr>
                    <tr>
                        <td>Charges:</td>
                        <td> {{number_format($output['result']['charge'],2)}} points</td>
                    </tr>
                    <tr>
                        <td>Commission:</td>
                        <td>{{number_format($output['result']['commission'],2)}} points</td>
                    </tr>
                    <tr>
                        <td>Discount:</td>
                        <td> {{number_format($output['result']['discount'],2)}} points</td>
                    </tr>
                    <tr class="hr">
                        <td>Total:</td>
                        <td>{{$output['result']['total']}} points</td>
                    </tr>
                    @endif
                </table>

                <a href="javascript:void(0)" class="btn btn-info btn-lg btn-action back" onclick="location.href='{!!url('/')!!}/rate/calculate';">
                    Back
                </a>
            </div>
            </div>

@stop
