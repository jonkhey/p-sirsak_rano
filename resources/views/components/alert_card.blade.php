@if (session('dangerCard'))
   <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {!! session('dangerCard') !!}
   </div>
@elseif (session('infoCard'))
   <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {!! session('infoCard') !!}
   </div>
@elseif (session('warningCard'))
   <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {!! session('warningCard') !!}
   </div>
@elseif (session('successCard'))
   <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {!! session('successCard') !!}
   </div>
@elseif ($errors->any())
   <ul class="list-group">
      @foreach ($errors->all() as $error)
         <li class="list-group-item list-group-item-danger">{{ $error }}</li>
      @endforeach
   </ul>
@endif
