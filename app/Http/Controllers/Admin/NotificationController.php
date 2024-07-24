<?php

namespace App\Http\Controllers\Admin;

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

        $data = Notification::where('type', $type)->get();
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
