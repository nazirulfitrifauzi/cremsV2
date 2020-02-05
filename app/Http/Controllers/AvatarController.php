<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function changeAvatar(Request $request)
    {
        $avatar = $request->file('avatar');

        $avatar_name = 'avatar_' . auth()->user()->id . '.jpg';

        Storage::disk('local')->putFileAs('public/Avatar', $avatar, $avatar_name);

        User::whereId(auth()->user()->id)
                    ->update([
                        'avatar'    => $avatar_name
                    ]);

        session()->flash('success', 'Your avatar has successfully updated.');
        return back();
    }
}
