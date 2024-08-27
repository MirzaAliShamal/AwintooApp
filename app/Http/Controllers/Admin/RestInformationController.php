<?php

namespace App\Http\Controllers\Admin;

use Auth, Mail;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Mail\VisaDeniedMail;
use App\Mail\VisaAcceptedMail;
use Illuminate\Validation\Rule;
use App\Rules\FileTypeValidate;
use App\Models\RestInformation;
use App\Imports\RestInfoImport;
use App\Mail\DocumentReceivedMail;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Mail\ApplicationStatusChangeMail;
use App\Mail\VisaApplicationSubmittedMail;

class RestInformationController extends Controller
{
    public function index()
    {
        $pageTitle = 'Rest Information';
        $user = Auth::user();
        $data = RestInformation::orderBy('created_at', 'desc')->paginate(7);
        if ($user->role == 2) {
            $data = RestInformation::whereHas('client', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orderBy('created_at', 'desc')->paginate(7);
        } 
        return view('admin.info.list', compact('pageTitle', 'data'));
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
                Excel::import(new RestInfoImport, $path);
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
        $clients = Client::get();
        $user = Auth::user();
        if($user->role == 2) {
            $clients = Client::where('user_id', $user->id)->get();
        }
        return view('admin.info.add', compact('pageTitle', 'clients'));
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'body_size' => 'required|string|max:255',
            'name_with_vietnam_characters' => 'required|string|max:255',
            'training_program' => 'nullable|string|max:255',
            'system_email' => 'nullable|email|max:255',
            'place_of_birth' => 'required|string',
            'nationality' => 'required|string',
            'marital_status' => 'required|string',
            'spouse_name' => 'required|string',
            'english_characters_living_address' => 'required|string',
            'vietnam_living_address' => 'required|string',
            'driver_licence_issue_date' => 'nullable|date',
            'driver_license_expiry_date' => 'nullable|date',
            'police_certificate_expiry_date' => 'required|date',
            'visa_application_number' => 'nullable|numeric',
            'insurance_type' => 'nullable|string|max:255',
            'insurance_expiry_date' => 'nullable|date',
            'amount_paid' => 'nullable|numeric|min:0',
            'balance_amount' => 'nullable|numeric|min:0',
            'working_place' => 'nullable|string|max:255',
            'address_abroad' => 'nullable|string',
            'phone_abroad' => 'nullable|string',
            'five_minutes_work_video' => 'nullable|mimes:zip|max:5120',
            'legalized_police_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'legalized_school_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'legalized_driver_license' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'legalized_driver_license' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'visa_number' => 'nullable|string|max:255',
            'visa_issue_date' => 'nullable|date',
            'visa_expiry_date' => 'nullable|date|after_or_equal:visa_issue_date',
            'residence_permit_number' => 'nullable|string|max:255',
            'residence_permit_issue_date' => 'nullable|date',
            'residence_permit_expiry_date' => 'nullable|date|after_or_equal:residence_permit_issue_date',
            'bank_account_in_eu' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'resident_card_front' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'resident_card_back' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }
        $client = Client::findOrFail($request->client_id);
        $user = Auth::user();
        if ($user->role == 2 && $client->user_id != $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to add rest information for this client.'
            ]);
        }
        if ($client->restInfo) {
            return response()->json([
                'status' => false,
                'message' => 'This client already has rest information.'
            ]);
        }
        $restInfoData = $request->all();
        if(!empty($request->five_minutes_work_video)) {
            $restInfoData['five_minutes_work_video'] = fileUploader($request->five_minutes_work_video, getFilePath('five_minutes_work_video'));
        }
        if(!empty($request->legalized_police_certificate)) {
            $restInfoData['legalized_police_certificate'] = fileUploader($request->legalized_police_certificate, getFilePath('legalized_police_certificate'), getFileSize('legalized_police_certificate'));
        }
        if(!empty($request->legalized_school_certificate)) {
            $restInfoData['legalized_school_certificate'] = fileUploader($request->legalized_school_certificate, getFilePath('legalized_school_certificate'), getFileSize('legalized_school_certificate'));
        }
        if(!empty($request->legalized_driver_license)) {
            $restInfoData['legalized_driver_license'] = fileUploader($request->legalized_driver_license, getFilePath('legalized_driver_license'), getFileSize('legalized_driver_license'));
        }
        if(!empty($request->resident_card_front)) {
            $restInfoData['resident_card_front'] = fileUploader($request->resident_card_front, getFilePath('resident_card_front'), getFileSize('resident_card_front'));
        }
        if(!empty($request->resident_card_back)) {
            $restInfoData['resident_card_back'] = fileUploader($request->resident_card_back, getFilePath('resident_card_back'), getFileSize('resident_card_back'));
        }
        $restInfo = RestInformation::create($restInfoData);
        if(!empty($request->visa_application_number)) {
            // Mail::to($client->email)->send(new VisaApplicationSubmittedMail($client));
        } else {
            $restInfo->status = "Waiting Documents";
            $restInfo->save();
        }

        return response()->json([
            'status' => true,
            'redirect' => route('admin.info.index'),
            'message' => 'Rest Information created successfully.'
        ]);
    }

    public function edit($id) 
    {
        $restInfo = RestInformation::find($id);
        $user = Auth::user();
        
        if (empty($restInfo)) {
            return redirect()->route('admin.info.index')->with('error', 'Rest Info not found.');
        }
        
        $client = Client::find($restInfo->client_id);

        if ($user->role == 2 && $client->user_id != $user->id) {
            return redirect()->route('admin.info.index')->with('error', 'Unauthorized to edit this rest information.');
        }
        if($user->role == 2) {
            if (empty($restInfo->five_minutes_work_video) || 
                empty($restInfo->legalized_police_certificate) || 
                empty($restInfo->legalized_school_certificate) || 
                empty($restInfo->legalized_driver_license) ||
                empty($restInfo->resident_card_front) ||
                empty($restInfo->resident_card_back)) {

                $fileTypes = [
                    'legalized_police_certificate' => $restInfo->legalized_police_certificate ? strtolower(pathinfo($restInfo->legalized_police_certificate, PATHINFO_EXTENSION)) : null,
                    'legalized_school_certificate' => $restInfo->legalized_school_certificate ? strtolower(pathinfo($restInfo->legalized_school_certificate, PATHINFO_EXTENSION)) : null,
                    'legalized_driver_license' => $restInfo->legalized_driver_license ? strtolower(pathinfo($restInfo->legalized_driver_license, PATHINFO_EXTENSION)) : null,
                ];
                
                $clients = Client::get();
                $pageTitle = "Edit Rest Information";
                
                return view('admin.info.edit', compact('restInfo', 'pageTitle', 'clients', 'fileTypes'));
            } else {
                return redirect()->route('admin.info.index')->with('error', 'No editable fields are available.');
            }
        } else {
            $fileTypes = [
                'legalized_police_certificate' => $restInfo->legalized_police_certificate ? strtolower(pathinfo($restInfo->legalized_police_certificate, PATHINFO_EXTENSION)) : null,
                'legalized_school_certificate' => $restInfo->legalized_school_certificate ? strtolower(pathinfo($restInfo->legalized_school_certificate, PATHINFO_EXTENSION)) : null,
                'legalized_driver_license' => $restInfo->legalized_driver_license ? strtolower(pathinfo($restInfo->legalized_driver_license, PATHINFO_EXTENSION)) : null,
                'resident_card_front' => $restInfo->resident_card_front ? strtolower(pathinfo($restInfo->resident_card_front, PATHINFO_EXTENSION)) : null,
                'resident_card_back' => $restInfo->resident_card_back ? strtolower(pathinfo($restInfo->resident_card_back, PATHINFO_EXTENSION)) : null,
            ];

            $clients = Client::get();
            $pageTitle = "Edit Rest Information";

            return view('admin.info.edit', compact('restInfo', 'pageTitle', 'clients', 'fileTypes'));
        }
    }

    public function update(Request $request, $id) 
    {
        $restInfo = RestInformation::find($id);
        $user = Auth::user();
        if (!$restInfo) {
            return response()->json([
                'status' => false, 
                'message' => 'Rest Information not found.'
            ]);
        }
        $client = Client::findOrFail($request->client_id);
        // if ($user->role == 2 && $client->user_id != $user->id) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Unauthorized to update this rest information.'
        //     ]);
        // }
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'body_size' => 'required|string|max:255',
            'name_with_vietnam_characters' => 'required|string|max:255',
            'training_program' => 'nullable|string|max:255',
            'system_email' => 'nullable|email|max:255',
            'place_of_birth' => 'required|string',
            'nationality' => 'required|string',
            'marital_status' => 'required|string',
            'spouse_name' => 'required|string',
            'english_characters_living_address' => 'required|string',
            'vietnam_living_address' => 'required|string',
            'driver_licence_issue_date' => 'nullable|date',
            'driver_license_expiry_date' => 'nullable|date',
            'police_certificate_expiry_date' => 'required|date',
            'visa_application_number' => 'nullable|numeric',
            'insurance_type' => 'nullable|string|max:255',
            'insurance_expiry_date' => 'nullable|date',
            'amount_paid' => 'nullable|numeric|min:0',
            'balance_amount' => 'nullable|numeric|min:0',
            'working_place' => 'nullable|string|max:255',
            'address_abroad' => 'nullable|string',
            'phone_abroad' => 'nullable|string',
            'five_minutes_work_video' => 'nullable|mimes:zip|max:5120',
            'legalized_police_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'legalized_school_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'legalized_driver_license' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'visa_number' => 'nullable|string|max:255',
            'visa_issue_date' => 'nullable|date',
            'visa_expiry_date' => 'nullable|date|after_or_equal:visa_issue_date',
            'residence_permit_number' => 'nullable|string|max:255',
            'residence_permit_issue_date' => 'nullable|date',
            'residence_permit_expiry_date' => 'nullable|date|after_or_equal:residence_permit_issue_date',
            'bank_account_in_eu' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'resident_card_front' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'resident_card_back' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }
        $existingRestInfo = RestInformation::where('client_id', $request->client_id)->where('id', '!=', $request->id)->first();
        if ($existingRestInfo) {
            return response()->json([
                'status' => false,
                'message' => 'This client already has rest information.'
            ]);
        }
        $restInfoData = $request->all();
        if(!empty($request->five_minutes_work_video)) {
            $old = $restInfo->five_minutes_work_video;
            $restInfoData['five_minutes_work_video'] = fileUploader($request->five_minutes_work_video, getFilePath('five_minutes_work_video'), null, $old);
        }
        if(!empty($request->legalized_police_certificate)) {
            $old = $restInfo->legalized_police_certificate;
            $restInfoData['legalized_police_certificate'] = fileUploader($request->legalized_police_certificate, getFilePath('legalized_police_certificate'), getFileSize('legalized_police_certificate'), $old);
        }
        if(!empty($request->legalized_school_certificate)) {
            $old = $restInfo->legalized_school_certificate;
            $restInfoData['legalized_school_certificate'] = fileUploader($request->legalized_school_certificate, getFilePath('legalized_school_certificate'), getFileSize('legalized_school_certificate'), $old);
        }
        if(!empty($request->legalized_driver_license)) {
            $old = $restInfo->legalized_driver_license;
            $restInfoData['legalized_driver_license'] = fileUploader($request->legalized_driver_license, getFilePath('legalized_driver_license'), getFileSize('legalized_driver_license'), $old);
        }
        if(!empty($request->resident_card_front)) {
            $old = $restInfo->resident_card_front;
            $restInfoData['resident_card_front'] = fileUploader($request->resident_card_front, getFilePath('resident_card_front'), getFileSize('resident_card_front'), $old);
        }
        if(!empty($request->resident_card_back)) {
            $old = $restInfo->resident_card_back;
            $restInfoData['resident_card_back'] = fileUploader($request->resident_card_back, getFilePath('resident_card_back'), getFileSize('resident_card_back'), $old);
        }
        $currentVisaApplicationNumber = $restInfo->visa_application_number;
        $restInfo->update($restInfoData);
        if ($request->visa_application_number !== $currentVisaApplicationNumber) {
            if (!empty($request->visa_application_number)) {
                $restInfo->status = 'Visa Application Started';
                $restInfo->save();
                // Mail::to($client->email)->send(new VisaApplicationSubmittedMail($client));
            }
        }
        $this->checkAndSendEmail($restInfo, $request);
        return response()->json([
            'status' => true,
            'message' => 'Rest Information updated successfully.',
            'redirect' => route('admin.info.index'),
        ]);
    }

    public function destroy($id) 
    {
        $restInfo = RestInformation::find($id);
        if (empty($restInfo)) {
            return response()->json([
                'status' => false,
                'message' => 'Rest Information not found.'
            ]);
        }
        $client = Client::find($restInfo->client_id);
        $user = Auth::user();

        if ($user->role == 2 && $client->user_id != $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to delete this rest information.'
            ]);
        }
        if($user->role == 2) {
            if (empty($restInfo->five_minutes_work_video) || 
                empty($restInfo->legalized_police_certificate) || 
                empty($restInfo->legalized_school_certificate) || 
                empty($restInfo->legalized_driver_license)) {
                $paths = [
                    'five_minutes_work_video' => 'five_minutes_work_video',
                    'legalized_police_certificate' => 'legalized_police_certificate',
                    'legalized_school_certificate' => 'legalized_school_certificate',
                    'legalized_driver_license' => 'legalized_driver_license',
                    'resident_card_front' => 'resident_card_front',
                    'resident_card_back' => 'resident_card_back',
                ];
                foreach ($paths as $attribute => $folder) {
                    if ($restInfo->{$attribute}) {
                        $photoPath = public_path("assets/admin/clientDocs/clientRestInfo/{$folder}/" . $restInfo->{$attribute});
                        if (file_exists($photoPath)) {
                            unlink($photoPath);
                        }
                    }
                }
                $restInfo->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Rest Information deleted successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to delete this rest information.'
                ]);
            }
        } else {
            $paths = [
                'five_minutes_work_video' => 'five_minutes_work_video',
                'legalized_police_certificate' => 'legalized_police_certificate',
                'legalized_school_certificate' => 'legalized_school_certificate',
                'legalized_driver_license' => 'legalized_driver_license',
                'resident_card_front' => 'resident_card_front',
                'resident_card_back' => 'resident_card_back',
            ];
            foreach ($paths as $attribute => $folder) {
                if ($restInfo->{$attribute}) {
                    $photoPath = public_path("assets/admin/clientDocs/clientRestInfo/{$folder}/" . $restInfo->{$attribute});
                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }
            }
            $restInfo->delete();
            return response()->json([
                'status' => true,
                'message' => 'Rest Information deleted successfully.'
            ]);
        }
    }

    private function checkAndSendEmail($restInfo, $request)
    {
        $fileColumns = [
            'five_minutes_work_video', 'legalized_police_certificate', 'legalized_school_certificate', 'legalized_driver_license', 
            'resident_card_front', 'resident_card_back'
        ];
        $allFilesUploaded = collect($fileColumns)->every(function ($column) use ($restInfo) {
            return !empty($restInfo->$column);
        });  
        if ($allFilesUploaded) {
            // Mail::to($restInfo->client->email)->send(new DocumentReceivedMail($restInfo->client));
        }
    }

    public function updateStatus($id, $status)
    {
        $restInfo = RestInformation::find($id);
        $client = $restInfo->client;
        if ($restInfo) {
            $restInfo->status = $status;
            $restInfo->save();
            if($status == 'Accepted') {
                // Mail::to($client->email)->send(new VisaAcceptedMail($client));
            } elseif ($status == 'Denied') {
                // Mail::to($client->email)->send(new VisaDeniedMail($client));
            }
            // Mail::to($client->email)->send(new ApplicationStatusChangeMail($client, $restInfo));
            return response()->json([
                'status' => true,
                'message' => 'Status updated successfully.'
            ]);
        }
    }
}
