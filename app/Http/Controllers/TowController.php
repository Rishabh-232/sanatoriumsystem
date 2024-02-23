<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TOW;
use App\Models\LabManagment;
use App\Models\Patient;
use App\Models\Files;
use App\Models\Treatment;
use Carbon\Carbon;
use Auth;


use Illuminate\Http\Request;

class TowController extends Controller
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
   public function TOWlist()
    {
        $list = TOW::all(); // Retrieve all records

        return view('Type_of_work/TOWlist', ['TOWlist' => $list]);
    }

    public function TOWadd()
    {
        $Lab = LabManagment::all();
        return view('Type_of_work/TOWadd',['Lab' => $Lab]);
    }

    public function addTOW(Request $request) {
        $TOW = new TOW;
        $TOW->type_of_work              = $request->type_of_work; 

        // Build a comma-separated list of selected treatment names
        $selectedLabs = $request->lab_name;
        $labsNames = [];
        foreach ($selectedLabs as $treatment) {
            $labsNames[] = $treatment;
        }
        $TOW->lab_name = implode(',', $labsNames);
        $TOW->charges                  = $request->charges;
        $res = $TOW->save();
        $lastId = $TOW->id;
            
        return response()->json(['result' => $res, 'id' => $lastId]);
    }

    public function TOWview($id)
    {
        $details = TOW::find($id);
        return view('Type_of_work/TOWview', ['TOWDetails' => $details]);
    }


    public function TOWedit($id)
    {
        $details = TOW::find($id);
        $Lab = LabManagment::all();

        $TOWIds = explode(',', $details->lab_name);

        $towid = [];
        foreach($TOWIds as $Ids){

            $towN = TOW::where('lab_name',$Ids)->value('id');
            array_push($towid, $towN);
        }

        return view('Type_of_work/TOWedit', ['TOWDetails' => $details,'Lab' => $Lab,'TOWIds' => $towid]);
    }
    public function TOWdelete(request $request) {
        $TOW = TOW::find($request->TOWid);
        $res =$TOW->delete();
        return response()->json(['result' => $res]);  
    }


    public function updateTOW(request $request, $id) {
        
        $TOW = TOW::find($id);

        $TOW->type_of_work              = $request->type_of_work; 

        // Build a comma-separated list of selected treatment names
        $selectedLabs = $request->lab_name;
        $labsNames = [];
        foreach ($selectedLabs as $treatment) {
            $labsNames[] = $treatment;
        }
        $TOW->lab_name = implode(',', $labsNames);
        $TOW->charges                  = $request->charges;
        $res = $TOW->save();
        return response()->json(['result' => $res]);
    }

// patient page start

    public function patientlist()
    {
        $list = Patient::all();
        // print_r($list);exit;
        return view('patient/patientlist', ['patientlist' => $list]);

    }
   

    public function patientadd()
    {
        return view('patient/patientadd');
    }

    public function patientedit($id)
    {
        $details = Patient::find($id);
        return view('patient/patientedit', ['patient' => $details]);
    }

    public function patientview($id)
    {
        $details = Patient::find($id);
        $Treatment = Treatment::where('patient_id',$id)->get();
        $TreatmentImages = Files::where('patient_id', $id)->get();

        $formFiles = [];
        foreach ($TreatmentImages as $TreatmentImage) {
            if (!empty($TreatmentImage->formFile)) {
                $formFile = json_decode($TreatmentImage->formFile);
                $formFiles[] = $formFile;
            }
        }
        // print_r($formFile);exit;

        return view('patient/patientview', ['patient' => $details,'Treatment' =>$Treatment,'formFiles'=>$formFiles]);
    }
    
    public function patientdelete(request $request) {
        $patient = Patient::find($request->patientId);
        $res =$patient->delete();
        return response()->json(['result' => $res]);  
    }

    public function addpatient(Request $request)
    {
        $Patient = new Patient;
        $Patient->patient_name                    = $request->patient_name; 
        $Patient->address                         = $request->address;
        $Patient->age                             = $request->age;
        $Patient->dob                             = $request->dob;
        $Patient->mob_no                          = $request->mob_no;
        $res = $Patient->save();
        $lastId = $Patient->id;
            
        return response()->json(['result' => $res, 'id' => $lastId]);

    }
   
    public function updatepatient(request $request, $id) {

        $Patient = Patient::find($id);
        $Patient->patient_name                    = $request->patient_name; 
        $Patient->address                         = $request->address;
        $Patient->age                             = $request->age;
        $Patient->dob                             = $request->dob;
        $Patient->mob_no                          = $request->mob_no;
        $res = $Patient->save();
        return response()->json(['result' => $res]);
    }
    
    // treatment page add 

    public function addtreatment($id)
    {
        return view('patient/addtreatment', ['id' => $id]);
    }


    public function treatmentadd(Request $request)
    {

        $Patient = new Treatment;
        $Patient->patient_id                        = $request->patient_id; 
        $Patient->description                       = $request->description;
        $Patient->date                              = $request->date;
        $Patient->doctor                            = $request->doctor;

        $res = $Patient->save();
        $lastId = $Patient->id;
            
        return response()->json(['result' => $res, 'id' => $lastId]);

    }

    public function edittreatment($id)
    {
        $Treatment = Treatment::find($id);
        return view('patient/edittreatment',['Treatment'=>$Treatment]);
    }

    public function updatetreatment(request $request, $id) {

        $Treatment = Treatment::find($id);
        $Treatment->description                    = $request->description;
        $Treatment->doctor                         = $request->doctor;
        $Treatment->date                           = $request->date;
        $res = $Treatment->save();
        return response()->json(['result' => $res]);
    }
    
    public function Imageupload(request $request) {


        $images = $request->file('image_file');
        // print_r($images);exit;
        $destinationPath = public_path('/upload');
        $imageNames = [];
        
        foreach ($images as $image) {
            // print_r($image);
            $guessExtension = $image->guessExtension();
            $fileName = 'Treatment-'.Carbon::now()->timestamp.'-'.uniqid().'.'.$guessExtension;
            // echo $fileName."\n";
            $image->move($destinationPath, $fileName);
            $imageNames[] = $fileName;
            // sleep(1);
        }

        $Imageupload = new Files;
        $Imageupload->patient_id                        = $request->patientid; 
        $Imageupload->formFile                          = json_encode($imageNames); 
        $res = $Imageupload->save();
        return response()->json(['result' => $res]);
    }

    
}