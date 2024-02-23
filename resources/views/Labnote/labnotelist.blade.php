@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Lab Note</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Patient</li>
                        </ol>
                    </nav> -->
                    <a href="{{ url('/labnoteadd') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add Lab Note</button></a>
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
                                <th>Patient Name</th>
                                <th>Lab Name</th>
                                <th>Teeth/Tooth</th>
                                <th>Type of Work</th>
                                <th>Excepted Date of Deliver</th>
                                <th>Instructions</th>
                                <th>Work Given In The Form</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($doctorlist as $doctor)
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td>{{ $doctor->patient_name }}</td>
                                    <td>{{ $doctor->labname }}</td>
                                    <td>{{ $doctor->teeth_tooth }}</td>
                                    <td>{{ $doctor->type_of_work }}</td>
                                    <td>{{ $doctor->excepted_date_of_deliver }}</td>
                                    <td>
                                        <?php
                                        $noteValues = explode(',', $doctor->note); // Split the note field by commas
                                        foreach ($noteValues as $noteValue) {
                                            echo $noteValue . "<br>"; // Add a line break to display each value on a new line
                                        }
                                        ?>
                                        {{$doctor->additional}}
                                    </td>
                                    <td>{{ $doctor->selectedOption }}</td>
                                    <td class="button-holder">
                                        <a href="{{ url('labnoteview'."/".$doctor->id) }}" class="btn btn-outline-info">View</a>
                                        <a href="{{ url('labenotedit'."/".$doctor->id) }}" class="btn btn-outline-warning">Edit</a>
                                        <a id="deleteperson" class="btn btn-outline-danger deletedoctor" data-id="{{$doctor->id}}">Delete</a>
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
                'searching': false,
                'ordering': true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [7], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });

            // to delete doctor data from doctor list 
            $(document).on("click", ".deletedoctor", function(){ 
                var doctorid = $(this).data('id');
                $("#overlay").fadeIn(300);    
                $.ajax({
                    url: "{{ url('/deletelabnotedata') }}",
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
                                window.location.href = "{{ url('/labnotelist') }}";
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
            });
        });
    </script>
@endsection