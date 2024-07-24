<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
        $pageTitle = "Admin Login";
        return view('admin.auth.login', compact('pageTitle'));
    }  

    public function login(Request $request)
    {
        $validator = $this->validator($request->only(['email', 'password']));

        if ($validator->passes()) {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            $remember = $request->has('remember') ? true : false;
            if (auth()->attempt($credentials, $remember)) {
                return response()->json([
                    'status' => true,
                    'redirect' => route('admin.dashboard'),
                    'message' => 'Login Successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Email or Password is incorrect.'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field.',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return  to_route('admin.login');
    }

    private function validator($data){
        $rules = [
            'email' => 'required|email',
            'password' =>'required'
        ];
        $messages = [
            'email.required' => 'Email must be required.',
            'password.required' => 'The Password field is required.',
        ];

        return Validator::make($data, $rules, $messages);
    }
}
