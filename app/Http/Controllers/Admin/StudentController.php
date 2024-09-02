<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\Models\Client;
use App\Models\Student;
use App\Mail\ArrivalMail;
use App\Mail\PaymentMail;
use Illuminate\Http\Request;
use App\Mail\MonthlyReportMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index() 
    {
        $pageTitle = "Student List";
        $students = Student::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.student.list', compact('pageTitle', 'students'));
    }  

    public function create() 
    {
        $clients = Client::whereHas('restInfo')->get();
        $pageTitle = 'Add Student';
        return view('admin.Student.add', compact('pageTitle', 'clients'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        if ($query) {
            $students = Student::where(function($q) use ($query) {
                    $q->where('std_unique_id', 'like', "%$query%")
                      ->orWhere('full_name', 'like', "%$query%")
                      ->orWhere('employer', 'like', "%$query%")
                      ->orWhere('working_place_ro', 'like', "%$query%");
                })->orderBy('created_at', 'desc')->get();
        } else {
            $students = Student::orderBy('created_at', 'desc')->get();
        }
            return response()->json([
            'status' => true,
            'data' => $students,
        ]);
    }

    public function filter(Request $request)
    {
        $query = Student::query();
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('arrival_date_ro', [$request->start_date, $request->end_date]);
        }
        $students = $query->orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => true,
            'data' => $students
        ]);
    }

    public function sendArrivalNotification(Request $request)
    {
        $studentIds = $request->student_ids;
        $students = Student::with('client')->whereIn('id', $studentIds)->get();
        foreach ($students as $student) {
            if ($student->client && $student->client->email) {
                Mail::to($student->client->email)->send(new ArrivalMail($student));
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Arrival notifications sent successfully!',
        ]);
    }

    public function sendPaymentNotification(Request $request)
    {
        $studentIds = $request->student_ids;
        $students = Student::with('client')->whereIn('id', $studentIds)->get();
        foreach ($students as $student) {
            if ($student->client && $student->client->email) {
                Mail::to($student->client->email)->send(new PaymentMail($student));
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Payment notifications sent successfully!',
        ]);
    }

    public function sendMonthlyReport(Request $request)
    {
        $studentIds = $request->student_ids;
        $hrEmail = $request->hr_email;
        $students = Student::with('client')->whereIn('id', $studentIds)->get();
        Mail::to($hrEmail)->send(new MonthlyReportMail($students));
        return response()->json([
            'success' => true,
            'message' => 'Mail sent to HR successfully'
        ]);
    }

    
    public function getClientInfo($id)
    {
        $client = Client::with('restInfo', 'agent')->find($id);
        $restInfo =  $client->restInfo;
        $agent =  $client->agent;
        $agency = $agent->agency;
        $training = $restInfo->practicePlace;
        if (!$client) {
            return response()->json([
                'status' => false, 
                'message' => 'Client not found.'
            ]);
        }
        return response()->json([
            'status' => true, 
            'client' => $client,
            'restInfo' => $restInfo,
            'agent' => $agent,
            'agency' => $agency,
            'training' => $training,
        ]);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id|unique:students,client_id',
            'full_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer|min:0|max:120',
            'place_of_birth' => 'nullable|string|max:255',
            'sure_name' => 'nullable|string|max:255',
            'given_name' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'visa_number' => 'nullable|string|max:50',
            'visa_issue_date' => 'nullable|date',
            'visa_expiry_date' => 'nullable|date|after:visa_issue_date',
            'agency_name' => 'nullable|string|max:255',
            'agent_name' => 'nullable|string|max:255',
            'country_code' => 'nullable|string',
            'training_program' => 'required|string|max:255',
            'class_hours' => 'required|integer|min:0',
            'practice_hours' => 'required|integer|min:0',
            'address_in_ro' => 'required|string|max:255',
            'working_place_ro' => 'required|string|max:255',
            'training_place_ro' => 'required|string|max:255',
            'phone_number_ro' => 'required|string|max:20',
            'bank_account_ro' => 'required|string|max:50',
            'arrival_date_ro' => 'required|date',
            'address_abroad' => 'nullable|string|max:255',
            'working_place_abroad' => 'nullable|string|max:255',
            'training_place_abroad' => 'required|string|max:255',
            'phone_abroad' => 'nullable|string|max:20',
            'residence_permit_number' => 'nullable|string|max:50',
            'residence_permit_issue_date' => 'nullable|date',
            'residence_permit_expiry_date' => 'nullable|date|after:residence_permit_issue_date',
            'training_start_date' => 'required|date',
            'remain_hours_training_class' => 'required|integer|min:0',
            'remain_hours_practice' => 'required|integer|min:0',
            'work_start_date' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'monthly_rate' => 'required|numeric|min:0',
            'daily_rate' => 'required|numeric|min:0',
            'employer' => 'required|string|max:255',
            'monthly_time_sheet' => 'nullable|file|max:2048',
            'month' => 'required|string|max:20',
            'total_work_hours' => 'required|integer|min:0',
            'total_training_class_hours' => 'required|integer|min:0',
            'total_practice_hours' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }
        $client = Client::find($request->client_id);
        $studentData = $request->all();
        if (!empty($request->monthly_time_sheet)) {
            $studentData['monthly_time_sheet'] = fileUploader($request->monthly_time_sheet, getFilePath('monthly_time_sheet'));
        }
        $studentData['std_unique_id'] = $client->unique_id_number;
        Student::create($studentData);

        return response()->json([
            'status' => true,
            'redirect' => route('admin.student.index'),
            'message' => 'Student Record Created Successfully'
        ]);
    }

    public function edit($id) 
    {
        $pageTitle = "Edit Student Data";
        $student = Student::find($id);
        $clients = Client::whereHas('restInfo')->get();
        if (empty($student)) {
            return redirect()->route('admin.student.index')->with('error', 'Student not found.');
        }
        return view('admin.student.edit', compact('pageTitle', 'student', 'clients'));
    }

    public function update(Request $request, $id) 
    {
        $student = Student::find($id);
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id|unique:students,client_id,'  . $student->id,
            'full_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer|min:0|max:120',
            'place_of_birth' => 'nullable|string|max:255',
            'sure_name' => 'nullable|string|max:255',
            'given_name' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'visa_number' => 'nullable|string|max:50',
            'visa_issue_date' => 'nullable|date',
            'visa_expiry_date' => 'nullable|date|after:visa_issue_date',
            'agency_name' => 'nullable|string|max:255',
            'agent_name' => 'nullable|string|max:255',
            'country_code' => 'nullable|string',
            'training_program' => 'required|string|max:255',
            'class_hours' => 'required|integer|min:0',
            'practice_hours' => 'required|integer|min:0',
            'address_in_ro' => 'required|string|max:255',
            'working_place_ro' => 'required|string|max:255',
            'training_place_ro' => 'required|string|max:255',
            'phone_number_ro' => 'required|string|max:20',
            'bank_account_ro' => 'required|string|max:50',
            'arrival_date_ro' => 'required|date',
            'address_abroad' => 'nullable|string|max:255',
            'working_place_abroad' => 'nullable|string|max:255',
            'training_place_abroad' => 'required|string|max:255',
            'phone_abroad' => 'nullable|string|max:20',
            'residence_permit_number' => 'nullable|string|max:50',
            'residence_permit_issue_date' => 'nullable|date',
            'residence_permit_expiry_date' => 'nullable|date|after:residence_permit_issue_date',
            'training_start_date' => 'required|date',
            'remain_hours_training_class' => 'required|integer|min:0',
            'remain_hours_practice' => 'required|integer|min:0',
            'work_start_date' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'monthly_rate' => 'required|numeric|min:0',
            'daily_rate' => 'required|numeric|min:0',
            'employer' => 'required|string|max:255',
            'monthly_time_sheet' => 'nullable|file|mimes:xlsx,xls|max:2048',
            'month' => 'required|string|max:20',
            'total_work_hours' => 'required|integer|min:0',
            'total_training_class_hours' => 'required|integer|min:0',
            'total_practice_hours' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }
        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Payment not found.'
            ]);
        }
        $studentData = $request->all();
        $client = Client::find($request->client_id);
        if(!empty($request->monthly_time_sheet)) {
            $old = $student->monthly_time_sheet;
            $studentData['monthly_time_sheet'] = fileUploader($request->monthly_time_sheet, getFilePath('monthly_time_sheet'), null, $old);
        }
        $studentData['std_unique_id'] = $client->unique_id_number;
        $student->update($studentData);
        return response()->json([
            'status' => true,
            'message' => 'Student updated successfully.',
            'redirect' => route('admin.student.index'),
        ]);
    }

    public function destroy($id) 
    {
        $student = Student::find($id);
        if (empty($student)) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found.'
            ]);
        }
        if ($student->monthly_time_sheet) { 
            $filePath = public_path('assets/admin/monthly_time_sheet/' . $student->monthly_time_sheet);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $student->delete();
        return response()->json([
            'status' => true,
            'message' => 'Student deleted successfully.'
        ]);
    }
    
}
