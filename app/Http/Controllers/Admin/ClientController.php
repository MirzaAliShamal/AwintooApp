<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Imports\ClientsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index() 
    {
        $pageTitle = 'Clients';
        $user = auth()->user();
        if($user->role == 1) {
            $data = Client::with('agent')->paginate(7);
        } else {
            $data = Client::with('agent')->where('user_id', $user->id)->paginate(7);
        }
        return view('admin.client.list', compact('pageTitle', 'data'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        if ($query) {
            $clients = Client::with('job')->where('full_name', 'like', "%$query%")->get();
        } else {
            $clients = Client::with('job')->get();
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
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:clients',
            'school_level' => 'required|string|max:255',
            'job_id' => 'required|exists:jobs,id',
            'police_certificate_issue_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'application_date' => 'required|date',
        ]);

        if ($validator->passes()) {
            $authenticatedUser = auth()->user();

            if ($authenticatedUser->id == $request->user_id) {
                $clientData = $request->all();
                $clientData['user_id'] = $authenticatedUser->id;
                Client::create($clientData);
            } else if ($authenticatedUser->role == 1) {
                Client::create($request->all());
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to create this record',
                ]);
            }
            return response()->json([
                'status' => true,
                'redirect' => route('admin.client.index'),
                'message' =>  'Client created successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id) 
    {
        $pageTitle = "Edit Client";
        $jobs = Job::get();
        $agents = User::where('role', 2)->get();
        $user = auth()->user();
        if($user->role == 1) {
            $client = Client::find($id);
        } else {
            $client = Client::where('user_id', $user->id)->find($id);
        }
        if (empty($client)) {
            return redirect()->route('admin.client.index');
        }
        return view('admin.client.edit', compact('pageTitle', 'client', 'jobs', 'agents'));
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
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $client->id,
            'school_level' => 'required|string|max:255',
            'job_id' => 'required|exists:jobs,id',
            'police_certificate_issue_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
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
        if ($authenticatedUser->id == $request->user_id) {
            $clientData = $request->all();
            $clientData['user_id'] = $authenticatedUser->id;
            $client->update($clientData);
        } else if ($authenticatedUser->role == 1) {
            $client->update($request->all());
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to update this record',
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Client updated successfully.',
            'redirect' => route('admin.client.index'),
        ]);
    }

    public function destroy($id) 
    {
        $user = auth()->user();
        if($user->role == 1) {
            $client = Client::find($id);
        } else {
            $client = Client::where('user_id', $user->id)->find($id);
        }
        if (empty($client)) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found.'
            ]);
        }
        $client->delete();
        return response()->json([
            'status' => true,
            'message' => 'Client deleted successfully.'
        ]);
    }
}
