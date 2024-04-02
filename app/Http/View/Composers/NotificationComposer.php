<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userId = $user->getKey();
            $userClass = get_class($user);

            $unreadNotifications = Notification::where('data.notifiable_id', $userId)
                ->where('data.notifiable_type', $userClass)
                ->whereNull('read_at')
                ->orderBy('created_at', 'desc') // Ordena de manera descendente
                ->get();

            $view->with(compact('unreadNotifications'));
        } else {
            $view->with('unreadNotifications', collect([]));
        }
    }
}