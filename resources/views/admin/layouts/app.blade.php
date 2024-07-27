@extends('admin.layouts.master')
@section('content')
<div class="sidebar-mini layout-fixed">
  <div class="wrapper">
    <div id="loading-screen" style="display: none;">
      <div class="loading-content">
        <h2>Please wait...</h2>
      </div>
    </div>
    @include('admin.partials.navbar') 
    @include('admin.partials.sidebar')
    <div class="content-wrapper">
      @yield('panel')
    </div>
    @include('admin.partials.footer')
  </div>
</div>
@endsection