@if(session('first_time'))

    <div class="row">

        <div class="col-xs-12">
            <div class="alert alert-warning" id='successMessage'>
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Welcome !</strong>
                Please change your Password and Pin First!
            </div>
        </div>

    </div>

@endif
