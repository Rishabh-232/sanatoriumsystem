@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    {{-- <h3>Patient List</h3> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Patient</li>
                        </ol>
                    </nav> -->
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="buttons text-center">
                        <a href="{{ url('doctoredit'.'/'.$doctorDetails->id) }}" class="btn btn-outline-info mb-0">Edit</a>
                        <a id="deleteperson" class="btn btn-outline-danger deletedoctor mb-0">Delete</a>
                        <a href="{{ url('doctorlist') }}" class="btn btn-outline-secondary mb-0">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Doctor Information</h4>
                </div>
                <div class="card-body">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr colspan=2>
                                    <th class="text-bold-500">Id</th>
                                    <td>{{ $doctorDetails->id }}</td>
                                    <th class="text-bold-500">Name of the Doctor</th>
                                    <td>{{ $doctorDetails->doctor_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Age (In Years)</th>
                                    <td>@if($doctorDetails->age == '1970-01-01')
                                        {{ $doctorDetails->age }}
                                        @else
                                        {{ $doctorDetails->age }}
                                        @endif
                                    </td>
                                    <th class="text-bold-500">Sex</th>
                                    <td>{{ $doctorDetails->sex == 1 ? 'Male' : 'Female ' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Degree </th>
                                    <td>{{ $doctorDetails->degree }}</td>
                                    <th class="text-bold-500">Experience (Years)</th>
                                    <td>{{ $doctorDetails->experience }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Medical Registration Verified</th>
                                    <td>{{ $doctorDetails->medical_reg_verified }}</td>
                                    <th class="text-bold-500">Doctor Registration Number</th>
                                    <td>{{ $doctorDetails->doctor_reg_no }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Available time slot with days</th>
                                    <td>{{ $doctorDetails->time_slot_day }}</td>
                                    <th class="text-bold-500">Clinic Name</th>
                                    <td>{{ $doctorDetails->clinic_name }}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <th class="text-bold-500">Contact Number</th>
                                    <td>{{ $doctorDetails->contact }}</td>
                                    <th class="text-bold-500">Consultations Fee</th>
                                    <td>{{ $doctorDetails->consultation_fees }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Book Video Consultations</th>
                                    <td>{{ $doctorDetails->book_video_consult }}</td>
                                    <th class="text-bold-500">Book Hospital Appointment</th>
                                    <td>{{ $doctorDetails->book_hospital_app }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Rating(Patient Feedback)</th>
                                    <td>{{ $doctorDetails->rating }}</td>
                                    <th class="text-bold-500">Online Payment available</th>
                                    <td>{{ $doctorDetails->online_payment }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Language Know</th>
                                    <td>{{ $doctorDetails->language_know }}</td>
                                    <th class="text-bold-500">Location</th>
                                    <td>{{ $doctorDetails->location }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Frequently Ask Questions </th>
                                    <td>{{ $doctorDetails->faq }}</td>
                                    <th class="text-bold-500">Profile Photo</th>
                                    <td> 
                                        @foreach ($profile_photo as $report)
                                            <img src="{{ asset('upload/' . $report) }}" style="height:100px !important; width:150px !important" alt="Image"  />
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Color Identifier</th>
                                    <td><input type="color" value="{{ $doctorDetails->color }}" disabled></td>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script>
        $(document).ready(function() {

            // To delete patient
            $(document).on("click", ".deletedoctor", function(){ 
                var doctorid = {{$doctorDetails->id}}; 
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Doctor\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);   
                        $.ajax({
                            url: "{{ route('deletedoctordata') }}",
                            type: "DELETE",
                            data: {"doctorid": doctorid, "_token": $("input[name='_token']").val()},
                            dataType: "json", 
                            success: function(response) {
                                $("#overlay").fadeOut(300);
                                if(response.result)
                                {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Success",
                                        timer: 2000,
                                        button:"OK",
                                        showConfirmButton:true
                                    }).then(function() {
                                        window.location.href = "{{ url('/doctorlist') }}";
                                    });
                                }
                                else
                                {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error"
                                    });
                                }
                            }
                        });
                    }
                });
            });
            // To select Image
            // $('.teethsection img').click(function () {
            //     $(this).toggleClass('selected');
            //     var toothId = $(this).attr('data-id');
            //     if($(this).hasClass('selected'))
            //     {
            //         var tempSrc = '{{ asset('assets/images/infected') }}/'+toothId+".jpg";
            //     }
            //     else
            //     {
            //         var tempSrc = '{{ asset('assets/images/normal') }}/'+toothId+".jpg";   
            //     }
            //     $(this).attr('src', tempSrc);
            //     pushselectedteethtoArray();
            // });

            // $(function(){
            //     $(".dateofbirth").datepicker({ 
            //         dateFormat: 'dd-M-yy',
            //         changeYear: true,
            //         changeMonth: true,
            //         yearRange: "c-150:c+150"
            //     });
            //     $(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
            // });

            // $('#inlineForm, #newLabOrder, #visitinfo, #visitedit, #treatmentinfo, #selectteethModal').modal({
            //     backdrop: 'static',
            //     keyboard: false
            // });
        });
    </script>
@endsection