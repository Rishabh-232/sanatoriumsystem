<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\LabNote;
use App\Models\Inventory;
use Carbon\Carbon;
use Auth;

class IncomereportController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user() && Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3) {
                return $next($request);
            }
             return redirect()->route('home'); // Replace 'home' with the actual route name of your home page
        });
    }

    public function grossincomereport(Request $request) {

    	$incomesQuery = Visit::query(); // you can create a Builder instance

        if ( $request->get('from_date_lab') !== null) { 
            $from_datelab = Carbon::parse($request->get('from_date_lab'));
            $incomesQuery->where('visits.date_of_visit', '>=' , $from_datelab->format('Y-m-d'));
        }

        if ( $request->get('to_date_lab') !== null) { 
            $to_datelab = Carbon::parse($request->get('to_date_lab'));
            $incomesQuery->where('visits.date_of_visit', '<=' , $to_datelab->format('Y-m-d'));
        }

    	$labchargesQuery = LabNote::query(); // you can create a Builder instance

        if ( $request->get('from_date_lab') !== null) { 
            $from_datelab = Carbon::parse($request->get('from_date_lab'));
            $labchargesQuery->where('lab_note.created_at', '>=' , $from_datelab->format('Y-m-d'));
        }

        if ( $request->get('to_date_lab') !== null) { 
            $to_datelab = Carbon::parse($request->get('to_date_lab'));
            $labchargesQuery->where('lab_note.created_at', '<=' , $to_datelab->format('Y-m-d'));
        }

        $inventoryQuery = Inventory::query(); // you can create a Builder instance

        if ( $request->get('from_date_lab') !== null) { 
            $from_datelab = Carbon::parse($request->get('from_date_lab'));
            $inventoryQuery->where('inventory_consultation.date', '>=' , $from_datelab->format('Y-m-d'));
        }

        if ( $request->get('to_date_lab') !== null) { 
            $to_datelab = Carbon::parse($request->get('to_date_lab'));
            $inventoryQuery->where('inventory_consultation.date', '<=' , $to_datelab->format('Y-m-d'));
        }
    	
    	$incomes = $incomesQuery->get(['visits.total_amount']);
    	$labcharges = $labchargesQuery->orderBy('created_at')->get(['lab_bill', 'created_at']);
        $inventorycharges = $inventoryQuery->orderBy('date')->get(['payment', 'date']);

    	$grossamount = 0;
    	$grosspaidamount = 0;
        $inventoryamount = 0;
    	$profit = 0;
    	$dataArr = $labcharges->toArray();

    // 	if(count($dataArr) > 0) {
	   // 	$startDate = $dataArr[0]['order_date'];
	   // 	$endDate = $dataArr[count($dataArr) - 1]['order_date'];
	   // } else {
	   // 	$startDate = $request->get('from_date_lab');
	   // 	$endDate = $request->get('to_date_lab');
	   // }
	   
	   if($request->get('from_date_lab') !== null && $request->get('to_date_lab') !== null) {
	    	// $startDate = $dataArr[0]['order_date'];
	    	// $endDate = $dataArr[count($dataArr) - 1]['order_date'];
	    	$startDate = date('d-M-Y', strtotime($request->get('from_date_lab')));
	    	$endDate = date('d-M-Y', strtotime($request->get('to_date_lab')));
	    } else {
	    	$startDate = "";
	    	$endDate = "";
	    }

    	foreach($labcharges as $charge) {
    		$grossamount += $charge->lab_bill;
    	} 

    	foreach($incomes as $income) {
    		$grosspaidamount += $income->total_amount;
    	} 

        foreach($inventorycharges as $inventory) {
            $inventoryamount += $inventory->payment;
        }

    	$profit =   $grosspaidamount - $grossamount - $inventoryamount;

    	// $patientstotalamt = $incomes->total_amount;

    	// $grossamount = 0;
     //    $grossamount += $labcharges + $patientstotalamt;

        // print_r($grossamount); exit();

    	//print_r($request->get('from_date_lab'));

    	return view('income_report/gross_income_report', ['grosspaidamount' => $grosspaidamount, 'profit' => $profit, 'grossamount' => $grossamount, 'startDate' => $startDate, 'endDate' => $endDate, 'inventoryamount' => $inventoryamount]);
    }

    
}
