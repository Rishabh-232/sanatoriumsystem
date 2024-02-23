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

use Carbon\Carbon;

class PatientreportController extends Controller
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

  

    public function patientreport()
    {
        $list = Patient::all();
        return view('patient/patientreport', ['patientList' => $list]);
    }

      /**
     * Show the patient view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patientviewreport($id)
    {
        $details       = Patient::find($id);
        $startDateStr  = request()->input('startdate');
        $endDateStr  = request()->input('enddate');

        $startDate = \DateTime::createFromFormat('d-M-Y', $startDateStr)->format('Y-m-d');
        $endDate = \DateTime::createFromFormat('d-M-Y', $endDateStr)->format('Y-m-d');

        // print_r($startDate);exit;
        $treatmentlist = Treatment::where('patient_id', $id)
        ->whereBetween('treatment_date', [$startDate, $endDate]) // Add this line for date range filtering
        ->orderBy('treatment_date', 'asc')
        ->get();
        
        $visitlist = Visit::join('treatments', 'treatments.id', '=', 'visits.work_done')
        ->where('visits.patient_id', $id)
        ->whereBetween('date_of_visit', [$startDate, $endDate]) // Add this line for date range filtering
        ->select('visits.*', 'treatments.treatment_info as treatinfo')
        ->get();
        
        $prescriptionlist = Prescription::where('patient_id', $id)->whereBetween('date', [$startDate, $endDate])->get();
        $consentlist = Consent::where('patientId',$id)->whereBetween('date', [$startDate, $endDate])->get();


        foreach ($treatmentlist as $index => $row) {
            if (!empty($row['treatment_info'])) {
                $temp = explode(',', $row['treatment_info']); // Split by comma
                $tempStr = implode(', ', $temp); // Reconstruct with a comma and space
                $treatmentlist[$index]['treatmentStr'] = $tempStr;
            } else {
                $treatmentlist[$index]['treatmentStr'] = "";
            }
        }

        return view('patient/patientviewreport', ['patientDetails' => $details,'treatmentlist' => $treatmentlist, 'visitlist' => $visitlist,'prescriptionlist'=>$prescriptionlist,'consentlist' => $consentlist]); 
    }
      
            
}
  
