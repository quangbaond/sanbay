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
    <style>

    </style>
    </script>
</head>
<body>
    @yield('content')
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>