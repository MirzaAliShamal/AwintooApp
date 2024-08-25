<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index(Request $request) 
    {
        $type = $request->type;
        $readIds = $request->input('ids');
    
        $titles = [
            'passport' => 'Passport Expiry',
            'insurance' => 'Insurance Expiry',
            'driver' => 'Driver Licence Expiry',
            'police' => 'Police Licence Expiry',
        ];

        $pageTitle = $titles[$type] ?? 'ID Expiry';
        if(auth()->user()->role == 2) {
            $userId = auth()->id();
            $clients = Client::where('user_id', $userId)->pluck('id');
            $data = Notification::whereIn('client_id', $clients)->where('type', $type)->orderBy('created_at', 'desc')->get();
        } else {
            $data = Notification::orderBy('created_at', 'desc')->where('type', $type)->get();
        }
        if ($readIds) {
            Notification::where('id', $readIds)->update(['read' => 1]);
        }
        return view('admin.notification.list', compact('pageTitle', 'data'));
    }

    public function destroy($id)
    {
        $notify = Notification::find($id);
         if (empty($notify)) {
            return response()->json([
                'status' => false,
                'message' => 'Notification not found.'
            ]);
        }
        $notify->delete();
        return response()->json([
            'status' => true,
            'message' => 'Notification deleted successfully.'
        ]);
    }
}
