<?php

namespace App\Http\Controllers;

use App\Attendance;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (is_null(auth()->user()->staff_id))
        {
            return view('dashboard');
        }
        else
        {
            $staff = auth()->user()->staff_info->id;
            $today = now()->toDateString();
            $check = Attendance::where('staff_id',$staff)
                        ->whereDate('login_at',$today)
                        ->exists();

            return view('dashboard', compact('check'));
        }

    }
}
