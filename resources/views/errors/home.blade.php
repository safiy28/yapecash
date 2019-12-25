@if($errors->any())
    <div id="error_alert" class="alert alert-danger">@foreach($errors->all() as $error){{$error}} @endforeach
    </div>

@endif