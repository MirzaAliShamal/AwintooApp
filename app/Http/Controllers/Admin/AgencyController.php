<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AgencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1');
    }

    public function index() 
    {
        $pageTitle = "Agency";
        $agency = Agency::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.agency.list', compact('pageTitle', 'agency'));
    }

    public function create() 
    {
        $pageTitle = "Add Agency";
        return view('admin.agency.add', compact('pageTitle'));
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(),[
            'agency_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:500',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:agencies',
            'director_name' => 'required|string|max:255',
            'company_registration_number' => 'nullable|string|max:255',
            'company_tax_number' => 'nullable|string|max:255',
            'company_bank_account' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'contract_name' => 'nullable|string|max:255',
            'quota' => 'required|integer|min:0',
            'agency_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->passes()) {
            $agencyData = $request->all();
            if ($request->hasFile('agency_logo')) {            
                $agencyData['agency_logo'] = fileUploader($request->agency_logo, getFilePath('agencyLogo'), getFileSize('agencyLogo'));
            }
            $agency = Agency::create($agencyData);
            return response()->json([
                'status' => true,
                'redirect' => route('admin.agency.index'),
                'message' => 'Agency created successfully.'
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
        $pageTitle = "Edit Agency";
        $agency = Agency::find($id);
        if (empty($agency)) {
            return redirect()->route('admin.agency.index')->with('error', 'Agency not found.');
        }
        return view('admin.agency.edit', compact('pageTitle', 'agency'));
    }

    public function update(Request $request, $id)
    {
        $agency = Agency::find($id);

        $validator = Validator::make($request->all(), [
            'agency_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:500',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:agencies,email,' . $agency->id,
            'director_name' => 'required|string|max:255',
            'company_registration_number' => 'nullable|string|max:255',
            'company_tax_number' => 'nullable|string|max:255',
            'company_bank_account' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'contract_name' => 'nullable|string|max:255',
            'quota' => 'required|integer|min:0',
            'agency_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }
        if (!$agency) {
            return response()->json([
                'status' => false,
                'message' => 'Agency not found.'
            ]);
        }
        $agency->agency_name = $request->agency_name;
        $agency->company_name = $request->company_name;
        $agency->company_address = $request->company_address;
        $agency->phone_number = $request->phone_number;
        $agency->email = $request->email;
        $agency->director_name = $request->director_name;
        $agency->company_registration_number = $request->company_registration_number;
        $agency->company_tax_number = $request->company_tax_number;
        $agency->company_bank_account = $request->company_bank_account;
        $agency->bank_name = $request->bank_name;
        $agency->contract_name = $request->contract_name;
        $agency->quota = $request->quota;

        if(!empty($request->agency_logo)) {
            $old = $agency->agency_logo;
            $agency['agency_logo'] = fileUploader($request->file('agency_logo'), getFilePath('agencyLogo'), null, $old);
        }
        $agency->save();
        return response()->json([
            'status' => true,
            'message' => 'Agency updated successfully.',
            'redirect' => route('admin.agency.index'),
        ]);
    }

    public function destroy($id) 
    {
        $agency = Agency::find($id);
        if (empty($agency)) {
            return response()->json([
                'status' => false,
                'message' => 'Agency not found.'
            ]);
        }
        if ($agency->agency_logo) { 
            $filePath = public_path('assets/admin/agency_logo/' . $agency->agency_logo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $agency->delete();
        return response()->json([
            'status' => true,
            'message' => 'Agency deleted successfully.'
        ]);
    }
}
