@extends('layout.inner-main')
@section('body-content')

            <h1 class="title-text">Tranglo Order Status</h1>
            @include('layout.partials.point-table')
            <div class="clearfix"></div>

            @include('errors.list')

            <div class="leftpan">
                <div class="panel">
                    <h2>Tranglo Order Status</h2>
                    <div class="panelcontent">
                        <ul class="review-list">
                            <li><strong>Trx Status Code :</strong> {{$trx_status['TrxStatus']}}</li>
                            <li><strong>Order ID (GTN) :</strong> {{$trx_status['GTN']}}</li>
                            <li><strong>Trx Status :</strong> {{$trx_status['Description']}}</li>
                            <li><strong>TRX ID :</strong> {{$trx_status['transID']}}</li>
                            @if(isset($trx_status['PayoutID']))
                            <li><strong>Payout ID :</strong> @if(isset($trx_status['PayoutID'])){{$trx_status['PayoutID']}}@endif
                            </li>
                            <li><strong>Payout PIN :</strong> @if(isset($trx_status['PayoutPIN'])){{$trx_status['PayoutPIN']}}@endif
                            </li>
                            <li><strong>Payout Status :</strong> @if(isset($trx_status['PayoutStatus'])){{$trx_status['PayoutStatus']}}@endif
                            </li>
                            <li><strong>Status Update Date :</strong> @if(isset($trx_status['PayoutStatusUpdateDate'])){{$trx_status['PayoutStatusUpdateDate']}}@endif
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="panel">
                    <h2>Order Details</h2>
                    <div class="panelcontent">
                        <ul class="review-list">
                            <li><strong>Service Name :</strong>{{$reports['service']['name']}} </li>
                            <li><strong>Sender Name :</strong>{{$reports['user']['name']}} </li>
                            <li><strong>Sender ID :</strong> {{$reports['sender_mobile']}}</li>
                            <li><strong>Receiver Name :</strong> {{$receiver['name']}}</li>
                            <li><strong>Receiver Number :</strong> {{$reports['receiver_mobile']}}</li>
                            @if($reports['service_id'] === 8)
                            <li><strong>Bank Name :</strong> </strong> {{$receiver['recipient_banks']['name']}}</li>
                            <li><strong>Bank A/C No :</strong> {{$receiver['bank_ac_no']}}</li>
                                @if($receiver['recipient_bank_branch']['name'])
                                    <li><strong>Branch Name :</strong> {{$receiver['recipient_bank_branch']['name']}}</li>
                                @elseif($receiver['ifsc_code'])
                                    <li><strong>IFSC Code :</strong> {{$receiver['ifsc_code']}}</li>
                                @endif
                            @endif
                            @if($reports['service_id'] === 10)
                            <li><strong>Wallet Number :</strong> {{$reports['account_name']}}</li>
                            @endif
                            <li><strong>Country :</strong> {{$receiver['country']}}</li>
                            <li><strong>Given Amount :</strong> {{number_format(str_replace(',', '', $reports['old_amount']), 3)}} {{$reports['currency']}}</li>
                            <li><strong>MyCashPoint :</strong> {{number_format(str_replace(',', '', $reports['amount']), 3)}}</li>
                            <li><strong>Charges :</strong> {{number_format(str_replace(',', '', $reports['charges']), 3)}}</li>
                            <li><strong>Commission :</strong> {{number_format(str_replace(',', '', $reports['commission']), 3)}}</li>
                            <li><strong>Discount :</strong> {{number_format(str_replace(',', '', $reports['discount']), 3)}}</li>
                            <li><strong>Total :</strong> {{number_format(str_replace(',', '', $reports['deducted']), 3)}}</li>
                        </ul>
                    </div>
                </div>
                <a href="javascript:void(0)" class="btn btn-info btn-lg btn-action back" onclick="location.href='{!!url('/')!!}/tranglo-tracker';">
                    Back
                </a>
            </div>

@stop
