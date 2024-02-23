@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body card-body-mobile">
                    <div class="buttons text-center card-head-btn-holder">
                        <a href="{{ url('shadeedit'.'/'.$shadeDetails->id) }}" class="btn btn-outline-info mb-0">Edit</a>
                        <a id="shade" class="btn btn-outline-danger deleteshade mb-0">Delete</a>
                        <a href="{{ url('/shadelist') }}" class="btn btn-outline-secondary mb-0">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Shades Information</h4>
                </div>
                <div class="card-body">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr colspan=2>
                                    <th class="text-bold-500">Id</th>
                                    <td>{{ $shadeDetails->id }}</td>
                                    <th class="text-bold-500">Shade Name</th>
                                    <td>{{ $shadeDetails->shade_name }}</td>
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
            $(document).on("click", ".deleteshade", function(){ 
                var shadeid = {{$shadeDetails->id}}; 
                $("#overlay").fadeIn(300);   
                $.ajax({
                    url: "{{ url('/deleteshadedata') }}",
                    type: "DELETE",
                    data: {"shadeid": shadeid, "_token": $("input[name='_token']").val()},
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
                                window.location.href = "{{ url('/shadelist') }}";
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