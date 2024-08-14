<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationReservationController extends Controller
{
    public function index()
    {
        // Récupère l'utilisateur actuellement authentifié
        $user = Auth::user();

        // Récupère les notifications non lues
        $unreadNotifications = $user->unreadNotifications;

        // Retourne une vue avec les notifications non lues
        return view('notifications.index', compact('unreadNotifications'));
    }

    public function markAsRead()
    {
        $user = Auth::user();

        // Marque toutes les notifications non lues comme lues
        $user->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
}
