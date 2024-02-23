<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Quote;
use App\Models\Treatment;
use App\Models\RefTreatment;
use App\Models\QuoteRowItem;

class QuoteController extends Controller
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
     * Show the quote add.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function quoteadd()
    {
        $referList = RefTreatment::all();
        // Fetch charges information along with treatments
        $treatmentsWithCharges = RefTreatment::select('id', 'name', 'charge_one', 'charge_two', 'charge_three')->get();
        
        $list = Patient::orderBy('id', 'asc')->get(['id', 'name']);
        $doctor = Doctor::all('id', 'doctor_name');
        
        return view('quote/quoteadd', ['PatientList' => $list,'doctorlist' => $doctor,'referList' => $referList,'treatmentsWithCharges' => $treatmentsWithCharges]);
    }


    /**
     * Show the quote list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function quotelist()
    // {
    //     $list = Quote::join('patients','patients.id','=','quotes.patient_id', 'LEFT')
    //                  ->join('doctors','doctors.id','=','quotes.doctor_id', 'LEFT')          
    //         ->get(['quotes.*','patients.name', 'doctors.doctor_name']);

    //     $patientList = Patient::all();
    //     return view('quote/quotelist', ['quotelist' => $list, 'patientList' => $patientList]);
    // }
    public function quotelist()
    {
        $list = Quote::join('patients', 'patients.id', '=', 'quotes.patient_id', 'LEFT')
                     ->join('doctors', 'doctors.id', '=', 'quotes.doctor_id', 'LEFT')
                     ->orderBy('quotes.id', 'DESC')
                     ->get(['quotes.*', 'patients.name', 'doctors.doctor_name']);

        $patientList = Patient::all();
        return view('quote/quotelist', ['quotelist' => $list, 'patientList' => $patientList]);
    }


    /**
     * Insert quote record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addQuote(Request $request, $id) {

        $quote = new Quote;
        $quote->patient_id         = $id; 
        $quote->quote_date         = date("Y-m-d", strtotime($request->quote_date)); 

        // Build a comma-separated list of selected treatment names
        $selectedTreatments = $request->treatment;
        $treatmentNames = [];
        foreach ($selectedTreatments as $treatment) {
            $treatmentNames[] = $treatment;
        }
        $quote->treatment = implode(',', $treatmentNames);
        $quote->teeth              = $request->Qselectedteeth; 
        $quote->doctor_id          = $request->doctor_name; 
        $quote->charge_opt_one     = $request->chargeone; 
        $quote->charge_opt_two     = $request->chargetwo; 
        $quote->charge_opt_three   = $request->chargethree; 
        $quote->discount           = $request->discount; 
        $quote->status             = 'open'; 
        $res = $quote->save();

        return response()->json(['result' => $res]);
    }

    /**
     * Insert Quote record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function addQuotePlan(Request $request) {

        $quote = new Quote;
        $quote->patient_id = $request->patient_name;
        $quote->quote_date = date("Y-m-d", strtotime($request->quote_date));

        // Build a comma-separated list of selected treatment names
        $selectedTreatments = $request->treatment;
        $treatmentNames = [];
        foreach ($selectedTreatments as $treatment) {
            $treatmentNames[] = $treatment;
        }
        $quote->treatment = implode(',', $treatmentNames);
       
        $quote->charge_opt_one = $request->chargeone;
        $quote->charge_opt_two = $request->chargetwo;
        $quote->charge_opt_three = $request->chargethree;
        $quote->discount = $request->discount;

        $quote->teeth = $request->selectedteeth;
        $quote->doctor_id = $request->doctor_name;
        $quote->status = 'open';
        $res = $quote->save();

        $lastNo = $quote->id;

        $formData = $request->all();
        $rowItems = json_decode($formData['rowItems'], true);

        // Save rowItems data to the database
        foreach ($rowItems as $rowData) {
            $rowItem = new QuoteRowItem;
            $rowItem->quote_id = $lastNo;
            $rowItem->treatment = $rowData['treatment'];
            $rowItem->chargesOption1 = $rowData['chargesOption1'];
            $rowItem->chargesOption2 = $rowData['chargesOption2'];
            $rowItem->chargesOption3 = $rowData['chargesOption3'];
            $rowItem->discount = $rowData['discount'];
            $rowItem->save();
        }

        return response()->json(['result' => $res]);
    }


    /**
     * Show the quote view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
    public function quoteview($id)
    {
        $details = Quote::join('patients', 'patients.id', '=', 'quotes.patient_id')
                         ->join('doctors', 'doctors.id', '=', 'quotes.doctor_id')          
                         ->where('quotes.id', $id)
                         ->select('quotes.*', 'patients.name AS patient_name', 'doctors.doctor_name','patients.sex as pSex','patients.age as p_age')
                         ->first();
        
        $QuoteRowList = QuoteRowItem::where('quote_id',$id)->get();
        // print_r($QuoteRowList);exit;

        return view('quote/quoteview', ['quoteDetails' => $details,'QuoteRowList'=>$QuoteRowList]); 
    }

    // delete quote data
    public function deleteQuotedata(request $request) {

        $quoteRow = QuoteRowItem::where('quote_id',$request->quoteplanid);
        $resRow =$quoteRow->delete();

        $quote = Quote::find($request->quoteplanid);
        $res =$quote->delete();
        return response()->json(['result' => $res]);  
    }


     
}