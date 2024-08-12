<?php

namespace App\Http\Controllers;

use App\Models\Notification;
// use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotifications($mentee_id)
    {
        $notifications = Notification::where('mentee_id', $mentee_id)
                                       ->orderBy('created_at', 'desc')
                                       ->get();

        return response()->json($notifications);
    }
}
