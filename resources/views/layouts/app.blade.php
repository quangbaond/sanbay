<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} {{ isset($title) ? $title : '' }}</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="/css/style.css">
<!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = "{{ env('SMARTSUB_KEY') }}";
        window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
    </script>

</head>
<body>
    @yield('content')
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onload = function() {
            document.getElementById('amount').addEventListener('keyup', function() {
                var a = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                this.value = a;
            });
        }
    </script>
</body>
</html>