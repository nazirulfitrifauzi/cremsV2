<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notify;

class NotificationController extends Controller
{
    public function getNotification()
    {
        return Notify::whereNull('read_at')
                        ->where('receiver', auth()->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public function updateNotification(Request $request)
    {
        $id = request(['id']);

        Notify::whereId($id)->update(['read_at' => now()]);
    }
}
