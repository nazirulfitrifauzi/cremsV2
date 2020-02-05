<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\User;
use App\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AjaxUserController extends Controller
{
    public function getalluser()
    {
        $user = User::where('active', '1')
                            ->get();

        return DataTables::of($user)
                            ->make(true);
    }

    public function getinactiveuser()
    {
        $n_user = User::where('active', '0')
                            ->orderBy('created_at', 'asc')
                            ->get();

        return DataTables::of($n_user)
                            ->make(true);
    }
}
