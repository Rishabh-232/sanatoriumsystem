@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Inventory</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reference Treatments</li>
                        </ol>
                    </nav> -->
                    <a data-bs-toggle="modal" data-bs-target="#addreftreatModal" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add Inventory</button></a>
                    <!-- <a data-bs-toggle="modal" data-bs-target="#addconsultationModal" class="new-button"><button type="button" class="btn btn-outline-primary float-end" style="margin-right: 5px;">Add Consultation</button></a> -->
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
                                <th>Sr. No.</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php $i = 1; ?>
                            @foreach($inventoryList as $invelist)
	                            <tr>
		                            <td>{{ $i++; }}</td>
		                            <td>@if($invelist->date == '')
                                        @else
                                        {{ date('d-M-Y', strtotime($invelist->date)) }}
                                        @endif
                                    </td>
		                            <td>{{ $invelist->name }}</td>
		                            <td>{{ $invelist->payment }}</td>
		                            <td>@if($invelist->reference == 'Inventory')
                                            <span class="badge bg-success">Inventory</span>
                                        @else
                                            <span class="badge bg-info">Consultation</span>                        
                                        @endif
                                    </td>
		                            <td class="button-holder">
		                            	@if($invelist->reference == 'Inventory')
											<a href="#" class="btn btn-outline-warning edit_inventory" data-bs-toggle="modal" data-bs-target="#inventoryedit" data-id="{{ $invelist->id }}">Edit</a>
										@elseif($invelist->reference == 'Consultation')
										    <a href="#" class="btn btn-outline-warning edit_consultation" data-bs-toggle="modal" data-bs-target="#consultationedit" data-id="{{ $invelist->id }}">Edit</a>
										@endif                                        
                                        <a id="deleteperson" class="btn btn-outline-danger deleterinventor" data-id="{{ $invelist->id }}">Delete</a>
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
                    <h4 class="modal-title" id="myModalLabel33">Add Inventory</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="addinventory">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="reference" id="reference" value="Inventory">
                        <label>Dealer Name</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" id="dealer_name" name="dealer_name">
                        </div>
                        <label>Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control onlynumbers" id="amount" name="amount">
                        </div>
                        <label>Paid Date</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control paiddate" id="paid_date" name="paid_date">
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

    <!--Add Consultation form Modal -->
    <div class="modal fade text-left" id="addconsultationModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Consultation</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="addconsultation">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="reference" id="reference" value="Consultation">
                        <label>Doctor Name</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" id="doctor_name" name="doctor_name">
                        </div>
                        <label>Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" id="amount" name="amount" onlynumbers>
                        </div>
                        <label>Date</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control paiddate" id="consultationdate" name="consultationdate">
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
    <div class="modal fade text-left" id="inventoryedit" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Inventory</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="editinventoryForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="Inventoryid" id="Inventoryid">
                        <label>Dealer Name</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" id="editdealer_name" name="editdealer_name">
                        </div>
                        <label>Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control onlynumbers" id="editamount" name="editamount">
                        </div>
                        <label>Paid Date</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control paiddate" id="editpaid_date" name="editpaid_date">
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
    <div class="modal fade text-left" id="consultationedit" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Consultation</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="editconsultationForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="Consultationid" id="Consultationid">
                        <label>Doctor Name</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" id="consdoctor_name" name="consdoctor_name">
                        </div>
                        <label>Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" id="consamount" name="consamount">
                        </div>
                        <label>Date</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control paiddate" id="consconsultationdate" name="consconsultationdate">
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
                    extend: 'csv',
                    title: 'Partition-List'
                } ],
                'order': false,
                'bInfo': false, //Left side Info entries Hide
                'bPaginate': false, // Pagination Hide
                'columnDefs': [ {
                    'targets': [2], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            });

            // to delete inventor data from inventor list 
            $(document).on("click", ".deleterinventor", function(){ 
                var reftreatid = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Inventory\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);    
                        $.ajax({
                            url: "{{ route('deleteinventordata') }}",
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
                                        window.location.reload();
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

             //to submit add inventory
            $("#addinventory").submit(function(e){
                var $this = $(this);
                var formData = new FormData(this);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addInventory') }}",
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
                                window.location.reload();
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

             //to submit add consultation
            $("#addconsultation").submit(function(e){
                var $this = $(this);
                var formData = new FormData(this);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addConsultation') }}",
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
                                window.location.reload();
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

            // get data of edit inventory data
            $(document).on("click", ".edit_inventory", function(){    
                var reftreatid = $(this).data('id');
                $("#overlay").fadeIn(300);    
                // console.log(reftreatid);
                $.ajax({
                    url: "{{ route('getinventorydata') }}",
                    type: "GET",
                    data: {"reftreatid": reftreatid, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                        $("#overlay").fadeOut(300);
                        $("#Inventoryid").val(response.data.id);
                        $("#editdealer_name").val(response.data.name);
                        $("#editamount").val(response.data.payment);
                        $("#editpaid_date").val(response.data.date);
                    }
                });
            });

            // get data of edit consultation data
            $(document).on("click", ".edit_consultation", function(){    
                var reftreatid = $(this).data('id');
                $("#overlay").fadeIn(300);    
                // console.log(reftreatid);
                $.ajax({
                    url: "{{ route('getconsultationdata') }}",
                    type: "GET",
                    data: {"reftreatid": reftreatid, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                        $("#overlay").fadeOut(300);
                        $("#Consultationid").val(response.data.id);
                        $("#consdoctor_name").val(response.data.name);
                        $("#consamount").val(response.data.payment);
                        $("#consconsultationdate").val(response.data.date);
                    }
                });
            });

            // To Update inventory data
            $("form#editinventoryForm").submit(function(e){
                var $this = $(this);
                var formData = $this.serializeArray();

                $.ajax({
                    url: "{{ route('updateinventory') }}",
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
                                window.location.reload();
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

            // To Update Consultation data
            $("form#editconsultationForm").submit(function(e){
                var $this = $(this);
                var formData = $this.serializeArray();

                $.ajax({
                    url: "{{ route('updateconsultation') }}",
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
                                window.location.reload();
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

            $(function(){
    			$(".paiddate").datepicker({ 
    				dateFormat: 'dd-M-yy',
    				changeYear: true,
    				changeMonth: true,
					yearRange: "c-150:c+150"
    			});
			});
           
        });
    </script>
@endsection