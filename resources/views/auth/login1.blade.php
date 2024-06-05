@extends('_layouts.auth_template')
@section('body')
   <div class="login-box">
      <div class="card card-outline card-{{ $styleApp->value_10 }}">
         <div class="card-header text-center">
            <a href="#" class="h1">{{ $profilApp->value_1 }}</a>
         </div>
         <div class="card-body">
            <p class="login-box-msg">Masuk untuk memulai sesi</p>

            @include('components.alert_card')

            <form action="{{ route('login') }}" method="post" autocomplete="off">
               @csrf

               @error('username')
                  <code>{{ $message }}</code>
               @enderror
               <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Username" value="{{ old('username') }}" name="username" required autofocus>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-user"></span>
                     </div>
                  </div>
               </div>
               @error('password')
                  <code>{{ $message }}</code>
               @enderror
               <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Kata Sandi" name="password" required>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-8">
                     <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                           Ingat Saya
                        </label>
                     </div>
                  </div>
                  <div class="col-4">
                     <button type="submit" class="btn btn-{{ $styleApp->value_10 }} btn-block">Masuk</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection
