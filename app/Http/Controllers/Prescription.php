<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Treatment;
use App\Models\Medicines;
use App\Models\Medicinescategories;
use Carbon\Carbon;

class Prescription extends Controller
{
    //

    /**
     * Create Prescription Form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patientprescription($id) {
       // $list = Patient::all();
      $details            = Patient::find($id);
      $details->actualAge = Carbon::parse($details->date_of_birth)->age;

      $medicine = Medicines::join('medicine_categories', 'medicine_categories.id', '=', 'medicines.medicine_category_id')->get(['medicines.*','medicine_categories.name as medicatename']);
      $medicate = Medicinescategories::get(['medicine_categories.*']);

      $medicineId = Medicines::join('medicine_categories', 'medicine_categories.id', '=', 'medicines.medicine_category_id')->get(['medicine_categories.*','medicines.medicine_category_id as medicateid']);
      $medcategory = Medicinescategories::get(['medicine_categories.*']);
      $finalArr = [];
      foreach ($medicate as $value) {
       // code...
        $medicine = Medicines::join('medicine_categories', 'medicine_categories.id', '=', 'medicines.medicine_category_id')->where('medicines.medicine_category_id', $value->id)->get(['medicines.*','medicine_categories.name as medicatename'])->toArray();
        $finalArr[$value->name] = $medicine;
      }

      return view('prescription/prescriptionadd', ['patientList' => $details, 'patientId' => $id, 'medicine' => $medicine, 'medicate' => $medicate,  'medicineId' => $medicineId, 'finalArr' => $finalArr, 'medcategory' => $medcategory]);
    }
}
