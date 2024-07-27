<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Job;
use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index() 
    {
        $pageTitle = 'Payment';
        $user = Auth::user();
        $data = Payment::all();

        if ($user->role == 2) {
            $data = Payment::whereHas('client', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        } 
        return view('admin.payment.list', compact('pageTitle', 'data'));
    }

    public function generateInvoice($id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return back();
        }
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role == 1) {
            $pdf = PDF::loadView('reports.invoice', compact('payment'));
            return $pdf->download('invoice.pdf');
        } else if ($authenticatedUser->role == 2) {
            $client = $payment->client;
            if ($client && $client->user_id == $authenticatedUser->id) {
                $pdf = PDF::loadView('reports.invoice', compact('payment'));
                return $pdf->download('invoice.pdf');
            } else {
                return back();
            }
        } else {
                return back();
        }
    }

    public function getClientInfo($id)
    {
        $client = Client::with('job')->find($id);
        if (!$client) {
            return response()->json(['status' => false, 'message' => 'Client not found.']);
        }
        return response()->json(['status' => true, 'client' => $client]);
    }
    
    public function create() 
    {
        $pageTitle = 'Add';
        $jobs = Job::get();
        $clients = Client::get();
        $user = Auth::user();
        if($user->role == 2) {
            $clients = Client::where('user_id', $user->id)->get();
        }
        return view('admin.payment.add', compact('pageTitle', 'jobs', 'clients'));
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'client_name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:255',
            'payment' => 'required|numeric',
            'job_id' => 'required|exists:jobs,id',
            'price' => 'required|numeric',
            'proof_of_payment' => 'required|mimes:jpeg,jpg,pdf|max:2048',
            'after_deduction' => 'required|numeric',
        ]);
        if ($validator->passes()) {
            $authenticatedUser = auth()->user();
            $client = Client::find($request->client_id);
            if (!$client) {
                return response()->json([
                    'status' => false,
                    'message' => 'Client not found.'
                ]);
            }
            if ($authenticatedUser->role == 1) {
                $paymentData = $request->all();
                $paymentData['proof_of_payment'] = fileUploader($request->proof_of_payment, getFilePath('proof_of_payment'));
                Payment::create($paymentData);
                return response()->json([
                    'status' => true,
                    'redirect' => route('admin.payment.index'),
                    'message' => 'Payment created successfully.'
                ]);
            } else if ($authenticatedUser->role == 2) {
                if ($client->user_id == $authenticatedUser->id) {
                    $paymentData = $request->all();
                    $paymentData['proof_of_payment'] = fileUploader($request->proof_of_payment, getFilePath('proof_of_payment'));
                    Payment::create($paymentData);
                    return response()->json([
                        'status' => true,
                        'redirect' => route('admin.payment.index'),
                        'message' => 'Payment created successfully.'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthorized to add payment for this client.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to create payment.'
                ]);
            }
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
        $pageTitle = "Edit Payment";
        $payment = Payment::find($id);
        $user = Auth::user();
        if (!$payment) {
            return redirect()->route('admin.payment.index')->with('error', 'Payment not found.');
        }

        $fileTypes = [
            'proof_of_payment' => $payment->proof_of_payment ? strtolower(pathinfo($payment->proof_of_payment, PATHINFO_EXTENSION)) : null,
        ];

        if ($user->role == 2) {
            $client = $payment->client;
            if ($client && $client->user_id != $user->id) {
                return redirect()->route('admin.payment.index')->with('error', 'Unauthorized to edit this payment.');
            }
        }
        $clients = Client::all();
        $jobs = Job::all();

        if ($user->role == 2) {
            $clients = Client::where('user_id', $user->id)->get();
        }

        return view('admin.payment.edit', compact('clients', 'jobs', 'payment', 'pageTitle', 'fileTypes'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'client_name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:255',
            'payment' => 'required|numeric',
            'job_id' => 'required|exists:jobs,id',
            'price' => 'required|numeric',
            'proof_of_payment' => 'nullable|mimes:jpeg,jpg,pdf|max:2048',
            'after_deduction' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input fields',
                'errors' => $validator->errors()
            ]);
        }
        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => 'Payment not found.'
            ]);
        }
        $client = Client::find($request->client_id);
        if ($user->role == 1) {
            $paymentData = $request->all();

           if(!empty($request->proof_of_payment)) {
                $old = $payment->proof_of_payment;
                $paymentData['proof_of_payment'] = fileUploader($request->proof_of_payment, getFilePath('proof_of_payment'), null, $old);
            }
            $payment->update($paymentData);
            return response()->json([
                'status' => true,
                'message' => 'Payment updated successfully.',
                'redirect' => route('admin.payment.index'),
            ]);
        } else if ($user->role == 2) {
            if ($client && $client->user_id == $user->id) {
                $paymentData = $request->all();
                if(!empty($request->proof_of_payment)) {
                    $old = $payment->proof_of_payment;
                    $paymentData['proof_of_payment'] = fileUploader($request->proof_of_payment, getFilePath('proof_of_payment'), null, $old);
                }
                $payment->update($paymentData);
                return response()->json([
                    'status' => true,
                    'message' => 'Payment updated successfully.',
                    'redirect' => route('admin.payment.index'),
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to update this payment.'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to update payment.'
            ]);
        }
    }


    public function destroy($id) 
    {
        $payment = Payment::find($id);
        if (empty($payment)) {
            return response()->json([
                'status' => false,
                'message' => 'Payment not found.'
            ]);
        }
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role == 1) {
            $payment->delete();
            return response()->json([
                'status' => true,
                'message' => 'Payment deleted successfully.'
            ]);
        } else if ($authenticatedUser->role == 2) {
            $client = $payment->client;
            if ($client && $client->user_id == $authenticatedUser->id) {
                $payment->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Payment deleted successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized to delete this payment.'
                ]);
            }
        }
    }
}
