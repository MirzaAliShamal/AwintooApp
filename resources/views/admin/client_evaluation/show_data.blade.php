@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div id="client-docs" class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.eavaluation.showDocs', $client->id) }}" class="btn btn-outline-dark">{{ $client->full_name }}`s Documents</a>
                <a href="{{ route('admin.eavaluation.index') }}" class="btn btn-outline-dark">Back</a>
                <a href="#rest-info" class="btn btn-outline-dark">Rest Information</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card p-4">
            <!-- Client Data -->
            <div class="row mb-4">
                <div class="col-sm-12">
                    <h4>Client Data</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Client ID</th>
                                <td>{{ $client->unique_id_number }}</td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $client->full_name }}</td>
                            </tr>
                            <tr>
                                <th>Father's Name</th>
                                <td>{{ $client->father_name }}</td>
                            </tr>
                            <tr>
                                <th>Mother's Name</th>
                                <td>{{ $client->mother_name }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ ucfirst($client->gender) }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ Carbon\Carbon::parse($client->dob)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Passport Number</th>
                                <td>{{ $client->passport_number }}</td>
                            </tr>
                            <tr>
                                <th>Issue Date</th>
                                <td>{{ Carbon\Carbon::parse($client->issue_date)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Expiry Date</th>
                                <td>{{ Carbon\Carbon::parse($client->expiry_date)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>ID Expiry Date</th>
                                <td>{{ Carbon\Carbon::parse($client->id_expiry_date)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>ID Number</th>
                                <td>{{ $client->id_number }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $client->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $client->email }}</td>
                            </tr>
                            <tr>
                                <th>School Level</th>
                                <td>{{ $client->school_level }}</td>
                            </tr>
                            <tr>
                                <th>Job ID</th>
                                <td>{{ $client->job->job_name }}</td>
                            </tr>
                            <tr>
                                <th>Police Certificate Issue Date</th>
                                <td>{{ Carbon\Carbon::parse($client->police_certificate_issue_date)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Agent Name</th>
                                <td>{{ $client->agent->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Rest Information -->
            @if ($client->restInfo)
                <div class="row">
                    <div class="col-sm-12">
                        <h4 id="rest-info">Rest Information</h4>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Body Size</th>
                                    <td>{{ $client->restInfo->body_size }}</td>
                                </tr>
                                <tr>
                                    <th>Name with Vietnam Characters</th>
                                    <td>{{ $client->restInfo->name_with_vietnam_characters }}</td>
                                </tr>
                                <tr>
                                    <th>Training Program</th>
                                    <td>
                                        @if (is_array($client->restInfo->practicePlace->practice_and_work_fields))
                                            {{ implode(', ', $client->restInfo->practicePlace->practice_and_work_fields) }}
                                        @else
                                            No fields selected
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>System Email</th>
                                    <td>{{ $client->restInfo->system_email }}</td>
                                </tr>
                                <tr>
                                    <th>Place of Birth</th>
                                    <td>{{ $client->restInfo->place_of_birth }}</td>
                                </tr>
                                <tr>
                                    <th>Nationality</th>
                                    <td>{{ $client->restInfo->nationality }}</td>
                                </tr>
                                <tr>
                                    <th>Marital Status</th>
                                    <td>{{ $client->restInfo->marital_status }}</td>
                                </tr>
                                <tr>
                                    <th>Spouse Name</th>
                                    <td>{{ $client->restInfo->spouse_name }}</td>
                                </tr>
                                <tr>
                                    <th>English Characters Living Address</th>
                                    <td>{{ $client->restInfo->english_characters_living_address }}</td>
                                </tr>
                                <tr>
                                    <th>Vietnam Living Address</th>
                                    <td>{{ $client->restInfo->vietnam_living_address }}</td>
                                </tr>
                                <tr>
                                    <th>Driver Licence Issue Date</th>
                                    <td>{{ Carbon\Carbon::parse($client->restInfo->driver_licence_issue_date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Driver License Expiry Date</th>
                                    <td>{{ Carbon\Carbon::parse($client->restInfo->driver_license_expiry_date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Police Certificate Expiry Date</th>
                                    <td>{{ Carbon\Carbon::parse($client->restInfo->police_certificate_expiry_date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Visa Application Number</th>
                                    <td>{{ $client->restInfo->visa_application_number }}</td>
                                </tr>
                                <tr>
                                    <th>Insurance Type</th>
                                    <td>{{ $client->restInfo->insurance_type }}</td>
                                </tr>
                                <tr>
                                    <th>Insurance Expiry Date</th>
                                    <td>{{ Carbon\Carbon::parse($client->restInfo->insurance_expiry_date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Amount Paid</th>
                                    <td>{{ $client->restInfo->amount_paid }}</td>
                                </tr>
                                <tr>
                                    <th>Balance Amount</th>
                                    <td>{{ $client->restInfo->balance_amount }}</td>
                                </tr>
                                <tr>
                                    <th>Working Place</th>
                                    <td>{{ $client->restInfo->working_place }}</td>
                                </tr>
                                <tr>
                                    <th>Address Abroad</th>
                                    <td>{{ $client->restInfo->address_abroad }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Abroad</th>
                                    <td>{{ $client->restInfo->phone_abroad }}</td>
                                </tr>
                                <tr>
                                    <th>Visa Number</th>
                                    <td>{{ $client->restInfo->visa_number }}</td>
                                </tr>
                                <tr>
                                    <th>Visa Issue Date</th>
                                    <td>{{ Carbon\Carbon::parse($client->restInfo->visa_issue_date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Visa Expiry Date</th>
                                    <td>{{ Carbon\Carbon::parse($client->restInfo->visa_expiry_date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Residence Permit Number</th>
                                    <td>{{ $client->restInfo->residence_permit_number }}</td>
                                </tr>
                                <tr>
                                    <th>Residence Permit Issue Date</th>
                                    <td>{{ Carbon\Carbon::parse($client->restInfo->residence_permit_issue_date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Residence Permit Expiry Date</th>
                                    <td>{{ Carbon\Carbon::parse($client->restInfo->residence_permit_expiry_date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Bank Account in EU</th>
                                    <td>{{ $client->restInfo->bank_account_in_eu }}</td>
                                </tr>
                                <tr>
                                    <th>Bank Name</th>
                                    <td>{{ $client->restInfo->bank_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
