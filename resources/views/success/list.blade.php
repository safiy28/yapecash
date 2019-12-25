@if(session()->has('success'))
    <div class="row">

        <div class="col-xs-12">
            <div class="alert alert-success" id='successMessage'>
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success !</strong> {{session('success')}}
            </div>
        </div>

    </div>
@endif
