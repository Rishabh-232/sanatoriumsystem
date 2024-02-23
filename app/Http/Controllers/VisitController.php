<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Quote;
use App\Models\Treatment;
use App\Models\ViewRowItem;
use Carbon\Carbon;
use PDF;



class VisitController extends Controller
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
     * Show the visit list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function visitlist()
    {
        $list = Visit::join('patients', 'patients.id', '=', 'visits.patient_id', 'LEFT')
                ->orderBy('visits.date_of_visit', 'asc')->get(['visits.*', 'patients.name']);
                
        return view('visit/visitlist', ['visitlist' => $list]);
    }

    /**
     * Insert patient record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addVisit(Request $request, $id) {


        $xrays = $request->file('xrays_file');
        // print_r($xrays);exit;
        $destinationPath = public_path('/Xrays');
        $xrayNames = [];
        $maxSize = 5 * 1024 * 1024; // 2MB in bytes
        $x = 10;

        if (!empty($xrays)) {
            foreach ($xrays as $xray) {
                if ($xray->getSize() > $maxSize) {
                    return redirect()->back()->with('error', 'File size exceeds the 2MB limit. Please select a smaller file.');
                }
                $guessExtension = $xray->guessExtension();
                $fileName = 'xray-'.Carbon::now()->timestamp.'-'.uniqid().'.'.$guessExtension;
                $img =\Image::make($xray);
                $img->save($destinationPath . '/' . $fileName, $x);
                $xrayNames[] = $fileName;
                // sleep(1);
            }
        }

        $visit = new Visit;
        $visit->patient_id         = $id; 
        $visit->date_of_visit      = date("Y-m-d", strtotime($request->date_of_visit)); 
        $visit->work_done          = $request->treatment; 
        $visit->total_amount       = $request->total_amount;
        $visit->balance_amount     = $request->balance_amount;
        $visit->remaining_amount     = $request->remaining_amount;
        $visit->remark             = $request->remarks;
        $visit->xrays                = json_encode($xrayNames);
        $visit->created_at         = Carbon::now('Asia/Kolkata');
        $res = $visit->save();
        $lastNo = $visit->id;

        $formData = $request->all();
        // print_r($formData['refTreat']);exit;

        if (isset($formData['refTreat']) && is_array($formData['refTreat'])) {
            foreach($formData['refTreat'] as $reftreat){
                if (isset($reftreat['checktreatment'][0])) {
                    $Dvist = new ViewRowItem;
                    $Dvist->visit_id         = $lastNo; 
                    $Dvist->work_done         = $request->treatment; 
                    $Dvist->treatment         = $reftreat['checktreatment'][0]; 
                    $Dvist->charges          = $reftreat['charges'][0]; 
                    $Dvist->balance_amt     = $reftreat['balance'][0]; 
                    $Dvist->total_amount     = $reftreat['remark'][0];
                    $Dvist->created_at         = Carbon::now('Asia/Kolkata');
 
                    $ress = $Dvist->save();
                }
            }
        }

        return response()->json(['result' => $res]);
    } 

    /**
     * Show the visit update.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateVisit(request $request) {
        $visit = Visit::find($request->Evisit_id);

        $xrays = $request->file('Exrays_file');
        // print_r($xrays);exit;
        $destinationPath = public_path('/Xrays');
        $xrayNames = [];
        $maxSize = 5 * 1024 * 1024; // 2MB in bytes
        $x = 10;

        if (!empty($xrays)) {
            foreach ($xrays as $xray) {
                if ($xray->getSize() > $maxSize) {
                    return redirect()->back()->with('error', 'File size exceeds the 2MB limit. Please select a smaller file.');
                }                $guessExtension = $xray->guessExtension();
                $fileName = 'xray-'.Carbon::now()->timestamp.'-'.uniqid().'.'.$guessExtension;
                $img =\Image::make($xray);
                $img->save($destinationPath . '/' . $fileName, $x);
                $xrayNames[] = $fileName;
            }
        }else{
            $previousData = json_decode($visit->xrays, true);
            if (!empty($previousData) && is_array($previousData)) {
                $xrayNames = $previousData;
            }
        }
        

        $data = $request->except('_token');
        $visit->date_of_visit      = date("Y-m-d", strtotime($request->Edate_of_visit)); 
        $visit->work_done          = $request->Etreatment; 
        $visit->total_amount        = $request->Etotal_amount;
        $visit->balance_amount       = $request->Ebalance_amount;
        $visit->remaining_amount     = $request->Eremaining_amount;
        $visit->remark              = $request->Eremarks;
        $visit->xrays                = json_encode($xrayNames);
        $visit->created_at                 = Carbon::now('Asia/Kolkata');
        $res = $visit->save();
        
        return response()->json(['result' => $res]);
    }

        // Get visit data
        public function getvisitdata(request $request) {
            $id     = $request->get('visitid');
            $visit = Visit::join('treatments', 'treatments.id', '=', 'visits.work_done')
            ->join('patients', 'patients.id', '=', 'visits.patient_id')
            ->where('visits.id', $id)
            ->select('visits.*', 'treatments.treatment_info as treatinfo','patients.name as name','patients.age as age','patients.patient_uniq_id as patient_uniq_id','patients.contact_1 as mobno','patients.address as address')
            ->first();

            $visit->date_of_visit = date("d-M-Y", strtotime($visit->date_of_visit));
            return response()->json(['data' => $visit]);
        }

        public function viewvisitdata(Request $request) {
            $id = $request->get('visitid');
            $visit = Visit::join('treatments', 'treatments.id', '=', 'visits.work_done')
                ->where('visits.id', $id)
                ->select('visits.*', 'treatments.treatment_info as treatinfo')
                ->first(); // Use first() to get a single model instance
        
            if ($visit) {
                $visit->date_of_visit = date("d-M-Y", strtotime($visit->date_of_visit));
                return response()->json(['data' => $visit]);
            } else {
                // Handle the case where no record with the given ID is found
                return response()->json(['error' => 'Visit not found'], 404);
            }
        }

        public function viewdetailsvisitdata(Request $request) {
            $id = $request->get('visitid');
            
            $visitDetails = ViewRowItem::where('visit_id',$id)->get();
        
            return response()->json(['data' => $visitDetails]);
            
        }
        


    // Delete visit data
    public function deleteVisitdata(request $request) {
        $id     = $request->get('visitedid');
        $visitRow = ViewRowItem::where('visit_id',$id);
        $resRow =$visitRow->delete();

        $visit = Visit::find($id);
        $res =$visit->delete();

        return response()->json(['result' => $res]);
    }

    public function xrays($id)
    {
        $details = Visit::where('patient_id',$id)->get(['visits.xrays']);
        $file = [];
        foreach($details as $det){
            if (!empty($det['xrays'])) {
                $xrays = json_decode($det['xrays'], true);
                
                // Assuming $xrays is an array of file paths, you may need to adjust this based on your data structure
                foreach ($xrays as $xray) {
                    // Add each x-ray file path to the $file array
                    $file[] = $xray;
                }
            }
        }
        // print_r($file);exit;
        if(!$file) $file = [];

        return view('patient/xrays', ['file' =>$file,'pid'=>$id]);
    }

    public function visitsummary($id)
    {
        $details = Visit::join('patients','patients.id','=','visits.patient_id','LEFT')
        ->where('patient_id',$id)->orderBy('created_at', 'desc')->get(['visits.*','patients.name as pname','patients.patient_uniq_id as patient_uniq_id'])->first();
        // print_r($details['xrays']);exit;
        $file = json_decode($details['xrays']);
        if(!$file) $file = [];
        $html = view('visit/visitsummary', compact('details','file'));
        $pdf = PDF::loadHTML($html);
        return $pdf->download('Visit Report.pdf');

    }
     
}