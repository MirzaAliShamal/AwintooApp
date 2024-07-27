<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1');
    }
    
    public function index()
    {
        $pageTitle = "Generate Reports";
        return view('admin.report.list', compact('pageTitle'));
    }

    public function confirmReport(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::find($clientId);
        if($client) {
            $pdf = PDF::loadView('reports.confirm', compact('client'));
            return $pdf->download('confirm-report.pdf');
            // return view('reports.confirm', compact('client'));
        } else {
            return back();
        }
    }

    public function contractReport(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::find($clientId);
        if($client) {
            $pdf = PDF::loadView('reports.contract', compact('client'));
            return $pdf->download('contract-report.pdf');
            // return view('reports.contract', compact('client'));
        } else {
            return back();
        }
    }

    public function loiReport(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::find($clientId);
        if($client) {
            $pdf = PDF::loadView('reports.loi', compact('client'));
            return $pdf->download('loi-report.pdf');
            // return view('reports.loi', compact('client'));
        } else {
            return back();
        }
    }

    public function rptApplication(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::find($clientId);
        if($client) {
            $pdf = PDF::loadView('reports.rpt', compact('client'));
            return $pdf->download('rpt-Application.pdf');
            // return view('reports.rpt', compact('client'));
        } else {
            return back();
        }
    }


}
