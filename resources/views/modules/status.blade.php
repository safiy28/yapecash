@if($service_result['success'])
    <div class="panel success">
        <i class="fa fa-check-circle-o fa-5x"></i>
        <strong>Congratulations</strong>, your action has been successfully generate.
    </div>
@else
    <div class="panel failed">
        <i class="fa fa-times-circle-o fa-5x"></i>
        <strong>Failed</strong><br><br>{{(isset($error_message) && $error_message)?$error_message:"Please go back and check your..."}}
    </div>
@endif
