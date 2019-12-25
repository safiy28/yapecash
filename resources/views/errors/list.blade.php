
@if($errors->any())
    <div class="service_alert danger">
        <div class="icon">
            <div class="glyphicon glyphicon-remove"></div>
        </div>
        <div class="massages">
            <div class="alert-title">ERROR</div>
            <div class="alert-body">
                @foreach((array)$errors->all() as $error)
                    <p>   {{$error}}</p>
                @endforeach
            </div>
        </div>
    </div>
@else

    <div class="row">
        <div class="col-xs-12">
            @foreach($errors->all() as $error => $value)
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{strstr(preg_replace('/[^a-zA-Z0-9_ -]/s','',$value)," ")}}
                </div>
            @endforeach
        </div>
    </div>



@endif