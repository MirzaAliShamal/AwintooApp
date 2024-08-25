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
        $pageTitle = "Generate Forms";
        return view('admin.report.list', compact('pageTitle'));
    }

    public function confirmReport(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first();
        if($client) {
            return view('reports.confirm', compact('client'));
        } else {
            return back();
        }
    }

    public function confirmReportPrint(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first(); 
        if ($client) {
            $pdf = PDF::loadView('reports.confirm', ['client' => $client, 'isPdf' => true]);
            return $pdf->download('confirmation-letter.pdf');
        } else {
            return back();
        }
    }

    public function contractReport(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number', $clientId)->first(); 
        if($client) {
            return view('reports.contract', compact('client'));
        } else {
            return back();
        }
    }

    public function contractReportPrint(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first(); 
        if ($client) {
            $pdf = PDF::loadView('reports.contract', ['client' => $client, 'isPdf' => true]);
            return $pdf->download('training-contract.pdf');
        } else {
            return back();
        }
    }

    public function loiReport(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first(); 
        if($client) {
            return view('reports.loi', compact('client'));
        } else {
            return back();
        }
    }

    public function loiReportPrint(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first(); 
        if ($client) {
            $pdf = PDF::loadView('reports.loi',  ['client' => $client, 'isPdf' => true]);
            return $pdf->download('loi-report.pdf');
        } else {
            return back();
        }
    }

    public function rptApplication(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first(); 
        if($client) {
            return view('reports.rpt', compact('client'));
        } else {
            return back();
        }
    }

    public function rptAppPrint(Request $request)
    {
        $clientId = $request->client_id;
        $client = Client::where('unique_id_number' ,$clientId)->first(); 
        if ($client) {
            $pdf = PDF::loadView('reports.rpt', ['client' => $client, 'isPdf' => true])
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
                
            return $pdf->download('rpt-Application.pdf');
        } else {
            return back();
        }
    }
}
