<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!--===============================================================================================-->
   <link rel="icon" href="data:image/png;base64,{{ $profilApp->pict }}">
   <title>{{ $profilApp->value_2 }}</title>
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/vendor/bootstrap/css/bootstrap.min.css') }}">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/vendor/animate/animate.css') }}">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/vendor/css-hamburgers/hamburgers.min.css') }}">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/vendor/animsition/css/animsition.min.css') }}">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/vendor/select2/select2.min.css') }}">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/vendor/daterangepicker/daterangepicker.css') }}">
   <!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/css/util.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('login1/css/main.css') }}">
   <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

   <div class="limiter">
      <div class="container-login100">
         <div class="wrap-login100">

            <form class="login100-form validate-form" action="{{ route('login') }}" method="post" autocomplete="off">
               @csrf

               <span class="login100-form-title p-b-43">
                  Masuk untuk memulai sesi
               </span>

               <code>
                  @if (session('dangerCard'))
                     {!! session('dangerCard') !!}
                  @elseif (session('infoCard'))
                     {!! session('infoCard') !!}
                  @elseif (session('warningCard'))
                     {!! session('warningCard') !!}
                  @elseif (session('successCard'))
                     {!! session('successCard') !!}
                  @elseif ($errors->any())
                     <ul class="list-group">
                        @foreach ($errors->all() as $error)
                           <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                     </ul>
                  @endif

               </code>

               @error('username')
                  <code>{{ $message }}</code>
               @enderror

               <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="text" value="{{ old('username') }}" name="username" required autofocus>
                  <span class="focus-input100"></span>
                  <span class="label-input100">Username</span>
               </div>

               @error('password')
                  <code>{{ $message }}</code>
               @enderror

               <div class="wrap-input100 validate-input" data-validate="Password is required">
                  <input class="input100" type="password" name="password" required>
                  <span class="focus-input100"></span>
                  <span class="label-input100">Kata Sandi</span>
               </div>

               <div class="flex-sb-m w-full p-t-3 p-b-32">
                  <div class="contact100-form-checkbox">
                     <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                     <label class="label-checkbox100" for="ckb1">
                        Ingat Saya
                     </label>
                  </div>
               </div>


               <div class="container-login100-form-btn">
                  <button class="login100-form-btn">
                     Masuk
                  </button>
               </div>

            </form>

            <div class="login100-more" style="background-image: url('{{ asset('login1/images/bg-01.jpg') }}');">
            </div>
         </div>
      </div>
   </div>





   <!--===============================================================================================-->
   <script src="{{ asset('login1/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
   <!--===============================================================================================-->
   <script src="{{ asset('login1/vendor/animsition/js/animsition.min.js') }}"></script>
   <!--===============================================================================================-->
   <script src="{{ asset('login1/vendor/bootstrap/js/popper.js') }}"></script>
   <script src="{{ asset('login1/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
   <!--===============================================================================================-->
   <script src="{{ asset('login1/vendor/select2/select2.min.js') }}"></script>
   <!--===============================================================================================-->
   <script src="{{ asset('login1/vendor/daterangepicker/moment.min.js') }}"></script>
   <script src="{{ asset('login1/vendor/daterangepicker/daterangepicker.js') }}"></script>
   <!--===============================================================================================-->
   <script src="{{ asset('login1/vendor/countdowntime/countdowntime.js') }}"></script>
   <!--===============================================================================================-->
   <script src="{{ asset('login1/js/main.js') }}"></script>

</body>

</html>
