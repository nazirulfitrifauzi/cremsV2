<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjaxClientUserController extends Controller
{
    public function getClientUser()
    {
        $clientUser = DB::select('select a.*, b.client_name from client_users_info a inner join client_info b on b.id = a.client_id');

        return DataTables::of($clientUser)
                            ->make(true);
    }
}