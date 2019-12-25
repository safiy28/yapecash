@extends('app')

@section('header')
    <style>
        .littleUp {
            margin-bottom: 2%;
        }

        #msg {
            display: none;
        }


    </style>


@stop

@section('content')
    <?php $manageRates = $logged_user->groups()->first()->hasPermission("rates.manage"); ?>
    @include('success.list')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Available Rates

                </header>
                <div class="panel-body">

                    @if($manageRates)
                        <a class="btn btn-primary pull-right littleUp" data-toggle="modal" data-target="#createRate">Add
                            New Rate</a>
                    @endif
                    <table class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Country</th>
                            <th>Currency</th>
                            <td>Rate Per RM</td>
                            <td>Active</td>
                            <td>logo</td>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>


                        @foreach($rates as  $index=>$rate)

                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$rate->country}} </td>
                                <td>
                                    {{$rate->currency}}
                                </td>
                                <td>
                                    {{$rate->rate_per_rm}}
                                </td>
                                <td>{{$rate->active?"Yes":"No"}}</td>
                                <td><img src="{{URL::to("files" . $rate->logo)}}" alt=""/></td>
                                @if($manageRates)
                                    <td>
                                        <a href="{{url('rates')}}/{{$rate->id}}/edit"><i class="fa fa-pencil fa-lg"></i></a>

                                        <a href="{{url('rates')}}/{{$rate->id}}/destroy"><i
                                                    class="fa fa-times-circle fa-lg"></i></a>

                                    </td>
                                @else
                                    <td>Not Permitted</td>
                                @endif
                            </tr>

                        @endforeach

                        </tbody>
                    </table>

                </div>
                @include('errors.list')

            </section>
        </div>
    </div>

@stop

@section('modal')
    @if($manageRates)
        <!-- Modal -->
        <div class="modal fade" id="createRate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add New Rate </h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url'=>'rates','files'=>true]) !!}


                        <div class="form-group">
                            {!! Form::label('country','Country') !!}
                            {!! Form::text('country','',['class'=>'form-control','id'=>'myInput' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('currency','Currency') !!}
                            {!! Form::text('currency','',['class'=>'form-control' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('rate_per_rm','Rate Per RM') !!}
                            {!! Form::text('rate_per_rm','',['class'=>'form-control' ])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('logo','Logo of Country') !!}
                            {!! Form::file('logo','',['class'=>'form-control'])!!}
                        </div>

                        <div class="form-group">
                            <input type="radio" name="active" checked value=1>enabled<br>
                            <input type="radio" name="active" value=0>disabled
                        </div>

                        <div class="form-group">
                            {!! Form::label('pin','Pin') !!}
                            {!! Form::input('number','pin','',['class'=>'form-control' ])!!}
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            {!! Form::submit('Save',['class'=>'btn btn-primary'])!!}
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop


@section('footer')

    <script>
        setTimeout(function () {
            $("#successMessage").slideUp();
        }, 3000);
    </script>

    <script>
        $('#createRate').on('shown.bs.modal', function () {
            $('#myInput').focus()
        });

        $('#checkBox').change(function () {
            $('#msg').toggle();
        });

        $(function () {
            $('body').delegate('a.modal-image-link', 'click', function () {

                $('#modal-image-content').attr("src", $(this).attr('data-image'));
            })
        });
    </script>


@stop
