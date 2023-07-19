<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //

    public function index(){

        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        $notifications = Auth()->user()->notifications->map(function($notification){
            return [
                'data' => $notification->data,
                'created_at' =>$notification->created_at->format('d M Y H:i')
            ];
        });

        return $notifications;
    }
}
