<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;

class ClientsImport implements ToCollection, WithHeadingRow, WithValidation
{
   public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if ($row->filter()->isEmpty()) continue;

            // Ensure correct data extraction
            $dob = $this->convertExcelDate($row['dob']);
            $issueDate = $this->convertExcelDate($row['issue_date']);
            $expiryDate = $this->convertExcelDate($row['expiry_date']);
            $idExpiryDate = $this->convertExcelDate($row['id_expiry_date']);
            $policeCertIssueDate = $this->convertExcelDate($row['police_certificate_issue_date']);
            $applicationDate = $this->convertExcelDate($row['application_date']);

            $client = Client::updateOrCreate(
                ['id' => $row['id']],
                [
                    'full_name' => $row['full_name'],
                    'father_name' => $row['father_name'],
                    'mother_name' => $row['mother_name'],
                    'gender' => $row['gender'],
                    'dob' => $dob,
                    'passport_number' => $row['passport_number'],
                    'issue_date' => $issueDate,
                    'expiry_date' => $expiryDate,
                    'id_expiry_date' => $idExpiryDate,
                    'phone_number' => $row['phone_number'],
                    'email' => $row['email'],
                    'school_level' => $row['school_level'],
                    'job_id' => $row['job_id'],
                    'police_certificate_issue_date' => $policeCertIssueDate,
                    'agent_name' => $row['agent_name'],
                    'application_date' => $applicationDate,
                ]
            );
        }
    }

    private function convertExcelDate($excelDate)
    {

        try {
            return Carbon::createFromFormat('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excelDate)->format('Y-m-d'));
        } catch (\Exception $e) {
            return null; 
        }
    }

    public function rules(): array
    {
        return [
            'id' => 'integer',
            'full_name' => 'string',
            'father_name' => 'string',
            'mother_name' => 'string',
            'gender' => 'in:male,female,other',
            'dob' => 'nullable',
            'passport_number' => 'string|unique:clients,passport_number',
            'issue_date' => 'nullable',
            'expiry_date' => 'nullable',
            'id_expiry_date' => 'nullable',
            'phone_number' => 'integer',
            'email' => 'string|email|unique:clients,email',
            'school_level' => 'string',
            'job_id' => 'exists:jobs,id',
            'police_certificate_issue_date' => 'nullable',
            'agent_name' => 'string',
            'application_date' => 'nullable',
        ];
    }
}
