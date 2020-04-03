<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Issues;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Issues $issue, Staff $staff)
    {
        // if(auth()->user()->roles->role == 'Staff')
        // {
        //     $Issues = Issues::where()
        // }
        // else
        // {
        //     $Issues = Issues::all()->paginate(15);
        // }


        return view('issue.index', ['Issues' => $issue->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Staff $staff)
    {
        $staff = Staff::all();
        return view('issue.create', compact('staff'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $newdate = Carbon::createFromFormat('m/d/Y', $request->get('date'));

        $issue = new Issues([
            'name'              =>  $request->get('name'),
            'date'              =>  $newdate,
            'subject'           =>  $request->get('subject'),
            'description'       =>  $request->get('description'),
            'email'             =>  $request->get('email'),
            'staffAssigned'     =>  $request->get('staffAssigned'),
            'status'            =>  $request->get('status')
            // column name => name dri form frontend
        ]);

        $issue->save();

        session()->flash('success', 'Issue successfully added.');
        return redirect()->route('issues.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function show(Issues $issue, Staff $staff)
    {
        $id = $issue->id;
        $issue = Issues::find($id);
        return view('issue.show', compact('issue', 'staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function edit(Issues $issue, Staff $staff)
    {
        $staff = Staff::all();
        $id = $issue->id;
        $issue = Issues::find($id);
        return view('issue.edit', compact('issue', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issues $issue, Staff $staff)
    {
        //dd($request->all());
        $newdate = Carbon::createFromFormat('m/d/Y', $request->get('date'));

        $issue->name = request('name');
        $issue->date = $newdate;
        $issue->subject = request('subject');
        $issue->description = request('description');
        $issue->email = request('email');
        $issue->staffAssigned = request('staffAssigned');
        $issue->status = request('status');

        $issue->update();


        session()->flash('success', 'Issue successfully updated.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issues $issue)
    {
        $id = $issue->id;
        $issue = Issues::where('id', $id)->value('id');

        Issues::destroy($id);

        //  Return response
        return response()->json([
            'success' => true,
            'message' => "Issue " . $issue . " has been deleted.",
        ]);
    }
}
