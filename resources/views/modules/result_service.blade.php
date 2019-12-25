@if($service_result['success'])
    <div class="service_alert success">
        <div class="icon">
            <div class="glyphicon glyphicon-ok-circle"></div>
        </div>
        <div class="massages">
            <div class="alert-title">Success</div>
            <div class="alert-body">
                <strong>Congratulations</strong>, your action has been successfully generate.
            </div>
        </div>
    </div>
@else
    <div class="service_alert danger">
        <div class="icon">
            <div class="glyphicon glyphicon-remove-circle"></div>
        </div>
        <div class="massages">
            <div class="alert-title">Failed</div>
            <div class="alert-body">
                <strong>Sorry </strong> {{(isset($error_message) && $error_message)?$error_message:"Please go back and check your..."}}
            </div>
        </div>
    </div>
@endif
