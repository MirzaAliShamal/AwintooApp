<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1');
    }
    
    public function index() {
        $pageTitle = 'Jobs';
        $jobs = Job::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.job.list', compact('pageTitle', 'jobs'));
    }

    public function create() {
        $pageTitle = 'Add';
        return view('admin.job.add', compact('pageTitle'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'job_name' => 'required|string',
            'price' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            $data = $request->only(['job_name', 'price']);
            Job::create($data);
            return response()->json([
                'status' => true,
                'redirect' => route('admin.job.index'),
                'message' =>  'Job created successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id) {

        $pageTitle = "Edit Job";
        $job = Job::find($id);
        if (empty($job)) {
            return redirect()->route('admin.job.index');
        }

        return view('admin.job.edit', compact('job', 'pageTitle'));
    }


    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'job_name' => 'required|string',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }

       
        $job = Job::find($id);
        if (!$job) {
            return response()->json([
                'status' => false, 
                'message' => 'Job not found.'
            ]);
        }

        $job->update($request->only(['job_name', 'price']));

        return response()->json([
            'status' => true,
            'message' => 'Job updated successfully.',
            'redirect' => route('admin.job.index'),
        ]);
    }

    public function destroy($id) {
        $job = Job::find($id);
         if (empty($job)) {
            return response()->json([
                'status' => false,
                'message' => 'Job not found.'
            ]);
        }
        if ($job->clients()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete job. It is already used in one or more clients.'
            ]);
        }
        $job->delete();
        return response()->json([
            'status' => true,
            'message' => 'Job deleted successfully.'
        ]);
    }
}
