<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="icon" href="data:image/png;base64,{{ $profilApp->pict }}">
   <title>{{ $profilApp->value_2 }}</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <div class="container-fluid">
         <a class="navbar-brand" href="#"> &emsp; </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">{{ $profilApp->value_2 }}</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('/') }}">Home</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>

   <div class="container-fluid">
      @if (session('dangerCard'))
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! session('dangerCard') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      @elseif (session('infoCard'))
         <div class="alert alert-info alert-dismissible fade show" role="alert">
            {!! session('infoCard') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      @elseif (session('warningCard'))
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {!! session('warningCard') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      @elseif (session('successCard'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('successCard') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      @elseif ($errors->any())
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul class="list-group">
               @foreach ($errors->all() as $error)
                  <li class="list-group-item">{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif
      @yield('body')
   </div>

   <div id="preLoadJs" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
      <div class="text-center">
         <div class="spinner-grow text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous">
   </script>

   @yield('ownScript')

</body>

</html>
