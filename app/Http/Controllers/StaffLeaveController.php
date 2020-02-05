<?php

namespace App\Http\Controllers;

use App\StaffLeave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect,Response;

class StaffLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave = StaffLeave::where('status','1')->get();
        return view('leave.index', compact('leave'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        //   dd($request->all());
        $this->validate($request, [
            'type'              => ['required'],
            'title'             => ['required'],
            'start'             => ['required'],
            'end'               => ['required']
        ]);
        
        $staffid = auth()->user()->staff_info->id;

        if ($request->has('halfday'))
        {
            $halfday = '1';

            if ($request->get('am') == '1')
            {
                $start = $request->get('start').' 09:00:00';
                $end = $request->get('end').' 13:00:00';
                
                $start2 = Carbon::createFromFormat('m/d/Y H:i:s', $start);
                $end2 = Carbon::createFromFormat('m/d/Y H:i:s', $end);
                // dd($end2);
            }
            else if ($request->get('pm') == '1')
            {
                $start = $request->get('start').' 14:00:00';
                $end = $request->get('end').' 18:00:00';

                $start2 = Carbon::createFromFormat('m/d/Y H:i:s', $start);
                $end2 = Carbon::createFromFormat('m/d/Y H:i:s', $end);
            }
        }
        else
        {
            $halfday = '0';

            $start = $request->get('start');
            $end = $request->get('end');
            
            $start2 = Carbon::createFromFormat('m/d/Y', $start);
            $end2 = Carbon::createFromFormat('m/d/Y', $end);
        }

        $staffleave = new StaffLeave([
            'type'              =>  $request->get('type'),
            'title'             =>  $request->get('title'),
            'start'             =>  $start2,
            'end'               =>  $end2,
            'halfDay'           =>  $halfday,
            'staff_id'          =>  $staffid
        ]);
        
        $staffleave->save();
        
        session()->flash('success', 'Leave Application successfully submitted.');
        return redirect()->route('staff-leave.index');
    }

    public function list()
    {
        return view('leave.list');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\StaffLeave  $staffLeave
     * @return \Illuminate\Http\Response
     */
    public function show(StaffLeave $staffLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaffLeave  $staffLeave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $name = StaffLeave::find($id)->staff_info->name;
        StaffLeave::whereId($id)->update(['status' => 1]);

        session()->flash('success', $name."'s leave application has been approved.");
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaffLeave  $staffLeave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffLeave $staffLeave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffLeave  $staffLeave
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $name = StaffLeave::find($id)->staff_info->name;
        StaffLeave::destroy($id);

        //  Return response
        return response()->json([
            'success' => true,
            'message' => $name ."'s leave application has been rejected.",
        ]);
    }
}
