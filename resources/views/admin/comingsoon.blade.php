@extends('_layouts.app_template')
@section('body')
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-{{ $styleApp->value_10 }}">
            <div class="card-body bg-{{ $styleApp->value_10 }}">
               <p style="font-size: 40px">
                  Coming Soon
               </p>
            </div>
         </div>
      </div>
   </div>
@endsection
