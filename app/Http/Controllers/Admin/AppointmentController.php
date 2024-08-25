<?php

namespace App\Http\Controllers\Admin;

use Auth, Mail;
use App\Models\Client;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Mail\AppointmentMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1');
    }

    public function index() 
    {
        $pageTitle = "Appointment";
        $appointments = Appointment::orderBy('appointment_date', 'asc')->paginate(7);
        return view('admin.appointment.list', compact('pageTitle', 'appointments'));
    }

    public function create() 
    {
        $pageTitle = "Create New Appointment";
        $clients = Client::get();
        return view('admin.appointment.add', compact('pageTitle', 'clients'));
    }

    public function store(Request $request) 
    {   
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'type_of_appointment' => 'required',
            'other_details' => 'nullable',
            'appointment_date' => 'required|date', 
            'appointment_time' => 'required|date_format:H:i',
        ]);
        if ($validator->passes()) {
            $client = Client::find($request->client_id);
            if (!$client) {
                return response()->json([
                    'status' => false,
                    'message' => 'Client not found.'
                ]);
            }
            $appointmentData = $request->all();
            $appointmentData['full_name'] = $client->full_name;
            $appointment = Appointment::create($appointmentData);
            // Mail::to($client->email)->send(new AppointmentMail($appointment));
            return response()->json([
                'status' => true,
                'redirect' => route('admin.appointment.index'),
                'message' => 'Appointment created successfully.'
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
        $pageTitle = "Edit Appointment";
        $appointment = Appointment::find($id);
        $user = Auth::user();
        
        if (!$appointment) {
            return redirect()->route('admin.appointment.index')->with('error', 'Appointment not found.');
        }
        $clients = Client::all();
        return view('admin.appointment.edit', compact('pageTitle', 'clients', 'appointment'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'type_of_appointment' => 'required',
            'other_details' => 'nullable',
            'appointment_date' => 'required|date', 
            'appointment_time' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }
        if (!$appointment) {
            return response()->json([
                'status' => false,
                'message' => 'Appointment not found.'
            ]);
        }
        $client = Client::find($request->client_id);
        $appointmentData = $request->all();
        $appointmentData['full_name'] = $client->full_name;
        if($request->type_of_appointment == 'Others') {
            $appointmentData['other_details'] = $request->other_details;
        } else {
            $appointmentData['other_details'] = '';
        }

        $appointment->update($appointmentData);
        return response()->json([
            'status' => true,
            'message' => 'Appointment updated successfully.',
            'redirect' => route('admin.appointment.index'),
        ]);
    }

    public function destroy($id) 
    {
        $appointment = Appointment::find($id);
        if (empty($appointment)) {
            return response()->json([
                'status' => false,
                'message' => 'Appointment not found.'
            ]);
        }
        $authenticatedUser = Auth::user();
        $appointment->delete();
        return response()->json([
            'status' => true,
            'message' => 'Appointment deleted successfully.'
        ]);
    }

    public function deleteExpireAppointment() 
    {
        Appointment::where('appointment_date', '<', now()->startOfDay())->delete();
        return redirect()->route('admin.appointment.index')->with('success', 'Expired Appointment Deleted Successfully.');
    }
}
