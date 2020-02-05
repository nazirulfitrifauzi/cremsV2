<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Staff;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        if (is_null(auth()->user()->staff_id)) //client
        {
            $info = User::where('email',auth()->user()->email)
                            ->first();
        }
        else //staff
        {
            $info = Staff::where('email',auth()->user()->email)
                            ->first();
        }

        return view('profile.edit', compact('info'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {   
        if (is_null(auth()->user()->staff_id)) //client
        {
            auth()->user()->update($request->all());
        }
        else // staff
        {
            $this->validate($request, [
                'name'              => ['required', 'string'],
                'address'           => ['required'],
                'icno'              => ['required', 'string'],
                'mobile'            => ['required', 'string'],
                'personal_email'    => ['required', 'email'],
                'email'             => ['required', 'email']
            ]);
    
            $data = request([
                'name',
                'address',
                'icno',
                'mobile',
                'phone',
                'personal_email',
                'email' 
            ]);
            
            Staff::whereId(auth()->user()->staff_id)->update($data);
        }

        session()->flash('success', 'Your profile has successfully updated.');
        return back();
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
