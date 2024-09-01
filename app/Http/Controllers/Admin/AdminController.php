<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Job;
use App\Models\User;
use App\Models\Client;
use App\Models\Agency;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\PracticePlace;
use App\Models\RestInformation;
use Illuminate\Validation\Rule;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pageTitle = 'Dashboard';
        
        $user = Auth::user(); 
        $totalJobs = Job::count();
        $totalUsers = User::count();
        $totalAgency = Agency::count();
        $totalClients = Client::count();
        $totalStudents = Student::count();
        $totalPayments = Payment::count();
        $totalInfo = RestInformation::count();
        $totalAppointment = Appointment::count();
        $totalPracticePlace = PracticePlace::count();

        if($user->role == 2) {
            $totalClients = Client::where('user_id', $user->id)->count();
            $totalInfo = RestInformation::whereHas('client', function($query) use ($user) {
                            $query->where('user_id', $user->id);
                        })->count();
            $totalPayments = Payment::whereHas('client', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
        } 
        return view('admin.dashboard', compact('pageTitle', 'totalClients', 'totalInfo', 'totalUsers', 'totalJobs', 'totalPayments', 'totalAppointment', 'totalAgency', 'totalPracticePlace', 'totalStudents'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $admin = auth()->user();
        return view('admin.profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $admin = auth()->user();
        $validator = $this->profileValidator($request->only(['name', 'email', 'phone_number', 'image']), $admin->id);
        if ($validator->passes()) {
            if ($request->hasFile('image')) {            
                $old = $admin->image;
                $admin->image = fileUploader($request->image, getFilePath('adminProfilePic'), getFileSize('adminProfilePic'), $old);
            }
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);
            return response()->json([
                'status' => true,
                'redirect' => route('admin.profile'),
                'message' => 'Profile Updated Succesfully.'
            ]);
        } else {
            return response()->json([
                'status'=> false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function password()
    {
        $pageTitle = 'Password Setting';
        $admin = auth()->user();
        return view('admin.password', compact('pageTitle', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $validator = Validator::make($request->only('old_password', 'new_password', 'confirm_password'), [
            'old_password' => 'required|min:4',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors() 
            ]);
        }
        $admin = auth()->user();
        if (!Hash::check($request->old_password, $admin->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Your old password is incorrect.'
            ]);
        }
        $admin->password = Hash::make($request->new_password);
        $admin->save();
        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.'
        ]);
    }

    private function profileValidator($data, $id = null)
    {
        $rules = [
            'name' => 'required',
            'email' => [ 'required', 'email', Rule::unique('users')->ignore($id) ],
            'phone_number' => ['nullable', 'string' ],
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ];
        $messages = [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'email.email' => 'The Email must be a valid Email.',
            'email.unique' => 'The Email already used.',
        ];
        return Validator::make($data, $rules, $messages);
    }
}
