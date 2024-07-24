<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\RestInfoImport;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;

class RestInfoImport implements ToCollection, WithHeadingRow, WithValidation
{
     public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if ($row->filter()->isEmpty()) continue;

            // Convert dates from d/m/Y to Y-m-d
            $driverLicenseIssueDate = Carbon::createFromFormat('d/m/Y', $row['driver_licence_issue_date'])->format('Y-m-d');
            $driverLicenseExpiryDate = Carbon::createFromFormat('d/m/Y', $row['driver_license_expiry_date'])->format('Y-m-d');
            $policeCertificateExpiryDate = Carbon::createFromFormat('d/m/Y', $row['police_certificate_expiry_date'])->format('Y-m-d');
            $interviewDate = Carbon::createFromFormat('d/m/Y', $row['interview_date'])->format('Y-m-d');
            $insuranceExpiryDate = Carbon::createFromFormat('d/m/Y', $row['insurance_expiry_date'])->format('Y-m-d');

            RestInfoImport::updateOrCreate(
                ['client_id' => $row['client_id']], 
                [
                    'body_size' => $row['body_size'],
                    'phone_type' => $row['phone_type'],
                    'name_with_vietnam_characters' => $row['name_with_vietnam_characters'],
                    'job_apply' => $row['job_apply'],
                    'training_program' => $row['training_program'],
                    'system_email' => $row['system_email'],
                    'english_characters_living_address' => $row['english_characters_living_address'],
                    'vietnam_living_address' => $row['vietnam_living_address'],
                    'bank_in_vn' => $row['bank_in_vn'],
                    'country_to_go' => $row['country_to_go'],
                    'school_diploma' => $row['school_diploma'],
                    'original_english_legalizedFM_equalize' => $row['original_english_legalizedFM_equalize'],
                    'driver_licence_issue_date' => $driverLicenseIssueDate,
                    'driver_license_expiry_date' => $driverLicenseExpiryDate,
                    'photo' => $row['photo'], 
                    'video_working_link' => $row['video_working_link'],
                    'police_certificate_expiry_date' => $policeCertificateExpiryDate,
                    'visa_application_number' => $row['visa_application_number'],
                    'interview_date' => $interviewDate,
                    'insurance_type' => $row['insurance_type'],
                    'insurance_expiry_date' => $insuranceExpiryDate,
                    'amount_paid' => $row['amount_paid'],
                    'balance_amount' => $row['balance_amount'],
                    'document_to_upload' => $row['document_to_upload'], 
                    'working_place' => $row['working_place'],
                    'address_abroad' => $row['address_abroad'],
                    'phone_abroad' => $row['phone_abroad'],
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'client_id' => 'required|exists:clients,id',
            'body_size' => 'required|string|max:255',
            'phone_type' => 'required|string|max:255',
            'name_with_vietnam_characters' => 'required|string|max:255',
            'job_apply' => 'required|string|max:255',
            'training_program' => 'nullable|string|max:255',
            'system_email' => 'required|email|max:255',
            'english_characters_living_address' => 'required|string',
            'vietnam_living_address' => 'required|string',
            'bank_in_vn' => 'required|in:yes,no',
            'country_to_go' => 'required|string|max:255',
            'school_diploma' => 'required|string|max:255',
            'original_english_legalizedFM_equalize' => 'nullable|string|max:255',
            'driver_licence_issue_date' => 'required|date_format:d/m/Y',
            'driver_license_expiry_date' => 'required|date_format:d/m/Y',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_working_link' => 'nullable|url',
            'police_certificate_expiry_date' => 'required|date_format:d/m/Y',
            'visa_application_number' => 'required|numeric',
            'interview_date' => 'required|date_format:d/m/Y',
            'insurance_type' => 'required|string|max:255',
            'insurance_expiry_date' => 'required|date_format:d/m/Y',
            'amount_paid' => 'required|numeric|min:0',
            'balance_amount' => 'required|numeric|min:0',
            'document_to_upload' => 'nullable|file|max:2048',
            'working_place' => 'required|string|max:255',
            'address_abroad' => 'required|string',
            'phone_abroad' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'driver_licence_issue_date.date_format' => 'The driver license issue date must be in the format d/m/Y.',
            'driver_license_expiry_date.date_format' => 'The driver license expiry date must be in the format d/m/Y.',
            'police_certificate_expiry_date.date_format' => 'The police certificate expiry date must be in the format d/m/Y.',
            'interview_date.date_format' => 'The interview date must be in the format d/m/Y.',
            'insurance_expiry_date.date_format' => 'The insurance expiry date must be in the format d/m/Y.',
        ];
    }
}

