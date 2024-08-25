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
        <form class="saveForm" data-storeURL="{{ route('admin.appointment.store') }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">                             
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="client_id">Client ID</label>
                                        <select class="form-control" name="client_id" id="client_id">
                                            <option value="">Select Client</option>
                                            @forelse($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->unique_id_number }} - {{ $client->full_name }}</option>
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
                                        <input type="text" id="client_name" disabled class="form-control" placeholder="Client Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="location">Location</label>
                                        <input type="text" id="location" name="location" class="form-control" placeholder="Location">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="type_of_appointment">Choose Type of Appointment</label>
                                        <select name="type_of_appointment" id="type_of_appointment" class="form-control" required>
                                            <option value="">Select Appointment Type</option>
                                            <option value="Interview appointment">Interview appointment</option>
                                            <option value="In deep interview by embassy">In deep interview by embassy</option>
                                            <option value="Re interview">Re interview</option>
                                            <option value="Doctor appointment">Doctor appointment</option>
                                            <option value="Immigration appointment">Immigration appointment</option>
                                            <option value="School appointment">School appointment</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12" id="other_details_container" style="display: none;">
                                    <div class="mb-3">
                                        <label for="other_details">Other Details</label>
                                        <textarea name="other_details" id="other_details" class="form-control" rows="4" placeholder="Provide details if appointment type is 'Others'"></textarea>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="appointment_date">Appointment Date</label>
                                        <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="appointment_time">Appointment Time</label>
                                        <input type="time" name="appointment_time" id="appointment_time" class="form-control" required>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                        
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-dark">Save</button>
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
