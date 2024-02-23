<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Signature;
use Illuminate\Support\Facades\Http;
use PDF;
use Auth;
use Carbon\Carbon;


class BillingController extends Controller
{
    //
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
    //    public function billing()
    // {
    //     $list = Visit::join('patients', 'patients.id', '=', 'visits.patient_id', 'LEFT')
    //                  ->join('lab_orders', 'lab_orders.patient_id', '=', 'visits.patient_id', 'LEFT')   
    //                  ->orderBy('visits.date_of_visit', 'asc')
    //                  ->select('visits.*', 'patients.name', 'patients.age', 'patients.sex', 'patients.contact_1', 'patients.attended_by', 'lab_orders.amount')
    //                  ->get();
                     
    //     return view('billing/billing', ['visitlist' => $list]);
    // }

   public function billing()
    {
        $list = Visit::join('patients', 'patients.id', '=', 'visits.patient_id', 'LEFT')
        ->join('treatments', 'treatments.id', '=', 'visits.work_done')
        ->select('visits.*', 'patients.name','patients.age','patients.sex','patients.contact_1','treatments.treatment_info as treatinfo')
        ->get();
        $signature = Signature::all();     
        return view('billing/billing', ['visitlist' => $list,'signature' => $signature[0]['signature']]);
    }
    // public function billing()
    // {
    //     $list = Visit::join('patients', 'patients.id', '=', 'visits.patient_id', 'LEFT')
    //                  ->leftJoin('lab_orders', function ($join) {
    //                      $join->on('lab_orders.patient_id', '=', 'visits.patient_id')
    //                           ->whereRaw('DATE(visits.date_of_visit) = DATE(lab_orders.order_date)');
    //                  })
    //                  ->orderBy('visits.date_of_visit', 'asc')
    //                  ->select('visits.*', 'patients.name', 'patients.age', 'patients.sex', 'patients.contact_1', 'patients.attended_by', 'lab_orders.amount')
    //                  ->get();
                     
    //     return view('billing/billing', ['visitlist' => $list]);
    // }
    
     public function sendBilling($id)
    {
        $billDetails = Visit::join('treatments', 'treatments.id', '=', 'visits.work_done')
        ->join('patients', 'patients.id', '=', 'visits.patient_id')
        ->where('visits.id', $id)
        ->select('visits.*', 'treatments.treatment_info as treatinfo','patients.name as name','patients.age as age','patients.patient_uniq_id as patient_uniq_id','patients.contact_1 as mobno','patients.address as address')
        ->first();
        
        // print_r($billDetails->mobno);exit;
    
        $html = view('billing/sendBilling', compact('billDetails'));
    
        // Generate the PDF
        $pdf = PDF::loadHTML($html);
    
        // Generate a unique filename
        // $fileName = 'Consent-Form' . Carbon::now()->timestamp . '-' . uniqid() . '.pdf';
        $fileName = 'Bill' . '-'  . Carbon::now()->timestamp .'.pdf';

        $consent = Visit::find($id);
        $consent->sendBilling        = $fileName;
            
        $res = $consent->save();
    
        // Save the PDF to the specified directory
        $pdf->save(public_path('Billing/' . $fileName));

            $message = "Billing";
            $instantInstanceId = '65A0E886829CE';
            $instantAccessToken = '659f7b7e9e1a2';
            $num  = $billDetails->mobno;

            $url = 'https://allexpert.store/api/send';

                    $number = '91' . $num;

                    $postData = [
                        'number' => $number,
                        'type' => 'text',
                        'message' => $message,
                        'media_url' => "https://identx.in/drishitadentalclinic/public/Billing/{$fileName}",
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
        return $pdf->download("Billing.pdf");
    
    }


}
