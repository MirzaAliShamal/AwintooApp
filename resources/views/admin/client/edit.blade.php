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
                                        <input type="text" name="passport_number" value="{{ $client->passport_number }}" id="passport_number" class="form-control" placeholder="Passport Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="issue_date">Issue Date</label>
                                        <input type="date" name="issue_date" value="{{ $client->issue_date }}" id="issue_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="expiry_date">Expiry Date</label>
                                        <input type="date" name="expiry_date" value="{{ $client->expiry_date }}" id="expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_number">ID Number</label>
                                        <input type="number" name="id_number" id="id_number" value="{{ $client->id_number }}" class="form-control" placeholder="ID Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                @if(auth()->user()->role == 1)
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                        <small>Leave empty if not want to change password</small>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="school_level">School Level</label>
                                        <select class="form-control" name="school_level" id="school_level">
                                            <option value="">Select School Level</option>
                                            <option value="Primary School" {{ ($client->school_level == 'Primary School') ? 'selected' : '' }}>Primary School</option>
                                            <option value="Secondary School" {{ ($client->school_level == 'Secondary School') ? 'selected' : '' }}>Secondary School</option>
                                            <option value="High School" {{ ($client->school_level == 'High School') ? 'selected' : '' }}>High School</option>
                                            <option value="Higher Education" {{ ($client->school_level == 'Higher Education') ? 'selected' : '' }}>Higher Education</option>
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
                                            <option value="{{ $job->id }}" {{ ($client->job_id == $job->id ) ? 'selected' : '' }}>{{ $job->job_name }}</option>
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
                                        <input type="date" name="police_certificate_issue_date" value="{{ $client->police_certificate_issue_date }}" id="police_certificate_issue_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="application_date">Application Date</label>
                                        <input type="date" name="application_date" id="application_date" value="{{ $client->application_date }}" class="form-control">
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

                                <div class="mt-2">
                                    <h3>Documents To Upload</h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="photo">Photo 3x4 cm with white background</label>
                                            <input type="file" name="photo" id="photo" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            @if (isset($client->photo) && !empty($client->photo) && $fileTypes['photo'] != 'pdf')
                                            <img id="photo_preview" src="{{ getImage(getFilePath('clientPhoto') . '/' . $client->photo) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                            @else
                                            <img id="photo_preview" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="id_front">ID Card Front</label>
                                            <input type="file" name="id_front" id="id_front" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            @if (isset($client->id_front) && !empty($client->id_front) && $fileTypes['id_front'] != 'pdf')
                                            <img id="id_front_photo" src="{{ getImage(getFilePath('id_front') . '/' . $client->id_front) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                            @else
                                            <img id="id_front_photo" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="id_back">ID Card Back</label>
                                            <input type="file" name="id_back" id="id_back" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            @if (isset($client->id_back) && !empty($client->id_back) && $fileTypes['id_back'] != 'pdf')
                                            <img id="id_back_photo" src="{{ getImage(getFilePath('id_back') . '/' . $client->id_back) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                            @else
                                            <img id="id_back_photo" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="driver-fields" class="row" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                                <label for="license_front">Driver License Front</label>
                                                <input type="file" name="license_front" id="license_front" class="form-control">
                                                <p></p>
                                            </div>
                                            <div class="col-md-6">
                                                @if (isset($client->license_front) && !empty($client->license_front) && $fileTypes['license_front'] != 'pdf')
                                                <img id="license_front_photo" src="{{ getImage(getFilePath('license_front') . '/' . $client->license_front) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                                @else
                                                <img id="license_front_photo" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                                <label for="license_back">Driver License Back</label>
                                                <input type="file" name="license_back" id="license_back" class="form-control">
                                                <p></p>
                                            </div>
                                            <div class="col-md-6">
                                                @if (isset($client->license_back) && !empty($client->license_back) && $fileTypes['license_back'] != 'pdf')
                                                <img id="license_back_photo" src="{{ getImage(getFilePath('license_back') . '/' . $client->license_back) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                                @else
                                                <img id="license_back_photo" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="job_application_sign">Job Application Form Signed</label>
                                            <input type="file" name="job_application_sign" id="job_application_sign" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            @if (isset($client->job_application_sign) && !empty($client->job_application_sign) && $fileTypes['job_application_sign'] != 'pdf')
                                            <img id="job_application_sign_photo" src="{{ getImage(getFilePath('job_application_sign') . '/' . $client->job_application_sign) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                            @else
                                            <img id="job_application_sign_photo" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="passport_copy">Passport Copy</label>
                                            <input type="file" name="passport_copy" id="passport_copy" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            @if (isset($client->passport_copy) && !empty($client->passport_copy) && $fileTypes['passport_copy'] != 'pdf')
                                            <img id="passport_copy_photo" src="{{ getImage(getFilePath('passport_copy') . '/' . $client->passport_copy) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                            @else
                                            <img id="passport_copy_photo" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="police_certificate">Police Certificate</label>
                                            <input type="file" name="police_certificate" id="police_certificate" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            @if (isset($client->police_certificate) && !empty($client->police_certificate) && $fileTypes['police_certificate'] != 'pdf')
                                            <img id="police_certificate_photo" src="{{ getImage(getFilePath('police_certificate') . '/' . $client->police_certificate) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                            @else
                                            <img id="police_certificate_photo" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="school_certificate">School Certificate</label>
                                            <input type="file" name="school_certificate" id="school_certificate" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            @if (isset($client->school_certificate) && !empty($client->school_certificate) && $fileTypes['school_certificate'] != 'pdf')
                                            <img id="school_certificate_photo" src="{{ getImage(getFilePath('school_certificate') . '/' . $client->school_certificate) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                            @else
                                            <img id="school_certificate_photo" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="bank_certificate">Bank Certificate</label>
                                            <input type="file" name="bank_certificate" id="bank_certificate" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            @if (isset($client->bank_certificate) && !empty($client->bank_certificate) && $fileTypes['bank_certificate'] != 'pdf')
                                            <img id="bank_certificate_photo" src="{{ getImage(getFilePath('bank_certificate') . '/' . $client->bank_certificate) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                            @else
                                            <img id="bank_certificate_photo" src="#" alt="Image preview" style="display:none; max-width: 30%; height: auto;">
                                            @endif
                                        </div>
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