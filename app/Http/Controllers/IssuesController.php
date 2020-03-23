<?php

namespace App\Http\Controllers;

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
    public function index(Issues $issue)
    {
        return view('issue.index', ['Issues' => $issue->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('issue.create');
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

        $start = Carbon::createFromFormat('m/d/Y', $request->get('date'));

        // $issue = new Issues([
        $issue = new Issues([
            'name'              =>  $request->get('name'),
            'date'              =>  $start->format('Y-m-d'),
            'subject'           =>  $request->get('subject'),
            'description'       =>  $request->get('description'),
            'email'             =>  $request->get('csc_email'),

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
    public function show(Issues $issues)
    {
        return view('issue.show', ['Issues' => $issues->paginate(15)]);
    }

    public function assign(Issues $issues)
    {
        return view('issue.assign');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function edit(Issues $issue)
    {
        $id = $issue->id;
        $issue = Issues::find($id);
        return view('issue.edit', compact('issue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issues $issue)
    {
        //
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
