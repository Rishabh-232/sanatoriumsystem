<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Patient;
use App\Models\Appointment;
use DB;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patient:appointment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Cron is working fine!");
        // $instanceid = '64059ae17d0845643a0aa13b';
        // $patientschedule = Patient::where('date_of_birth', '=', now()->format('Y-m-d'))->get(['contact_1']);
        // $patientNumber = [];
        // foreach ($patientschedule as $patientDetails) {
        //     $message = 'Dento Relief Centre wishes you many many happy returns of the day. Regards Dr Akshay Biyani and staff.';
        //     $api = "https://wts.vision360solutions.co.in/api/sendText?token=".$instanceid."&phone=".$patientDetails['contact_1']."&message=".$message;
        //     echo $api;
        // }

        // $instanceid = '64059ae17d0845643a0aa13b';

        // $url = "https://wts.vision360solutions.co.in/api/sendText?token=".$instanceid."&message=Testing"."&phone=+918605217505";

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $resp = curl_exec($ch);

        // if($e = curl_error($ch)) {
        //     echo $e;
        // }
        // else {
        //     $decoded = json_decode($resp, true);
        //     print_r($decoded);
        // }
        // curl_close($ch);

        $instanceid = '64059ae17d0845643a0aa13b';

        // for birthday wishes
        
        $patientbirthdayschedule = Patient::where(DB::raw("(DATE_FORMAT(patients.date_of_birth,'%m-%d'))"), "=" , now()->format('m-d'))->get(['contact_1','name']);
        foreach ($patientbirthdayschedule as $patientDetails) {
            if ($patientDetails['contact_1'] != '') {                
                $message = urlencode('Dear '.$patientDetails['name'].' Dento Relief Centre wishes you many many happy returns of the day. Regards Dr Akshay Biyani and staff.');
                $patientnumber = '+91'.$patientDetails['contact_1'];
                // print_r($patientnumber); 
                // $url = "https://wts.vision360solutions.co.in/api/sendText?token=".$instanceid."&message=".$message."&phone=".$patientnumber;

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $resp = curl_exec($ch);

                if($e = curl_error($ch)) {
                    echo $e;
                }
                else {
                    $decoded = json_decode($resp, true);
                    print_r($decoded);
                }
                curl_close($ch);
            }
        }

        // for anniversary wishes

        $patientanniversaryschedule = Patient::where(DB::raw("(DATE_FORMAT(patients.anniversary,'%m-%d'))"), "=" , now()->format('m-d'))->get(['contact_1','name']);
        foreach ($patientanniversaryschedule as $patientDetails) {
            if ($patientDetails['contact_1'] != '') {                
                $message = urlencode('Dear '.$patientDetails['name'].' Dento Relief Centre wishes you a very happy anniversary. Regards Dr Akshay Biyani and staff.');
                $patientnumber = '+91'.$patientDetails['contact_1'];
                // print_r($patientnumber); 
                // $url = "https://wts.vision360solutions.co.in/api/sendText?token=".$instanceid."&message=".$message."&phone=".$patientnumber;

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $resp = curl_exec($ch);

                if($e = curl_error($ch)) {
                    echo $e;
                }
                else {
                    $decoded = json_decode($resp, true);
                    print_r($decoded);
                }
                curl_close($ch);
            }
        }

        // for appointment reminder

        $appointmentreminder = Appointment::select('patients.contact_1','patients.name','appointments.from_time')
                    ->join('patients', 'patients.name', '=', 'appointments.doctor', 'LEFT')
                    ->where(DB::raw("(DATE_FORMAT(appointments.from_time,'%Y-%m-%d'))"), "=" , now()->format('Y-m-d'))
                    ->get();        
        foreach ($appointmentreminder as $patientDetails) {
            if ($patientDetails['contact_1'] != '') {                 
                $appointmentDate = $patientDetails['from_time'];
                $date = date('Y-m-d', strtotime($appointmentDate));
                $time = date('h:i A', strtotime($appointmentDate));
                $patientnumber = '+91'.$patientDetails['contact_1'];
                $message = urlencode('Dear '.$patientDetails['name'].' A gentle reminder for today\'s dental appointment with Dr Akshay Biyani at Dento Relief Centre at '.$time);
                // print_r($patientnumber); 
                // $url = "https://wts.vision360solutions.co.in/api/sendText?token=".$instanceid."&message=".$message."&phone=".$patientnumber;

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $resp = curl_exec($ch);

                if($e = curl_error($ch)) {
                    echo $e;
                }
                else {
                    $decoded = json_decode($resp, true);
                    print_r($decoded);
                }
                curl_close($ch);
            }
        }
    }
}
