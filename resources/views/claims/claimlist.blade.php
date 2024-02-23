@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Insurance List</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Patient</li>
                        </ol>
                    </nav> -->
                    <a href="{{ url('/claimadd') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger for login form modal -->
                    <!-- <a href="{{ url('/patientadd') }}"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a> -->
                </div>
                <div class="card-body table-responsive asd">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th class="table-min-width-small padding-small">Sr. No.</th>
                                <th>Name of Insurance</th>
                                <th>Type of Insurance</th>
                                <th>Patient Name</th>
                                <th>What Diseases</th>
                                <!-- <th>Name of Doctor</th> -->
                                <th>Name of Hospital</th>
                                <th>Admitted Date</th>
                                <th>Discharged Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($claimlist as $claim)
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td>{{ $claim->claim_name }}</td>
                                    <td>{{ $claim->type_of_claim }}</td>
                                    <td>{{ $claim->patient_name }}</td>
                                    <td>{{ $claim->diseases }}</td>
                                    <!-- <td>{{ $claim->doctor_name }}</td> -->
                                    <td>{{ $claim->hospital_name }}</td>
                                    <td>@if($claim->admitted_date == '')
                                        @else
                                        {{ date('d-M-Y', strtotime($claim->admitted_date)) }}
                                        @endif
                                    </td>
                                    <td>@if($claim->discharged_date == '')
                                        @else
                                        {{ date('d-M-Y', strtotime($claim->discharged_date)) }}
                                        @endif
                                    </td>
                                    <td class="button-holder">
                                        <a href="{{ url('claimview'."/".$claim->id) }}" class="btn btn-outline-info">View</a>
                                        <a href="{{ url('claimedit'."/".$claim->id) }}" class="btn btn-outline-warning">Edit</a>
                                        <a id="deleteperson" class="btn btn-outline-danger deleteclaim" data-id="{{$claim->id}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

            // To apply datatable
            table = $("#tablelist").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    title: 'Doctor-List'
                } ],
                'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                'pageLength': 50, // sets the default number of rows per page to 50
                'searching': true,
                'ordering': true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [8], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });

            // to delete patient data from patient list 
            $(document).on("click", ".deleteclaim", function(){ 
                var claimid = $(this).data('id');
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