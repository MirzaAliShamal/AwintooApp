<?php

namespace App\Http\Controllers\Front;

use Hash;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('front.dashboard');
    }

    public function restInfo() 
    {
        $active = auth('client')->user();
        $client = Client::with('restInfo')->where('id', $active->id)->first();
        return view('front.rest_information', compact('client'));
    }

    public function password()
    {
        return view('front.password');
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
        $client = auth('client')->user();
        if (!Hash::check($request->old_password, $client->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Your old password is incorrect.'
            ]);
        }
        $client->password = Hash::make($request->new_password);
        $client->save();
        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.'
        ]);
    }
}
