<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Visit;
use App\Models\Treatment;
use App\Models\Patient;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Appointmentcontroller extends Controller
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
     * Show the appointment list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function appontmentlist()
    {
        $list = Appointment::all();
        return view('appointment/appontmentlist', ['appointList' => $list]);
    }

    /**
     * Show the appointment list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addappontment()
    {
        $doctorappointList = Doctor::all();
        $list = Patient::all();
        $doctorlist = Doctor::all();

        $events = array();
        $bookings = Appointment::all();
        foreach ($bookings as $booking) {
            $events[] = [
                'id' => $booking->id,
                'title' => $booking->doctor . '|' . $booking->patient . '|' . $booking->color . '|' . $booking->status, // Combine doctor and patient names
                'description' => $booking->remarks,
                'start' => $booking->from_time,
                'end' => $booking->to_time,
            ];
        }

        return view('appointment/addappontment', ['appointList' => $list, 'doctorappointList' => $doctorappointList, 'events' => $events,'doctorfilterlist'=>$doctorlist]);
    }

    // add appointment data
    public function addAppontmentinfo(request $request) {
        // echo $request->startDate;
        // echo $request->endDate;
        // echo ." - ".;exit();
        $color = Doctor::where('doctor_name',$request->doctorlist)->value('color');
        // print_r($color[0]['color']);exit;
        $appointment = new Appointment;
        $appointment->from_time   = date("Y-m-d H:i:s", strtotime($request->startDate));
        $appointment->to_time     = date("Y-m-d H:i:s", strtotime($request->endDate));
        $appointment->doctor      = $request->doctorlist; 
        $appointment->patient     = $request->patientlist; 
        $appointment->color       = $color; 
        $appointment->remarks     = $request->remarks; 
        $res = $appointment->save();
        return response()->json(['result' => $res]);
    }

    // Edit appointment data
    public function updateAppontmentinfo(request $request) {

        if($request->status == 'Reschedule'){
            $appointment = Appointment::find($request->appointmentid);
            $res =$appointment->delete();
            return response()->json(['result' => $res]);

        }else{

            $color = Doctor::where('doctor_name', $request->updatedoctorlist)->value('color');
            $appointment = Appointment::find($request->appointmentid);
            $appointment->doctor = $request->updatedoctorlist;
            $appointment->patient = $request->updatepatientlist;
            $appointment->status       = $request->status; 
            $appointment->remarks = $request->updateremarks;
            $appointment->color = $color; // Update the color here
            $res = $appointment->save();

            // for pass same color to all saved doc appoint when update  
              
            // $doccolor = Appointment::where('doctor',$request->updatedoctorlist)->get();
            // // Update the color for each appointment
            // foreach ($doccolor as $appointment) {
            //     $appointment->color = $color;
            //     $appointment->save();
            // }

            return response()->json(['result' => $res,'data'=>$appointment]);
        }
    }

    // add appointment data
    public function addappointment(request $request) {
        $appointment = new Appointment;
        $appointment->from_time   = date("Y-m-d", strtotime($request->start_time));
        $appointment->to_time     = date("Y-m-d", strtotime($request->end_time));
        $appointment->doctor      = $request->patient_name; 
        $appointment->remarks     = $request->description; 
        $res = $appointment->save();
        return response()->json(['result' => $res]);
    }

     // Get appointment data data
    public function getappointmentdata(request $request) {
        $id     = $request->get('appointid');
        $appointment  = Appointment::where('id', $id)->first();

        $appointment->from_time = date("d-M-Y", strtotime($appointment->from_time));
        $appointment->to_time = date("d-M-Y", strtotime($appointment->to_time));
        return response()->json(['data' => $appointment]);
    }

    // update appointment data
    public function updateappointment(request $request) {
        $appointment = Appointment::find($request->Eappointid);
        
        $data = $request->except('_token'); 
        $appointment->from_time   = date("Y-m-d", strtotime($request->Estart_time));
        $appointment->to_time     = date("Y-m-d", strtotime($request->Eend_time));
        $appointment->doctor      = $request->Epatient_name; 
        $appointment->remarks     = $request->Edescription; 
        $res = $appointment->save();
        return response()->json(['result' => $res]);
    }

    // delete appointment data
    public function deletappointmentdata(request $request) {
        $appointment = Appointment::find($request->appid);
        $res =$appointment->delete();
        return response()->json(['result' => $res]);  
    }
    
    // delete appointment
    public function deleteAppoiement(request $request) {
        $appointment = Appointment::find($request->appointmentId);
        $res =$appointment->delete();
        return response()->json(['result' => $res]);  
    }

    public function getPatientnumber(Request $request) {
        
        $patientMnumber = Patient::where('name', '=', $request->patientId)
        ->get(['patients.*', 'patients.contact_1']);

        return response()->json(['response' => true, 'data' => $patientMnumber]);
    }

    public function getDoctornumber(Request $request) {
        
        $doctorMnumber = Doctor::where('doctor_name', '=', $request->doctorId)
        ->get(['doctors.*', 'doctors.contact']);

        return response()->json(['response' => true, 'data' => $doctorMnumber]);
    }
    
}