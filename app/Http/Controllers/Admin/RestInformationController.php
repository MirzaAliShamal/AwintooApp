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
            'driver_licence_issue_date' => 'required|date',
            'driver_license_expiry_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_working_link' => 'nullable|url',
            'police_certificate_expiry_date' => 'required|date',
            'visa_application_number' => 'required|numeric',
            'interview_date' => 'required|date',
            'insurance_type' => 'required|string|max:255',
            'insurance_expiry_date' => 'required|date',
            'amount_paid' => 'required|numeric|min:0',
            'balance_amount' => 'required|numeric|min:0',
            'document_to_upload' => 'nullable|file|max:2048',
            'working_place' => 'required|string|max:255',
            'address_abroad' => 'required|string',
            'phone_abroad' => 'required|string',
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
        $restInfo = RestInformation::create($request->all());
        if ($request->hasFile('photo')) {
            $restInfo->photo = fileUploader($request->photo, getFilePath('restInfoPhoto'));
            $restInfo->save();
        }
        if ($request->hasFile('document_to_upload')) {
            $restInfo->document_to_upload = fileUploader($request->document_to_upload, getFilePath('documentPath'));
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
        $clients = Client::get();
        $pageTitle = "Edit Rest Information";
        return view('admin.info.edit', compact('restInfo', 'pageTitle', 'clients'));
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
            'driver_licence_issue_date' => 'required|date',
            'driver_license_expiry_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'video_working_link' => 'nullable|url|',
            'police_certificate_expiry_date' => 'required|date',
            'visa_application_number' => 'required|numeric',
            'interview_date' => 'required|date',
            'insurance_type' => 'required|string|max:255',
            'insurance_expiry_date' => 'required|date',
            'amount_paid' => 'required|numeric|min:0',
            'balance_amount' => 'required|numeric|min:0',
            'document_to_upload' => 'nullable|file|max:2048',
            'working_place' => 'required|string|max:255',
            'address_abroad' => 'required|string',
            'phone_abroad' => 'required|string',
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
        if ($request->hasFile('photo')) {  
            $old = $restInfo->photo;
            $restInfo->photo = fileUploader($request->photo, getFilePath('restInfoPhoto'), getFileSize('restInfoPhoto'), $old);
        }
        if ($request->hasFile('document_to_upload')) {
            $oldDocument = $restInfo->document_to_upload;
            $documentPath = public_path('assets/document_files/' . $oldDocument);
            if (file_exists($documentPath)) {
                unlink($documentPath);
            }
            $restInfo->document_to_upload = fileUploader($request->document_to_upload, getFilePath('documentPath'));
        }
        $restInfo->client_id = $request->client_id;
        $restInfo->body_size = $request->body_size;
        $restInfo->phone_type = $request->phone_type;
        $restInfo->name_with_vietnam_characters = $request->name_with_vietnam_characters;
        $restInfo->job_apply = $request->job_apply;
        $restInfo->training_program = $request->training_program;
        $restInfo->system_email = $request->system_email;
        $restInfo->english_characters_living_address = $request->english_characters_living_address;
        $restInfo->vietnam_living_address = $request->vietnam_living_address;
        $restInfo->bank_in_vn = $request->bank_in_vn;
        $restInfo->country_to_go = $request->country_to_go;
        $restInfo->school_diploma = $request->school_diploma;
        $restInfo->original_english_legalizedFM_equalize = $request->original_english_legalizedFM_equalize;
        $restInfo->driver_licence_issue_date = $request->driver_licence_issue_date;
        $restInfo->driver_license_expiry_date = $request->driver_license_expiry_date;
        $restInfo->video_working_link = $request->video_working_link;
        $restInfo->police_certificate_expiry_date = $request->police_certificate_expiry_date;
        $restInfo->visa_application_number = $request->visa_application_number;
        $restInfo->interview_date = $request->interview_date;
        $restInfo->insurance_type = $request->insurance_type;
        $restInfo->insurance_expiry_date = $request->insurance_expiry_date;
        $restInfo->amount_paid = $request->amount_paid;
        $restInfo->balance_amount = $request->balance_amount;
        $restInfo->working_place = $request->working_place;
        $restInfo->address_abroad = $request->address_abroad;
        $restInfo->phone_abroad = $request->phone_abroad;
        $restInfo->save();
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
        if ($restInfo->document_to_upload) {
            $documentPath = public_path('assets/document_files/' . $restInfo->document_to_upload);
            if (file_exists($documentPath)) {
                unlink($documentPath);
            }
        }
        if ($restInfo->photo) {
            $photoPath = public_path('assets/images/restInfoPhoto/' . $restInfo->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        $restInfo->delete();
        return response()->json([
            'status' => true,
            'message' => 'Rest Information deleted successfully.'
        ]);
    }
}
