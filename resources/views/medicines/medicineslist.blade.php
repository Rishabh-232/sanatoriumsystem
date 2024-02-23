@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="page-title mb-3">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Medicines</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Medicines</li>
                        </ol>
                    </nav> -->
                </div>
            </div>
        </div>
        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="buttons text-center card-head-btn-holder">
                        <a href="#" class="btn btn-outline-info mb-0" data-bs-toggle="modal"
                        data-bs-target="#addmedicineModal">
                        Add Medicine
                        </a><a href="{{url('/medicategoryhome')}}" class="btn btn-outline-primary mb-0">
                        Medicine Categories Home
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th class="table-min-width-small">Sr. No.</th>
                                <th>Name</th>
                                <th>Medicine Category</th>
                                <th>Number Of Times</th>
                                <th>Before/After</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($medicine as $medi)
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td>{{ $medi->name }}</td>
                                    <td>{{ $medi->medicatename }}</td>
                                    <td>{{ $medi->number_of_times }}</td>
                                    <td>{{ $medi->before_after }}</td>
                                    <td class="button-holder">
                                        <a href="#" class="btn btn-outline-warning edit_visit"data-bs-toggle="modal" data-bs-target="#editmedicineModal" data-id="{{ $medi->id }}">Edit</a>
                                        <a id="deleteperson" class="btn btn-outline-danger deletemedicine" data-id="{{$medi->id}}">Delete</a>
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

    <!--Add medicine form Modal -->
    <div class="modal fade text-left" id="addmedicineModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Medicine</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="addmedicineForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="medi" id="medi">
                        <label>Name Of Medicine</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="name_medicine" name="name_medicine">
                        </div>
                        <label>Category</label>
                        <div class="form-group">
                            <select class="form-control" id="category" name="category">
                                @foreach($medicate as $medi)
                                    <option value="{{ $medi->id }}">{{ $medi->name }}</option>
                                @endforeach
                            </select>
                        </div>
                       <label>Number Of Times</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" class="select-checkbox hidecheck" id="morningCheckbox" name="morningCheckbox">
                                        <label class="form-check-label" for="morningCheckbox">M</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" class="select-checkbox hidecheck" id="afternoonCheckbox" name="afternoonCheckbox">
                                        <label class="form-check-label" for="afternoonCheckbox">A</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" class="select-checkbox hidecheck" id="eveningCheckbox" name="eveningCheckbox">
                                        <label class="form-check-label" for="eveningCheckbox">N</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="checkbox" class="select-checkbox hidecheck" id="sosCheckbox" name="sosCheckbox">
                                        <label class="form-check-label" for="sosCheckbox">SOS</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label>Before/After</label>
                        <div class="form-group">
                            <select class="form-control" id="berforeafter" name="berforeafter">
                                <option value="After Meal">After Meal</option>
                                <option value="Before Meal">Before Meal</option>
                            </select>
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
    <div class="modal fade text-left" id="editmedicineModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Medicine</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="editmedicineForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="Emedi" id="Emedi">
                        <label>Name Of Medicine</label>
                        <div class="form-group">
                            <input type="text" placeholder="" class="form-control" id="Ename_medicine" name="Ename_medicine">
                        </div>
                        <label>Category</label>
                        <div class="form-group">
                            <select class="form-control" id="Ecategory" name="Ecategory">
                                @foreach($medicate as $medi)
                                <option value="{{ $medi->id }}">{{ $medi->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label>Number Of Times</label>
                        <div class="form-group row">
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="select-checkbox Ehidecheck" id="EmorningCheckbox" name="EmorningCheckbox">
                                    <label class="form-check-label" for="EmorningCheckbox">M</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="select-checkbox Ehidecheck" id="EafternoonCheckbox" name="EafternoonCheckbox">
                                    <label class="form-check-label" for="EafternoonCheckbox">A</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="select-checkbox Ehidecheck" id="EeveningCheckbox" name="EeveningCheckbox">
                                    <label class="form-check-label" for="EeveningCheckbox">N</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="select-checkbox Ehidecheck" id="EsosCheckbox" name="EsosCheckbox">
                                    <label class="form-check-label" for="EsosCheckbox">SOS</label>
                                </div>
                            </div>
                        </div>
                        <label>Before/After</label>
                        <div class="form-group">
                            <select class="form-control" id="Eberforeafter" name="Eberforeafter">
                                <option value="After Meal">After Meal</option>
                                <option value="Before Meal">Before Meal</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
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
                    title: 'Medicines-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                    'targets': [4], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            });


            // to delete medicine data from list 
            $(document).on("click", ".deletemedicine", function(){ 
                var medi = $(this).data('id');

                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Medicine\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);    
                        $.ajax({
                            url: "{{ route('deletemedicinesdata') }}",
                            type: "DELETE",
                            data: {"medi": medi, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/medicines') }}";
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

             //to submit add medicines
            $("form#addmedicineForm").submit(function(e){
                var $this = $(this);
                var formData = new FormData(this);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addmedicines') }}",
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
                                window.location.href = "{{ url('/medicines') }}";
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

            

            // get data of edit medicines data
            $(document).on("click", ".edit_visit", function(){    
                var medi = $(this).data('id');    
                console.log(medi);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ route('getmedicinesdata') }}",
                    type: "GET",
                    data: {"medi": medi, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                        $("#overlay").fadeOut(300);
                        $("#Emedi").val(response.data.id);
                        $("#Ename_medicine").val(response.data.name);
                        $("#Ecategory").val(response.data.medicine_category_id);

                        // Handling "Number Of Times" checkboxes
                        var selectedTimes = response.data.number_of_times.split(', ');

                        $("#EmorningCheckbox").prop('checked', selectedTimes.includes('M'));
                        $("#EafternoonCheckbox").prop('checked', selectedTimes.includes('A'));
                        $("#EeveningCheckbox").prop('checked', selectedTimes.includes('E'));
                        $("#EsosCheckbox").prop('checked', selectedTimes.includes('SOS'));

                        $("#Eberforeafter").val(response.data.before_after);
                    }
                });
            });

            // To Update medicines data
            $("form#editmedicineForm").submit(function(e){
                var $this = $(this);
                var formData = $this.serializeArray();
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ route('updatemedicines') }}",
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
                                window.location.href = "{{ url('/medicines') }}";
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

            $('#addmedicineModal, #addmedicategoryModal, #editmedicineModal').modal({
                backdrop: 'static',
                keyboard: false
            });
           
        });
    </script>
    <!-- <script>
        $(document).ready(function() {
            function handleCheckboxChange(checkbox, checkboxClass, beforeAfterID) {
                checkbox.change(function() {
                    if (this.checked) {
                        $(`.${checkboxClass}`).not(this).prop('disabled', true);
                        $(`#${beforeAfterID}`).not(this).prop('disabled', true);
                    } else {
                        $(`.${checkboxClass}`).not(this).prop('disabled', false);
                        $(`#${beforeAfterID}`).not(this).prop('disabled', false);
                    }
                });

                if (checkbox.is(':checked')) {
                    $(`.${checkboxClass}`).not(checkbox).prop('disabled', true);
                }
            }

            handleCheckboxChange($('#sosCheckbox'), 'hidecheck', 'berforeafter');
            handleCheckboxChange($('#EsosCheckbox'), 'Ehidecheck', 'Eberforeafter');
        });
    </script> -->

@endsection