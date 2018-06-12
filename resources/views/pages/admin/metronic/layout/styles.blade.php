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
<link href="{!! \URLHelper::asset('libs/metronic/css/final.css', 'common') !!}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{!! \URLHelper::asset('metronic/css/styles.css', 'admin') !!}">
<!--end::Base Styles -->

