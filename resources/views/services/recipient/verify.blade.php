@extends('layout.inner-main')
@section('body-content')
    <h1 class="title-text">Service: {{session('service_name')}} (Review)</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>

    @include('errors.list')

    <form method="POST" action="{{ route('bank.transfer.review') }}">
        <div class="leftpan">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel ammount">
                        <h2>Sender Details</h2>
                        <div class="panelcontent">
                            <table class="table table-striped">
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td><strong>{{$user['user_name']}}</strong></td>
                                </tr>
                                <tr>
                                    <td>Mobile No</td>
                                    <td>:</td>
                                    <td><strong>{{$user['mobile_number']}}</strong></td>
                                </tr>
                                <tr>
                                    <td>Address</td><td>:</td>
                                    <td><strong>{{$user['address']}}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="panel ammount">
                        <h2>Receiver</h2>
                        <div class="panelcontent">
                            <div class="row">
                                <ul id="radio-option2">
                                    @foreach((array)$recipients as $key => $recipient)
                                        @if($recipient['active'] == 1)
                                            <li>
                                                <div class="selectarea radiogroup">
                                                    <input required type="radio" value="{{$recipient['id']}}" id="{{$key}}" name="recipient_id">
                                                </div>
                                                <label for="{{$key}}">{{$recipient['name']}}</label>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="row">
                                <div class="checkbox" style="margin-top: 0px;margin-bottom: 0px;font-family: sans-serif;">
                                    {{--<input type="hidden" value="" id="recipient_id" name="recipient_id">--}}
                                    <button type="button" onclick="location.href='{!!url('/')!!}/users/{{$user['id']}}/recipient/insidecreate';" class="btn btn-sm btn-success" style="background-color: #5bc0de;border-color: #5bc0de" id="cardBtn">
                                        <span id="riskButtonLabel">ADD NEW RECEIVER</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('modules.calculation')
                </div>
            </div>

            {{csrf_field()}}
            <input type="button" href="javascript:void(0)" onclick="window.history.back(-1)" value="BACK" class="submitbtn">
            {{--<input type="button" onclick="location.href='{!!url('/')!!}/services/{{session('service_id')}}';" value="BACK" class="submitbtn">--}}
            @if($isStatAvailable['status'])
            @if(!$charges['balance_exceeded'])
            {{--<input type="button" onclick="location.href='{!!url('/')!!}/users/{{$user['id']}}/recipient/insidecreate';" value="Add a New Receiver" class="submitbtn">--}}
                    @if(count($recipients) > 0)
                    <input type="submit" value="submit" class="submitbtn">
                    @endif
            @endif
            @endif
        </div>
    </form>
@stop