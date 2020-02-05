<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AjaxStaffLeaveController extends Controller
{
    public function getStaffLeave()
    {
        $staffleave = DB::select("select b.name, a.* from staff_leave a inner join staff_info b on b.id = a.staff_id where a.status = '0'");

        return DataTables::of($staffleave)
                            ->editColumn('type', function ($staffleave) {
                                if($staffleave->type == 'AL'){
                                    if($staffleave->halfDay == '0') {
                                        return 'Annual Leave';
                                    } elseif($staffleave->halfDay == '1') {
                                        return 'Half Day';
                                    }
                                } elseif($staffleave->type == 'MC') {
                                    return 'Medical Leave';
                                } elseif($staffleave->type == 'EL') {
                                    return 'Emergency Leave';
                                } elseif($staffleave->type == 'UP') {
                                    return 'Unpaid Leave';
                                } elseif($staffleave->type == 'CL') {
                                    return 'Compassionate Leave';
                                } elseif($staffleave->type == 'M') {
                                    return 'Maternity Leave';
                                } elseif($staffleave->type == 'P') {
                                    return 'Paternity Leave';
                                } elseif($staffleave->type == 'X') {
                                    return 'Unrecorded Leave';
                                }
                            })
                            ->editColumn('start', function($staffleave) {
                                if($staffleave->type == 'AL' && $staffleave->halfDay == '1') {
                                    return date('d/m/Y, g:ia', strtotime($staffleave->start) );
                                } else {
                                    return date('d/m/Y', strtotime($staffleave->start) );
                                }
                            })
                            ->editColumn('end', function($staffleave) {
                                if($staffleave->type == 'AL' && $staffleave->halfDay == '1') {
                                    return date('d/m/Y, g:ia', strtotime($staffleave->end) );
                                } else {
                                    return date('d/m/Y', strtotime($staffleave->end) );
                                }
                            })
                            ->editColumn('days', function($staffleave) {
                                $start = Carbon::parse($staffleave->start);
                                $end = Carbon::parse($staffleave->end);
                                $days = $start->diffInDays($end);

                                if($staffleave->type == 'AL' && $staffleave->halfDay == '1') {
                                    return '0.5';
                                } else {
                                    return $days+1;
                                }
                            })
                            ->make(true);
    }
}