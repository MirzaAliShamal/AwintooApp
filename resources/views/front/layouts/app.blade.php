@extends('front.layouts.master')
@section('content')
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gy-5 gx-4">
          @include('front.partials.sidebar')
      @yield('panel')
    </div>
  </div>
</div>
@endsection