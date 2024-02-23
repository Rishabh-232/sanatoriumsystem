@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Medicines Category Home</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <div style="display:flex; justify-content:right;">
                    <a href="{{ url('/medicines') }}" class="btn btn-primary mb-0 ">
                    Back
                    </a>
                    &nbsp;
                    <a href="#" class="btn btn-outline-success mb-0" data-bs-toggle="modal"
                    data-bs-target="#addmedicategoryModal">
                    Add Medicine Category
                    </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body table-responsive asd">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($medicatehome as $Mcatehome)
                                <tr>
                                    <td>{{ $i++; }}</td>
                                    <td>{{ $Mcatehome->name }}</td>
                                    <td class="button-holder">
                                        <a href="{{ url('medicineCategoryedit'."/".$Mcatehome->id) }}"  data-id="{{ $Mcatehome->id }}" data-bs-toggle="modal"  data-bs-target="#editmedicategoryModal" class="btn btn-outline-warning edit_Mcategory">Edit</a>
                                        <a id="deleteperson" class="btn btn-outline-danger Mcatehomedelete" data-id="{{$Mcatehome->id}}">Delete</a>
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
     <!-- add medicine category form model -->
     <div class="modal fade text-left" id="addmedicategoryModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Medicine Category</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="addmedicategoryForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="medi" id="medi">
                        <label>Name</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="addmedicinecategory" name="addmedicinecategory">
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
     <!-- add medicine category form model -->
     <div class="modal fade text-left" id="editmedicategoryModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Medicine Category</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="editmedicategoryForm">
                    @csrf
                    <div class="modal-body">
                        <label>Name</label>
                        <div class="form-group">
                        <input type="hidden" name="Emedi" id="Emedi">
                            <input type="text" placeholder=""
                                class="form-control" id="editmedicinecategory" name="editmedicinecategory">
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
                'lengthChange': false,
                'searching'   : true, // Pagination Hide
                'order': [[0, 'asc']],
                'columnDefs': [ {
                    'targets': [2], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            });  
            
            //to submit add medicines category
            $("form#addmedicategoryForm").submit(function(e){
                var $this = $(this);
                var formData = new FormData(this);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addmedicinescategory') }}",
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
                                window.location.href = "{{ url('/medicategoryhome') }}";
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

            // to delete TOWlist data from TOWlist list 
            $(document).on("click", ".Mcatehomedelete", function(){ 
                var Mcategory = $(this).data('id');
                $("#overlay").fadeIn(300);    
                $.ajax({
                    url: "{{ url('/deleteMedicineCategorydata') }}",
                    type: "DELETE",
                    data: {"Mcategory": Mcategory, "_token": $("input[name='_token']").val()},
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
                                window.location.href = "{{ url('/medicategoryhome') }}";
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

            // get data of edit medicines data
            $(document).on("click", ".edit_Mcategory", function(){    
                var medi = $(this).data('id');    
                console.log(medi);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('/getmedicinesCategorydata') }}",
                    type: "GET",
                    data: {"medi": medi, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                        $("#overlay").fadeOut(300);
                        $("#Emedi").val(response.data.id);
                        $("#editmedicinecategory").val(response.data.name);
                    }
                });
            });

             // To Update medicines data
             $("form#editmedicategoryForm").submit(function(e){
                var $this = $(this);
                var formData = $this.serializeArray();
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('/updatemedicinesCategory') }}",
                    type: "POST",
                    data: formData,
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
                                window.location.href = "{{ url('/medicategoryhome') }}";
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
        });
    </script>
@endsection