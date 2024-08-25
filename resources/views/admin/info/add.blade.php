@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.info.index') }}" class="btn btn-outline-dark">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="message"></div>
    <div class="container-fluid">
        <form class="saveForm" data-storeURL="{{ route('admin.info.store') }}">
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
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="body_size">Body Size</label>
                                        <input type="text" name="body_size" id="body_size" class="form-control" placeholder="Body Size">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name_with_vietnam_characters">Name in Mother Language</label>
                                        <input type="text" name="name_with_vietnam_characters" id="name_with_vietnam_characters" class="form-control" placeholder="Name with Vietnam Characters">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="training_program">Training Program</label>
                                        <input type="text" name="training_program" id="training_program" class="form-control" placeholder="Training Program">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="system_email">System Email</label>
                                        <input type="email" name="system_email" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="system_email" class="form-control" placeholder="System Email">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="place_of_birth">Place of Birth</label>
                                        <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" placeholder="Place of Birth">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nationality">Nationality</label>
                                        <input type="text" name="nationality" id="nationality" class="form-control" placeholder="Nationality">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="marital_status">Marital Status</label>
                                        <input type="text" name="marital_status" id="marital_status" class="form-control" placeholder="Marital Status">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="spouse_name">Spouse Name</label>
                                        <input type="text" name="spouse_name" id="spouse_name" class="form-control" placeholder="Spouse Name">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="english_characters_living_address">English Characters Living Address</label>
                                        <input type="text" name="english_characters_living_address" id="english_characters_living_address" class="form-control" placeholder="Living Address">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="vietnam_living_address">Currently Living Address</label>
                                        <input type="text" name="vietnam_living_address" id="vietnam_living_address" class="form-control" placeholder="Vietnam Living Address">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="driver_licence_issue_date">Driver Licence Issue Date</label>
                                        <input type="date" name="driver_licence_issue_date" id="driver_licence_issue_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="driver_license_expiry_date">Driver License Expiry Date</label>
                                        <input type="date" name="driver_license_expiry_date" id="driver_license_expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="police_certificate_expiry_date">Police Certificate Expiry Date</label>
                                        <input type="date" name="police_certificate_expiry_date" id="police_certificate_expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="visa_application_number">Visa Application Number</label>
                                        <input type="text" name="visa_application_number" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="visa_application_number" class="form-control" placeholder="Visa Application Number">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="insurance_type">Insurance Type</label>
                                        <input type="text" name="insurance_type" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="insurance_type" class="form-control" placeholder="Insurance Type">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="insurance_expiry_date">Insurance Expiry Date</label>
                                        <input type="date" name="insurance_expiry_date" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="insurance_expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="amount_paid">Amount Paid</label>
                                        <input type="number" step="0.01" name="amount_paid" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="amount_paid" class="form-control" placeholder="Amount Paid">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="balance_amount">Balance Amount</label>
                                        <input type="number" step="0.01" name="balance_amount" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="balance_amount" class="form-control" placeholder="Balance Amount">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="working_place">Working Place</label>
                                        <input type="text" name="working_place" id="working_place" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} class="form-control" placeholder="Working Place">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="address_abroad">Address Abroad</label>
                                        <input type="text" name="address_abroad" id="address_abroad" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} class="form-control" placeholder="Address Abroad">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="phone_abroad">Phone Abroad</label>
                                        <input type="text" name="phone_abroad" id="phone_abroad" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} class="form-control" placeholder="Phone Abroad">
                                        <p></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="visa_number">Visa Number</label>
                                        <input type="text" name="visa_number" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="visa_number" class="form-control" placeholder="Visa Number">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="visa_issue_date">Visa Issue Date</label>
                                        <input type="date" name="visa_issue_date" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="visa_issue_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="visa_expiry_date">Visa Expiry Date</label>
                                        <input type="date" name="visa_expiry_date" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="visa_expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="residence_permit_number">Residence Permit Number</label>
                                        <input type="text" name="residence_permit_number" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="residence_permit_number" class="form-control" placeholder="Residence Permit Number">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="residence_permit_issue_date">Residence Permit Issue Date</label>
                                        <input type="date" name="residence_permit_issue_date" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="residence_permit_issue_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="residence_permit_expiry_date">Residence Permit Expiry Date</label>
                                        <input type="date" name="residence_permit_expiry_date" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="residence_permit_expiry_date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="bank_account_in_eu">Bank Account in EU</label>
                                        <input type="text" name="bank_account_in_eu" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="bank_account_in_eu" class="form-control" placeholder="Bank Account in EU">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="bank_name">Bank Name</label>
                                        <input type="text" name="bank_name" {{ (auth()->user()->role == 2) ? 'disabled' : '' }} id="bank_name" class="form-control" placeholder="Bank Name">
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <h3>Documents To Upload</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="five_minutes_work_video">Video at least 5 minutes on working (Zip File Compressed)</label>
                                        <input type="file" name="five_minutes_work_video" id="five_minutes_work_video" accept=".zip" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="legalized_police_certificate">Foreign Ministry Legalized Police Certificate</label>
                                        <input type="file" name="legalized_police_certificate" id="legalized_police_certificate" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img id="police_certificate_photo" class="img-fluid img-thumbnail" src="#" alt="Image preview" style="display:none; max-width: 40%; height: auto;">
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="legalized_school_certificate">Foreign Ministry Legalized School Certificate</label>
                                        <input type="file" name="legalized_school_certificate" id="legalized_school_certificate" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img id="school_certificate_photo" src="#" class="img-fluid img-thumbnail" alt="Image preview" style="display:none; max-width: 40%; height: auto;">
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="legalized_driver_license">Foreign Ministry Legalized Driver Certificate</label>
                                        <input type="file" name="legalized_driver_license" id="legalized_driver_license" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img id="driver_license_photo" src="#" class="img-fluid img-thumbnail" alt="Image preview" style="display:none; max-width: 40%; height: auto;">
                                    </div>
                                </div>
                                
                                @if (auth()->user()->role == 1)
                                
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="resident_card_front">Resident Card Front</label>
                                        <input type="file" name="resident_card_front" id="resident_card_front" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img id="resident_card_front_photo" class="img-fluid img-thumbnail" src="#" alt="Image preview" style="display:none; max-width: 40%; height: auto;">
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="resident_card_back">Resident Card Back</label>
                                        <input type="file" name="resident_card_back" id="resident_card_back" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img id="resident_card_back_photo" class="img-fluid img-thumbnail" src="#" alt="Image preview" style="display:none; max-width: 40%; height: auto;">
                                    </div>
                                </div>
                                @endif
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
        handleFilePreview('#legalized_police_certificate', '#police_certificate_photo');
        handleFilePreview('#legalized_school_certificate', '#school_certificate_photo');
        handleFilePreview('#legalized_driver_license', '#driver_license_photo');
        handleFilePreview('#resident_card_front', '#resident_card_front_photo');
        handleFilePreview('#resident_card_back', '#resident_card_back_photo');
    });
</script>
@endpush