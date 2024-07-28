@push('style')
<style>
    .rest-info-table th {
        color: #000;
    }
</style>
@endpush
@extends('front.layouts.app')
@section('panel')
<div class="col-lg-8">
    <div class="mt-2">
        <h4>Rest Information</h4>
    </div>
 <table class="table table-bordered rest-info-table">
    @if(!empty($client->restInfo))
        <tbody class="text-center">
            <tr>
                <th>Body Size</th>
                <td>{{ $client->restInfo->body_size }}</td>
                <th>Name with Vietnam Characters</th>
                <td>{{ $client->restInfo->name_with_vietnam_characters }}</td>
            </tr>
            <tr>
                <th>
                    <span class="text-danger">Interview Date</span><br>
                    <span class="text-danger">Interview Time</span>
                </th>
                <td>
                    {{ Carbon\Carbon::parse($client->restInfo->interview_date)->format('d-m-Y') }}<br>
                    {{ Carbon\Carbon::parse($client->restInfo->interview_date)->format('h:i A') }}
                </td>
                <th>Training Program</th>
                <td>{{ $client->restInfo->training_program }}</td>
            </tr>
            <tr>
                <th colspan="4">Driver License</th>
            </tr>
            <tr>
                <th>Driver Licence Issue Date</th>
                <td>{{ Carbon\Carbon::parse($client->restInfo->driver_licence_issue_date)->format('d-m-Y') }}</td>
                <th>Driver License Expiry Date</th>
                <td>{{ Carbon\Carbon::parse($client->restInfo->driver_license_expiry_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th colspan="4">Police Certificate & Visa Application</th>
            </tr>
            <tr>
                <th>Police Certificate Expiry Date</th>
                <td>{{ Carbon\Carbon::parse($client->restInfo->police_certificate_expiry_date)->format('d-m-Y') }}</td>
                <th>Visa Application Number</th>
                <td>{{ $client->restInfo->visa_application_number }}</td>
            </tr>
            <tr>
                <th colspan="4">Insurance</th>
            </tr>
            <tr>
                <th>Insurance Type</th>
                <td>{{ $client->restInfo->insurance_type }}</td>
                <th>Insurance Expiry Date</th>
                <td>{{ Carbon\Carbon::parse($client->restInfo->insurance_expiry_date)->format('d-m-Y') }}</td>
            </tr>
             
            <tr>
                <th colspan="2">System Email</th>
                <td colspan="2">{{ $client->restInfo->system_email }}</td>
            </tr>
            <tr>
                <th colspan="4">Living Address</th>
            </tr>
            <tr>
                <th>English Characters Living Address</th>
                <td>{{ $client->restInfo->english_characters_living_address }}</td>
                <th>Vietnam Living Address</th>
                <td>{{ $client->restInfo->vietnam_living_address }}</td>
            </tr>           
            <tr>
                <th colspan="4">Abroad Detail</th>
            </tr>
            <tr>
                <th>Working Place</th>
                <td>{{ $client->restInfo->working_place }}</td>
                <th>Address Abroad</th>
                <td>{{ $client->restInfo->address_abroad }}</td>
            </tr>
            <tr>
                <th colspan="2">Phone Abroad</th>
                <td colspan="2">{{ $client->restInfo->phone_abroad }}</td>
            </tr>
        </tbody>
    </table>
    @endif
</div>
@endsection