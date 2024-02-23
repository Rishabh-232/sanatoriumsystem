<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\LabManagment;
use App\Models\TOW;
use App\Models\LabNote;
use App\Models\Plan;
use Carbon\Carbon;
use Auth;




use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
      public function index()
    {

        $currentYear = date('Y');
    
        // Calculate total patients for January
        $JanuaryPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 1)
        ->count();

        // Calculate total patients for February
        $FebruaryPatients = Patient::whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', 2)
            ->count();

        // Calculate total patients for March
        $MarchPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 3)
        ->count();

                // Calculate total patients for April
        $AprilPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 4)
        ->count();

        // Calculate total patients for May
        $MayPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 5)
        ->count();

        // Calculate total patients for June
        $JunePatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 6)
        ->count();

        // Calculate total patients for July
        $JulyPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 7)
        ->count();

        // Calculate total patients for August
        $AugustPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 8)
        ->count();

        // Calculate total patients for September
        $SeptemberPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 9)
        ->count();

        // Calculate total patients for October
        $OctoberPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 10)
        ->count();

        // Calculate total patients for November
        $NovemberPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 11)
        ->count();

        // Calculate total patients for December
        $DecemberPatients = Patient::whereYear('created_at', '=', $currentYear)
        ->whereMonth('created_at', '=', 12)
        ->count();



        // return view('home');
        $Todaycount = Appointment::whereDate('from_time', '=', date('Y-m-d'))->count();
        $Todayappoint = Appointment::whereDate('from_time', '=', date('Y-m-d'))->get();
        $Tomorrowcount = Appointment::whereDate('from_time', '=', date('Y-m-d', strtotime('+1 day')))->count();
        $Yesterdaycount = Appointment::whereDate('from_time', '=', date('Y-m-d', strtotime('-1 day')))->count();

        $Totalpatient = Patient::all()->count();

        $plandate = Plan::where('id',(Auth::user()->package))->get(['plans.*']);


        
        // print_r($Todaycount);exit();

        return view('home', [
        'Todaycount' => $Todaycount,
        'Tomorrowcount' => $Tomorrowcount,
        'Yesterdaycount' => $Yesterdaycount,
        'Todayappoint' => $Todayappoint,
        'Totalpatient' => $Totalpatient,
        'JanuaryPatients' => $JanuaryPatients,
        'FebruaryPatients' => $FebruaryPatients,
        'MarchPatients' => $MarchPatients,
        'AprilPatients' => $AprilPatients,
        'MayPatients' => $MayPatients,
        'JunePatients' => $JunePatients,
        'JulyPatients' => $JulyPatients,
        'AugustPatients' => $AugustPatients,
        'SeptemberPatients' => $SeptemberPatients,
        'OctoberPatients' => $OctoberPatients,
        'NovemberPatients' => $NovemberPatients,
        'DecemberPatients' => $DecemberPatients,
        'plandate' => $plandate,
        ]);
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexmanage()
    {   
        if(auth()->user()->roleNo == 3) {
            return redirect()->to('labnotelist');
            
        }else{

            $list = LabNote::join('lab' , 'lab.id', '=' ,'lab_note.lab_name')->where('active',1)->get(['lab_note.*','lab.lab_name as labname']);
            return view('homemanage', ['doctorlist' => $list]);
        }
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function table()
    {
        return view('table');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function form()
    {
        return view('form');
    }
    public function report()
    {   
        $lablist = LabManagment::all();
        $worklist = TOW::all();
        $list = LabNote::join('lab' , 'lab.id', '=' ,'lab_note.lab_name')->get(['lab_note.*','lab.lab_name as labname']);
        return view('Reportmanage/report', ['doctorlist' => $list,'lablist'=>$lablist,'worklist'=>$worklist]);
          
    }

    public function reportfilterlist(request $request)
    {
        $query = LabNote::query();
        // you can create a Builder instance

        if ($request->has('from_Date') && $request->has('to_Date') && !empty($request->input('from_Date')) && !empty($request->input('to_Date'))) { 
            $from_Date = Carbon::parse($request->input('from_Date'));
            $to_Date = Carbon::parse($request->input('to_Date'));

            $query->whereBetween('lab_note.created_at', [$from_Date->toDateString(), $to_Date->toDateString()]);
        }

        
        if ($request->has('lab_wise') && !empty($request->input('lab_wise'))) { 
            $lab_wise = $request->input('lab_wise');
            $query->where('lab_note.lab_name', '=', $lab_wise);
        }
        if ($request->has('payment_wise') && !empty($request->input('payment_wise'))) { 
            $payment_wise = $request->input('payment_wise');
            $query->where('lab_note.status', '=', $payment_wise);
        }

        // // Add a condition to filter by expected delivery date
        // if ($request->has('expected_date') && !empty($request->input('expected_date'))) {
        //     $expected_date = Carbon::parse($request->input('expected_date'));
        //     $query->whereDate('lab_note.excepted_date_of_deliver', '=', $expected_date->toDateString());
        // }
        // // Add a condition to filter by expected delivery date
        // if ($request->has('received_date') && !empty($request->input('received_date'))) {
        //     $received_date = Carbon::parse($request->input('received_date'));
        //     $query->whereDate('lab_note.receivedDate', '=', $received_date->toDateString());
        // }

        if ($request->has('expected_date') && $request->has('received_date') && !empty($request->input('expected_date')) && !empty($request->input('received_date'))) { 
            $from_Date = Carbon::parse($request->input('expected_date'));
            $to_Date = Carbon::parse($request->input('received_date'));

            $query->whereBetween('lab_note.receivedDate', [$from_Date->toDateString(), $to_Date->toDateString()]);
        }

        if ($request->has('work_wise') && !empty($request->input('work_wise'))) {
            // Here, we use the LIKE operator to filter based on the presence of a name
            $work_wise = $request->input('work_wise');
            $query->where('lab_note.type_of_work', 'LIKE', '%' . $work_wise . '%');
        }    
        
        $list = $query->join('lab' , 'lab.id', '=' ,'lab_note.lab_name')->get(['lab_note.*','lab.lab_name as labname']);
        // print_r($list);exit;

        return response()->json(['data' => $list]);
    }
}
