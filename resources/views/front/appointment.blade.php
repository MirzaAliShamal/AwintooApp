@extends('front.layouts.app')
@section('panel')
<div class="col-lg-8">
    <div class="mt-2">
        <h4>Appointments</h4>
    </div>
 <table class="table table-bordered text-center">
    <tr>
        <th>Appointment Name</th>
        <th>Location</th>
        <th>Others</th>
        <th>Time</th>
        <th>Date</th>
        <th>Status</th>
    </tr>
    <tbody>
        @forelse($appointments as $row)
        <tr>
            <td>{{ $row->type_of_appointment }}</td>
            <td>{{ $row->location }}</td>
            <td>{{ $row->other_details }}</td>
            <td>{{ \Carbon\Carbon::parse($row->appointment_time)->format('g:i A') }}</td>
            <td>{{ \Carbon\Carbon::parse($row->appointment_date)->format('d-m-Y') }}</td>
            <td>
                @php
                    $appointmentDate = \Carbon\Carbon::parse($row->appointment_date);
                @endphp

                @if($appointmentDate->isToday())
                    <span class="bg-primary text-white rounded p-1">Today</span>
                @else
                    <span class="bg-info text-white rounded p-1">Upcoming</span>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="4">Record Not Found</td></tr>
        @endforelse
    </tbody>
 </table>
</div>
@endsection