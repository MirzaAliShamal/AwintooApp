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
                                            <option value="{{ $client->id }}">{{ $client->id }} - {{ $client->full_name }}</option>
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
                                        <label for="phone_type">Phone Type</label>
                                        <input type="text" name="phone_type" id="phone_type" class="form-control" placeholder="Phone Type">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name_with_vietnam_characters">Name with Vietnam Characters</label>
                                        <input type="text" name="name_with_vietnam_characters" id="name_with_vietnam_characters" class="form-control" placeholder="Name with Vietnam Characters">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="job_apply">Job Apply</label>
                                        <input type="text" name="job_apply" id="job_apply" class="form-control" placeholder="Job Apply">
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
                                        <input type="email" name="system_email" id="system_email" class="form-control" placeholder="System Email">
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
                                        <label for="vietnam_living_address">Vietnam Living Address</label>
                                        <input type="text" name="vietnam_living_address" id="vietnam_living_address" class="form-control" placeholder="Vietnam Living Address">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="bank_in_vn">Bank in VN</label>
                                        <select name="bank_in_vn" id="bank_in_vn" class="form-control">
                                            <option value="">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="country_to_go">Country to Go</label>
                                        <input type="text" name="country_to_go" id="country_to_go" class="form-control" placeholder="Country to Go">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="school_diploma">School Diploma</label>
                                        <input type="text" name="school_diploma" id="school_diploma" class="form-control" placeholder="School Diploma">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="original_english_legalizedFM_equalize">Original English Legalized FM Equalize</label>
                                        <input type="text" name="original_english_legalizedFM_equalize" id="original_english_legalizedFM_equalize" class="form-control" placeholder="Original English Legalized FM Equalize">
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
                                        <label for="photo">Photo</label>
                                        <input type="file" name="photo" id="photo" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="video_working_link">Video Working Link</label>
                                        <input type="text" name="video_working_link" id="video_working_link" class="form-control" placeholder="Video Working Link">
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
                                        <input type="text" name="visa_application_number" id="visa_application_number" class="form-control" placeholder="Visa Application Number">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="interview_date">Interview Date</label>
                                        <input type="date" name="interview_date" id="interview_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="insurance_type">Insurance Type</label>
                                        <input type="text" name="insurance_type" id="insurance_type" class="form-control" placeholder="Insurance Type">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="insurance_expiry_date">Insurance Expiry Date</label>
                                        <input type="date" name="insurance_expiry_date" id="insurance_expiry_date" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="amount_paid">Amount Paid</label>
                                        <input type="number" step="0.01" name="amount_paid" id="amount_paid" class="form-control" placeholder="Amount Paid">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="balance_amount">Balance Amount</label>
                                        <input type="number" step="0.01" name="balance_amount" id="balance_amount" class="form-control" placeholder="Balance Amount">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="document_to_upload">Document to Upload</label>
                                        <input type="file" name="document_to_upload" id="document_to_upload" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="working_place">Working Place</label>
                                        <input type="text" name="working_place" id="working_place" class="form-control" placeholder="Working Place">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="address_abroad">Address Abroad</label>
                                        <input type="text" name="address_abroad" id="address_abroad" class="form-control" placeholder="Address Abroad">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone_abroad">Phone Abroad</label>
                                        <input type="text" name="phone_abroad" id="phone_abroad" class="form-control" placeholder="Phone Abroad">
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
@endsection