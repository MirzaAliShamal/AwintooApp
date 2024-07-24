<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GeneralSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1');
    }
    
    public function index()
    {
        $pageTitle = 'General Setting';
        return view('admin.setting.general', compact('pageTitle'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->only('site_title', 'email_from', 'copyright_text'), [
            'site_title' => 'nullable|string|max:50',
            'email_from' => 'nullable|string|max:50|email',
            'copyright_text' => 'nullable|string|max:100',
        ]);
        if($validator->passes()) {
            $general = gs();
            $general->site_title = $request->site_title;
            $general->email_from = $request->email_from;
            $general->copyright_text = $request->copyright_text;
            $general->save();
            return response()->json([
                'status' => true,
                'redirect' => route('admin.setting.index'),
                'message' => 'General Setting Updated Succesfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }
}
