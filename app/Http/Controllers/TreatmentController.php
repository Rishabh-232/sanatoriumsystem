<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Quote;
use App\Models\Treatment;
use App\Models\QuoteRowItem;
use App\Models\RefTreatment;
use Carbon\Carbon;

class TreatmentController extends Controller
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
     * Patient Treatment Form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patienttreatment($id) {
        $list = RefTreatment::all();
        
        $details       = Patient::find($id);
        $details->actualAge = Carbon::parse($details->date_of_birth)->age;

        return view('treatment/treatmentadd', ['treatmentList' => $list, 'patientId' => $id, 'patientDetails' => $details]);
    }

    /**
     * Insert patient record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
      public function addTreatment(Request $request) {
        // To create selected treatment json
        $actualStr = [];
        foreach ($request->checktreatment as $checkboxVal) {
            $tempValArr = explode("-", $checkboxVal);

            if($checkboxVal != "")
            {
                $actualStr[$tempValArr[0]] = [
                    'charges' => $request->charges[$tempValArr[1]],
                    'balance' => $request->charges[$tempValArr[1]],
                    'remark' => $request->remark[$tempValArr[1]],
                ];
            }
        }
        $treatmentStr = json_encode($actualStr);

        $treatment = new Treatment;
        $treatment->treatment_date = date("Y-m-d", strtotime($request->treatment_date));
        $treatment->treatment_info = $treatmentStr; 
        $treatment->patient_id     = $request->patientId; 
        $treatment->diagnosis      = $request->diagnosis;
        $treatment->tooth_number   = $request->selectedteeth;
        $res = $treatment->save();
        
        return response()->json(['result' => $res]);
    }


    /**
     * Insert patient record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addQuotePlanTreatment(Request $request, $id) {

        $quote = Quote::find($id);
        $quote->approve       =  1; 
        $quote->status       = 'open'; 
        $res = $quote->save();

        $treatmentTypes = explode(',', $request->work_done);
        $treatfetch = QuoteRowItem::where('quote_id', $id)->get();

        $treatmentData = [];
        if($request->charges_opt == 0){
            foreach ($treatmentTypes as $type) {
                foreach ($treatfetch as $rowItem) {
                    if ($rowItem->treatment == $type) {
                        $treatmentData[$type] = [
                            'charges' => $rowItem->chargesOption1,
                            'balance' => $rowItem->chargesOption1,
                            'remark' => null, // You can set this as needed
                        ];
                        break; // Exit the loop once a match is found
                    }
                }
            }
        }else if($request->charges_opt == 1){
            foreach ($treatmentTypes as $type) {
                foreach ($treatfetch as $rowItem) {
                    if ($rowItem->treatment == $type) {
                        $treatmentData[$type] = [
                            'charges' => $rowItem->chargesOption2,
                            'balance' => $rowItem->chargesOption2,
                            'remark' => null, // You can set this as needed
                        ];
                        break; // Exit the loop once a match is found
                    }
                }
            }
        }else if($request->charges_opt == 2){
            foreach ($treatmentTypes as $type) {
                foreach ($treatfetch as $rowItem) {
                    if ($rowItem->treatment == $type) {
                        $treatmentData[$type] = [
                            'charges' => $rowItem->chargesOption3,
                            'balance' => $rowItem->chargesOption3,
                            'remark' => null, // You can set this as needed
                        ];
                        break; // Exit the loop once a match is found
                    }
                }
            }
        }
        
        $treatmentInfoJson = json_encode($treatmentData);
        // print_r($treatmentInfoJson);exit;
        
        $treatment = new Treatment;
        $treatment->quote_id            = $id; 
        $treatment->treatment_date      = date("Y-m-d", strtotime($request->date_of_visit)); 
        $treatment->patient_id          = $request->patient_id;
        $treatment->treatment_info     = $treatmentInfoJson;
        // $treatment->treatment_info      = $request->work_done; 
        $treatment->charges             = $request->charges_opt;
        $treatment->remark              = $request->remarks;
        $treatment->created_at          = Carbon::now('Asia/Kolkata');

        $res = $treatment->save();

        return response()->json(['result' => $res]);
    } 
    /**
     * Insert patient record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   


    /**
     * Patient Treatment Form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function editpatienttreatment($id) {
        $list = RefTreatment::all();
        $details = Treatment::find($id);
        $TempTreatmentArr = json_decode($details->treatment_info);

        $TreatmentArr = [];
        foreach ($TempTreatmentArr as $key => $value) {
            $TreatmentArr[$key] = $value;
        }
        $toothArr = json_decode($details->tooth_number);
        return view('treatment/treatmentedit', ['treatmentList' => $list, 'treatmentDetails' => $details, 'TreatmentArr' => $TreatmentArr, 'toothArr' => $toothArr]);
    }

    /**
     * Show the visit update.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateTreatment(request $request, $id) {
        
        // To create selected treatment json
        $actualStr = [];
        foreach ($request->checktreatment as $checkboxVal) {
            // echo $checkboxVal;
            $tempValArr = explode("-", $checkboxVal);

            if($checkboxVal != "")
            {
                $actualStr[$tempValArr[0]] = [
                    'charges' => $request->charges[$tempValArr[1]],
                    'balance' => $request->charges[$tempValArr[1]],
                    'remark' => $request->remark[$tempValArr[1]],
                ];
            }
        }
        $treatmentStr = json_encode($actualStr);

        $treatment = Treatment::find($id);
        $treatment->treatment_date = date("Y-m-d", strtotime($request->treatment_date));
        $treatment->treatment_info = $treatmentStr; 
        $treatment->patient_id     = $request->patientId; 
        $treatment->diagnosis      = $request->diagnosis;
        $treatment->tooth_number   = $request->Eselectedteeth;
        $res = $treatment->save();

        return response()->json(['result' => $res]);
    }

     // Get view data of treatment
    public function get_treatmentdata(request $request) {
        $id     = $request->get('Treatmentid');
        $treatment  = Treatment::where('id', $id)->get(['treatments.*'])->first();
        // if($treatment['treatment_info'] != "") {
        //     $temp = json_decode($treatment['treatment_info']);
        //     $tempStr = '';
        //     foreach ($temp as $key => $value) {
        //         if($tempStr != "")
        //         {
        //             $tempStr .= ", ".$key." : ".$value;
        //         }
        //         else
        //         {
        //             $tempStr = $key." : ".$value;
        //         }
        //     }
        //     $treatment['treatmentStr'] = $tempStr;
        //     // print_r($temp);exit();
        // }
        // else
        // {
        //     $treatment['treatmentStr'] = "";
        // }

        $treatment->treatment_date = date("d-M-Y", strtotime($treatment->treatment_date));
        return response()->json(['data' => $treatment]);
    }

    // Delete visit data
    public function deletetreatmentdata(request $request) {
        $id     = $request->get('treatmentdid');
        $treatment = Treatment::find($id);
        $res = $treatment->delete();
        return response()->json(['result' => $res]);
    }
}