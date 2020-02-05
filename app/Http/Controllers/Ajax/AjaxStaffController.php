<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Staff;

class AjaxStaffController extends Controller
{
    public function getStaff()
    {
        $staff = Staff::all();

        return DataTables::of($staff)
                            ->make(true);
    }
}