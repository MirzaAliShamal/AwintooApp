<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Mail\VisaAcceptedMail;
use App\Mail\ClientValidationMail;
use App\Mail\DocumentsRequiestMail;
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
            $clients = Client::with('job', 'agent')->where('unique_id_number', 'like', "%$query%")->get();
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
        $message = $request->message;
        $client = Client::where('unique_id_number' ,$clientId)->first();
        if($client) {
            $agent = User::where('id', $client->user_id)->first();
            // Mail::to($agent->email)->send(new ClientValidationMail($client, $agent, $message)); 
            return back();
        } else {
            return back();
        }
    }

    public function clientDocsRequiredMail(Request $request) 
    {
        $clientId = $request->client_id;
        $message = $request->message;
        $client = Client::where('unique_id_number' ,$clientId)->first();
        if($client) {
            $agent = User::where('id', $client->user_id)->first();
            // Mail::to($agent->email)->send(new DocumentsRequiestMail($client, $agent, $message)); 
            return back();
        } else {
            return back();
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
