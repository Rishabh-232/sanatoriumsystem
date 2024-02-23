@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title mb-3">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Reference Treatment List</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reference Treatments</li>
                        </ol>
                    </nav> -->
                    <a data-bs-toggle="modal" data-bs-target="#addreftreatModal" class="new-button"><button type="button" class="btn btn-outline-primary float-end">New Reference Treatment</button></a>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger for login form modal -->
                    <!-- <a data-bs-toggle="modal" data-bs-target="#addreftreatModal" class="btn btn-outline-primary float-end">New Reference Treatment</a> -->
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th class="table-min-width-small">Sr. No.</th>
                                <th>Name</th>
                                <th>Charges Option 1</th>
                                <th>Charges Option 2</th>
                                <th>Charges Option 3</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($referencelist as $reflist)
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td>{{ $reflist->name }}</td>
                                    <td>{{ $reflist->charge_one }}</td>
                                    <td>{{ $reflist->charge_two }}</td>
                                    <td>{{ $reflist->charge_three }}</td>
                                    <td class="button-holder">
                                        <a href="#" class="btn btn-outline-warning edit_visit"data-bs-toggle="modal" data-bs-target="#reftreatedit" data-id="{{ $reflist->id }}">Edit</a>
                                        <a id="deleteperson" class="btn btn-outline-danger deletereftreat" data-id="{{$reflist->id}}">Delete</a>
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

    <!--Add Reference treatments form Modal -->
    <div class="modal fade text-left" id="addreftreatModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Reference Treatment</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="addreftreatForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="reftreatId" id="reftreatId">
                        <label>Reference Treatment</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="ref_treatments" name="ref_treatments">
                        </div>
                        <label>Charges Option 1</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="chargeone" name="chargeone" value="0">
                        </div>
                        <label>Charges Option 2</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="chargetwo" name="chargetwo" value="0">
                        </div>
                        <label>Charges Option 3</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="chargethree" name="chargethree" value="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1"
                            data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Edit Reference treatment form Modal -->
    <div class="modal fade text-left" id="reftreatedit" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Reference Treatment</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="editreftreatForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="Ereftreatid" id="Ereftreatid">
                        <label>Reference Treatment</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Eref_treatments" name="Eref_treatments">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1"
                            data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
                    title: 'RefrenceTreatment-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                    'targets': [2], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            });

            // to delete patient data from patient list 
            $(document).on("click", ".deletereftreat", function(){ 
                var reftreatid = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Reference Treatment\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);    
                        $.ajax({
                            url: "{{ route('deletereftreatdata') }}",
                            type: "DELETE",
                            data: {"reftreatid": reftreatid, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/ref_treatments') }}";
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

             //to submit add reftreatment
            $("#addreftreatForm").submit(function(e){
                var $this = $(this);
                var formData = new FormData(this);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addreftreatment') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false, 
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
                                window.location.href = "{{ url('/ref_treatments') }}";
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
                
                e.preventDefault();
            });

            // get data of edit reftreatment data
            $(document).on("click", ".edit_visit", function(){    
                var reftreatid = $(this).data('id');
                $("#overlay").fadeIn(300);    
                console.log(reftreatid);
                $.ajax({
                    url: "{{ route('getreftreatmentdata') }}",
                    type: "GET",
                    data: {"reftreatid": reftreatid, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                        $("#overlay").fadeOut(300);
                        $("#Ereftreatid").val(response.data.id);
                        $("#Eref_treatments").val(response.data.name);
                    }
                });
            });

            // To Update reftreatment data
            $("form#editreftreatForm").submit(function(e){
                var $this = $(this);
                var formData = $this.serializeArray();

                $.ajax({
                    url: "{{ route('updatereftreatment') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json", 
                    success: function(response) {
                        if(response.result)
                        {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                timer: 2000,
                                button:"OK",
                                showConfirmButton:true
                            }).then(function() {
                                window.location.href = "{{ url('/ref_treatments').'/'.Request::segment(2)  }}";
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
                
                e.preventDefault();
            });

            //Disable popup on click out side to page

            $('#addreftreatModal, #reftreatedit').modal({
                backdrop: 'static',
                keyboard: false
            });
           
        });
    </script>
@endsection