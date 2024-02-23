<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LabManagment;
use Illuminate\Http\Request;
use Auth;

class LabController extends Controller
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
    public function list()
    {
        $list = LabManagment::all();
        return view('Lab/lablist', ['lablist' => $list]);
    }

    public function labadd()
    {
        return view('Lab/labadd');
    }

    public function addLab(Request $request) {

        $lab = new LabManagment;
        $lab->lab_name                    = $request->lab_name; 
        $lab->contact_no                 = $request->lab_contact_no;
        $lab->lab_address                  = $request->lab_address;
        $lab->contact_person_no           = $request->contact_person_no;
        $lab->delivery_name              = $request->delivery_name;
        $lab->delivery_contct_no           = $request->delivery_contct_no;
        $lab->alt_delivry_name           = $request->alt_delivry_name;
        $lab->alt_delivry_contct_no           = $request->alt_delivry_contct_no;
        $lab->email                        = $request->email;
        $res = $lab->save();
        $lastId = $lab->id;
            
        return response()->json(['result' => $res, 'id' => $lastId]);
    }

    public function labview($id)
    {
        $details = LabManagment::find($id);
        return view('Lab/labview', ['labDetails' => $details]);
    }

    public function labedit($id)
    {
        $details = LabManagment::find($id);
        return view('Lab/labedit', ['labDetails' => $details]);
    }

    public function delete(request $request) {
        $lab = LabManagment::find($request->labid);
        $res =$lab->delete();
        return response()->json(['result' => $res]);  
    }


    public function updateLab(request $request, $id) {
        
        $lab = LabManagment::find($id);

        $lab->lab_name                    = $request->lab_name; 
        $lab->contact_no                 = $request->lab_contact_no;
        $lab->lab_address                  = $request->lab_address;
        $lab->contact_person_no           = $request->contact_person_no;
        $lab->delivery_name              = $request->delivery_name;
        $lab->delivery_contct_no           = $request->delivery_contct_no;
        $lab->alt_delivry_name           = $request->alt_delivry_name;
        $lab->alt_delivry_contct_no           = $request->alt_delivry_contct_no;
        $lab->email                        = $request->email;
        $res = $lab->save();
        return response()->json(['result' => $res]);
    }


    
}