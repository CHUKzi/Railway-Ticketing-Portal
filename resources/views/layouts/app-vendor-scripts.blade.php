<script type="text/javascript" src="{{ URL::asset('/build/bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/build/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/build/bower_components/popper.js/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/build/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ URL::asset('/build/assets/pages/waves/js/waves.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('/build/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.base-style').DataTable({
            "order": [
                [0, 'desc']
            ],
        });
    });
</script>
@yield('script')
