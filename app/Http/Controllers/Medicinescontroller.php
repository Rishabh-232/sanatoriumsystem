<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicines;
use App\Models\Medicinescategories;
use Auth;

class Medicinescontroller extends Controller
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

    // get view  all medicine and medicine category data in list 
    public function medicines()
    {
        $medicine = Medicines::join('medicine_categories', 'medicine_categories.id', '=', 'medicines.medicine_category_id')->get(['medicines.*','medicine_categories.name as medicatename']);
        $medicate = Medicinescategories::get(['medicine_categories.*']);
        return view('medicines/medicineslist', ['medicine' => $medicine, 'medicate' => $medicate]);
    }  


    // delete medicine data
    public function deletemedicinesdata(request $request) {
        $medicine = Medicines::find($request->medi);
        $res =$medicine->delete();
        return response()->json(['result' => $res]);  
    }

     // add medicines data
    public function addmedicines(Request $request) {
        $medicine = new Medicines;
        $medicine->name = $request->name_medicine; 
        $medicine->medicine_category_id = $request->category; 

        // Handle the "Number of Times" checkboxes
        $selectedTimes = [];

        if ($request->has('morningCheckbox')) {
            $selectedTimes[] = 'M';
        }

        if ($request->has('afternoonCheckbox')) {
            $selectedTimes[] = 'A';
        }

        if ($request->has('eveningCheckbox')) {
            $selectedTimes[] = 'E';
        }
        if ($request->has('sosCheckbox')) {
            $selectedTimes[] = 'SOS';
        }

        $medicine->number_of_times = implode(', ', $selectedTimes); // Store as a comma-separated string
        $medicine->before_after = $request->berforeafter;
        $res = $medicine->save();
        
        return response()->json(['result' => $res]);
    }

    // add medicines category data
    public function addmedicinescategory(request $request) {
        $medicine = new Medicinescategories;
        $medicine->name   = $request->addmedicinecategory;
        $res = $medicine->save();
        return response()->json(['result' => $res]);
    }

    // Get medicine for edit data data
    public function getmedicinesdata(request $request) {
        $id     = $request->get('medi');
        $medicine  = Medicines::where('id', $id)->first();
        return response()->json(['data' => $medicine]);
    }

    // update medicines data
    public function updatemedicines(Request $request) {
        $medicine = Medicines::find($request->Emedi);
        $medicine->name = $request->Ename_medicine;
        $medicine->medicine_category_id = $request->Ecategory;

        // Handle the "Number Of Times" checkboxes
        $selectedTimes = [];

        if ($request->has('EmorningCheckbox')) {
            $selectedTimes[] = 'M';
        }

        if ($request->has('EafternoonCheckbox')) {
            $selectedTimes[] = 'A';
        }

        if ($request->has('EeveningCheckbox')) {
            $selectedTimes[] = 'E';
        }
        if ($request->has('EsosCheckbox')) {
            $selectedTimes[] = 'SOS';
        }

        $medicine->number_of_times = implode(', ', $selectedTimes); // Store as a comma-separated string
        $medicine->before_after = $request->Eberforeafter;
        $res = $medicine->save();

        return response()->json(['result' => $res]);
    }


    // medicine category home page function
     public function medicategoryhome()
    {
        $medicatehome = Medicinescategories::all();
        return view('medicines/medicinecategoryhome', ['medicatehome' => $medicatehome]);
    }

      // delete medicine data
    public function deleteMedicineCategorydata(request $request) {
        $medicine = Medicinescategories::find($request->Mcategory);
        $res =$medicine->delete();
        return response()->json(['result' => $res]);  
    }

     // Get medicine for edit data data
     public function getmedicinesCategorydata(request $request) {
        $id     = $request->get('medi');
        $medicine  = Medicinescategories::where('id', $id)->first();
        return response()->json(['data' => $medicine]);
    }

    // update medicines data
    public function updatemedicinesCategory(Request $request) {
        $medicine = Medicinescategories::find($request->Emedi);
        $medicine->name  = $request->editmedicinecategory;
        $res = $medicine->save();

        return response()->json(['result' => $res]);
    }

  
}
