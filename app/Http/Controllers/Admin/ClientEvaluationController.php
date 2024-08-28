<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Mail\VisaAcceptedMail;
use App\Mail\ClientValidationMail;
use App\Mail\DocumentsRequestMail;
use App\Mail\ApplicationRejectMail;
use App\Http\Controllers\Controller;

class ClientEvaluationController extends Controller
{
    public function index()
    {
        $pageTitle = "Client Evaluation";
        $clients = Client::orderByRaw("CASE WHEN validation_status = 'Not Validate' THEN 0 ELSE 1 END")
                 ->orderBy('validation_status', 'asc')
                 ->paginate(7);
        return view('admin.client_evaluation.list', compact('pageTitle' ,'clients'));
    }

    public function show($id) 
    {
        $pageTitle = "Client Docuements";
        $client = Client::with('restInfo')->find($id);
        return view('admin.client_evaluation.show', compact('pageTitle', 'client'));
    }

    public function showData($id) 
    {
        $pageTitle = "Client Data";
        $client = Client::with('restInfo')->find($id);
        return view('admin.client_evaluation.show_data', compact('pageTitle', 'client'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        if ($query) {
            $clients = Client::with('job', 'agent')->where(function($q) use ($query) {
                    $q->where('unique_id_number', 'like', "%$query%")
                      ->orWhere('full_name', 'like', "%$query%");
                })->get();
        } else {
            $clients = Client::with('job', 'agent')->get();
        }
            return response()->json([
            'status' => true,
            'data' => $clients,
        ]);
    }

    public function clientValidationMail(Request $request) 
    {
        $clientId = $request->client_id;
        $validationOption = $request->input('validation_option'); 

        $client = Client::where('unique_id_number', $clientId)->first();
        if ($client) {
            if($client->validation_status === 'Not Validate') {
                $agent = User::where('id', $client->user_id)->first();
                $agency = $agent->agency;
                // $mail = Mail::to($agent->email);
                // if ($agency && $agency->email) {
                    // $mail->cc($agency->email);
                // }
                $client->validation_status = "Validate";
                $client->save();
                $mail->send(new ClientValidationMail($client, $agent, $validationOption));
                return back()->with('success', 'Client validation email sent successfully!');
            } else {
                return back()->with('completed', 'Client is already validated.');
            }
        } else {
            return back()->with('error', 'Client not found.');
        }
    }

    public function clientDocsRequiredMail(Request $request) 
    {
        $clientId = $request->client_id;
        $selectedDocuments = $request->input('documents', []); 
        $otherText = $request->input('other_text'); 

        $client = Client::where('unique_id_number', $clientId)->first();
        if ($client) {
            $agent = User::where('id', $client->user_id)->first();
            $agency = $agent->agency;
            // $mail = Mail::to($agent->email);
            // if ($agency && $agency->email) {
            //     $mail->cc($agency->email);
            // }
            // $mail->send(new DocumentsRequestMail($client, $agent, $selectedDocuments, $otherText));
            return back()->with('success', 'Document request email sent successfully!');
        } else {
            return back()->with('error' , 'Client not found.');
        }
    }

    public function clientRejectMail(Request $request) 
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first();
        if($client) {
            $agent = User::where('id', $client->user_id)->first();
            // Mail::to($agent->email)->send(new ApplicationRejectMail($client, $agent)); 
            return back()->with('success', 'Rejected mail sent successfully!');;
        } else {
            return back()->with('error', 'Client not found.');
        }
    }

    public function clientApplicationCompleteMail(Request $request) 
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first();
        if($client) {
            // Mail::to($client->email)->send(new VisaAcceptedMail($client)); 
            return back()->with('success', 'Mail sent successfully!');
        } else {
            return back()->with('error', 'Client not found.');
        }
    }

    public function deleteDocument($id, $document)
    {
        $client = Client::findOrFail($id);
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
        if (array_key_exists($document, $clientPaths) && $client->{$document}) {
            $folder = $clientPaths[$document];
            $filePath1 = public_path("assets/admin/clientDocs/images/{$folder}/" . $client->{$document});
            if (file_exists($filePath1)) {
                unlink($filePath1);
            }
            $filePath2 = public_path("assets/admin/clientDocs/{$folder}/" . $client->{$document});
            if (file_exists($filePath2)) {
                unlink($filePath2);
            }
            $client->{$document} = null;
            $client->save();
            return response()->json([
                'status' => true, 
                'message' => 'Document deleted successfully.'
            ]);
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
            if (array_key_exists($document, $restInfoPaths) && $restInfo->{$document}) {
                $folder = $restInfoPaths[$document];
                $filePath = public_path("assets/admin/clientDocs/clientRestInfo/{$folder}/" . $restInfo->{$document});
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $restInfo->{$document} = null;
                $restInfo->save();
                return response()->json([
                    'status' => true, 
                    'message' => 'Document deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => false, 
            'message' => 'Invalid document type.'
        ]);
    }
}
