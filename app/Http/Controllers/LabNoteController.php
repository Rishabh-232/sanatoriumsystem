<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\LabNote;
use App\Models\LabManagment;
use App\Models\TOW;
use App\Models\Note;
use App\Models\Shades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PDF;
use Auth;

use Carbon\Carbon;

class LabNoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user() && Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4) {
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
    public function labnotelist()
    {
        $list = LabNote::join('lab' , 'lab.id', '=' ,'lab_note.lab_name')
        ->join('patients','patients.id','=','lab_note.patient_name')
        ->get(['lab_note.*','lab.lab_name as labname','patients.name as patient_name']);
        return view('Labnote/labnotelist', ['doctorlist' => $list]);
    }

    /**
     * Show the doctor add.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function labnoteadd()
    {
        $list = Patient::orderBy('id', 'asc')->get();
        $Lab = LabManagment::all();
        $TOW = TOW::all();
        $note = Note::all();
        $Shades = Shades::all();

        return view('Labnote/labnoteadd', ['Lab' => $Lab,'TOW'=>$TOW,'note'=>$note,'PatientList' => $list,'Shades'=>$Shades]);
    }

    /**
     * Insert doctor record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function addLabNote(Request $request) {

        $labnum = LabManagment::find($request->lab_name);
        $patname = Patient::find($request->patient_name);
        // print_r($labnum['contact_no']);exit;

        $shadesArray = $request->shades;
        // print_r($shadesArray[0]);exit;
        $selectedOption = $request->input('selected_option');
        $selectedChecked = $request->input('checked_notes');

        // $labBill = 0;
        // foreach($request->type_of_work as $tow){
        //     $TOW = TOW::where('type_of_work',$tow)->get(['type_of_work.charges']);
        //     foreach($TOW as $charge){

        //         $labBill = $labBill + $charge['charges'];
        //     }
        // }
        // print_r($labBill);exit;
        $doctor = new LabNote;
        $doctor->patient_name                  = $request->patient_name; 
        $doctor->lab_name                      = $request->lab_name;
        $doctor->teeth_tooth                   = $request->selectedteeth;
        $doctor->additional                   = $request->additional;
        $doctor->multishade                   = $request->selectedShade;

        // Build a comma-separated list of selected TOW names
        // $selectedTOW = $request->type_of_work;
        // $TOWNames = [];
        // foreach ($selectedTOW as $TOW) {
        //     $TOWNames[] = $TOW;
        // }
        // $doctor->type_of_work = implode(',', $TOWNames);

        $doctor->type_of_work                  = $request->type_of_work;
        $doctor->excepted_date_of_deliver      = date("Y-m-d", strtotime($request->excepted_date_of_deliver));
        // $doctor->note                          = $selectedChecked;
        // $doctor->lab_bill                      = $labBill;
        $doctor->selectedOption                   = $selectedOption;
        $doctor->active                        = 1;
        $doctor->shades =                    $shadesArray[0];

            
        $res = $doctor->save();
        $lastId = $doctor->id;


        $message = "Lab Name: " . ($labnum ? $labnum->lab_name : 'N/A') . "\n";
        $message .= "Patient Name: " . ($patname ? $patname->name : 'N/A') . "\n";
        $message .= "Teeth/Tooth: $request->selectedteeth\n";
        // $message .= "Type Of Work: " . implode(',', $TOWNames) . "\n";
        $message .= "Type Of Work: $request->type_of_work\n";
        $message .= "Teeth Shade: $request->selectedShade, $shadesArray[0]\n";
        // $message .= "Instructions: $selectedChecked\n";
        $message .= "Instructions: $request->additional\n";
        $message .= "Work Given In The Form: $selectedOption\n";
        $message .= "Expected Date Of Delivery: " . date("Y-m-d", strtotime($request->excepted_date_of_deliver));

        $instantInstanceId = '65A0E886829CE';
        $instantAccessToken = '659f7b7e9e1a2';

        $url = 'https://allexpert.store/api/send';

                $number = '91' . $labnum['contact_no'];

                $postData = [
                    'number' => $number,
                    'type' => 'text',
                    'message' => $message,
                    'instance_id' => $instantInstanceId,
                    'access_token' => $instantAccessToken,
                ];

            $ch = curl_init($url);

            // Set the necessary cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

            // Execute the cURL request
            $response = curl_exec($ch);

            // Check for errors
            if ($response === false) {
                $error = curl_error($ch);
                return response()->json(['error' => $error], 500);
            }

            curl_close($ch);
            // Handle the response
            $result[] = ['result' => $response, 'number' => $number];

        return response()->json(['result' => $res, 'id' => $lastId]);
    }

    // for save and print function

     public function addprintLabNote(Request $request) {

        $labnum = LabManagment::find($request->lab_name);
        $patname = Patient::find($request->patient_name);
        $shadesArray = $request->shades;


        $selectedOption = $request->input('selected_option');
        $selectedChecked = $request->input('checked_notes');

        // print_r($selectedOption);exit;

        // $labBill = 0;
        // foreach($request->type_of_work as $tow){
        //     $TOW = TOW::where('type_of_work',$tow)->get(['type_of_work.charges']);
        //     foreach($TOW as $charge){

        //         $labBill = $labBill + $charge['charges'];
        //     }
        // }
        // print_r($labBill);exit;
        $doctor = new LabNote;
        $doctor->patient_name                  = $request->patient_name; 
        $doctor->lab_name                      = $request->lab_name;
        $doctor->teeth_tooth                   = $request->selectedteeth;
        $doctor->additional                   = $request->additional;
        $doctor->multishade                   = $request->selectedShade;


        // Build a comma-separated list of selected TOW names
        // $selectedTOW = $request->type_of_work;
        // $TOWNames = [];
        // foreach ($selectedTOW as $TOW) {
        //     $TOWNames[] = $TOW;
        // }
        // $doctor->type_of_work = implode(',', $TOWNames);

        $doctor->type_of_work                  = $request->type_of_work;
        $doctor->excepted_date_of_deliver      = date("Y-m-d", strtotime($request->excepted_date_of_deliver));
        // $doctor->note                          = $selectedChecked;
        // $doctor->lab_bill                      = $labBill;
        $doctor->selectedOption                   = $selectedOption;
        $doctor->active                        = 1;
        $doctor->shades                        =     $shadesArray[0];

            
        $res = $doctor->save();
        $lastId = $doctor->id;

        $message = "Lab Name: " . ($labnum ? $labnum->lab_name : 'N/A') . "\n";
        $message .= "Patient Name: " . ($patname ? $patname->name : 'N/A') . "\n";
        $message .= "Teeth/Tooth: $request->selectedteeth\n";
        // $message .= "Type Of Work: " . implode(',', $TOWNames) . "\n";
        $message .= "Type Of Work: $request->type_of_work\n";
        $message .= "Teeth Shade: $request->selectedShade, $shadesArray[0]\n";
        // $message .= "Instructions: $selectedChecked\n";
        $message .= "Instructions: $request->additional\n";
        $message .= "Work Given In The Form: $selectedOption\n";
        $message .= "Expected Date Of Delivery: " . date("Y-m-d", strtotime($request->excepted_date_of_deliver));

        $instantInstanceId = '65A0E886829CE';
        $instantAccessToken = '659f7b7e9e1a2';

        $url = 'https://allexpert.store/api/send';

                $number = '91' . $labnum['contact_no'];

                $postData = [
                    'number' => $number,
                    'type' => 'text',
                    'message' => $message,
                    'instance_id' => $instantInstanceId,
                    'access_token' => $instantAccessToken,
                ];

            $ch = curl_init($url);

            // Set the necessary cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

            // Execute the cURL request
            $response = curl_exec($ch);

            // Check for errors
            if ($response === false) {
                $error = curl_error($ch);
                return response()->json(['error' => $error], 500);
            }

            curl_close($ch);
            // Handle the response
            $result[] = ['result' => $response, 'number' => $number];
            
        return response()->json(['result' => $res, 'id' => $lastId]);
    }

     public function downloadLabNote(Request $request) {

        $labnum = LabManagment::find($request->lab_name);
        $patname = Patient::find($request->patient_name);

        $shadesArray = $request->shades;


        $selectedOption = $request->input('selected_option');
        $selectedChecked = $request->input('checked_notes');

        // print_r($selectedOption);exit;

        // $labBill = 0;
        // foreach($request->type_of_work as $tow){
        //     $TOW = TOW::where('type_of_work',$tow)->get(['type_of_work.charges']);
        //     foreach($TOW as $charge){

        //         $labBill = $labBill + $charge['charges'];
        //     }
        // }
        // print_r($labBill);exit;
        $doctor = new LabNote;
        $doctor->patient_name                  = $request->patient_name; 
        $doctor->lab_name                      = $request->lab_name;
        $doctor->teeth_tooth                   = $request->selectedteeth;
        $doctor->additional                   = $request->additional;
        $doctor->multishade                   = $request->selectedShade;


        // Build a comma-separated list of selected TOW names
        // $selectedTOW = $request->type_of_work;
        // $TOWNames = [];
        // foreach ($selectedTOW as $TOW) {
        //     $TOWNames[] = $TOW;
        // }
        // $doctor->type_of_work = implode(',', $TOWNames);

        $doctor->type_of_work                  = $request->type_of_work;
        $doctor->excepted_date_of_deliver      = date("Y-m-d", strtotime($request->excepted_date_of_deliver));
        // $doctor->note                          = $selectedChecked;
        // $doctor->lab_bill                      = $labBill;
        $doctor->selectedOption                   = $selectedOption;
        $doctor->active                        = 1;
        $doctor->shades                       =   $shadesArray[0];

            
        $res = $doctor->save();
        $lastId = $doctor->id;

        $message = "Lab Name: " . ($labnum ? $labnum->lab_name : 'N/A') . "\n";
        $message .= "Patient Name: " . ($patname ? $patname->name : 'N/A') . "\n";
        $message .= "Teeth/Tooth: $request->selectedteeth\n";
        // $message .= "Type Of Work: " . implode(',', $TOWNames) . "\n";
        $message .= "Type Of Work: $request->type_of_work\n";
        $message .= "Teeth Shade: $request->selectedShade, $shadesArray[0]\n";
        // $message .= "Instructions: $selectedChecked\n";
        $message .= "Instructions: $request->additional\n";
        $message .= "Work Given In The Form: $selectedOption\n";
        $message .= "Expected Date Of Delivery: " . date("Y-m-d", strtotime($request->excepted_date_of_deliver));

        $instantInstanceId = '65A0E886829CE';
        $instantAccessToken = '659f7b7e9e1a2';

        $url = 'https://allexpert.store/api/send';

                $number = '91' . $labnum['contact_no'];

                $postData = [
                    'number' => $number,
                    'type' => 'text',
                    'message' => $message,
                    'instance_id' => $instantInstanceId,
                    'access_token' => $instantAccessToken,
                ];

            $ch = curl_init($url);

            // Set the necessary cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

            // Execute the cURL request
            $response = curl_exec($ch);

            // Check for errors
            if ($response === false) {
                $error = curl_error($ch);
                return response()->json(['error' => $error], 500);
            }

            curl_close($ch);
            // Handle the response
            $result[] = ['result' => $response, 'number' => $number];
            
        return response()->json(['result' => $res, 'id' => $lastId]);
    }

    /**
     * Show the doctor view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function labnoteview($id)
    // {
    //     $details = LabNote::join('lab' , 'lab.id', '=' ,'lab_note.lab_name')->get(['lab_note.*','lab.lab_name as labname'])->find($id);
    //     $tow = LabNote::where('id',$id)->value('type_of_work');
    //     $Ids = explode(',', $tow);

    //     $towname = [];
    //     foreach($Ids as $Ids){

    //         $towN = TOW::where('id',$Ids)->value('type_of_work');
    //         array_push($towname, $towN);
    //     }
    //     // print_r($towname);
    //     return view('Labnote/labnoteview', ['doctorDetails' => $details,'towname'=>$towname]);
    // }
    public function labnoteview($id)
    {
        $details = LabNote::join('lab' , 'lab.id', '=' ,'lab_note.lab_name')
        ->join('patients','patients.id','=','lab_note.patient_name')
        ->get(['lab_note.*','lab.lab_name as labname','patients.name as patient_name' , 'patients.patient_uniq_id as patient_uniq_id'])->find($id);
        
        return view('Labnote/labnoteview', ['doctorDetails' => $details]);
    }

    // /**
    //  * Show the doctor edit.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function labenotedit($id)
    {
        $details = LabNote::find($id);
        $Lab = LabManagment::all();
        $Patient = Patient::orderBy('id', 'asc')->get();
        $TOW = TOW::all();
        $note = Note::all();
        $Shades = Shades::all();
        $toothArr = json_decode($details->teeth_tooth);

        $TOWIds = explode(',', $details->type_of_work);

        $towid = [];
        foreach($TOWIds as $Ids){

            $towN = TOW::where('type_of_work',$Ids)->value('id');
            array_push($towid, $towN);
        }
        // print_r($towid);exit;

        return view('Labnote/labenotedit', ['doctorDetails' => $details,'Lab' => $Lab ,'TOW' => $TOW , 'toothArr' => $toothArr ,'TOWIds' => $towid,'note'=>$note,'Patient'=>$Patient,'Shades'=>$Shades]);
    }
    
    public function receptionistedit($id)
    {
        $details = LabNote::find($id);
        $Lab = LabManagment::all();
        $toothArr = json_decode($details->teeth_tooth);

        return view('Labnote/receptionistedit', ['doctorDetails' => $details,'Lab' => $Lab ]);
    }

    // /**
    //  * Show the doctor update.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function updateLabnote(request $request, $id) {

        $shadesArray = $request->shades;

        $selectedOption = $request->input('selected_option');
        $selectedChecked = $request->input('checked_notes');

        // $labBill = 0;
        // foreach($request->type_of_work as $tow){
        //     $TOW = TOW::where('type_of_work',$tow)->get(['type_of_work.charges']);
        //     foreach($TOW as $charge){

        //         $labBill = $labBill + $charge['charges'];
        //     }
        // }


        $doctor = LabNote::find($id);
        $doctor->patient_name                  = $request->patient_name; 
        $doctor->lab_name                      = $request->lab_name;
        $doctor->teeth_tooth                   = $request->Eselectedteeth;
        $doctor->additional                   = $request->additional;
        $doctor->multishade                   = $request->selectedShade;


        // Build a comma-separated list of selected TOW names
        // $selectedTOW = $request->type_of_work;
        // $TOWNames = [];
        // foreach ($selectedTOW as $TOW) {
        //     $TOWNames[] = $TOW;
        // }
        // $doctor->type_of_work = implode(',', $TOWNames);

        $doctor->type_of_work                  = $request->type_of_work;
        $doctor->excepted_date_of_deliver      = date("Y-m-d", strtotime($request->excepted_date_of_deliver));
        // $doctor->note                          = $selectedChecked;
        // $doctor->lab_bill                      = $labBill;
        $doctor->selectedOption                   = $selectedOption;
        $doctor->shades                        =      $shadesArray[0];
        $res = $doctor->save();
        return response()->json(['result' => $res]);
    }


    public function updateReceptionist(request $request, $id) {
        $doctor = LabNote::find($id);
        $doctor->to_be_given                    = $request->to_be_given;
        $doctor->given                          = $request->given;
        if ($request->given_on == 'Not Given') {
            $doctor->given_On = NULL;
        } else {
            $doctor->given_On = date("Y-m-d", strtotime($request->given_on));
        }
        // $doctor->given_On                       = date("Y-m-d", strtotime($request->given_on));
        $doctor->received                       = $request->Received;
        $doctor->checked                        = $request->Checked;
        $doctor->redo_repeat                    = $request->redo_repeat;
        $doctor->deliver_to_person              = $request->deliver;
        $doctor->lab_bill                       = $request->lab_bill;
        $doctor->given_appointment             = $request->given_appoint;
        if ($request->receivedDate == 'Not Given') {
            $doctor->receivedDate = NULL;
        } else {
            $doctor->receivedDate = date("Y-m-d", strtotime($request->receivedDate));
        }
        $doctor->status                       = $request->status;
        if($request->status == 3){
            $doctor->active                       = 0;
        }
        $res = $doctor->save();
        return response()->json(['result' => $res]);
    }

    // // delete doctor data
    public function deletelabnotedata(request $request) {
        $doctor = LabNote::find($request->doctorid);
        $res =$doctor->delete();
        return response()->json(['result' => $res]);  
    }

    /**
     * Show the patient list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function doctorreport()
    // {
    //     $list = LabNotess::all();
    //     return view('doctor/doctorreport', ['doctorlist' => $list]);
    // }

    // /**
    //  * Populates labreport list page
    //  *
    //  * @param 
    //  * 
    //  * @return view labreportfilterlist
    //  */ 
    // public function doctorfilterlist(request $request)
    // {
    //     $condition = array();
    //     if(!empty($request->get('doctor_name'))) { 
    //         $condition[] = ['doctors.doctor_name', 'like', '%'.$request->get('doctor_name').'%']; 
    //     }
    //     if($request->get('sex')!= "") { 
    //         $condition[] = ['doctors.sex', 'like', '%'.$request->get('sex').'%']; 
    //     }
    //     if(!empty($request->get('degree'))) { 
    //         $condition[] = ['doctors.degree', 'like', '%'.$request->get('degree').'%']; 
    //     }
    //     if($request->get('experience')!= "") { 
    //         $condition[] = ['doctors.experience', 'like', '%'.$request->get('experience').'%']; 
    //     }
    //     if($request->get('clinic_name')!= "") { 
    //         $condition[] = ['doctors.clinic_name', 'like', '%'.$request->get('clinic_name').'%']; 
    //     }
    //     if($request->get('location')!= "") { 
    //         $condition[] = ['doctors.location', 'like', '%'.$request->get('location').'%']; 
    //     }

    //     $doctor = Doctor::where($condition)->get();
    //     // print_r($doctor);exit();
    //     return response()->json(['data' => $doctor]);
    // }

    public function generatePDF(Request $request,$id)
    {
        $details = LabNote::join('lab' , 'lab.id', '=' ,'lab_note.lab_name')
        ->join('patients','patients.id','=','lab_note.patient_name')
        ->get(['lab_note.*','lab.lab_name as labname','patients.patient_uniq_id as patient_uniq_id'])->find($id);
        // print_r($details);exit;
        // Get the form data from the request and build your HTML view
        $html = view('Labnote/template', compact('details'));

        // Generate the PDF
        $pdf = PDF::loadHTML($html);

        // You can save the PDF to a file or return it as a response
        return $pdf->download('Lab Receipt.pdf');
    }
   
}