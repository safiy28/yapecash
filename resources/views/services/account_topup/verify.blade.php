@extends('layout.inner-main')
@section('body-content')
    <div class="area services bpb area-services">
        <div class="container">
            <h2 class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">Service : {{session('service_name')}} ( Review )</h2>

            @include('errors.list')

            <div class="service_body">
                @if(!$service_result['balance_exceeded'])
                <form role="form" method="POST" action="{{ url('recipient/review') }}">
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Calculation</div>
                            <div class="panel-body calculation">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Given Amount</td>
                                        <td>{{session('recipient_inputs')['amount']}} {{$service_result['currency']}}</td>
                                    </tr>
                                    <tr>
                                        <td>MyCashPoint</td>
                                        <td>{{$service_result['amount']}} Points</td>
                                    </tr>
                                    <tr>
                                        <td>Charges </td>
                                        <td>{{$service_result['charge']}} points</td>
                                    </tr>
                                    <tr>
                                        <td>Commission</td>
                                        <td>{{$service_result['commission']}} points</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>{{$service_result['discount']}} points</td>
                                    </tr>
                                    @if(!$service_result['balance_exceeded'])
                                        <tr class="info">
                                            <th>Total Amount</th>
                                            <th>{{(double)str_replace(',', '', $service_result['amount']) + $service_result['charge']}}
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
                            <?php session(['form_submitted' => 1]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Sender Details</div>
                            <div class="panel-body calculation">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Name</td>
                                        <td><strong>{{$user['user_name']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile No</td>
                                        <td><strong>{{$user['mobile_number']}}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="service_panel panel panel-default">
                            <div class="panel-heading">Receiver</div>
                            <div class="panel-body calculation">
                                <ul class="list-radio" id="radio-option2">
                                    @foreach($recipients as $key => $recipient)
                                        @if($recipient['active'] == 1)
                                            <li class="list-radio-item">
                                                <input required type="radio" value="{{$recipient['id']}}" id="{{$key}}" name="recipient_id">
                                                <label for="{{$key}}">{{$recipient['name']}}</label>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{csrf_field()}}
                <a href="javascript:void(0)" class="btn btn-danger btn-lg btn-action back" onclick="window.history.back(-1)">Back</a>
                @if(!$service_result['balance_exceeded'] && session('extra_permissions')['users_info_manage'])
                <a href="{{url("/users/{$user['id']}/recipient/insidecreate")}}" class="btn btn-primary btn-action btn-lg">Add New Recipient</a>
                <button class="btn btn-success btn-lg btn-action forward">Submit</button>
                @endif
                </form>
            </div>
        </div>
    </div>
@stop