@extends('front.layouts.app')
@section('panel')
<div class="col-lg-8">
 <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Body Size</td>
                <td>{{ $client->restInfo->body_size }}</td>
                <td>Phone Type</td>
                <td>{{ $client->restInfo->phone_type }}</td>
            </tr>
            <tr>
                <td>Job Apply</td>
                <td>{{ $client->restInfo->job_apply }}</td>
                <td>Name with Vietnam Characters</td>
                <td>{{ $client->restInfo->name_with_vietnam_characters }}</td>
            </tr>
            <tr>
                <td>Training Program</td>
                <td>{{ $client->restInfo->training_program }}</td>
                <td>System Email</td>
                <td>{{ $client->restInfo->system_email }}</td>
            </tr>
            <tr>
                <td>English Characters Living Address</td>
                <td>{{ $client->restInfo->english_characters_living_address }}</td>
                <td>Vietnam Living Address</td>
                <td>{{ $client->restInfo->vietnam_living_address }}</td>
            </tr>
            <tr>
                <td>Bank in Vietnam</td>
                <td>{{ $client->restInfo->bank_in_vn }}</td>
                <td>Country To Go</td>
                <td>{{ $client->restInfo->country_to_go }}</td>
            </tr>
            <tr>
                <td>School Diploma</td>
                <td>{{ $client->restInfo->school_diploma }}</td>
                <td>Original English LegalizedFM Equalize</td>
                <td>{{ $client->restInfo->original_english_legalizedFM_equalize }}</td>
            </tr>
            <tr>
                <td>Driver Licence Issue Date</td>
                <td>{{ $client->restInfo->driver_licence_issue_date }}</td>
                <td>Driver License Expiry Date</td>
                <td>{{ $client->restInfo->driver_license_expiry_date }}</td>
            </tr>
            <tr>
                <td>Photo</td>
                <td><img src="{{ getImage(getFilePath('restInfoPhoto'). '/' .$client->restInfo->photo) }}" alt="Client Photo"></td>
                <td>Video Working Link</td>
                <td>{{ $client->restInfo->video_working_link }}</td>
            </tr>
            <tr>
                <td>Police Certificate Expiry Date</td>
                <td>{{ $client->restInfo->police_certificate_expiry_date }}</td>
                <td>Visa Application Number</td>
                <td>{{ $client->restInfo->visa_application_number }}</td>
            </tr>
            <tr>
                <td>Interview Date</td>
                <td>{{ $client->restInfo->interview_date }}</td>
                <td>Insurance Type</td>
                <td>{{ $client->restInfo->insurance_type }}</td>
            </tr>
            <tr>
                <td>Insurance Expiry Date</td>
                <td>{{ $client->restInfo->insurance_expiry_date }}</td>
                <td>Amount Paid</td>
                <td>{{ $client->restInfo->amount_paid }}</td>
            </tr>
            <tr>
                <td>Balance Amount</td>
                <td>{{ $client->restInfo->balance_amount }}</td>
                <td>Document To Upload</td>
                <td>{{ $client->restInfo->document_to_upload }}</td>
            </tr>
            <tr>
                <td>Working Place</td>
                <td>{{ $client->restInfo->working_place }}</td>
                <td>Address Abroad</td>
                <td>{{ $client->restInfo->address_abroad }}</td>
            </tr>
            <tr>
                <td>Phone Abroad</td>
                <td>{{ $client->restInfo->phone_abroad }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection