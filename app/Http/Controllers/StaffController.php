<?php

namespace App\Http\Controllers;

use App\Staff;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff.index');
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              => ['required', 'string'],
            'start_date'        => ['required'],
            'designation'       => ['required','string'],
            'csc_email'         => ['required', 'email'],
            'password'          => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $start = Carbon::createFromFormat('m/d/Y', $request->get('start_date'));

        $staff = new Staff([
            'name'              =>  $request->get('name'),
            'email'             =>  $request->get('csc_email'),
            'start_date'        =>  $start->format('Y-m-d'),
            'designation'       =>  $request->get('designation')
        ]);
        
        $staff->save();

        $this->insertToUser($request);
        
        session()->flash('success', 'Staff successfully added.');
        return redirect()->route('staff.index');
    }

    public function insertToUser($request)
    {
        $staff_id = Staff::where('icno', $request->get('icno'))
                            ->value('id');

        User::create([
            'name'      =>  $request->get('name'),
            'email'     =>  $request->get('csc_email'),
            'password'  =>  Hash::make($request->get('password')),
        ]);

        User::where('email', $request->get('csc_email'))->update([
            'role'      => '2',
            'active'    => '1' ,
            'staff_id'  => $staff_id
        ]);
    }

    public function show(Staff $staff)
    {
        //
    }

    public function edit($id)
    {
        $staff = Staff::whereId($id)->first();
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'name'              => ['required', 'string'],
            'address'            => ['required', 'string'],
            'icno'              => ['required'],
            'personal_email'    => ['required', 'email'],
            'mobile'            => ['required'],
            'email'             => ['required', 'email'],
            'start_date'        => ['required'],
            'designation'       => ['required','string']
        ]);

        $data = request([
            'name',
            'address',
            'icno',
            'personal_email',
            'mobile',
            'email',
            'designation'
        ]);

        Staff::whereId($id)->update($data);

        $start = Carbon::createFromFormat('m/d/Y', $request->get('start_date'));
        Staff::whereId($id)->update(['start_date' => $start->format('Y-m-d')]);

        session()->flash('success', 'Staff info successfully updated.');
        return back();
    }

    public function destroy($id)
    {
        $name = Staff::whereId($id)->value('name');
        Staff::destroy($id);

        //  Return response
        return response()->json([
            'success' => true,
            'message' => "Staff ". $name ." has been deleted.",
        ]);
    }
}
