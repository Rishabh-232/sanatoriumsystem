@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <div  id="subscriptionDiv" class="alert alert-danger alert-dismissible fade show position-relative" role="alert">
            <button type="button"  class="btn-close" style="position: absolute; top: 0; right: 0;">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">Renew Your Subscription Now!</h4>
            <p>Your Subscription will end in 30 days</p>
            <div class="row">
                <div class="col-12 col-md-6 offset-md-6">
                    <button class="btn btn-success">Renew Now</button>
                </div>
            </div>
        </div>
    </div>
    <div class="page-heading">
        <h3>Profile Statistics</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex wd justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <a href="#" ><i class="iconly-boldShow"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 wid">
                                        <h6 class="font-extrabold">Total Patients</h6>
                                        <h6 class="font-semibold mb-0">{{ $Totalpatient }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 wd d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 wid">
                                                <!-- class="text-muted" -->
                                        <h6 class="font-extrabold">Yesterdays Appointments</h6>
                                        <h6 class="font-semibold mb-0">{{ $Yesterdaycount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card"  id="todayAppointments" style="cursor:pointer">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex wd justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 wid">
                                        <h6 class="font-extrabold">Todays Appointments</h6>
                                        <h6 class="font-semibold mb-0">{{ $Todaycount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card" id="upcommingAppointments" style="cursor:pointer">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex  wd justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 wid">
                                        <h6 class="font-extrabold">Upcoming Appointments</h6>
                                        <h6 class="font-semibold mb-0">{{ $Tomorrowcount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Patient Visit</h4>
                            </div>
                            <div class="card-body">
                            <div id="chart-profile-visit" 
                                data-jan-count="{{ $JanuaryPatients }}"
                                data-feb-count="{{ $FebruaryPatients }}"
                                data-march-count="{{ $MarchPatients }}"
                                data-april-count="{{ $AprilPatients }}"
                                data-may-count="{{ $MayPatients }}"
                                data-june-count="{{ $JunePatients }}"
                                data-july-count="{{ $JulyPatients }}"
                                data-august-count="{{ $AugustPatients }}"
                                data-september-count="{{ $SeptemberPatients }}"
                                data-october-count="{{ $OctoberPatients }}"
                                data-november-count="{{ $NovemberPatients }}"
                                data-december-count="{{ $DecemberPatients }}">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-primary" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="assets/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Europe</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">862</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-europe"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-success" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="assets/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">America</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">375</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-america"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                style="width:10px">
                                                <use
                                                    xlink:href="assets/images/bootstrap-icons.svg#circle-fill" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Indonesia</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">1025</h5>
                                    </div>
                                    <div class="col-12">
                                        <div id="chart-indonesia"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Comments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="assets/images/faces/5.jpg">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Congratulations on your graduation!</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="assets/images/faces/2.jpg">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Wow amazing design! Can you make another tutorial for
                                                        this design?</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-12 col-lg-3">
                <div class="card message-holder">
                    <div class="card-header">
                        <h4>Messages Sent</h4>
                    </div>
                    @foreach($Todayappoint as $today)
                    <div class="card-content pb-4">
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="assets/images/faces/user.jpg">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">{{ $today->patient }}</h5>
                                <h6 class="mb-0">{{ $today->from_time }}</h6>
                                <h6 class="mb-0">{{ $today->remarks }}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- <div class="card">
                    <div class="card-header">
                        <h4>Visitors Profile</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-visitors-profile"></div>
                    </div>
                </div> -->
            </div>
        </section>
    </div>
@endsection
@section('jsscript')
    <!-- Need: Apexcharts -->
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script> -->

    <script>
        $(document).ready(function() {
            // Get the current date
            var currentDate = new Date();

            // Get the plan date in the format "yyyy-mm-dd"
            var planDateStr = "<?php echo $plandate[0]['todate']; ?>"; // Use the plan date from $plandate
            console.log("planDateStr:", planDateStr);


            // Convert the plan date string to a Date object
            var planDate = new Date(planDateStr);

            // Calculate the difference in milliseconds between the two dates
            var timeDifference = planDate - currentDate;

            // Calculate the difference in days
            var daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

            function updateSubscriptionInfo(daysRemaining) {
                var subscriptionDiv = $("#subscriptionDiv");
                var message = "Your Subscription will end in " + daysRemaining + " days";

                if (daysRemaining <= 0) {
                    message = "Your Subscription has Ended";
                }

                subscriptionDiv.find("p").text(message);

            }

             // Function to update subscription info
            function updateSubscription() {
                // Calculate the remaining days
                var currentDate = new Date();
                var timeDifference = planDate - currentDate;
                var daysRemaining = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

                // Update the subscription information
                updateSubscriptionInfo(daysRemaining);
            }

            // Call the function to update subscription info on page load
            updateSubscription();

            // Set an interval to update the subscription info every day
            setInterval(updateSubscription, 24 * 60 * 60 * 1000);

            var number_of_days = "<?php echo $plandate[0]['number_of_days']; ?>"; // Use the plan date from $plandate
            console.log("number_of_days:", number_of_days);

            if(number_of_days == 30){
                if (daysDifference <= 10) {
                    // Show the div
                    $("#subscriptionDiv").css('display', 'none');
                } else {
                    // Hide the div
                    $("#subscriptionDiv").css('display', 'none');
                }
            }else{
                if (daysDifference <= 30) {
                    // Show the div
                    $("#subscriptionDiv").css('display', 'none');
                } else {
                    // Hide the div
                    $("#subscriptionDiv").css('display', 'none');
                }
            }
        });
    </script>


    <script>
     document.addEventListener("DOMContentLoaded", function() {

    var chartContainer = document.getElementById('chart-profile-visit');
    var Totaljan = chartContainer.getAttribute('data-jan-count');
    var Totalfeb = chartContainer.getAttribute('data-feb-count');
    var Totalmarch = chartContainer.getAttribute('data-march-count');
    var Totalapril = chartContainer.getAttribute('data-april-count');
    var Totalmay = chartContainer.getAttribute('data-may-count');
    var Totaljune = chartContainer.getAttribute('data-june-count');
    var Totaljuly = chartContainer.getAttribute('data-july-count');
    var Totalaugust = chartContainer.getAttribute('data-august-count');
    var Totalseptember = chartContainer.getAttribute('data-september-count');
    var Totaloctober = chartContainer.getAttribute('data-october-count');
    var Totalnovember = chartContainer.getAttribute('data-november-count');
    var Totaldecember = chartContainer.getAttribute('data-december-count');
    var optionsProfileVisit = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled: false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity: 1
        },
        plotOptions: {},
        series: [{
            name: 'Patients',
            data: [Totaljan,Totalfeb,Totalmarch,Totalapril,Totalmay,Totaljune,Totaljuly,Totalaugust,Totalseptember,Totaloctober,Totalnovember,Totaldecember]
        }],
        colors: ['#435ebe'],
        xaxis: {
            categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"],
        },
    };

    var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
    chartProfileVisit.render();
});
    </script>

<script>
    $(document).ready(function() {
        $('#todayAppointments').on('click', function() {
            // Replace 'YOUR_URL_HERE' with the actual URL you want to navigate to
            window.location.href =  "{{ url('/addappontment') }}?Dashboard=" + encodeURIComponent('1');;
        });
        $('#upcommingAppointments').on('click', function() {
            // Replace 'YOUR_URL_HERE' with the actual URL you want to navigate to
            window.location.href =  "{{ url('/addappontment') }}?Dashboard=" + encodeURIComponent('2');;
        });
    });
</script>
@endsection