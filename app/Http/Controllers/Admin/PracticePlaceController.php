<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PracticePlace;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PracticePlaceController extends Controller
{
    public function index() 
    {
        $pageTitle = "Training / Practice";
        $practice = PracticePlace::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.practice.list', compact('pageTitle', 'practice'));
    }

    public function create() 
    {
        $pageTitle = "Add";
        return view('admin.practice.add', compact('pageTitle'));
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(),[
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_tax_number' => 'nullable|string|max:100',
            'company_email' => 'required|email|max:255|unique:practice_places,company_email',
            'company_phone_number' => 'nullable|numeric',
            'legal_representative_name' => 'nullable|string|max:255',
            'legal_representative_email' => 'nullable|email|max:255|unique:practice_places,legal_representative_email',
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_email' => 'nullable|email|max:255|unique:practice_places,contact_person_email',
            'practice_and_work_fields' => 'required|string|in:Welder,Locksmiths,Driver,Electrician,Regular Job Not Skilled,Baker,Teacher,HR,Secretary,Manager',
        ]);

        if ($validator->passes()) {
            $practiceData = $request->all();
            PracticePlace::create($practiceData);
            return response()->json([
                'status' => true,
                'redirect' => route('admin.practice.index'),
                'message' => 'Training created successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please check input validation.',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id) 
    {
        $pageTitle = "Edit";
        $practice = PracticePlace::find($id);
        if(!$practice) {
            return redirect()->route('admin.practice.index')->with('error', 'Record not found.');
        }
        return view('admin.practice.edit', compact('pageTitle', 'practice'));
    }

    public function update(Request $request, $id) 
    {
        $practice = PracticePlace::find($id);
        $validator = Validator::make($request->all(),[
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_tax_number' => 'nullable|string|max:100',
            'company_email' => 'required|string|email|max:255|unique:practice_places,company_email,' . $practice->id,
            'company_phone_number' => 'nullable|numeric',
            'legal_representative_name' => 'nullable|string|max:255',
            'legal_representative_email' => 'nullable|string|email|max:255|unique:practice_places,legal_representative_email,' . $practice->id,
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_email' => 'nullable|string|email|max:255|unique:practice_places,contact_person_email,' . $practice->id,
            'practice_and_work_fields' => 'required|string|in:Welder,Locksmiths,Driver,Electrician,Regular Job Not Skilled,Baker,Teacher,HR,Secretary,Manager',
        ]);
        if(!$practice) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.',
            ]);
        }
        if ($validator->passes()) {
            $practiceData = $request->all();
            $practice->update($practiceData);
            return response()->json([
                'status' => true,
                'redirect' => route('admin.practice.index'),
                'message' => 'Record updated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please check input validation.',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id) 
    {
        $practice = PracticePlace::find($id);
         if (empty($practice)) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);
        }
        $practice->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record deleted successfully.'
        ]);
    }
}
