<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Sale;
use App\Models\Bill;
class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        return view('reports.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        setlocale(LC_TIME, 'Spanish');
        $startDate= $request->startDate;
        $endDate= $request->endDate;
        $dateRanges = CarbonPeriod::create($startDate, $endDate);
          $dataSales =[];
          $dataBills =[];
          $dataDaysLabels = [];
        foreach ($dateRanges as $value) {       
                $dataSales[] = Sale::where([
                    ['created_at', '>=', $value],
                    ['created_at', '<=', $value->copy()->endOfDay()],                   
                ])->sum('amount');
                $dataBills[] = Bill::where([
                    ['created_at', '>=', $value],
                    ['created_at', '<=', $value->copy()->endOfDay()],                   
                ])->sum('total_amount');                
               
                $day = $value->copy()->isoFormat('D');
                $month = $value->isoFormat('MMMM');
               $dataDaysLabels[] =  $day . ' ' . $month;
         
           
        }
         $data = array(            
            'dataSales' => $dataSales,
            'dataBills' => $dataBills,
            'dataDaysLabels' => $dataDaysLabels,            
          
        );

     return view('reports.index', compact('data'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
