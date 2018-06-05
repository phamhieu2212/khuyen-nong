<script src="{!! \URLHelper::asset('libs/metronic/vendors/base/vendors.bundle.js', 'admin') !!}"></script>
<script src="{!! \URLHelper::asset('libs/metronic/demo/default/base/scripts.bundle.js', 'admin') !!}"></script>
<script src="{!! \URLHelper::asset('metronic/js/script.js', 'admin') !!}"></script>

<script type="text/javascript">
    var Boilerplate = {
        'csrfToken': "{!! csrf_token() !!}"
    };

    @if(Session::has('message-success'))
        toastr.success("{{ Session::get('message-success') }}", "Success");
    @elseif(Session::has('message-failed'))
        toastr.error("{{ Session::get('message-failed') }}", "Error");
    @endif
</script>