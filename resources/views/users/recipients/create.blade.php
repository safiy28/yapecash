@extends('layout.inner-main')
@section('body-content')
    <h1 class="title-text">Add Recipient</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>
    @include('errors.list')

    <div class="leftpan row">
        <div class="col-md-8 col-lg-offset-2">
            <form  role="form" method="POST" action="{{ url('/')}}/users/{{$user_id}}/recipient/create" accept-charset="UTF-8" >
                <div class="panel ammount">
                    <h2>Recipient Information</h2>
                    <div class="panelcontent">
                        <div class="rate-amount">
                            <strong>Name*</strong>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                        </div>
                    </div>
                    <div class="panelcontent">
                        <div class="rate-amount">
                            <strong>Relationship*</strong>
                            <input type="text" name="relation" class="form-control" placeholder="Enter Relationship" required>
                        </div>
                    </div>
                    <div class="panelcontent">
                        <div class="rate-amount">
                            <strong>Phone</strong>
                            <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" required>
                        </div>
                    </div>
                    <div class="panelcontent">
                        <div class="rate-amount">
                            <strong>Transfer Type*</strong>
                            <select name="transfer_type" id="transfer_type" required class="form-control">
                                <option value="">Select Transfer Type</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="cash">Cash Pickup</option>
                            </select>
                        </div>
                    </div>
                    <div class="panelcontent">
                        <div class="rate-amount">
                            <strong>Country*</strong>
                            <input type="text" name="country" class="form-control" placeholder="Enter Country" required>
                        </div>
                    </div>
                    <div class="tp_input bank" id="bnkTrnsfer" style="display: none">
                        <div class="panelcontent">
                            <div class="rate-amount">
                                <strong>Bank Name*</strong>
                                <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="Enter Bank Name">
                            </div>
                        </div>
                        <div class="panelcontent">
                            <div class="rate-amount">
                                <strong>Acc No*</strong>
                                <input type="text" id="bank_ac_no" name="bank_ac_no" class="form-control" placeholder="Enter Acc No">
                            </div>
                        </div>
                    </div>
                    <div class="tp_input cash" id="cashPickup"  style="display: none">
                        <input type="hidden" name="bank_type" value="selected">
                    </div>
                    {{--<div class="tp_input branch" id="bnkBranch" style="display: none">--}}
                        <div class="panelcontent" id="branch_code" style="display: none">
                            <div class="rate-amount">
                                <strong>Branch Name*</strong>
                                <input type="text" id="branch_name" name="branch_name" class="form-control" placeholder="Enter Branch Name">
                            </div>
                        </div>

                   {{-- </div>--}}
                    <div class="panelcontent">
                        <div class="rate-amount">
                            <label>Active</label>
                            <input type="radio" name="active" checked value="1"> YES
                            <input type="radio" name="active" value="0"> NO
                        </div>
                    </div>
                </div>
                {{csrf_field()}}
                <input type="submit" name="" value="Add" class="submitbtn" onClick="clearform();">
            </form>
        </div>
    </div>
@stop
@section('footer-script')
    <script>
        $(function() {
            $('#transfer_type').change(function(){
                if($(this).val() == "cash")
                {
                    $('#bnkTrnsfer').hide();
                    $('#cashPickup').show();
                    $('#branch_code').hide();
                    $('#bank_name').removeAttr('required');
                    $('#bank_ac_no').removeAttr('required');
                    //$('#bnkBranch').hide();
                    $('#country').val("");
                    $('#bank_name').val("");
                    $('#branch_name').val("");
                    $('#bank_ac_no').val("");
                }
                if($(this).val() == "bank")
                {
                    $('#cashPickup').hide();
                    $('#bnkTrnsfer').show();
                    $('#bank_name').attr('required','required');
                    $('#bank_ac_no').attr('required','required');
                    //$('#bnkBranch').show();
                    $('#country').val("");
                    $('#bank_name').val("");
                    $('#branch_name').val("");
                    $('#bank_ac_no').val("");
                    $('#branch_code').show();

                }
            });

        });
    </script>
    <script src="{!!url('/')!!}/js/custom.js"></script>
@stop


