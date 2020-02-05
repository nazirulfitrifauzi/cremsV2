<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Support\Facades\DB;

class AjaxClientController extends Controller
{
    public function getClient()
    {
        $client = Client::all();

        return DataTables::of($client)
                            ->make(true);
    }
}