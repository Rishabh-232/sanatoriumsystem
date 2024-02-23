@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Lab List</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <a href="{{ url('/labadd') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add Lab</button></a>
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
                                <th>Lab Name</th>
                                <th>Lab Contact No</th>
                                <th>Lab Address</th>
                                <th>Contact Person No</th>
                                <th>Delivery Person Name</th>
                                <th>Delivery Person Contact No</th>
                                <th>Alternate Delivery Person Name</th>
                                <th>Alternate Delivery Person Contact No</th>
                                <th>Mail Id</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($lablist as $lab)
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td>{{ $lab->lab_name }}</td>
                                    <td>{{ $lab->contact_no }}</td>
                                    <td>{{ $lab->lab_address }}</td>
                                    <td>{{ $lab->contact_person_no }}</td>
                                    <td>{{ $lab->delivery_name }}</td>
                                    <td>{{ $lab->delivery_contct_no }}</td>
                                    <td>{{ $lab->alt_delivry_name }}</td>
                                    <td>{{ $lab->alt_delivry_contct_no }}</td>
                                    <td>{{ $lab->email }}</td>
                                    <td class="button-holder">
                                        <a href="{{ url('labview'."/".$lab->id) }}" class="btn btn-outline-info">View</a>
                                        <a href="{{ url('labedit'."/".$lab->id) }}" class="btn btn-outline-warning">Edit</a>
                                        <a id="deleteperson" class="btn btn-outline-danger deletelab" data-id="{{$lab->id}}">Delete</a>
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
                    title: 'lab-List'
                } ],
                'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                'pageLength': 50, // sets the default number of rows per page to 50
                'searching': false,
                'ordering': true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [6], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });

            // to delete lab data from lab list 
            $(document).on("click", ".deletelab", function(){ 
                var labid = $(this).data('id');
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