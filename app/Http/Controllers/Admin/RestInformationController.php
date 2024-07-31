<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\FileTypeValidate;
use App\Models\RestInformation;
use App\Imports\RestInfoImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class RestInformationController extends Controller
{
    public function index()
    {
        $pageTitle = 'Rest Information';
        $user = Auth::user();
        $data = RestInformation::get();
        if ($user->role == 2) {
            $data = RestInformation::whereHas('client', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
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

    public function create() {
        $pageTitle = 'Add';
        $clients = Client::get();
        $user = Auth::user();
        if($user->role == 2) {
            $clients = Client::where('user_id', $user->id)->get();
        }
        return view('admin.info.add', compact('pageTitle', 'clients'));
    }

    public function store(Request $request) {
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
            'driver_licence_issue_date' => 'required|date',
            'driver_license_expiry_date' => 'required|date',
            'police_certificate_expiry_date' => 'required|date',
            'visa_application_number' => 'nullable|numeric',
            'interview_date' => 'nullable|date',
            'insurance_type' => 'nullable|string|max:255',
            'insurance_expiry_date' => 'nullable|date',
            'amount_paid' => 'nullable|numeric|min:0',
            'balance_amount' => 'nullable|numeric|min:0',
            'working_place' => 'nullable|string|max:255',
            'address_abroad' => 'nullable|string',
            'phone_abroad' => 'nullable|string',
            'five_minutes_work_video' => 'nullable|mimes:zip|max:20480',
            'legalized_police_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'legalized_school_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'legalized_driver_license' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
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
        $restInfo = RestInformation::create($restInfoData);
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
        if ($user->role == 2) {
            return redirect()->route('admin.info.index')->with('error', 'Unauthorized to edit this rest information.');
        }
        $fileTypes = [
                'legalized_police_certificate' => $restInfo->legalized_police_certificate ? strtolower(pathinfo($restInfo->legalized_police_certificate, PATHINFO_EXTENSION)) : null,
                'legalized_school_certificate' => $restInfo->legalized_school_certificate ? strtolower(pathinfo($restInfo->legalized_school_certificate, PATHINFO_EXTENSION)) : null,
                'legalized_driver_license' => $restInfo->legalized_driver_license ? strtolower(pathinfo($restInfo->legalized_driver_license, PATHINFO_EXTENSION)) : null,
            ];
        $clients = Client::get();
        $pageTitle = "Edit Rest Information";
        return view('admin.info.edit', compact('restInfo', 'pageTitle', 'clients', 'fileTypes'));
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
        if ($user->role == 2 && $client->user_id != $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to update this rest information.'
            ]);
        }
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
            'driver_licence_issue_date' => 'required|date',
            'driver_license_expiry_date' => 'required|date',
            'police_certificate_expiry_date' => 'required|date',
            'visa_application_number' => 'nullable|numeric',
            'interview_date' => 'nullable|date',
            'insurance_type' => 'nullable|string|max:255',
            'insurance_expiry_date' => 'nullable|date',
            'amount_paid' => 'nullable|numeric|min:0',
            'balance_amount' => 'nullable|numeric|min:0',
            'working_place' => 'nullable|string|max:255',
            'address_abroad' => 'nullable|string',
            'phone_abroad' => 'nullable|string',
            'five_minutes_work_video' => 'nullable|mimes:zip|max:20480',
            'legalized_police_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'legalized_school_certificate' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'legalized_driver_license' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
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
        $restInfo->update($restInfoData);
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
        if ($user->role == 2) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to delete this rest information.'
            ]);
        }
        $paths = [
            'five_minutes_work_video' => 'five_minutes_work_video',
            'legalized_police_certificate' => 'legalized_police_certificate',
            'legalized_school_certificate' => 'legalized_school_certificate',
            'legalized_driver_license' => 'legalized_driver_license',
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
