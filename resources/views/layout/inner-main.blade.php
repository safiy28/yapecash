@include('layout.partials.header')
@include('layout.partials.navigation')
<div class="section content_area">
    <div class="wapper">
        @yield('body-content')
    </div>

</div>

@include('layout.partials.panel-footer')


<script src="{{url('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/5.6.3/js/jquery.mmenu.all.min.js" type="text/javascript"></script>

<script>

    $(function() {
        /*$('.success').fadeIn("slow").delay(4000).fadeOut("slow");*/
    });
    jQuery(document).ready(function($) {

        $("#menu").mmenu({
            slidingSubmenus: false,
            extensions: ["pageshadow"],
            extensions: ["theme-dark"],
            extensions: ["effect-slide-menu", "effect-slide-listitems"]
        });
    });
</script>
<script src="{{url('js/script.js')}}"></script>
@yield('footer-script')
</body>
</html>
