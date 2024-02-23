<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Auth;

class InventoryController extends Controller
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
    public function inventorylist()
    {                
        $list = Inventory::orderBy('date', 'asc')->get();
        return view('Inventory/inventory', ['inventoryList' => $list]);
    }

    // add inventory data
    public function addInventory(request $request) {
        $inventory = new Inventory;
        $inventory->reference   = $request->reference; 
        $inventory->name   = $request->dealer_name; 
        $inventory->payment   = $request->amount; 
        $inventory->date   = date("Y-m-d", strtotime($request->paid_date));
        $res = $inventory->save();
        return response()->json(['result' => $res]);
    }

    // add Consultation data
    public function addConsultation(request $request) {
        $inventory = new Inventory;
        $inventory->reference   = $request->reference; 
        $inventory->name   = $request->doctor_name; 
        $inventory->payment   = $request->amount; 
        $inventory->date   = date("Y-m-d", strtotime($request->consultationdate));
        $res = $inventory->save();
        return response()->json(['result' => $res]);
    }

    // Get reference inventory data
    public function getinventorydata(request $request) {
        $id     = $request->get('reftreatid');
        $reftreat  = Inventory::where('id', $id)->first();
        $reftreat->date = date("d-M-Y", strtotime($reftreat->date));
        return response()->json(['data' => $reftreat]);
    }

    // Get reference consultation data
    public function getconsultationdata(request $request) {
        $id     = $request->get('reftreatid');
        $reftreat  = Inventory::where('id', $id)->first();
        $reftreat->date = date("d-M-Y", strtotime($reftreat->date));
        return response()->json(['data' => $reftreat]);
    }

    // update ref inventory data
    public function updateinventory(request $request) {
        $inventory = Inventory::find($request->Inventoryid);
        
        $data = $request->except('_token'); 
        $inventory->name   = $request->editdealer_name; 
        $inventory->payment   = $request->editamount; 
        $inventory->date   = date("Y-m-d", strtotime($request->editpaid_date));
        $res = $inventory->save();
        return response()->json(['result' => $res]);
    }

    // update ref consultation data
    public function updateconsultation(request $request) {
        $consultation = Inventory::find($request->Consultationid);
        
        $data = $request->except('_token'); 
        $consultation->name   = $request->consdoctor_name; 
        $consultation->payment   = $request->consamount; 
        $consultation->date   = date("Y-m-d", strtotime($request->consconsultationdate));
        $res = $consultation->save();
        return response()->json(['result' => $res]);
    }

    // delete reftreat data
    public function deleteinventordata(request $request) {
        $reftreat = Inventory::find($request->reftreatid);
        $res =$reftreat->delete();
        return response()->json(['result' => $res]);  
    }
}
