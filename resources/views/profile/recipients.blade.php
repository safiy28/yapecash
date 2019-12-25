@extends('layout.inner-main')
@section('body-content')

    <h1 class="title-text">Recipient List</h1>
    @include('layout.partials.point-table')
    <div class="clearfix"></div>
    @include('errors.list')

    <div class="leftpan">
        <ul class="btn_wrappa">
            <li><a href="{{url('/profile/recipients?type=bank')}}">Bank Transfer</a></li>
            <li><a href="{{url('/profile/recipients?type=cash')}}">Cash Pickup</a></li>
            {{--<li><a href="{{url('/profile/recipients?type=wallet')}}">Wallet Transfer</a></li>--}}
            <li><a href="{{route('recipients')}}">All</a></li>
            <li><a href="{{ route('recipient', [$user]) }}">Add Recipient</a></li>
            <div style="clear: both"></div>
        </ul>
    @if(Session::has('flash_message'))
        <!--    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>-->

            <div class="panel success">
                <i class="fa fa-check-circle-o fa-5x"></i>
                <strong>Congratulations</strong>, your action has been successfully generate.
            </div>

        @endif
        <div class="tblcon">

            <table id="my-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>RelationShip</th>
                    <th>Phone</th>
                    <th>Transfer type</th>
                    <th>Bank Name</th>
                    <th>Bank AC No</th>
                    <th>Active</th>
                    <th>Edit</th>
                    {{--<th>Del</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($recipients as $recipient)
                    <tr>
                        <td>{{$recipient['name']}}</td>
                        <td>{{$recipient['relation']}}</td>
                        <td>{{$recipient['phone']}}</td>
                        <td>{{$recipient['transfer_type']}}</td>
                        <td>{{$recipient['bank_name']}}</td>
                        <td>{{$recipient['bank_ac_no']}}</td>
                        <td>
                            @if($recipient['active'])
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>
                            <a href="{{url("/users/{$user}/recipient/{$recipient['id']}/edit")}}">Edit</a>
                        </td>
                        {{--<td>
                            <a href="{{url("/users/{$user}/recipient/{$recipient['id']}/delete")}}">Delete</a>
                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="clearfix"></div>

    </div>
@stop

@section('footer-script')
    <style>
        .tblcon tr:first-child td {
            background-color: #F4F4F4;
            border: 0px solid #bfbfbf;
            text-align: justify;
            border-width: 0px 0px 1px 1px;
            font-size: 100%;
            font-weight: normal;
            color: black;
        }

        .tblcon thead th {
            background-color: #464646;
            border: 0px solid #bfbfbf;
            text-align: center;
            padding: 7px;
            border-width: 0px 0px 1px 1px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
        }
        .btn_wrappa {
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .btn_wrappa li a{
            padding: 10px 0;
            margin-right: 10px;
            background: #337ab7;
            color: #fff;
            width: 140px;
            display: block;
            text-align: center;
            font-size: 17px;
            border-radius: 20px;
            float: left;

        }
        .btn_wrappa li {
            float: left;
            margin-bottom: 10px;
        }
        .btn_wrappa li.pull-right {
            float: right;
        }
    </style>
    <link rel="stylesheet" href="{!!url('/')!!}/dynatable/jquery.dynatable.css"/>
    <script src="{{url('/dynatable/jquery.dynatable.js')}}"></script>

    {{--<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/js/data-tables/DT_bootstrap.js')}}"></script>--}}

    <script>
        $(function () {

            $('#my-table').dynatable();

            /*$('#my-table').DataTable({
                dom: 'Brtip',
                aaSorting: [],
                iDisplayLength: 10,
                pagingType: 'numbers'
            });*/
        });
    </script>
@stop

