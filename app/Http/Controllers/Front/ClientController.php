<?php

namespace App\Http\Controllers\Front;

use App\Models\Client;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function dashboard()
    {
        $totalAppointment = Appointment::where('client_id', auth('client')->id())
                ->where('appointment_date', '>=', \Carbon\Carbon::now()->startOfDay())->count();
        return view('front.dashboard', compact('totalAppointment'));
    }

    public function restInfo() 
    {
        $active = auth('client')->user();
        $client = Client::with('restInfo')->where('id', $active->id)->first();
        return view('front.rest_information', compact('client'));
    }

    public function appointment() 
    {
        $active = auth('client')->user();
        $appointments = Appointment::where('client_id', $active->id)->where('appointment_date', '>=', now()->startOfDay())->orderBy('appointment_date', 'asc')->get();
        return view('front.appointment', compact('appointments'));
    }

    public function notify() 
    {
        $data = Notification::where('client_id', auth('client')->id())->orderby('id', 'desc')->get();
        return view('front.notify', compact('data'));
    }

    public function readNotify($id) 
    {
        $notification = Notification::findOrFail($id);
        $notification->read = 1;
        $notification->save();
        return response()->json([
            'status' => true,
            'redirect' => route('front.notify')
        ]);
    }
}
