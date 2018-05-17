<!--begin::Web font -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
    WebFont.load({
        google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
        active: function () {
            sessionStorage.fonts = true;
        }
    });
</script>
<!--end::Web font -->

<!--begin::Base Styles -->
<link rel="stylesheet" type="text/css" href="{!! \URLHelper::asset('metronic/vendors/base/vendors.bundle.css', 'admin') !!}">
<link rel="stylesheet" type="text/css" href="{!! \URLHelper::asset('metronic/demo/default/base/style.bundle.css', 'admin') !!}">
<!--end::Base Styles -->

