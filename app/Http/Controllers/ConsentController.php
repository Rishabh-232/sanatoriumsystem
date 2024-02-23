<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Consent;
use App\Models\Visit;
use App\Models\Treatment;
use Carbon\Carbon;
use App\Models\Patient;
use App\Models\ConcentMaster;
use App\Models\Signature;
use PDF;


class ConsentController extends Controller
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
     * Show the consent list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function consentform()
    {
        $list = Consent::all();
        return view('consent/consentform', ['consentlist' => $list]);
    }

    /**
     * Show the consent view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function consentview($id)
    {
        $details = Consent::find($id);
        $signature = Signature::all();

        return view('consent/consentformview', ['consentDetails' => $details,'signature' => $signature[0]['signature']]); 
    }

 
    /**
     * Show the consent add.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function consentformadd()
    {
        return view('consent/consentformadd');
    }

    public function addConsent(Request $request)
    {

        $selectedPastValues = $request->input('past');
        $pastblood = $request->input('pastblood');

        $consent = new Consent;
        $consent->patientId                         =       $request->patientId; 
        $consent->name                              =        $request->name;
        $consent->date                              =         date("Y-m-d", strtotime($request->date));
        $consent->address                           =         $request->address;
        $consent->contact                           =         $request->contact;
        $consent->email                             =         $request->email;
        $consent->chiefcomplain                     =        $request->chiefcomplain;
        $consent->medicalhistory                   =         $request->medicalhistory;
        $consent->dentalhistory                    =         $request->dentalhistory;
        $consent->undermedication                  =         $request->undermedication;
        $consent->specialinstruction               =         $request->specialinstruction;
        $consent->advice                            = $selectedPastValues;
        $consent->bloodinvestigate                   = $pastblood;
        $consent->maxrightcaries        = $request->maxrightcaries;
        $consent->maxleftcaries        = $request->maxleftcaries;
        $consent->manrightcaries        = $request->manrightcaries;
        $consent->manleftcaries        = $request->manleftcaries;
        $consent->maxrightcervical        = $request->maxrightcervical;
        $consent->maxleftcervical        = $request->maxleftcervical;
        $consent->manrightcervical        = $request->manrightcervical;
        $consent->manleftcervical        = $request->manleftcervical;
        $consent->maxrightroot        = $request->maxrightroot;
        $consent->maxleftroot        = $request->maxleftroot;
        $consent->manrightroot        = $request->manrightroot;
        $consent->manleftroot        = $request->manleftroot;
        $consent->maxrightmissing        = $request->maxrightmissing;
        $consent->maxleftmissing        = $request->maxleftmissing;
        $consent->manrightmissing        = $request->manrightmissing;
        $consent->manleftmissing        = $request->manleftmissing;
        $consent->maxrightrestored        = $request->maxrightrestored;
        $consent->maxleftrestored        = $request->maxleftrestored;
        $consent->manrightrestored        = $request->manrightrestored;
        $consent->manleftrestored        = $request->manleftrestored;
        $consent->maxrightcrowned        = $request->maxrightcrowned;
        $consent->maxleftcrowned        = $request->maxleftcrowned;
        $consent->manrightcrowned        = $request->manrightcrowned;
        $consent->manleftcrowned        = $request->manleftcrowned;
        $consent->maxrightbridge        = $request->maxrightbridge;
        $consent->maxleftbridge        = $request->maxleftbridge;
        $consent->manrightbridge        = $request->manrightbridge;
        $consent->manleftbridge        = $request->manleftbridge;
        $consent->maxrightcalculas        = $request->maxrightcalculas;
        $consent->maxleftcalculas        = $request->maxleftcalculas;
        $consent->manrightcalculas        = $request->manrightcalculas;
        $consent->manleftcalculas        = $request->manleftcalculas;
        $consent->maxrightimpacted        = $request->maxrightimpacted;
        $consent->maxleftimpacted        = $request->maxleftimpacted;
        $consent->manrightimpacted        = $request->manrightimpacted;
        $consent->manleftimpacted        = $request->manleftimpacted;

        $res = $consent->save();
        $lastId = $consent->id;
        
    return response()->json(['result' => $res, 'id' => $lastId]);
    }

    /**
     * Show the consent edit.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function consentedit($id)
    {
        $details = Consent::find($id);
        $signature = Signature::all();


        return view('consent/consentformedit', ['consentDetails' => $details,'signature' => $signature[0]['signature'] ]);
    }

    /**
     * Show the doctor update.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateConsent(request $request, $id) {
        $consent = Consent::find($id);

        $selectedPastValues = $request->input('past');
        $pastblood = $request->input('pastblood');

        $data = $request->except('_token');
        $consent->name                              =        $request->name;
        $consent->date                              =         date("Y-m-d", strtotime($request->date));
        $consent->address                           =         $request->address;
        $consent->contact                           =         $request->contact;
        $consent->email                             =         $request->email;
        $consent->chiefcomplain                     =        $request->chiefcomplain;
        $consent->medicalhistory                   =         $request->medicalhistory;
        $consent->dentalhistory                    =         $request->dentalhistory;
        $consent->undermedication                  =         $request->undermedication;
        $consent->specialinstruction               =         $request->specialinstruction;
        $consent->advice                            = $selectedPastValues;
        $consent->bloodinvestigate                   = $pastblood;

        $consent->maxrightcaries        = $request->maxrightcaries;
        $consent->maxleftcaries        = $request->maxleftcaries;
        $consent->manrightcaries        = $request->manrightcaries;
        $consent->manleftcaries        = $request->manleftcaries;
        $consent->maxrightcervical        = $request->maxrightcervical;
        $consent->maxleftcervical        = $request->maxleftcervical;
        $consent->manrightcervical        = $request->manrightcervical;
        $consent->manleftcervical        = $request->manleftcervical;
        $consent->maxrightroot        = $request->maxrightroot;
        $consent->maxleftroot        = $request->maxleftroot;
        $consent->manrightroot        = $request->manrightroot;
        $consent->manleftroot        = $request->manleftroot;
        $consent->maxrightmissing        = $request->maxrightmissing;
        $consent->maxleftmissing        = $request->maxleftmissing;
        $consent->manrightmissing        = $request->manrightmissing;
        $consent->manleftmissing        = $request->manleftmissing;
        $consent->maxrightrestored        = $request->maxrightrestored;
        $consent->maxleftrestored        = $request->maxleftrestored;
        $consent->manrightrestored        = $request->manrightrestored;
        $consent->manleftrestored        = $request->manleftrestored;
        $consent->maxrightcrowned        = $request->maxrightcrowned;
        $consent->maxleftcrowned        = $request->maxleftcrowned;
        $consent->manrightcrowned        = $request->manrightcrowned;
        $consent->manleftcrowned        = $request->manleftcrowned;
        $consent->maxrightbridge        = $request->maxrightbridge;
        $consent->maxleftbridge        = $request->maxleftbridge;
        $consent->manrightbridge        = $request->manrightbridge;
        $consent->manleftbridge        = $request->manleftbridge;
        $consent->maxrightcalculas        = $request->maxrightcalculas;
        $consent->maxleftcalculas        = $request->maxleftcalculas;
        $consent->manrightcalculas        = $request->manrightcalculas;
        $consent->manleftcalculas        = $request->manleftcalculas;
        $consent->maxrightimpacted        = $request->maxrightimpacted;
        $consent->maxleftimpacted        = $request->maxleftimpacted;
        $consent->manrightimpacted        = $request->manrightimpacted;
        $consent->manleftimpacted        = $request->manleftimpacted;
            
        $res = $consent->save();
        return response()->json(['result' => $res]);
    }

    // delete consent data
    public function deleteconsentdata(request $request) {
        $consent = Consent::find($request->consentid);
        $res =$consent->delete();
        return response()->json(['result' => $res]);  
    }


    /**
     * Show the patient list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function PatientlistConsentShow($id) {

        $patient = Patient::find($id);
        $pname = $patient->name;
        $paddress = $patient->address;
        $pcontact = $patient->contact_1;
        $pemail = $patient->email;
        $signature = Signature::all();
        // print_r($signature[0]['signature']);exit;
       
        return view('consent/consentformadd', ['patientId' => $id,'signature' => $signature[0]['signature'],'pname' => $pname,'paddress' => $paddress,'pcontact' => $pcontact,'pemail' => $pemail]);
    }

    public function fetchPatientData(Request $request) {
        $selectedConsentFormName = $request->input('consentFormName');
        
        $patient = Patient::where('name', $selectedConsentFormName)->first();

        if ($patient) {
            return response()->json($patient);
        } else {
            return response()->json(['error' => 'Patient not found'], 404);
        }
    }

    // concent masterv conytroller

    public function consentmasterlist()
    {
        $list = ConcentMaster::all();
        return view('ConsentMaster/consentmasterlist',['consentmasterList' => $list]);
    }

    public function addconsentmaster(Request $request)
    {
        $consent = new ConcentMaster;
        $consent->consentname                = $request->consentname; 
        $consent->heading                = $request->heading; 
        $consent->consent               = $request->consent; 
        $res = $consent->save();
        $lastId = $consent->id;
        
    return response()->json(['result' => $res, 'id' => $lastId]);
    }

    public function consentmasterview($id)
    {
        $details = ConcentMaster::find($id);
        
        return view('ConsentMaster/consentmasterview', ['consentmasterDetails' => $details]); 
    }

    public function consentmasteredit($id)
    {
        $details = ConcentMaster::find($id);
        return view('ConsentMaster/consentmasteredit', ['consentmasterDetails' => $details]);
    }

    public function updateconsentmaster(request $request, $id) {
        $consent = ConcentMaster::find($id);

        $consent->consentname                = $request->consentname; 
        $consent->heading                = $request->heading; 
        $consent->consent               = $request->consent; 
        $res = $consent->save();
        return response()->json(['result' => $res]);
    }

      // delete consent data
      public function deleteconsentmaster(request $request) {
        $consent = ConcentMaster::find($request->consentid);
        $res =$consent->delete();
        return response()->json(['result' => $res]);  
    }

    public function fetchconcentData(Request $request) {
        $concentId = $request->input('concentId');
        
        $consent = ConcentMaster::where('consentname', $concentId)->first();
        // print_r($consent);exit;
        if ($consent) {
            return response()->json($consent);
        } else {
            return response()->json(['error' => 'Consent not found'], 404);
        }
    }


    public function sendConsent($id)
    {
        $consentDetails = Consent::find($id);
        // print_r($consentDetails->contact);exit;

        $html = view('consent/sendConsent', compact('consentDetails'));
    
        // Generate the PDF
        $pdf = PDF::loadHTML($html);
    
        // Generate a unique filename
        // $fileName = 'Consent-' . Carbon::now()->timestamp . '-' . uniqid() . '.pdf';
                $fileName = 'Consent-Form' . '-'  . Carbon::now()->timestamp .  '.pdf';


        $consent = Consent::find($id);
        $consent->sendconsent        = $fileName;
            
        $res = $consent->save();
    
        // Save the PDF to the specified directory
        $pdf->save(public_path('Consentform/' . $fileName));

      
            $message = "Consent Form";
            $instantInstanceId = '65A0E886829CE';
            $instantAccessToken = '659f7b7e9e1a2';
            $num  = $consentDetails->contact;
            // print_r($num);exit;

            $url = 'https://allexpert.store/api/send';

                    $number = '91' . $num;

                    $postData = [
                        'number' => $number,
                        'type' => 'text',
                        'message' => $message,
                        'media_url' => "https://identx.in/drishitadentalclinic/public/Consentform/{$fileName}",
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
                return $pdf->download("Consent Form.pdf");
            
    }
    
}
