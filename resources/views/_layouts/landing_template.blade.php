<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="icon" href="data:image/png;base64,{{ $profilApp->pict }}">
   <title>{{ $profilApp->value_2 }}</title>

   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
   <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
   <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.min.css') }}">
   @yield('headerCSSLand')
</head>

<body class="hold-transition layout-top-nav">
   <div class="wrapper">

      <nav class="main-header navbar navbar-expand-md navbar-light navbar-white {{ $styleApp->value_3 }}">
         <div class="container">
            <a href="{{ route('/') }}" class="navbar-brand">
               <img src="data:image/png;base64,{{ $profilApp->pict }}" alt="Logo Perusahaan" class="brand-image img-circle elevation-3"
                  style="opacity: .8">
               <span class="brand-text font-weight-light">{{ $profilApp->value_2 }}</span>
            </a>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
               <ul class="navbar-nav">
                  <li class="nav-item">
                     @if (auth()->check())
                        <a href="{{ route('/') }}" class="nav-link">Happy Shoping <b>"<u>{{ auth()->user()->userData()->nama }}</u>"</b></a>
                     @endif
                  </li>
               </ul>
            </div>

            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
               @if (!auth()->check())
                  <li class="nav-item">
                     <button type="button" data-mode="addUser" data-id="0" class="userDataa nav-link btn btn-{{ $styleApp->value_10 }} mr-2"
                        data-toggle="modal" data-target="#modalForm">
                        <b> Daftar </b>
                     </button>
                  </li>
                  <li class="nav-item">
                     <button type="button" data-mode="loginUser" data-id="0" class="userDataa nav-link btn btn-{{ $styleApp->value_10 }}"
                        data-toggle="modal" data-target="#modalForm">
                        <b> Masuk </b>
                     </button>
                  </li>
               @else
                  <li class="nav-item">
                     <a href="{{ route('/') }}" class="nav-link"><b>Home</b></a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('keranjang') }}" class="nav-link"><b>Keranjang</b></a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('logout_pengguna') }}" class="nav-link"><b>Keluar</b></a>
                  </li>
               @endif
            </ul>
         </div>
      </nav>

      <div class="content-wrapper">
         <div class="content-header">
            <div class="container">
               <div class="row mb-2">
                  {{-- <div class="col-sm-6">
                     <h1 class="m-0"> </h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layout</a></li>
                     </ol>
                  </div> --}}
               </div>
            </div>
         </div>

         <div class="content">
            <div class="container">
               @include('components.alert_card')
               @yield('bodyLand')

               <div id="preLoadJs" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
                  <div class="text-center">
                     <div class="spinner-grow text-warning" role="status">
                        <span class="visually-hidden"></span>
                     </div>
                  </div>
               </div>

               <div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                     <div class="modal-content" id="modalUser">

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <footer class="main-footer">
         <div class="float-right d-none d-sm-inline">
         </div>
         <strong>{{ $profilApp->value_12 }}</strong>
      </footer>
   </div>

   <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
   <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
   <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>

   @yield('footerJSLand')

   <script>
      $('.userDataa').click(function() {
         var id1 = $(this).attr("data-mode");
         var id2 = $(this).attr("data-id");

         $.ajax({
            url: "{{ url('landing/vm_daftar') }}/" + id1 + '/' + id2,
            type: "GET",
            beforeSend: function() {
               $('#preLoadJs').show();
            },
            success: function(data) {
               $('#modalUser').html(data);
            },
            complete: function() {
               $('#preLoadJs').hide();
            },
         });
      });
   </script>

   <script type="text/javascript">
      function preview_image(event) {
         var id = event.target.id;
         var reader = new FileReader();
         reader.onload = function() {
            var output = document.getElementById(id);
            output.src = reader.result;
            // output.setAttribute('width', '100px');
            // output.setAttribute('height', '100px');
         }
         reader.readAsDataURL(event.target.files[0]);
      }
   </script>

   <script>
      $(function() {
         var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
         });
         @if (session('success'))
            toastr.success('{!! session('success') !!}')
         @elseif (session('info'))
            toastr.info('{!! session('info') !!}')
         @elseif (session('danger'))
            toastr.error('{!! session('danger') !!}')
         @elseif (session('warning'))
            toastr.warning('{!! session('warning') !!}')
         @elseif ($errors->any())
            @foreach ($errors->all() as $error)
               toastr.error('{{ $error }}')
            @endforeach
         @endif
      });
   </script>
</body>

</html>
