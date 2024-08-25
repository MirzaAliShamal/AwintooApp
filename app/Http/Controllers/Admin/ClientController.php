<?php

namespace App\Http\Controllers\Admin;

use Hash, Mail;
use App\Models\Job;
use App\Models\User;
use App\Models\Client;
use App\Mail\ClientCredsMail;
use Illuminate\Http\Request;
use App\Imports\ClientsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\ClientStatusUpdateMail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ClientAdditionalInformationMail;

class ClientController extends Controller
{
    public function generateMissingClientIds()
    {
        $clients = Client::where('unique_id_number', '')->get();
        foreach ($clients as $client) {
            $client->save();
        }
        return response()->json([
            'message' => 'Client IDs generated successfully!',
            'generated_count' => $clients->count(),
        ]);
    }
    
    public function index() 
    {
        $pageTitle = 'Clients';
        $user = auth()->user();
        if($user->role == 1) {
            $data = Client::orderBy('created_at', 'desc')->with('agent')->paginate(7);
        } else {
            $data = Client::orderBy('created_at', 'desc')->with('agent')->where('user_id', $user->id)->paginate(7);
        }
        return view('admin.client.list', compact('pageTitle', 'data'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        if ($query) {
            $clients = Client::with('job', 'agent')->where('full_name', 'like', "%$query%")->get();
        } else {
            $clients = Client::with('job', 'agent')->get();
        }
        return response()->json([
            'status' => true,
            'data' => $clients,
        ]);
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,csv',
        ]);

        if ($validator->passes()) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
            $path = public_path('uploads/'.$fileName);
            try {
                Excel::import(new ClientsImport, $path);
                return response()->json([
                    'status' => true,
                    'redirect' => route('admin.client.index'),
                    'message' => 'Saved',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function create() 
    {
        $pageTitle = 'Add';
        $jobs = Job::get();
        $agents = User::where('role', 2)->get();
        return view('admin.client.add', compact('pageTitle', 'jobs', 'agents'));
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'passport_number' => 'required|string|max:255|unique:clients',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'id_expiry_date' => 'required|date',
            'id_number' => 'required|string|unique:clients',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:clients',
            'school_level' => 'required|string|max:255',
            'job_id' => 'required|exists:jobs,id',
            'police_certificate_issue_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
            'photo' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'id_front' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'id_back' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'license_front' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'license_back' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'job_application_sign' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'passport_copy' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'police_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'school_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'bank_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'application_date' => 'nullable|date',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
        $authenticatedUser = auth()->user();
        if ($authenticatedUser->id != $request->user_id && $authenticatedUser->role != 1) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to create this record',
            ]);
        }
        $clientData = $request->all();

        $clientData['user_id'] = $request->user_id;
        if ($authenticatedUser->role == 2) {
            $clientData['user_id'] = $authenticatedUser->id;
        }
        $clientData['password'] = Hash::make($request->password);
        if (!empty($request->photo)) {
            $clientData['photo'] = fileUploader($request->photo, getFilePath('photo'), getFileSize('photo'));
        }
        if (!empty($request->id_front)) {
            $clientData['id_front'] = fileUploader($request->id_front, getFilePath('id_front'), getFileSize('id_front'));
        }
        if (!empty($request->id_back)) {
            $clientData['id_back'] = fileUploader($request->id_back, getFilePath('id_back'), getFileSize('id_back'));
        }
        if (!empty($request->license_front)) {
            $clientData['license_front'] = fileUploader($request->license_front, getFilePath('license_front'), getFileSize('license_front'));
        }
        if (!empty($request->license_back)) {
            $clientData['license_back'] = fileUploader($request->license_back, getFilePath('license_back'), getFileSize('license_back'));
        }
        if (!empty($request->job_application_sign)) {
            $clientData['job_application_sign'] = fileUploader($request->job_application_sign, getFilePath('job_application_sign'));
        }
        if (!empty($request->passport_copy)) {
            $clientData['passport_copy'] = fileUploader($request->passport_copy, getFilePath('passport_copy'), getFileSize('passport_copy'));
        }
        if (!empty($request->police_certificate)) {
            $clientData['police_certificate'] = fileUploader($request->police_certificate, getFilePath('police_certificate'), getFileSize('police_certificate'));
        }
        if (!empty($request->school_certificate)) {
            $clientData['school_certificate'] = fileUploader($request->school_certificate, getFilePath('school_certificate'), getFileSize('school_certificate'));
        }
        if (!empty($request->bank_certificate)) {
            $clientData['bank_certificate'] = fileUploader($request->bank_certificate, getFilePath('bank_certificate'), getFileSize('bank_certificate'));
        }
        $client = Client::create($clientData);
        // Mail::to($client->email)->send(new ClientCredsMail($client, $request->password));
        $this->checkAndSendEmail($client, $request);
        return response()->json([
            'status' => true,
            'redirect' => route('admin.client.index'),
            'message' => 'Client created successfully.'
        ]);
    }

    public function edit($id) 
    {
        $pageTitle = "Edit Client";
        $jobs = Job::get();
        $agents = User::where('role', 2)->get();
        $user = auth()->user();
        $client = Client::find($id);

        if (empty($client)) {
            return redirect()->route('admin.client.index');
        }
        
        if ($user->role == 2 && $client->user_id != $user->id) {
            return redirect()->route('admin.client.index')->with('error', 'Unauthorized to edit this client.');
        }
        if($user->role == 2) {
            $jobNameContainsDriver = preg_match('/\bdriver\b/i', $client->job->job_name);
            
            if (empty($client->photo) || empty($client->id_front) || empty($client->id_back) || 
                empty($client->job_application_sign) || empty($client->passport_copy) || 
                empty($client->police_certificate) || empty($client->school_certificate) || 
                empty($client->bank_certificate) || 
                ($jobNameContainsDriver && (empty($client->license_front) || empty($client->license_back)))) {

                $fileTypes = [
                    'photo' => $client->photo ? strtolower(pathinfo($client->photo, PATHINFO_EXTENSION)) : null,
                    'id_front' => $client->id_front ? strtolower(pathinfo($client->id_front, PATHINFO_EXTENSION)) : null,
                    'id_back' => $client->id_back ? strtolower(pathinfo($client->id_back, PATHINFO_EXTENSION)) : null,
                    'license_front' => $client->license_front ? strtolower(pathinfo($client->license_front, PATHINFO_EXTENSION)) : null,
                    'license_back' => $client->license_back ? strtolower(pathinfo($client->license_back, PATHINFO_EXTENSION)) : null,
                    'job_application_sign' => $client->job_application_sign ? strtolower(pathinfo($client->job_application_sign, PATHINFO_EXTENSION)) : null,
                    'passport_copy' => $client->passport_copy ? strtolower(pathinfo($client->passport_copy, PATHINFO_EXTENSION)) : null,
                    'police_certificate' => $client->police_certificate ? strtolower(pathinfo($client->police_certificate, PATHINFO_EXTENSION)) : null,
                    'school_certificate' => $client->school_certificate ? strtolower(pathinfo($client->school_certificate, PATHINFO_EXTENSION)) : null,
                    'bank_certificate' => $client->bank_certificate ? strtolower(pathinfo($client->bank_certificate, PATHINFO_EXTENSION)) : null,
                ];

                return view('admin.client.edit', compact('pageTitle', 'client', 'jobs', 'agents', 'fileTypes'));
            } else {
                return redirect()->route('admin.client.index')->with('error', 'Client documents are incomplete.');
            }
        } else {
            $fileTypes = [
                'photo' => $client->photo ? strtolower(pathinfo($client->photo, PATHINFO_EXTENSION)) : null,
                'id_front' => $client->id_front ? strtolower(pathinfo($client->id_front, PATHINFO_EXTENSION)) : null,
                'id_back' => $client->id_back ? strtolower(pathinfo($client->id_back, PATHINFO_EXTENSION)) : null,
                'license_front' => $client->license_front ? strtolower(pathinfo($client->license_front, PATHINFO_EXTENSION)) : null,
                'license_back' => $client->license_back ? strtolower(pathinfo($client->license_back, PATHINFO_EXTENSION)) : null,
                'job_application_sign' => $client->job_application_sign ? strtolower(pathinfo($client->job_application_sign, PATHINFO_EXTENSION)) : null,
                'passport_copy' => $client->passport_copy ? strtolower(pathinfo($client->passport_copy, PATHINFO_EXTENSION)) : null,
                'police_certificate' => $client->police_certificate ? strtolower(pathinfo($client->police_certificate, PATHINFO_EXTENSION)) : null,
                'school_certificate' => $client->school_certificate ? strtolower(pathinfo($client->school_certificate, PATHINFO_EXTENSION)) : null,
                'bank_certificate' => $client->bank_certificate ? strtolower(pathinfo($client->bank_certificate, PATHINFO_EXTENSION)) : null,
            ];
            return view('admin.client.edit', compact('pageTitle', 'client', 'jobs', 'agents', 'fileTypes'));
        }
    }

    public function update(Request $request, $id) 
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'status' => false, 
                'message' => 'Client not found.'
            ]);
        }
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'passport_number' => 'required|string|max:255|unique:clients,passport_number,' . $client->id,
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'id_expiry_date' => 'required|date',
            'id_number' => 'required|string|unique:clients,id_number,' . $client->id,
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $client->id,
            'password' => 'nullable|string',
            'school_level' => 'required|string|max:255',
            'job_id' => 'required|exists:jobs,id',
            'police_certificate_issue_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
            'police_certificate_issue_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
            'photo' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'id_front' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'id_back' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'license_front' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'license_back' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'job_application_sign' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'passport_copy' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'police_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'school_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'bank_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'application_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }
        $authenticatedUser = auth()->user();
        if ($authenticatedUser->id == $request->user_id || $authenticatedUser->role == 1) {
            $clientData = $request->except(['password']);
            if (!empty($request->password)) {
                $clientData['password'] = Hash::make($request->password);
            }
            $fieldsToUpload = [
                'photo' => 'photo',
                'id_front' => 'id_front',
                'id_back' => 'id_back',
                'license_front' => 'license_front',
                'license_back' => 'license_back',
                'job_application_sign' => 'job_application_sign',
                'passport_copy' => 'passport_copy',
                'police_certificate' => 'police_certificate',
                'school_certificate' => 'school_certificate',
                'bank_certificate' => 'bank_certificate',
            ];
            foreach ($fieldsToUpload as $field => $pathKey) {
                if ($request->hasFile($field)) {
                    $oldFile = $client->$field ?? null;
                    if ($field === 'job_application_sign') {
                        $clientData[$field] = fileUploader($request->file($field), getFilePath($pathKey), null, $oldFile);
                    } else {
                        $clientData[$field] = fileUploader($request->file($field), getFilePath($pathKey), getFileSize($pathKey), $oldFile);
                    }
                }
            }
            $client->update($clientData);
            $this->checkAndSendEmail($client, $request);
            return response()->json([
                'status' => true,
                'message' => 'Client updated successfully.',
                'redirect' => route('admin.client.index'),
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized to update this record',
        ]);
    }

    public function destroy($id) 
    {
        $user = auth()->user();
        $client = $user->role == 1 ? Client::find($id) : Client::where('user_id', $user->id)->find($id);

        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found.'
            ]);
        }
        if ($user->role == 2 && $client->user_id != $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized.'
            ]);
        }
        $clientPaths = [
            'photo' => 'photo',
            'id_front' => 'idFront',
            'id_back' => 'idBack',
            'license_front' => 'licenseFront',
            'license_back' => 'licenseBack',
            'job_application_sign' => 'job_application_sign',
            'passport_copy' => 'passport_copy',
            'police_certificate' => 'police_certificate',
            'school_certificate' => 'school_certificate',
            'bank_certificate' => 'bank_certificate',
        ];
        foreach ($clientPaths as $attribute => $folder) {
            if ($client->{$attribute}) {
                $photoPath = public_path("assets/admin/clientDocs/images/{$folder}/" . $client->{$attribute});
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }

                $photoPath = public_path("assets/admin/clientDocs/{$folder}/" . $client->{$attribute});
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
        }
        $restInfo = $client->restInfo;
        if ($restInfo) {
            $restInfoPaths = [
                'five_minutes_work_video' => 'five_minutes_work_video',
                'legalized_police_certificate' => 'legalized_police_certificate',
                'legalized_school_certificate' => 'legalized_school_certificate',
                'legalized_driver_license' => 'legalized_driver_license',
                'resident_card_front' => 'resident_card_front',
                'resident_card_back' => 'resident_card_back',
            ];
            foreach ($restInfoPaths as $attribute => $folder) {
                if ($restInfo->{$attribute}) {
                    $photoPath = public_path("assets/admin/clientDocs/clientRestInfo/{$folder}/" . $restInfo->{$attribute});
                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }
            }
        }
        $client->delete();
        return response()->json([
            'status' => true,
            'message' => 'Client and associated rest information deleted successfully.'
        ]);
    }

    private function checkAndSendEmail($client, $request)
    {
        $fileColumns = [
            'photo', 'id_front', 'id_back', 'job_application_sign', 
            'passport_copy', 'police_certificate', 'school_certificate', 'bank_certificate'
        ];
        $jobNameContainsDriver = preg_match('/\bdriver\b/i', $client->job->job_name);

        if ($jobNameContainsDriver) {
            $fileColumns = array_merge($fileColumns, ['license_front', 'license_back']);
        }
        $allFilesUploaded = collect($fileColumns)->every(function ($column) use ($client) {
            return !empty($client->$column);
        });  
        if ($allFilesUploaded) {
            $client->status = 'Documents Processing';
            $client->save();
            // Mail::to(gs()->email_from)->send(new ClientAdditionalInformationMail($client));
        }
    }

    public function updateStatus($id, $status)
    {
        $client = Client::find($id);
        if ($client) {
            $client->status = $status;
            $client->save();
            $agent = User::where('id', $client->user_id)->first();
            // Mail::to($agent->email)->send(new ClientStatusUpdateMail($client, $agent));
            return response()->json([
                'status' => true,
                'message' => 'Status updated successfully.'
            ]);
        }
    }
}
