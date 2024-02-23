<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Models\Claim;
use Illuminate\Http\Request;
use App\Models\Patient;
use Carbon\Carbon;

class ClaimController extends Controller
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
     * Show the claim list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function claimlist()
    {
        $list = Claim::all();
        return view('claims/claimlist', ['claimlist' => $list]);
    }

    /**
     * Show the claim add.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function claimadd()
    {
        return view('claims/claimadd');
    }

    /**
     * Insert claim record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function addClaim(Request $request) {
    
        $images = $request->file('image_file');
        // print_r($images);exit;
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
                $fileName = 'Claim-'.Carbon::now()->timestamp.'-'.uniqid().'.'.$guessExtension;
                $img =\Image::make($image);
                $img->save($destinationPath . '/' . $fileName, $x);
                $imageNames[] = $fileName;
            }
        }

        $claim = new Claim;
        $claim->claim_name                   = $request->claim_name; 
        $claim->type_of_claim                = $request->type_of_claim;
        $claim->patient_name                 = $request->patient_name;
        $claim->diseases                     = $request->diseases;
        $claim->doctor_name                  = $request->doctor_name;
        $claim->hospital_name                = $request->hospital_name;
        $claim->admitted_date                = date("Y-m-d", strtotime($request->admitted_date));
        $claim->discharged_date              = date("Y-m-d", strtotime($request->discharged_date));
        $claim->hospital_bills               = $request->hospital_bills;
        $claim->lab_bills                    = $request->lab_bills;
        $claim->reports_of_treatment         = json_encode($imageNames);
            
        $res = $claim->save();
        $lastId = $claim->id;

        return response()->json(['result' => $res, 'id' => $lastId]);
    }

    /**
     * Show the Claim view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function claimview($id)
    {
        $details = Claim::find($id);
        $reports_of_treatment = json_decode($details['reports_of_treatment']);
        // print_r($reports_of_treatment);exit;
        if(!$reports_of_treatment) $reports_of_treatment = [];
        
        return view('claims/claimview', ['claimDetails' => $details , 'reports_of_treatment' => $reports_of_treatment]); 
    }

    /**
     * Show the claim edit.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function claimedit($id)
    {
        $details = Claim::find($id);
        return view('claims/claimedit', ['claimDetails' => $details]);
    }

    /**
     * Show the doctor update.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateClaim(request $request, $id) {

        $images = $request->file('image_file');
        // print_r($images);exit;
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
                $fileName = 'Claim-'.Carbon::now()->timestamp.'-'.uniqid().'.'.$guessExtension;
                $img =\Image::make($image);
                $img->save($destinationPath . '/' . $fileName, $x);
                $imageNames[] = $fileName;
            }
        }else{
            $previousData = json_decode($claim->reports_of_treatment, true);
            if (!empty($previousData) && is_array($previousData)) {
                $imageNames = $previousData;
            }
        }
        $claim = Claim::find($id);

        $data = $request->except('_token');
        $claim->claim_name                   = $request->claim_name; 
        $claim->type_of_claim                = $request->type_of_claim;
        $claim->patient_name                 = $request->patient_name;
        $claim->diseases                     = $request->diseases;
        $claim->doctor_name                  = $request->doctor_name;
        $claim->hospital_name                = $request->hospital_name;
        $claim->admitted_date                = date("Y-m-d", strtotime($request->admitted_date));
        $claim->discharged_date              = date("Y-m-d", strtotime($request->discharged_date));
        $claim->hospital_bills               = $request->hospital_bills;
        $claim->lab_bills                    = $request->lab_bills;
        $claim->reports_of_treatment         = json_encode($imageNames);

        
        $res = $claim->save();
        return response()->json(['result' => $res]);
    }

    // delete doctor data
    public function deleteclaimdata(request $request) {
        $claim = Claim::find($request->claimid);
        $res =$claim->delete();
        return response()->json(['result' => $res]);  
    }


    /**
     * Show the patient list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function patientlistShow() {
        $list = Patient::orderBy('id', 'asc')->get();
        return view('claims/claimadd', ['patientList' => $list]);
    }
}