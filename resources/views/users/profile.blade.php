@extends('app')

@section('header')

@stop


@section('content')

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Name: {{$user->name}} ({{$user->mobile_number}})
                </header>

                <div class="panel-body">
                    <div class="modal-body">
                        <div class="row">

                            <strong>Father's Name :</strong> {{$profile->father_name}}
                            <br/>
                            <strong>Mother's Name :</strong> {{$profile->mother_name}}
                            <br/>
                            <strong>Present Address :</strong> {{$profile->present_address}}
                            <br/>
                            <strong>Permanent Address :</strong> {{$profile->permanent_address}}
                            <br/>
                            <strong>ID Type :</strong> {{$profile->id_type}}
                            <br/>
                            <strong>ID No :</strong> {{$profile->id_no}}
                            <br/>
                            <strong>ID Expire Date :</strong> {{$profile->id_expire_date->toDateString()}}
                            <br/>
                            <strong>ID Scan :</strong> <a data-toggle="modal" data-target="#image-show-modal" href=""
                                                          class="modal-image-link btn btn-primary btn-sm"
                                                          data-image="{{URL::to("files" . $profile->scan)}}">Click to
                                See</a>
                            <br/>
                            <strong>Date Of Birth :</strong> {{$profile->date_of_birth->toFormattedDateString()}}
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>

@stop

@section('modal')

    <!-- Modal -->
    <div class="modal fade" id="image-show-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Scanned ID</h4>
                </div>
                <div class="modal-body">
                    <img id="modal-image-content" class="img img-responsive" src=""/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script>
        $(function () {
            $('body').delegate('a.modal-image-link', 'click', function () {
                console.log("click");
                $('#modal-image-content').attr("src", $(this).attr('data-image'));
            })
        });
    </script>
@stop
