<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\StaffClaim;
use Carbon\Carbon;

class AjaxStaffClaimController extends Controller
{
    public function getStaffClaimAll()
    {
        $firstDay = Carbon::now()->firstOfMonth();
        $lastDay = Carbon::now()->endOfMonth();

        $claim = StaffClaim::where('date','>=',$firstDay)
                                ->where('date','<=', $lastDay)
                                ->get();

        return DataTables::of($claim)
                            ->editColumn('staff_id', function ($claim) {
                                return $claim->staff_info->name;
                            })
                            ->editColumn('type', function ($claim) {
                                return strtoupper($claim->type);
                            })
                            ->editColumn('date', function ($claim) {
                                return $claim->date->format('d/m/Y h:i:s A');
                            })
                            ->make(true);
    }

    public function getStaffClaim(Request $request)
    {
        $firstDay = Carbon::now()->firstOfMonth();
        $lastDay = Carbon::now()->endOfMonth();

        $claim = StaffClaim::where('staff_id', $request->staff_id)
                                ->where('date','>=',$firstDay)
                                ->where('date','<=', $lastDay)
                                ->get();

        return DataTables::of($claim)
                            ->editColumn('staff_id', function ($claim) {
                                return $claim->staff_info->name;
                            })
                            ->editColumn('type', function ($claim) {
                                return strtoupper($claim->type);
                            })
                            ->editColumn('date', function ($claim) {
                                return $claim->date->format('d/m/Y');
                            })
                            ->make(true);
    }
}
