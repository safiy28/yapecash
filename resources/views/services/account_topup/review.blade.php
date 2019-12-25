@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}} ( Review )</h2>

            @include('errors.list')

            <div class="service_body">
                @if(!session('recipient_charges')['balance_exceeded'])
                <form role="form" method="POST" action="{{ url('account_topup/confirm') }}">
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Calculation</div>
                            <div class="panel-body calculation">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Given Amount</td>
                                        <td>{{session('recipient_inputs')['amount']}} {{session('recipient_charges')['currency']}}</td>
                                    </tr>
                                    <tr>
                                        <td>MyCashPoint</td>
                                        <td>{{session('recipient_charges')['amount']}} Points</td>
                                    </tr>
                                    <tr>
                                        <td>Charges </td>
                                        <td>{{session('recipient_charges')['charge']}} points</td>
                                    </tr>
                                    <tr>
                                        <td>Commission</td>
                                        <td>{{session('recipient_charges')['commission']}} points</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>{{session('recipient_charges')['discount']}} points</td>
                                    </tr>
                                    @if(!session('recipient_charges')['balance_exceeded'])
                                        <tr class="info">
                                            <th>Total Amount</th>
                                            <th>{{(double)str_replace(',', '', session('recipient_charges')['total']) + session('recipient_charges')['charge']}}
                                                points</th>
                                        </tr>
                                    @else
                                        <tr class="danger">
                                            <th>Total</th>
                                            <th>Balance exceeded</th>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="service_panel panel panel-default">
                                    <div class="panel-heading">Pin Number</div>
                                    <div class="panel-body calculation">
                                        <input type="password" value="{{isset($pin)?$pin:""}}" name="pin" required
                                               placeholder="Enter Pin Number" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Sender Details</div>
                            <div class="panel-body calculation">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Name</td>
                                        <td><strong>{{ session('name') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile No</td>
                                        <td><strong>{{ session('mobile_number') }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Reciver Details</div>
                            <div class="panel-body calculation">
                                <table class="table table-striped">
                                    <tr><td><strong>Bank Name :</strong></td> <td>{{ str_replace('_', ' ', $recipient['bank']) }}</td></tr>
                                    <tr><td><strong>Transfer Mode :</strong></td> <td>{{ str_replace('_', ' ', $recipient['mode']) }}</td></tr>
                                    <tr><td><strong>Account Number:</strong></td> <td>{{ $recipient['receiver_account_number'] }}</td></tr>
                                    <tr><td><strong>Account Holder Name :</strong></td> <td>{{ $recipient['account_name'] }}</td></tr>
                                    <tr><td><strong>Recipient Reference :</strong></td> <td>{{ $recipient['purpose'] }}</td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{csrf_field()}}
                <a href="javascript:void(0)" class="btn btn-danger btn-lg btn-action back" onclick="window.history.back(-1)">Back</a>
                @if(!session('recipient_charges')['balance_exceeded'])
                <button class="btn btn-success btn-lg btn-action forward">Submit</button>
                @endif
                </form>
            </div>
        </div>
    </div>
@stop