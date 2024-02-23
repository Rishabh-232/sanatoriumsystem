<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\AssignPage;
use Carbon\Carbon;


class Plancontroller extends Controller
{
    //
    public function planlist()
    {
        $planlist = Plan::all();
        return view('plan/planlist', ['planlist' => $planlist]);
    }
    
    public function addPlan(request $request) {

        $selectedChecked = $request->input('checked_notes');
        // print_r($request->days);exit;
        $plan = new Plan;
        $plan->plan_name   = $request->plan_name; 
        $plan->plan_price   = $request->plan_price; 
        $plan->number_of_days   = $request->days; 
        $plan->access_to_page   = $selectedChecked; 
        $plan->fromdate         = Carbon::now('Asia/Kolkata');
        $plan->todate         = Carbon::now('Asia/Kolkata')->addDays($request->days);

  
        $res = $plan->save();
        return response()->json(['result' => $res]);
    }

       // delete plan data
    public function deleteplandata(request $request) {
        $plan = Plan::find($request->planid);
        $res =$plan->delete();
        return response()->json(['result' => $res]);  
    }
 
 
    // add reference treatment data
    public function planadd(request $request) {
        $page = AssignPage::all();
        return view('plan/planadd',['page'=>$page]); 

    }

       // add reference treatment data
    public function planview($id)
       {
           $plan = Plan::find($id);
           
           return view('plan/planview', ['planDetails' => $plan ]); 
       }

    public function planedit($id)
    {
        $details = Plan::find($id);
        $page = AssignPage::all();

        return view('plan/planedit', ['planDetails' => $details,'page'=>$page]);
    }
  

     // Get plan data data
    public function getplandata(request $request) {
        $id     = $request->get('planid');
        $plan  = Plan::where('id', $id)->first();
        return response()->json(['data' => $plan]);
    }

    // update plan data
    public function updatePlan(request $request, $id) {

        $selectedChecked = $request->input('checked_notes');

        $plan = Plan::find($id);
        
        $data = $request->except('_token'); 
        $plan->plan_name   = $request->plan_name;
        $plan->plan_price   = $request->plan_price;
        $plan->number_of_days   = $request->days; 
        $plan->access_to_page   = $selectedChecked; 
        $plan->fromdate          = Carbon::parse($request->from_date, 'Asia/Kolkata');
        $plan->todate          = Carbon::parse($request->from_date, 'Asia/Kolkata')->addDays($request->days);
        


        $res = $plan->save();
        return response()->json(['result' => $res]);
    }

    

}
