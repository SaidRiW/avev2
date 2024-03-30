<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Carbon\Carbon;
use Auth;

class NotificationController extends Controller
{
    public function markAllAsRead(Request $request)
    {
        $userId = Auth::id();

        Notification::where('data.notifiable_id', $userId)
                    ->whereNull('read_at')
                    ->get()
                    ->each(function ($notification) {
                        $notification->read_at = Carbon::now();
                        $notification->save();
                    });

        return back()->with('status', 'Todas las notificaciones han sido marcadas como leídas.');
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
                                    ->where('data.notifiable_id', Auth::id())
                                    ->whereNull('read_at')
                                    ->first();
    
        if ($notification) {
            $notification->read_at = Carbon::now();
            $notification->save();
    
            return redirect()->back()->with('status', 'Notificación marcada como leída.');
        }
    
        return redirect()->back()->with('error', 'Notificación no encontrada.');
    }

}
