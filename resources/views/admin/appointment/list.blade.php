@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.appointment.create') }}" class="btn btn-outline-dark">Add Appointment</a>
                <a href="{{ route('admin.appointment.deleteExpireAppointment') }}" class="btn btn-outline-danger">Delete Expires Appointment</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
    <div class="message"></div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="card">
        <div class="card-body table-responsive">                                 
            <table id="datatable" class="table table-hover text-nowrap text-center">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Appointment Type</th>
                        <th>Location</th>
                        <th>Others</th>
                        <th>Appointment Time</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @forelse($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->full_name }}</td>
                        <td>{{ $appointment->type_of_appointment }}</td>
                        <td>{{ $appointment->location }}</td>
                        <td>{{ $appointment->other_details }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}</td>
                        <td>
                        @php
                            $appointmentDate = \Carbon\Carbon::parse($appointment->appointment_date);
                        @endphp

                        @if($appointmentDate->isToday())
                            <span class="badge badge-success">Today</span>
                        @elseif($appointmentDate->isPast())
                            <span class="badge badge-danger">Expired</span>
                        @else
                            <span class="badge badge-primary">Upcoming</span>
                        @endif
                        </td>
                        <td>
                           {{--  <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.appointment.edit', $appointment->id) }}">
                                <i class="fa fa-pen"></i>
                            </a> --}}
                            <a href="#" data-destroy="{{ route('admin.appointment.destroy', $appointment->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Record not found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>  
            <div class="mt-2">
                {{ $appointments->links() }}
            </div>                              
        </div>
    </div>
</div>
</section>
@endsection