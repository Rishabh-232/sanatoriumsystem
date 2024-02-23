@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
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
                        <a href="{{ url('labedit'.'/'.$labDetails->id) }}" class="btn btn-outline-info mb-0">Edit</a>
                        <a id="deleteperson" class="btn btn-outline-danger deletelab mb-0">Delete</a>
                        <a href="{{ url('lablist') }}" class="btn btn-outline-secondary mb-0">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Lab Information</h4>
                </div>
                <div class="card-body">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr colspan=2>
                                    <th class="text-bold-500">Id</th>
                                    <td>{{ $labDetails->id }}</td>
                                    <th class="text-bold-500">Lab Name</th>
                                    <td>{{ $labDetails->lab_name }}</td>
                                </tr>
                                <tr colspan=2>
                                    <th class="text-bold-500">Contact No</th>
                                    <td>{{ $labDetails->contact_no }}</td>
                                    <th class="text-bold-500">Lab Address</th>
                                    <td>{{ $labDetails->lab_address }}</td>
                                </tr>
                                <tr colspan=2>
                                    <th class="text-bold-500">Contact Person No</th>
                                    <td>{{ $labDetails->contact_person_no }}</td>
                                    <th class="text-bold-500">Email</th>
                                    <td>{{ $labDetails->email }}</td>
                                </tr>
                                <tr colspan=2>
                                    <th class="text-bold-500">Delivery Person Name</th>
                                    <td>{{ $labDetails->delivery_name }}</td>
                                    <th class="text-bold-500">Delivery Person Contact No</th>
                                    <td>{{ $labDetails->delivery_contct_no }}</td>
                                </tr>
                                <tr colspan=2>
                                    <th class="text-bold-500">Alternate Delivery Person Name</th>
                                    <td>{{ $labDetails->alt_delivry_name }}</td>
                                    <th class="text-bold-500">Alternate Delivery Person Contact No</th>
                                    <td>{{ $labDetails->alt_delivry_contct_no }}</td>
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
            $(document).on("click", ".deletelab", function(){ 
                var labid = {{$labDetails->id}}; 
                $("#overlay").fadeIn(300);   
                $.ajax({
                    url: "{{ url('/deletelabdata') }}",
                    type: "DELETE",
                    data: {"labid": labid, "_token": $("input[name='_token']").val()},
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
                                window.location.href = "{{ url('/lablist') }}";
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