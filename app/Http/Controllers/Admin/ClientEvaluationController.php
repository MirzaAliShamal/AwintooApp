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
        $clients = Client::orderBy('created_at', 'desc')->paginate(7);
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
            $agent = User::where('id', $client->user_id)->first();
            $agency = $agent->agency;
            // $mail = Mail::to($agent->email);
            // if ($agency && $agency->email) {
                // $mail->cc($agency->email);
            // }
            // $mail->send(new ClientValidationMail($client, $agent, $validationOption));
            return back()->with('status', 'Client validation email sent successfully!');
        } else {
            return back()->withErrors('Client not found.');
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
            return back()->with('status', 'Document request email sent successfully!');
        } else {
            return back()->withErrors('Client not found.');
        }
    }

    public function clientRejectMail(Request $request) 
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first();
        if($client) {
            $agent = User::where('id', $client->user_id)->first();
            // Mail::to($agent->email)->send(new ApplicationRejectMail($client, $agent)); 
            return back();
        } else {
            return back();
        }
    }

    public function clientApplicationCompleteMail(Request $request) 
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first();
        if($client) {
            // Mail::to($client->email)->send(new VisaAcceptedMail($client)); 
            return back();
        } else {
            return back();
        }
    }
}
