@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="message"></div>
    <div class="container-fluid">
        <form class="saveForm" data-storeURL="{{ route('admin.client.update', $client->id) }}">
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">                             
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="full_name">Full Name</label>
                                        <input type="text" name="full_name" id="full_name" value="{{ $client->full_name }}" class="form-control" placeholder="Full Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="father_name">Father Name</label>
                                        <input type="text" name="father_name" id="father_name" value="{{ $client->father_name }}" class="form-control" placeholder="Father Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="mother_name">Mother Name</label>
                                        <input type="text" name="mother_name" id="mother_name" value="{{ $client->mother_name }}" class="form-control" placeholder="Mother Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="male" {{ ($client->gender == 'male') ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ ($client->gender == 'female') ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ ($client->gender == 'other') ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" value="{{ $client->dob }}" id="dob" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="passport_number">Passport Number</label>
                                        <input type="number" name="passport_number" value="{{ $client->passport_number }}" id="passport_number" class="form-control" placeholder="Passport Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="issue_date">Issue Date</label>
                                        <input type="date" name="issue_date" value="{{ $client->issue_date }}" id="issue_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="expiry_date">Expiry Date</label>
                                        <input type="date" name="expiry_date" value="{{ $client->expiry_date }}" id="expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="id_expiry_date">ID Expiry Date</label>
                                        <input type="date" name="id_expiry_date" value="{{ $client->id_expiry_date }}" id="id_expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" name="phone_number" value="{{ $client->phone_number }}" id="phone_number" class="form-control" placeholder="Phone Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ $client->email }}" class="form-control" placeholder="Email">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="school_level">School Level</label>
                                        <input type="text" name="school_level" id="school_level" value="{{ $client->school_level }}" class="form-control" placeholder="School Level">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="job_id">Job</label>
                                        <select class="form-control" name="job_id" id="job_id">
                                            <option value="">Select Job</option>
                                            @forelse($jobs as $job)
                                            <option value="{{ $job->id }}" {{ ($client->job_id == $job->id ) ? 'selected' : '' }}>{{ $job->job_name }}</option>
                                            @empty
                                            <option>No Record Found</option>
                                            @endforelse
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="police_certificate_issue_date">Police Certificate Issue Date</label>
                                        <input type="date" name="police_certificate_issue_date" value="{{ $client->police_certificate_issue_date }}" id="police_certificate_issue_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                @if(auth()->user()->role == 1)
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="user_id">Agent Name</label>
                                        <select class="form-control" name="user_id" id="user_id">
                                            <option value="">Select Agent</option>
                                            @forelse($agents as $agent)
                                            <option value="{{ $agent->id }}" {{ ($client->user_id == $agent->id ) ? 'selected' : '' }}>{{ $agent->name }}</option>
                                            @empty
                                            <option>No Record Found</option>
                                            @endforelse
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                @endif
                                @if(auth()->user()->role == 2)
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @endif
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="application_date">Application Date</label>
                                        <input type="date" name="application_date" id="application_date" value="{{ $client->application_date }}" class="form-control">
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
@endsection