<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefTreatment;
use Auth;

class RefTreatmentcontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user() && Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3) {
                return $next($request);
            }
             return redirect()->route('home'); // Replace 'home' with the actual route name of your home page
        });
    }
    public function ref_treatments()
    {
        $referencelist = RefTreatment::all();
        return view('reference_treatment/ref_treatmentslist', ['referencelist' => $referencelist]);
    }
    
 

    // delete reftreat data
    public function deletereftreatdata(request $request) {
        $reftreat = RefTreatment::find($request->reftreatid);
        $res =$reftreat->delete();
        return response()->json(['result' => $res]);  
    }

    // add reference treatment data
    public function addreftreatment(request $request) {
        $reftreat = new RefTreatment;
        $reftreat->name   = $request->ref_treatments; 
        $reftreat->charge_one     = $request->chargeone; 
        $reftreat->charge_two     = $request->chargetwo; 
        $reftreat->charge_three   = $request->chargethree; 
        $res = $reftreat->save();
        return response()->json(['result' => $res]);
    }

     // Get reference treatment data data
    public function getreftreatmentdata(request $request) {
        $id     = $request->get('reftreatid');
        $reftreat  = RefTreatment::where('id', $id)->first();
        return response()->json(['data' => $reftreat]);
    }

    // update ref treatment data
    public function updatereftreatment(request $request) {
        $reftreat = RefTreatment::find($request->Ereftreatid);
        
        $data = $request->except('_token'); 
        $reftreat->name   = $request->Eref_treatments;
        $res = $reftreat->save();
        return response()->json(['result' => $res]);
    }

  
}
