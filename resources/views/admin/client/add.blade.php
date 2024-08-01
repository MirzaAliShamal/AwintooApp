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
        <form class="saveForm" data-storeURL="{{ route('admin.client.store') }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">                             
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="full_name">Full Name</label>
                                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="father_name">Father Name</label>
                                        <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Father Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="mother_name">Mother Name</label>
                                        <input type="text" name="mother_name" id="mother_name" class="form-control" placeholder="Mother Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" id="dob" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="passport_number">Passport Number</label>
                                        <input type="text" name="passport_number" id="passport_number" class="form-control" placeholder="Passport Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="issue_date">Issue Date</label>
                                        <input type="date" name="issue_date" id="issue_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="expiry_date">Expiry Date</label>
                                        <input type="date" name="expiry_date" id="expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_number">ID Number</label>
                                        <input type="number" name="id_number" id="id_number" class="form-control" placeholder="ID Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_expiry_date">ID Expiry Date</label>
                                        <input type="date" name="id_expiry_date" id="id_expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                        <p></p>
                                    </div>
                                </div>
                                @if(auth()->user()->role == 1)
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                                        <p></p>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="school_level">School Level</label>
                                        <select class="form-control" name="school_level" id="school_level">
                                            <option value="">Select School Level</option>
                                            <option value="Primary School">Primary School</option>
                                            <option value="Secondary School">Secondary School</option>
                                            <option value="High School">High School</option>
                                            <option value="Higher Education">Higher Education</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="job_id">Job</label>
                                        <select class="form-control" name="job_id" id="job_id">
                                            <option value="">Select Job</option>
                                            @forelse($jobs as $job)
                                            <option value="{{ $job->id }}">{{ $job->job_name }}</option>
                                            @empty
                                            <option>No Record Found</option>
                                            @endforelse
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="police_certificate_issue_date">Police Certificate Issue Date</label>
                                        <input type="date" name="police_certificate_issue_date" id="police_certificate_issue_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="application_date">Application Date</label>
                                        <input type="date" name="application_date" id="application_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                @if(auth()->user()->role == 1)
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="user_id">Agent Name</label>
                                         <select class="form-control" name="user_id" id="user_id">
                                            <option value="">Select Agent</option>
                                            @forelse($agents as $agent)
                                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                            @empty
                                            <option>Agent Not Found</option>
                                            @endforelse
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                @endif
                                @if(auth()->user()->role == 2)
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @endif

                                <div class="mt-2">
                                    <h3>Documents</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                        <label for="photo">Photo 3x4 cm with white background</label>
                                        <input type="file" name="photo" id="photo" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="photo_preview" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                        <label for="id_front">ID Card Front</label>
                                        <input type="file" name="id_front" id="id_front" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="id_front_photo" src="#" alt="Image preview" style="display:none; max-width: 60%; height: auto;">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                        <label for="id_back">ID Card Back</label>
                                        <input type="file" name="id_back" id="id_back" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="id_back_photo" src="#" alt="Image preview" style="display:none; max-width: 60%; height: auto;">
                                    </div>
                                    </div>
                                </div>
                                <div id="driver-fields" class="row" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                            <label for="license_front">Driver License Front</label>
                                            <input type="file" name="license_front" id="license_front" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            <img id="license_front_photo" src="#" alt="Image preview" style="display:none; max-width: 60%; height: auto;">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                            <label for="license_back">Driver License Back</label>
                                            <input type="file" name="license_back" id="license_back" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            <img id="license_back_photo" src="#" alt="Image preview" style="display:none; max-width: 60%; height: auto;">
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                        <label for="job_application_sign">Job Application Form Signed</label>
                                        <input type="file" name="job_application_sign" id="job_application_sign" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="job_application_sign_photo" src="#" alt="Image preview" style="display:none; max-width: 60%; height: auto;">
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                        <label for="passport_copy">Passport Copy</label>
                                        <input type="file" name="passport_copy" id="passport_copy" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="passport_copy_photo" src="#" alt="Image preview" style="display:none; max-width: 60%; height: auto;">
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                        <label for="police_certificate">Police Certificate</label>
                                        <input type="file" name="police_certificate" id="police_certificate" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="police_certificate_photo" src="#" alt="Image preview" style="display:none; max-width: 60%; height: auto;">
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                        <label for="school_certificate">School Certificate</label>
                                        <input type="file" name="school_certificate" id="school_certificate" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="school_certificate_photo" src="#" alt="Image preview" style="display:none; max-width: 60%; height: auto;">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                        <label for="bank_certificate">Bank Certificate</label>
                                        <input type="file" name="bank_certificate" id="bank_certificate" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="bank_certificate_photo" src="#" alt="Image preview" style="display:none; max-width: 60%; height: auto;">
                                    </div>
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
@endsection

@push('script')
<script>
$(document).ready(function() {
   $('#job_id').on('change', function() {
    var selectedOption = $(this).find('option:selected');
    var jobName = selectedOption.text().toLowerCase(); 
    if (jobName.includes('driver')) { 
        $('#driver-fields').show();
    } else {
        $('#driver-fields').hide();
    }
});

    function handleFilePreview(input, previewId) {
        $(input).on('change', function(event) {
            var file = event.target.files[0];
            var previewElement = $(previewId);
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var fileType = file.type;
                    if (fileType.startsWith('image/')) {
                        previewElement.attr('src', e.target.result).show();
                    } else {
                        previewElement.hide();
                    }
                };
                reader.readAsDataURL(file);
            } else {
                previewElement.hide();
            }
        });
    }
    handleFilePreview('#photo', '#photo_preview');
    handleFilePreview('#id_front', '#id_front_photo');
    handleFilePreview('#id_back', '#id_back_photo');
    handleFilePreview('#license_front', '#license_front_photo');
    handleFilePreview('#license_back', '#license_back_photo');
    handleFilePreview('#job_application_sign', '#job_application_sign_photo');
    handleFilePreview('#passport_copy', '#passport_copy_photo');
    handleFilePreview('#police_certificate', '#police_certificate_photo');
    handleFilePreview('#school_certificate', '#school_certificate_photo');
    handleFilePreview('#bank_certificate', '#bank_certificate_photo');
});
</script>
@endpush