<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Client;
use App\Models\RestInformation;
use App\Models\User;
use App\Models\Job;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pageTitle = 'Dashboard';
        $user = Auth::user(); 
        $totalClients = Client::count();
        $totalInfo = RestInformation::count();
        $totalUsers = User::count();
        $totalJobs = Job::count();
        $totalPayments = Payment::count();
        if($user->role == 2) {
            $totalClients = Client::where('user_id', $user->id)->count();
            $totalInfo = RestInformation::whereHas('client', function($query) use ($user) {
                            $query->where('user_id', $user->id);
                        })->count();
            $totalPayments = Payment::whereHas('client', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
        } 
        
        return view('admin.dashboard', compact('pageTitle', 'totalClients', 'totalInfo', 'totalUsers', 'totalJobs', 'totalPayments'));
    }
}
