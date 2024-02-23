<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Visit;
use App\Models\Quote;
use App\Models\LabNote;
use App\Models\Treatment;
use App\Models\Prescription;
use App\Models\RefTreatment;
use App\Models\ViewRowItem;
use App\Models\PrescriptionMaster;
use App\Models\Consent;
use App\Models\CustomMessage;
use App\Models\Signature;


use Carbon\Carbon;

class PatientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the patient list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patientlist()
    {
        $referList = RefTreatment::all();
        $list = Patient::orderBy('id', 'asc')->get();
        $doctor = Doctor::all();
        $treatmentsWithCharges = RefTreatment::select('id', 'name', 'charge_one', 'charge_two', 'charge_three')->get();
        return view('patient/patientlist', ['patientList' => $list, 'doctorlist' => $doctor,'referList' => $referList,'treatmentsWithCharges' => $treatmentsWithCharges]);
    }

 
    /**
     * Show the patient add.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patientadd()
    {
        return view('patient/patientadd');
    }

    /**
     * Insert patient record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
       public function addPatient(Request $request) {
        
        $images = $request->file('image_file');
        $destinationPath = public_path('/upload');
        $imageNames = [];

        $maxSize = 5 * 1024 * 1024; // 2MB in bytes

        $x = 10;
        if (!empty($images)) {
            foreach ($images as $image) {

                if ($image->getSize() > $maxSize) {
                    return redirect()->back()->with('error', 'File size exceeds the 2MB limit. Please select a smaller file.');
                }
                $guessExtension = $image->guessExtension();
                $fileName = 'Patient-'.Carbon::now()->timestamp.'-'.uniqid().'.'.$guessExtension;
                $img =\Image::make($image);
                $img->save($destinationPath . '/' . $fileName, $x);
                $imageNames[] = $fileName;
                // $image->move($destinationPath, $fileName);
                // $imageNames[] = $fileName;
            }
        }

        $currentYear = date('Y');

        $patient = new Patient;
        $patient->name                   = $request->full_name; 
        $patient->date_of_birth          = date("Y-m-d", strtotime($request->dob));
        $patient->age                    = $request->age;
        $patient->sex                    = $request->gender;
        $patient->address                = $request->address;
        $patient->contact_1              = $request->contact_number1;
        $patient->contact_2              = $request->contact_number2;
        $patient->email                  = $request->email_id;
        $patient->drug_allergy           = $request->drug_allergies;
        $patient->attended_by            = $request->attended_by;
        $patient->past_medical_history   = $request->past_medical_history;
        $patient->anniversary            = $request->anniversary ? date("Y-m-d", strtotime($request->anniversary)) : '';
        $patient->patient_insurance      = $request->insurance;
        $patient->consent_form           = $request->consent_form;
        $patient->chiefcomplaint           = $request->chiefcomplaint;
        $patient->pastdental           = $request->pastdental;
        $patient->investigation           = $request->investigation;

        $selectedTOW = $request->bloodinvestigation;

        if (!empty($selectedTOW)) {
            $bloodNames = [];

            foreach ($selectedTOW as $TOW) {
                $bloodNames[] = $TOW;
            }

            $patient->bloodinvestigation = implode(',', $bloodNames);
        } else {
            $patient->bloodinvestigation = ''; // or any default value you want when $selectedTOW is empty
        }

        // $patient->bloodinvestigation           = $request->bloodinvestigation;
        $patient->uploadedfile         = json_encode($imageNames);

            
        $res = $patient->save();
        $lastId = $patient->id;

        $paddedLastId = str_pad($lastId, 4, '0', STR_PAD_LEFT);

        $opnum_update = Patient::find($lastId);
        $opnum_update->patient_uniq_id                   = "P" . $currentYear . $paddedLastId;
        $response = $opnum_update->save();
            
        return response()->json(['result' => $res, 'id' => $lastId]);
    }



    /**
     * Show the patient view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patientview($id)
    {
        $details       = Patient::find($id);
        $visitlist = Visit::join('treatments', 'treatments.id', '=', 'visits.work_done')
        ->where('visits.patient_id', $id)
        ->select('visits.*', 'treatments.treatment_info as treatinfo')
        ->get();
        $treatmentlist = Treatment::where('patient_id', $id)->orderBy('treatment_date', 'asc')->get();
        $patientList   = Patient::all();
        $list = RefTreatment::all();
        $prescriptionlist = PrescriptionMaster::where('patient_id', $id)->get();
        $laborder = LabNote::join('lab','lab.id','=','lab_note.lab_name')->where('patient_name',$id)->get(['lab_note.*','lab.lab_name as lab_name']);
        $consentlist = Consent::where('patientId',$id)->get();
        $signature = Signature::all();

        $file = json_decode($details['uploadedfile']);
        if(!$file) $file = [];



        // print_r($visitchargeAmount);exit;

        foreach ($treatmentlist as $index => $row) {
        if (!empty($row['treatment_info'])) {
            $temp = explode(',', $row['treatment_info']); // Split by comma
            $tempStr = implode(', ', $temp); // Reconstruct with a comma and space
            $treatmentlist[$index]['treatmentStr'] = $tempStr;
        } else {
            $treatmentlist[$index]['treatmentStr'] = "";
        }
    }


        $details->actualAge = Carbon::parse($details->date_of_birth)->age;
        
        return view('patient/patientview', ['patientDetails' => $details, 'visitlist' => $visitlist, 'treatmentlist' => $treatmentlist, 'patientList' => $patientList, 'ReftreatmentList' => $list,'prescriptionlist'=>$prescriptionlist,'laborder'=>$laborder,'file' =>$file,'consentlist' => $consentlist,'signature' => $signature[0]['signature']]); 
    }

    /**
     * Show the patient edit.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patientedit($id)
    {
        $details = Patient::find($id);
        $TOWIds = explode(',', $details->bloodinvestigation);

        return view('patient/patientedit', ['patientDetails' => $details,'TOWIds' => $TOWIds,]);
    }

    /**
     * Show the patient update.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePatient(request $request, $id) {
        $patient = Patient::find($id);

        $images = $request->file('image_file');
        $destinationPath = public_path('/upload');
        $imageNames = [];
        $maxSize = 5 * 1024 * 1024; // 2MB in bytes

        $x = 10;
        if (!empty($images)) {
            foreach ($images as $image) {
                if ($image->getSize() > $maxSize) {
                    return redirect()->back()->with('error', 'File size exceeds the 2MB limit. Please select a smaller file.');
                }
                $guessExtension = $image->guessExtension();
                $fileName = 'Patient-'.Carbon::now()->timestamp.'-'.uniqid().'.'.$guessExtension;
                $img =\Image::make($image);
                $img->save($destinationPath . '/' . $fileName, $x);
                $imageNames[] = $fileName;
                // $image->move($destinationPath, $fileName);
                // $imageNames[] = $fileName;
            }
        }else{
            $previousData = json_decode($patient->uploadedfile, true);
            if (!empty($previousData) && is_array($previousData)) {
                $imageNames = $previousData;
            }
        }

        $data = $request->except('_token');
        $patient->name                   = $request->full_name; 
        $patient->date_of_birth          = date("Y-m-d", strtotime($request->dob));
        $patient->age                    = $request->age;
        $patient->sex                    = $request->gender;
        $patient->address                = $request->address;
        $patient->contact_1              = $request->contact_number1;
        $patient->contact_2              = $request->contact_number2;
        $patient->email                  = $request->email_id;
        $patient->drug_allergy           = $request->drug_allergies;
        $patient->attended_by            = $request->attended_by;
        $patient->past_medical_history   = $request->past_medical_history;
        $patient->anniversary            = $request->anniversary ? date("Y-m-d", strtotime($request->anniversary)) : '';
        $patient->patient_insurance      = $request->insurance;
        $patient->consent_form           = $request->consent_form;
        $patient->chiefcomplaint           = $request->chiefcomplaint;
        $patient->pastdental           = $request->pastdental;
        $patient->investigation           = $request->investigation;

        $selectedTOW = $request->bloodinvestigation;

        if (!empty($selectedTOW)) {
            $bloodNames = [];

            foreach ($selectedTOW as $TOW) {
                $bloodNames[] = $TOW;
            }

            $patient->bloodinvestigation = implode(',', $bloodNames);
        } else {
            $patient->bloodinvestigation = ''; // or any default value you want when $selectedTOW is empty
        }

        // $patient->bloodinvestigation           = $request->bloodinvestigation;
        $patient->uploadedfile         = json_encode($imageNames);

        $res = $patient->save();
       
        return response()->json(['result' => $res]);
    }

    // delete patient data
    public function deletepatientdata(request $request) {
        $patient = Patient::find($request->patientid);
        $res =$patient->delete();
        return response()->json(['result' => $res]);  
    }

    

    public function gettreatdata(request $request ,$Id){
        $treatment = Treatment::find($Id);
        $latestVisittreatData = ViewRowItem::where('work_done', $Id)->get();
        // $latestVisittreatData = ViewRowItem::where('work_done', $Id)
        //     ->where('visit_id', function ($query) {
        //         $query->selectRaw('max(visit_id)')
        //             ->from('viewsrowitem');
        //     })
        // ->get();

        $treatmentInfo = json_decode($treatment->treatment_info, true);

        // echo count($latestVisittreatData);exit;
        if(count($latestVisittreatData) > 0){
            $formattedlatestVisittreatData = [];
         // Loop through the $latestVisittreatData data and organize it in the desired format
            foreach ($latestVisittreatData as $item) {
                $formattedlatestVisittreatData[$item->treatment] = [
                    'charges' => $item->total_amount,
                    'balance' => $item->balance_amt,
                    'remark' => Null,
                ];
            }
            $treatmentInfo['latestVisittreatData'] = $formattedlatestVisittreatData;
            $treatmentInfo = $treatmentInfo['latestVisittreatData'];
        }

        // print_r($treatmentInfo);exit;

        return response()->json(['data' => $treatmentInfo]);
    }

    // delete patient data
    public function custommessagesend(request $request) {
        
        $checkedIds = json_decode($request->input('checkedIds')); // Decoding the JSON string to retrieve the array
        
        $images = $request->file('image_file');
        // print_r($images);exit;
        $destinationPath = public_path('/Custom');
        $imageNames = [];

        $maxSize = 5 * 1024 * 1024; // 2MB in bytes


        if (!empty($images)) {
            foreach ($images as $image) {

                if ($image->getSize() > $maxSize) {
                    return redirect()->back()->with('error', 'File size exceeds the 2MB limit. Please select a smaller file.');
                }
                $guessExtension = $image->guessExtension();
                $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $originalFileName  . '-' .Carbon::now()->timestamp .'.'.$guessExtension;
                $image->move($destinationPath, $fileName);
                $imageNames[] = $fileName;
            }
        }

        $custom = new CustomMessage;
        $custom->message                   = $request->Cmessage; 
        $custom->uploadedfile         = json_encode($imageNames);

        $res = $custom->save();
        $lastId = $custom->id;

        $patient = CustomMessage::find($lastId);
        
        $previousData  = json_decode($patient->uploadedfile, true);
        if (!empty($previousData) && is_array($previousData)) {
            $imagePaths = array_map(function ($imageName) {
                return 'https://identx.in/drishitadentalclinic/public/Custom/' . $imageName;
            }, $previousData);
        } else {
            $imagePaths = []; // If no images are present
        }
        // print_r($imagePaths[0]);exit;

        try {
            $message = $request->Cmessage;
            $instantInstanceId = '65A0E886829CE';
            $instantAccessToken = '659f7b7e9e1a2';

            $url = 'https://allexpert.store/api/send';

            foreach ($checkedIds as $index => $number) {
                    $number = '91' . $number;

                    $postData = [
                        'number' => $number,
                        'type' => 'text',
                        'message' => $message,
                        'media_url' => (!empty($imagePaths)) ? $imagePaths[0] : '', // Assign empty string if $imagePaths is empty
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

            }

            return response()->json(['result' => $response, 'id' => $lastId]);  

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
            
    }
    
}