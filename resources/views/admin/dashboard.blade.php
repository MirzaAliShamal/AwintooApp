@extends('admin.layouts.app')
@section('panel')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $pageTitle }}</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $totalClients }}</h3>
                <p>Clients</p>
              </div>
              <a href="{{ route('admin.client.create') }}" class="small-box-footer">Add Client <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $totalInfo }}</h3>
                <p>Rest Information</p>
              </div>
              <a href="{{ route('admin.info.create') }}" class="small-box-footer">Add Rest Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @if(auth()->user()->role == 1)
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Admins / Agents</p>
              </div>
              <a href="{{ route('admin.user.create') }}" class="small-box-footer">Add Admin / Agents <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $totalJobs }}</h3>
                <p>Job</p>
              </div>
              <a href="{{ route('admin.job.create') }}" class="small-box-footer">Add Job <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endif
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $totalPayments }}</h3>
                <p>Payemnt</p>
              </div>
              <a href="{{ route('admin.payment.create') }}" class="small-box-footer">Add Payment <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection