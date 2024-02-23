<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Treatment;
use App\Models\Medicines;
use App\Models\Medicinescategories;
use App\Models\PrescriptionMaster;
use Carbon\Carbon;
use App\Models\Signature;
use PDF;


class PrescriptionController extends Controller
{
    //

    /**
     * Create Prescription Form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patientprescription($id) {
        $details = Patient::find($id);
        $details->actualAge = Carbon::parse($details->date_of_birth)->age;

        $medicine = Medicines::join('medicine_categories', 'medicine_categories.id', '=', 'medicines.medicine_category_id')->get(['medicines.*','medicine_categories.name as medicatename']);

        // $medicate = Medicinescategories::get(['medicine_categories.name as medicatename']);

        // $medicine = Medicines::get(['medicines.*,medicine_categories.name as medicatename']);

        // $medicine = Medicines::all();
        $signature = Signature::all();

        return view('prescription/prescriptionadd', ['patientList' => $details,'signature' => $signature[0]['signature'], 'patientId' => $id, 'medicine' => $medicine]);
}
    public function savePrescription(Request $request)
    {

        $patientId = $request->input('patient_id');
        $selectedEntries = $request->input('selected_entries');

        $pres_master = new PrescriptionMaster;
        $pres_master->patient_id                    = $patientId; 
        $res = $pres_master->save();
        $lastId = $pres_master->id;


        foreach ($selectedEntries as $entry) {
            $prescription = new Prescription();
            $prescription->master_id	 = $lastId;
            $prescription->patient_id = $patientId;
            $prescription->medicine_name = $entry['medicineName'];
            $prescription->number_of_times = $entry['numberOfTimes'];
            // $prescription->before_after = $entry['beforeAfter'];
            $prescription->remarks = $entry['remarks'];
            $prescription->date = Carbon::today()->toDateString();
            $prescription->save();
        }

        return response()->json(['result' => $res,'billno'=>$lastId]);
    }

    // Get lab order data
    public function getinfoprescriptiondata(request $request) {
        $id     = $request->get('prescriptionid');
        $lab  = Prescription::where('master_id', $id)->get();
        // print_r($lab);exit;
        return response()->json(['data' => $lab]);
    }

    // Delete visit data
    public function deletePrescriptiondata(request $request) {
        $id     = $request->get('prescriptionid');

        $Row = Prescription::where('master_id',$id);
        $resRow =$Row->delete();

        $lab = PrescriptionMaster::find($id);
        $res = $lab->delete();
        return response()->json(['result' => $res]);
    }
    
     public function sendPrescription($id)
    {
        $Prescription  = Prescription::where('master_id', $id)->get();

        $pmaster = PrescriptionMaster::find($id);

        $patientdetails = Patient::find($pmaster->patient_id);
        // print_r($patientdetails->contact_1);exit;
    
        $html = view('prescription/sendPrescription', compact('Prescription'));
    
        // Generate the PDF
        $pdf = PDF::loadHTML($html);
    
        // Generate a unique filename
        // $fileName = 'Consent-Form' . Carbon::now()->timestamp . '-' . uniqid() . '.pdf';
        $fileName = 'Prescription' . '-'  . Carbon::now()->timestamp .'.pdf';

        $consent = PrescriptionMaster::find($id);
        $consent->sendPrescription       = $fileName;
            
        $res = $consent->save();
    
        // Save the PDF to the specified directory
        $pdf->save(public_path('Prescription/' . $fileName));

            $message = "Prescription";
            $instantInstanceId = '65A0E886829CE';
            $instantAccessToken = '659f7b7e9e1a2';
            $num  = $patientdetails->contact_1;

            $url = 'https://allexpert.store/api/send';

                    $number = '91' . $num;

                    $postData = [
                        'number' => $number,
                        'type' => 'text',
                        'message' => $message,
                        'media_url' => "https://identx.in/drishitadentalclinic/public/Prescription/{$fileName}",
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
    
        // You can save the PDF to a file or return it as a response
        return $pdf->download("Prescription.pdf");
    
    }

}
