@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    {{-- <h3>Plan List</h3> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="buttons text-center">
                        <a href="{{ url('planedit'.'/'.$planDetails->id) }}" class="btn btn-outline-info mb-0">Edit</a>
                        <a id="deleteperson" class="btn btn-outline-danger deleteplan mb-0">Delete</a>
                        <a href="{{ url('planlist') }}" class="btn btn-outline-secondary mb-0">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Plan Information</h4>
                </div>
                <div class="card-body">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr colspan=2>
                                    <th class="text-bold-500">Id</th>
                                    <td>{{ $planDetails->id }}</td>
                                    <th class="text-bold-500">Plan Name</th>
                                    <td>{{ $planDetails->plan_name }}</td>
                                </tr>
                                <tr colspan=2>
                                    <th class="text-bold-500">Plan Price</th>
                                    <td>{{ $planDetails->plan_price }}</td>
                                    <th class="text-bold-500">access_to_page</th>
                                    <td>{{ $planDetails->access_to_page }}</td>
                                    
                                </tr>
                                <tr colspan=2>
                                    <th class="text-bold-500">Number Of Days</th>
                                    <td>{{ $planDetails->number_of_days }}</td>
                                    
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

            // To delete plan
            $(document).on("click", ".deleteplan", function(){ 
                var planid = {{$planDetails->id}}; 
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