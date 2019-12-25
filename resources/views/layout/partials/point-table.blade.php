<div class="rightpan">
    <div class="memberstatus">
        <h2>{{session('name')}}
            <span>
                ID # {{session('mobile_number')}}
            </span>
        </h2>
        <ul>
            <li>Total Balance: <strong>{{session('total_points')?:'No'}} AUD</strong></li>
            <li>Available Balance: <strong>{{session('available_points')?:'No'}} AUD</strong></li>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>