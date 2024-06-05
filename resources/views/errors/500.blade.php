@extends('_layouts.main')

@section('content')

<div class="row">
    <div class="col-sm-12 text-center">

        <div class="wrapper-page">
            <img src="{{ asset('zircos') }}/assets/images/animat-rocket-color.gif" alt="" height="240">
            <h1 style="font-size: 78px;">500</h1>
            <h3 class="text-uppercase text-danger">Internal Server Error</h3>
            <p class="text-muted mb-2">Why not try refreshing your page? or you can contact <a class="text-primary">support</a></p>

            <a class="btn btn-success waves-effect waves-light m-t-20" href="{{ url()->previous() }}"> Return Home</a>
        </div>

    </div>
</div>

@endsection