<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" href="data:image/png;base64,{{ $profilApp->pict }}">
   <title>{{ $profilApp->value_2 }}</title>

   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
   <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition login-page">

   @yield('body')

   <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
