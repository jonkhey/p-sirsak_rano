@extends('_layouts.app_template')
@section('body')
   <div class="row">
      <div class="col-lg-12">
         <div class="card-body card card-{{ $styleApp->value_10 }} d-flex align-items-center justify-content-center">
            <div class="row">
               <div class="col-sm-3">
                  <img class="" src="data:image/png;base64,{{ $profilApp->pict }}" height="200" width="200" alt="logo">
               </div>
               <div class="col-sm-9" style="">
                  <h1><b> {{ $profilApp->value_1 }} </b></h1>
                  <br>
                  <h4>
                     {{ $profilApp->value_3 }}, {{ $profilApp->value_4 }}, {{ $profilApp->value_5 }}, {{ $profilApp->value_6 }},
                     {{ $profilApp->value_7 }}
                  </h4>
                  <h5>Nomor Telephone : {{ $profilApp->value_8 }}</h5>
                  <br>
                  <h4><b> {{ $profilApp->value_10 }} </b></h4>
               </div>
            </div>
         </div>
         <div class="card card-body bg-info d-flex align-items-center justify-content-center">
            <h1>Selamat Datang {{ auth()->user()->userData()->nama }}</h1>
         </div>
      </div>
   </div>
@endsection
