@extends('front.layouts.app')
@section('panel')
<div class="col-lg-8">
   <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <div class="mr-5"><b>Total Appointment <span class="float-right">({{ $totalAppointment }})</span></b></div>
        </div>
      </div>
    </div>
</div>
@endsection