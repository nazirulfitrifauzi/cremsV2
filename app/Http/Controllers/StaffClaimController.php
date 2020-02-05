<?php

namespace App\Http\Controllers;

use App;
use App\Company;
use App\StaffClaim;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firstDay = Carbon::now()->firstOfMonth();
        $lastDay = Carbon::now()->endOfMonth();

        $total_claim = 0;
        $claim = StaffClaim::where('date', '>=', $firstDay)
                            ->where('date', '<=', $lastDay)
                            ->where('status', '1')
                            ->where('approved', '1')
                            ->get();

        foreach ($claim as $data) {
            $total_claim += $data->amt;
        }

        return view('claim.index', compact('total_claim'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('claim.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type'              => ['required'],
            'amt'               => ['required'],
            'attachment'        => ['required']
        ]);

        $cmonth       = now()->format('M');
        $cyear        = now()->year;
        $runningno = StaffClaim::orderBy('id', 'desc')->limit(1)->first();

        if (!$runningno) {
            $newrunningno = sprintf('%09d', 0 + 1);
        } else {
            $newrunningno = sprintf('%09d', $runningno->id + 1);
        }

        $refno        = 'CLA/'.strtoupper($cmonth).$cyear .'/'. $newrunningno;

        $receipt = $request->file('attachment');
        $receipt_name = 'receipt_CLA_'.strtoupper($cmonth).$cyear .'_'. $newrunningno . '.jpg';
        Storage::disk('local')->putFileAs('public/Receipt', $receipt, $receipt_name);

        $staffClaim = new StaffClaim([
            'ref_no'        => $refno,
            'staff_id'      => auth()->user()->staff_id,
            'type'          => $request->get('type'),
            'amt'           => $request->get('amt'),
            'remarks'       => $request->get('remarks'),
            'attachment'    => $receipt_name,
            'date'          => now()
        ]);

        $staffClaim->save();

        session()->flash('success', 'Your Claim Application has been submit.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::first();
        $claim = StaffClaim::whereId($id)->first();
        $user = StaffClaim::find($id)->staff_info;

        $content = array(
            'company'   => $company,
            'claim'     => $claim,
            'user'      => $user,
        );

        view()->share([
            'content' => $content
        ]);

        $pdf_name = $claim->ref_no . '.pdf';

        $data = [
                'title'     => $pdf_name
            ];

        $pdf = PDF::loadView('claim.pdf.form', $data);
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        StaffClaim::whereId($id)->update(['status' => '1', 'approved' => '1']);

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StaffClaim::whereId($id)->update(['status' => '1', 'approved' => '0']);

        //  Return response
        return response()->json([
            'success' => true,
            'message' => "Claim Appplication has been rejected.",
        ]);
    }
}
