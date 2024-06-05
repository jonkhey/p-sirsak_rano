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
   @yield('headerCSS')
</head>

<body
   class="hold-transition {{ $styleApp->value_12 ? 'layout-top-nav' : 'sidebar-mini layout-fixed ' . $styleApp->value_1 . ' ' . $styleApp->value_2 . ' ' . $styleApp->value_6 . ' ' . $styleApp->value_9 }}">
   <div class="wrapper">
      @if ($styleApp->value_11)
         <!-- Preloader -->
         <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="data:image/png;base64,{{ $profilApp->pict }}" alt="LogoLoading" height="60" width="60">
         </div>
      @endif

      @if ($styleApp->value_12)
         <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
               <a href="{{ route('/') }}" class="navbar-brand">
                  <img src="data:image/png;base64,{{ $profilApp->pict }}" alt="Logo Perusahaan" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                  <span class="brand-text font-weight-light">{{ $profilApp->value_2 }}</span>
               </a>

               <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                  <ul class="navbar-nav">
                     @foreach (getMenu() as $menuHeader)
                        @if ($menuHeader->is_detail == 0)
                           <li class="nav-item">
                              <a href="{{ route($menuHeader->url) }}" class="nav-link">{{ $menuHeader->menu_nama }}</a>
                           </li>
                        @else
                           <li class="nav-item dropdown">
                              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                 class="nav-link dropdown-toggle">{{ $menuHeader->menu_nama }}</a>
                              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                 @foreach (getSubMenu($menuHeader->menu_id) as $sm)
                                    <li><a href="{{ route($sm->url) }}" class="dropdown-item">{{ $sm->title }}</a></li>
                                 @endforeach
                              </ul>
                           </li>
                        @endif
                     @endforeach
                  </ul>
               </div>

               <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                  <li class="nav-item dropdown">
                     <a class="nav-link" data-toggle="dropdown" href="#">
                        <b> {{ auth()->user()->userData()->nama }} </b>
                     </a>
                     <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header"><strong>Konfigurasi</strong> </span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item">
                           <i class="fas fa-power-off mr-2"></i> Sign Out
                        </a>
                     </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                     </a>
                  </li>
                  <li class="nav-item"> &emsp; </li>
               </ul>
            </div>
         </nav>
      @else
         <nav class="main-header navbar navbar-expand navbar-white navbar-light {{ $styleApp->value_3 }}">
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
               </li>
               <li class="nav-item d-none d-sm-inline-block">
                  <a href="{{ route('/') }}" class="nav-link">Landing Page</a>
               </li>
            </ul>

            <ul class="navbar-nav ml-auto">
               <li class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                     <b> {{ auth()->user()->userData()->nama }}</b>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                     <span class="dropdown-item dropdown-header"><strong>Konfigurasi</strong> </span>
                     <div class="dropdown-divider"></div>
                     <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="fas fa-power-off mr-2"></i> Sign Out
                     </a>
                  </div>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                     <i class="fas fa-expand-arrows-alt"></i>
                  </a>
               </li>
               <li class="nav-item"> &emsp; </li>
            </ul>
         </nav>

         <aside class="main-sidebar elevation-4 {{ $styleApp->value_5 ?? 'sidebar-dark-primary' }}">
            <a href="{{ route('/') }}" class="brand-link {{ $styleApp->value_4 }}">
               <img src="data:image/png;base64,{{ $profilApp->pict }}" alt="Logo Apps" class="brand-image img-circle elevation-3"
                  style="opacity: .8">
               <span class="brand-text font-weight-light">{{ $profilApp->value_2 }}</span>
            </a>

            <div class="sidebar">
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img
                        src="{{ auth()->user()->userData()->image? 'data:image/png;base64,' .auth()->user()->userData()->image: asset('lte/dist/img/user.png') }}"
                        class="img-circle elevation-2" alt="User Image">

                  </div>
                  <div class="info">
                     <a href="#" class="d-block">{{ auth()->user()->username }}</a>
                  </div>
               </div>

               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column {{ $styleApp->value_7 }} {{ $styleApp->value_8 }}" data-widget="treeview"
                     role="menu" data-accordion="false">
                     @foreach (getMenu() as $menuHeader)
                        @if ($menuHeader->is_detail == 0)
                           <li class="nav-item">
                              <a href="{{ route($menuHeader->url) }}"
                                 class="nav-link {{ request()->is($menuHeader->url . '*') ? 'active' : '' }}">
                                 <i class="nav-icon {{ $menuHeader->icon }}"></i>
                                 <p> {{ $menuHeader->menu_nama }} </p>
                              </a>
                           </li>
                        @else
                           <li class="nav-item" id="aktivNavItem{{ $menuHeader->menu_id }}">
                              <a href="#" class="nav-link" id="aktivNavLink{{ $menuHeader->menu_id }}">
                                 <i class="nav-icon {{ $menuHeader->icon }}"></i>
                                 <p>
                                    {{ $menuHeader->menu_nama }}
                                    <i class="fas fa-angle-left right"></i>
                                 </p>
                              </a>
                              <ul class="nav nav-treeview">
                                 @php
                                    $cekMenuId = '';
                                 @endphp
                                 @foreach (getSubMenu($menuHeader->menu_id) as $sm)
                                    <li class="nav-item">
                                       <a href="{{ route($sm->url) }}" class="nav-link {{ request()->is($sm->url . '*') ? 'active' : '' }}">
                                          &nbsp; &nbsp;
                                          <i class="{{ $sm->icon }}"></i>
                                          &nbsp;
                                          <p>{{ $sm->title }}</p>
                                          @php
                                             $cekMenuId1 = request()->is($sm->url . '*') ? $sm->menu_id : '';
                                             if ($cekMenuId1 != '') {
                                                 $cekMenuId = $cekMenuId1;
                                             }
                                          @endphp
                                       </a>
                                    </li>
                                 @endforeach

                                 @if ($cekMenuId == $menuHeader->menu_id)
                                    <script>
                                       document.getElementById("aktivNavLink{{ $menuHeader->menu_id }}").classList.add("active");
                                       document.getElementById("aktivNavItem{{ $menuHeader->menu_id }}").classList.add("menu-open");
                                    </script>
                                 @endif
                              </ul>
                           </li>
                        @endif
                     @endforeach
                  </ul>
               </nav>
            </div>
         </aside>
      @endif

      <div class="content-wrapper">
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  {{-- <div class="col-sm-6">
                     <h1 class="m-0">Dashboard</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                     </ol>
                  </div> --}}
               </div>
            </div>
         </div>

         <div class="content">
            <div class="{{ $styleApp->value_12 ? 'container' : 'container-fluid' }}">
               <div id="preLoadJs" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
                  <div class="text-center">
                     <div class="spinner-grow text-warning" role="status">
                        <span class="visually-hidden"></span>
                     </div>
                  </div>
               </div>

               @yield('body')
            </div>
         </div>
      </div>

      <footer class="main-footer">
         <strong>{{ $profilApp->value_12 }}</strong>
         <div class="float-right d-none d-sm-inline-block">
         </div>
      </footer>
   </div>

   <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
   <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
   <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>

   @yield('footerJS')

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
