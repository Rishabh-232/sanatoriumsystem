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
                        <a href="{{ url('claimedit'.'/'.$claimDetails->id) }}" class="btn btn-outline-info mb-0">Edit</a>
                        <a id="deleteperson" class="btn btn-outline-danger deleteclaim mb-0">Delete</a>
                        <a href="{{ url('claimlist') }}" class="btn btn-outline-secondary mb-0">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Insurance Information</h4>
                </div>
                <div class="card-body">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr colspan=2>
                                    <th class="text-bold-500">Id</th>
                                    <td>{{ $claimDetails->id }}</td>
                                    <th class="text-bold-500">Name of the Insurance</th>
                                    <td>{{ $claimDetails->claim_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Type of Insurance</th>
                                    <td>{{ $claimDetails->type_of_claim }}</td>
                                    <th class="text-bold-500">Patient Name</th>
                                    <td>{{ $claimDetails->patient_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">What Diseases</th>
                                    <td>{{ $claimDetails->diseases }}</td>
                                    <th class="text-bold-500">Name of Doctor</th>
                                    <td>{{ $claimDetails->doctor_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Name of Hospital</th>
                                    <td>{{ $claimDetails->hospital_name }}</td>
                                    <th class="text-bold-500">Admitted Date</th>
                                    <td>{{ $claimDetails->admitted_date }}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <th class="text-bold-500">Discharged Date</th>
                                    <td>{{ $claimDetails->discharged_date }}</td>
                                    <th class="text-bold-500">Hospital Bills</th>
                                    <td>{{ $claimDetails->hospital_bills }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Lab Bills</th>
                                    <td>{{ $claimDetails->lab_bills }}</td>
                                    <th class="text-bold-500">Total Bills</th>
                                    <td>{{ $claimDetails->hospital_bills + $claimDetails->lab_bills}}</td>
                                </tr> 
                                <tr>
                                    <th class="text-bold-500">Reports of treatment</th>
                                    <td> 
                                        @foreach ($reports_of_treatment as $report)
                                            <img src="{{ asset('upload/' . $report) }}" style="height:100px !important; width:150px !important" alt="Image"  />
                                        @endforeach
                                    </td>
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
            $(document).on("click", ".deleteclaim", function(){ 
                var claimid = {{$claimDetails->id}};
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Claim\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) { 
                        $("#overlay").fadeIn(300);   
                        $.ajax({
                            url: "{{ route('deleteclaimdata') }}",
                            type: "DELETE",
                            data: {"claimid": claimid, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/claimlist') }}";
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
        });
    </script>
@endsection