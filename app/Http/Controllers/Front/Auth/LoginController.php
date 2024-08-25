<?php

namespace App\Http\Controllers\Front\Auth;

use Hash, Mail;
use App\Models\Job;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Mail\NewClientRegisterMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('client.guest')->except('logout');
    }

    public function showLoginForm() 
    {
        $pageTitle = "Login";
        return view('front.auth.login', compact('pageTitle'));
    }  

    public function showRegisterForm() 
    {
        $pageTitle = "Register";
        $jobs = Job::get();
        $agents = User::where('role', 2)->get();
        return view('front.auth.register', compact('pageTitle', 'agents', 'jobs'));
    } 

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email'=> 'required|email|unique:clients',
            'password'=> 'required|min:5|confirmed',
            'user_id'=> 'required|exists:users,id',
            'job_id'=> 'required|exists:jobs,id',
        ]);

        if($validator->passes()){

            $client = new Client;
            $client->full_name = $request->name;
            $client->email = $request->email;
            $client->job_id = $request->job_id;
            $client->user_id = $request->user_id;
            $client->password = Hash::make($request->password);
            $client->save();

            session()->flash('success','You have been successfully registered');
            // Mail::to(gs()->email_from)->send(new NewClientRegisterMail($client));

            return response()->json([
                'status' => true,
                'redirect' => route('login')
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    } 

    public function login(Request $request)
    {
        $validator = $this->validator($request->only(['email', 'password']));
        if ($validator->passes()) {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            if (auth()->guard('client')->attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'redirect' => route('front.dashboard'),
                    'message' => 'Login Successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'redirect' => route('login'),
                    'message' => 'Email or Password is incorrect.'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'redirect' => route('login'),
                'message' => 'Please fill the required input field.',
                'errors' => $validator->errors()
            ]);
        }
    }

    protected function guard()
    {
        return auth()->guard('client');
    } 

    public function logout(Request $request)
    {
        $this->guard('client')->logout();
        $request->session()->invalidate();
        return  to_route('login');
    }

    private function validator($data)
    {
        $rules = [
            'email' => 'required',
            'password' =>'required'
        ];
        $messages = [
            'email.required' => 'Email must be required.',
            'password.required' => 'The Password field is required.',
        ];

        return Validator::make($data, $rules, $messages);
    }
}
