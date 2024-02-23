<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Patient;
use Carbon\Carbon;
use Auth;

class DoctorController extends Controller
{
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
    public function doctorlist()
    {
        $list = Doctor::all();
        return view('doctor/doctorlist', ['doctorlist' => $list]);
    }

    /**
     * Show the doctor add.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function doctoradd()
    {
        return view('doctor/doctoradd');
    }

    /**
     * Insert doctor record to database.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addDoctor(Request $request) {
    
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
                // print_r($image);
                $guessExtension = $image->guessExtension();
                $fileName = 'Doctor-'.Carbon::now()->timestamp.'-'.uniqid().'.'.$guessExtension;
                $img =\Image::make($image);
                $img->save($destinationPath . '/' . $fileName, $x);
                $imageNames[] = $fileName;
                // $image->move($destinationPath, $fileName);
                // $imageNames[] = $fileName;
            }
        }

        $doctor = new Doctor;
        $doctor->doctor_name                   = $request->doctor_name;
        $doctor->age                           = $request->age;
        $doctor->sex                           = $request->sex;
        $doctor->degree                        = $request->degree;
        $doctor->experience                    = $request->experience;
        $doctor->medical_reg_verified          = $request->medical_reg_verified;
        $doctor->doctor_reg_no                 = $request->doctor_reg_no;
        $doctor->time_slot_day                 = $request->time_slot_day;
        $doctor->clinic_name                   = $request->clinic_name;
        $doctor->contact                       = $request->contact;
        $doctor->consultation_fees             = $request->consultation_fees;
        $doctor->book_video_consult            = $request->book_video_consult;
        $doctor->book_hospital_app             = $request->book_hospital_app;
        $doctor->rating                        = $request->rating;
        $doctor->online_payment                = $request->online_payment;
        $doctor->language_know                 = $request->language_know;
        $doctor->location                      = $request->location;
        $doctor->faq                           = $request->faq;
        $doctor->color                           = $request->color;
        $doctor->profile_photo                 = json_encode($imageNames);
            
        $res = $doctor->save();
        $lastId = $doctor->id;
            
        return response()->json(['result' => $res, 'id' => $lastId]);
    }

    /**
     * Show the doctor view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function doctorview($id)
    {
        $details = Doctor::find($id);
        $profile_photo = json_decode($details['profile_photo']);
        if(!$profile_photo) $profile_photo = [];
        return view('doctor/doctorview', ['doctorDetails' => $details , 'profile_photo' => $profile_photo]);
    }

    /**
     * Show the doctor edit.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function doctoredit($id)
    {
        $details = Doctor::find($id);
        return view('doctor/doctoredit', ['doctorDetails' => $details]);
    }

    /**
     * Show the doctor update.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateDoctor(request $request, $id) {

        $doctor = Doctor::find($id);
        
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
                $fileName = 'Doctor-'.Carbon::now()->timestamp.'-'.uniqid().'.'.$guessExtension;
                $img =\Image::make($image);
                $img->save($destinationPath . '/' . $fileName, $x);
                $imageNames[] = $fileName;
                // $image->move($destinationPath, $fileName);
                // $imageNames[] = $fileName;
            }
        }else{
            $previousData = json_decode($doctor->profile_photo, true);
            if (!empty($previousData) && is_array($previousData)) {
                $imageNames = $previousData;
            }
        }

        $data = $request->except('_token');
        $doctor->doctor_name                   = $request->doctor_name; 
        $doctor->age                           = $request->age;
        $doctor->sex                           = $request->sex;
        $doctor->degree                        = $request->degree;
        $doctor->experience                    = $request->experience;
        $doctor->medical_reg_verified          = $request->medical_reg_verified;
        $doctor->doctor_reg_no                 = $request->doctor_reg_no;
        $doctor->time_slot_day                 = $request->time_slot_day;
        $doctor->clinic_name                   = $request->clinic_name;
        $doctor->contact                       = $request->contact;
        $doctor->consultation_fees             = $request->consultation_fees;
        $doctor->book_video_consult            = $request->book_video_consult;
        $doctor->book_hospital_app             = $request->book_hospital_app;
        $doctor->rating                        = $request->rating;
        $doctor->online_payment                = $request->online_payment;
        $doctor->language_know                 = $request->language_know;
        $doctor->location                      = $request->location;
        $doctor->faq                           = $request->faq;
        $doctor->color                           = $request->color;
        $doctor->profile_photo                 = json_encode($imageNames);
        $res = $doctor->save();
        return response()->json(['result' => $res]);
    }

    // delete doctor data
    public function deletedoctordata(request $request) {
        $doctor = Doctor::find($request->doctorid);
        $res =$doctor->delete();
        return response()->json(['result' => $res]);  
    }

}