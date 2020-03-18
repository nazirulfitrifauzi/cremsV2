<?php

namespace App\Http\Controllers;

use App\Issues;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function show(Issues $issues)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issues  $issues
     * @return \Illuminate\Http\Response
     */
    public function edit(Issues $issue)
    {
        //
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
        //
    }
}
