@extends('admin.layouts.master')
@section('content')
<div class="login-page">
  <div class="message"></div>
  <div class="login-box">
    <div class="card">
      <a href="#" class="mt-2 login-logo">
        {{ ($general->site_title) ? $general->site_title : 'Admin Login' }}
      </a>
      <div class="card-body login-card-body">
        <form class="saveForm" data-storeURL="{{ route('admin.login') }}">
          <div class="input-group mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <p></p>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <p></p>
          </div>
          {{-- <div class="d-flex flex-wrap justify-content-between">
            <div class="form-check me-3">
              <input class="form-check-input" name="remember" type="checkbox" id="remember">
              <label class="form-check-label" for="remember">Remember Me</label>
            </div>
          </div> --}}
          <div class="row">
            <div class="col-mb-4 mt-2">
              <button type="submit" class="btn btn-dark btn-block">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection