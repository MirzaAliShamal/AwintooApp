@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.appointment.index') }}" class="btn btn-outline-dark">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="message"></div>
    <div class="container-fluid">
        <form class="saveForm" data-storeURL="{{ route('admin.appointment.update', $appointment->id) }}">
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">                             
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="client_id">Client ID</label>
                                        <select class="form-control" name="client_id" id="client_id">
                                            @forelse($clients as $client)
                                            <option value="{{ $client->id }}" {{ ($appointment->client_id == $client->id) ? 'selected' : '' }}>{{ $client->unique_id_number }} - {{ $client->full_name }}
                                            </option>
                                            @empty
                                            <option>No Record Found</option>
                                            @endforelse
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="client_name">Client Name</label>
                                        <input type="text" id="client_name" value="{{ $appointment->client->full_name }}" disabled class="form-control" placeholder="Client Name">
                                        <p></p>
                                    </div>
                                </div>
                               <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="location">Location</label>
                                        <select id="location" name="location" class="form-control">
                                            <option value="">Choose a location</option>
                                            <option value="Romanian Embassy in Hanoi" {{ $appointment->location == 'Romanian Embassy in Hanoi' ? 'selected' : '' }}>Romanian Embassy in Hanoi</option>
                                            <option value="Romanian Embassy in Manila" {{ $appointment->location == 'Romanian Embassy in Manila' ? 'selected' : '' }}>Romanian Embassy in Manila</option>
                                            <option value="Romanian Embassy in UAE" {{ $appointment->location == 'Romanian Embassy in UAE' ? 'selected' : '' }}>Romanian Embassy in UAE</option>
                                            <option value="Romanian Embassy in Saudi Arabia" {{ $appointment->location == 'Romanian Embassy in Saudi Arabia' ? 'selected' : '' }}>Romanian Embassy in Saudi Arabia</option>
                                            <option value="ProTech Training Center Piatra Neamt" {{ $appointment->location == 'ProTech Training Center Piatra Neamt' ? 'selected' : '' }}>ProTech Training Center Piatra Neamt</option>
                                            <option value="ProTech Training Center Bucuresti" {{ $appointment->location == 'ProTech Training Center Bucuresti' ? 'selected' : '' }}>ProTech Training Center Bucuresti</option>
                                            <option value="ProTech Training Center Iasi" {{ $appointment->location == 'ProTech Training Center Iasi' ? 'selected' : '' }}>ProTech Training Center Iasi</option>
                                            <option value="ProTech Training Center Cluj" {{ $appointment->location == 'ProTech Training Center Cluj' ? 'selected' : '' }}>ProTech Training Center Cluj</option>
                                            <option value="ProTech Training Center Mehedinti" {{ $appointment->location == 'ProTech Training Center Mehedinti' ? 'selected' : '' }}>ProTech Training Center Mehedinti</option>
                                            <option value="ProTech Service and Support" {{ $appointment->location == 'ProTech Service and Support' ? 'selected' : '' }}>ProTech Service and Support</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="type_of_appointment">Choose Type of Appointment</label>
                                        <select name="type_of_appointment" id="type_of_appointment" class="form-control" required>
                                            <option value="">Select Appointment Type</option>
                                            <option value="Interview appointment" {{ $appointment->type_of_appointment == 'Interview appointment' ? 'selected' : '' }}>Interview appointment</option>
                                            <option value="In deep interview by embassy" {{ $appointment->type_of_appointment == 'In deep interview by embassy' ? 'selected' : '' }}>In deep interview by embassy</option>
                                            <option value="Re interview" {{ $appointment->type_of_appointment == 'Re interview' ? 'selected' : '' }}>Re interview</option>
                                            <option value="Doctor appointment" {{ $appointment->type_of_appointment == 'Doctor appointment' ? 'selected' : '' }}>Doctor appointment</option>
                                            <option value="Immigration appointment" {{ $appointment->type_of_appointment == 'Immigration appointment' ? 'selected' : '' }}>Immigration appointment</option>
                                            <option value="School appointment" {{ $appointment->type_of_appointment == 'School appointment' ? 'selected' : '' }}>School appointment</option>
                                            <option value="Others" {{ $appointment->type_of_appointment == 'Others' ? 'selected' : '' }}>Others</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12" id="other_details_container" style="display: {{ $appointment->type_of_appointment == 'Others' ? 'block' : 'none' }};">
                                    <div class="mb-3">
                                        <label for="other_details">Other Details</label>
                                        <textarea name="other_details" id="other_details" class="form-control" rows="4" placeholder="Provide details if appointment type is 'Others'">{{ $appointment->other_details }}</textarea>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="appointment_date">Appointment Date</label>
                                        <input type="date" name="appointment_date" id="appointment_date" class="form-control" value="{{ $appointment->appointment_date }}" required>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="appointment_time">Appointment Time</label>
                                        <input type="time" name="appointment_time" id="appointment_time" class="form-control" value="{{ $appointment->appointment_time }}" required>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                        
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-dark">Update</button>
            </div>
        </form>
    </div>
</section>

@push('script')
<script>
    $('#type_of_appointment').on('change', function() {
        var otherDetailsContainer = $('#other_details_container');
        if ($(this).val() === 'Others') {
            otherDetailsContainer.show();
        } else {
            otherDetailsContainer.hide();
        }
    });
</script>
@endpush
@endsection
