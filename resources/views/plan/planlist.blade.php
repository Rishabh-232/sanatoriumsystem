@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Plan List</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Patient</li>
                        </ol>
                    </nav> -->
                    <a href="{{ url('/planadd') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a>
               
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger for login form modal -->
                    <!-- <a href="{{ url('/customeradd') }}"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a> -->
                </div>
                <div class="card-body table-responsive asd">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th class="table-min-width-small">Sr. No.</th>
                                <th>Plan Name</th>
                                <th>Plan Price</th>
                                <th>access_to_page</th>
                                <th>Number Of Days</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($planlist as $plan )
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td class="table-min-width-small">{{ $plan->plan_name }}</td>
                                    <td class="table-min-width-small">{{ $plan->plan_price }}</td>
                                    <td class="table-min-width-small">{{ $plan->access_to_page	 }}</td>
                                    <td class="table-min-width-small">{{ $plan->number_of_days	 }}</td>
                                    <td class="button-holder">
                                        <a href="{{ url('planview'."/".$plan->id) }}" class="btn btn-outline-info">View</a>
                                        <a href="{{ url('planedit'."/".$plan->id) }}" class="btn btn-outline-warning">Edit</a>
                                        <a id="deleteplan" class="btn btn-outline-danger deleteplan" data-id="{{$plan->id}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>  
            </div>

        </section>
@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            // To apply datatable
            table = $("#tablelist").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    title: 'Plan-List'
                } ],
                'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                'pageLength': 10, // sets the default number of rows per page to 50
                'searching'   : true,
                'ordering': true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [1], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            // To delete plan
            $(document).on("click", ".deleteplan", function(){ 
                var planid = $(this).data('id'); 
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Plan\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);   
                        $.ajax({
                            url: "{{ route('deleteplandata') }}",
                            type: "DELETE",
                            data: {"planid": planid, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/planlist') }}";
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