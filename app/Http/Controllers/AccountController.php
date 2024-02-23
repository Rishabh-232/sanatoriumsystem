<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Lab;
use App\Models\Treatment;
use Carbon\Carbon;
use Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user() && Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3) {
                return $next($request);
            }
             return redirect()->route('home'); // Replace 'home' with the actual route name of your home page
        });
    }

    /**
     * Show the patient list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function accountlist()
    // {
    //     $list = Visit::join('patients', 'patients.id', '=', 'visits.patient_id', 'LEFT')
    //                  ->leftJoin('lab_orders', function ($join) {
    //                      $join->on('lab_orders.patient_id', '=', 'visits.patient_id')
    //                           ->whereRaw('DATE(visits.date_of_visit) = DATE(lab_orders.order_date)');
    //                  })
    //                  ->orderBy('visits.date_of_visit', 'asc')
    //                  ->select('visits.*', 'patients.name', 'patients.age', 'patients.sex', 'patients.contact_1', 'patients.attended_by', 'lab_orders.amount','lab_orders.lab_name')
    //                  ->get();
                
    //     return view('account/accountlist', ['visitlist' => $list]);
    // }
    public function accountlist()
    {
        $list = Visit::join('patients', 'patients.id', '=', 'visits.patient_id', 'LEFT')
        ->join('treatments', 'treatments.id', '=', 'visits.work_done')
                     ->select('visits.*', 'patients.name','treatments.treatment_info as treatinfo')
                     ->get();
                
        // print_r($list);exit;
        return view('account/accountlist', ['visitlist' => $list]);
    }
}