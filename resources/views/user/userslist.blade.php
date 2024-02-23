@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Users List</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Patient</li>
                        </ol>
                    </nav> -->
                    <a href="{{ url('/userAdd') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Package</th>
                                <th>User Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($userslist as $user)
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->package }}</td>
                                    <td>
                                        @if ($user->roleNo == 1)
                                            SuperAdmin
                                        @elseif ($user->roleNo == 2)
                                            Admin
                                        @elseif ($user->roleNo == 3)
                                            Branch Manager
                                        @elseif ($user->roleNo == 4)
                                            Doctor
                                        @elseif ($user->roleNo == 5)
                                         Receptionist
                                        @endif
                                    </td>
                                    <td class="button-holder">
                                        <!-- <a href="{{ url('claimview'."/".$user->id) }}" class="btn btn-outline-info">View</a> -->
                                        <a href="{{ url('userslistedit'."/".$user->id) }}" class="btn btn-outline-warning">Edit</a>
                                        <a id="deleteperson" class="btn btn-outline-danger deleteusers" data-id="{{$user->id}}">Delete</a>
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
            table = $("#userslist").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    title: 'userslist'
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
            $(document).on("click", ".deleteusers", function(){ 
                var usersid = $(this).data('id');
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
                            url: "{{ route('deleteuserslist') }}",
                            type: "DELETE",
                            data: {"usersid": usersid, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/userslist') }}";
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