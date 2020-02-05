<?php

namespace App\Http\Controllers;

use App\Advance;
use App\StaffClaim;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use PDF;

class StaffAdvanceController extends Controller
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

        return view('advance.index', compact('total_claim'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('advance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->input('action'))
        {
            case 'schedule':
                $amt = floatval(str_replace(',', '', $request->get('amt')));
                $deduct = $request->get('month_deduct');
                $duration = $request->get('month_duration');

                $x = Carbon::now()->addMonths(1)->endOfMonth(); //end of nextmonth;
                $y = Carbon::now()->addMonths($duration-1)->endOfMonth();
                $z = Carbon::now()->addMonths($duration)->endOfMonth()->format('F Y');
                $last_deduct = $amt-(($duration-1)*$deduct);

                foreach (CarbonPeriod::create($x, $y) as $month) {
                    $months[$month->format('m-Y')] = $month->format('F Y');
                }

                $content = array(
                    'months'   => $months,
                );
        
                view()->share([
                    'content' => $content
                ]);

                $pdf_name = 'Repayment Schedule.pdf';

                $data = [
                        'title'         => $pdf_name,
                        'amt'           => $amt,
                        'deduct'        => $deduct,
                        'duration'      => $duration,
                        'last_month'    => $z,
                        'last_deduct'   => $last_deduct,
                    ];

                $pdf = PDF::loadView('advance.pdf.schedule', $data);
                return $pdf->stream();

                break;
            case 'store':
                dd('store');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function show(Advance $advance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function edit(Advance $advance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advance $advance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advance $advance)
    {
        //
    }
}
