@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Edit</h3>
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

	    <!-- // Basic multiple Column Form section start -->
		<section id="multiple-column-form">
	        <div class="row match-height">
	            <div class="col-12">
	                <div class="card">
	                    <div class="card-header">
	                        <h4 class="card-title"></h4>
	                    </div>
	                    <div class="card-content">
	                        <div class="card-body">
	                            <form class="form">
                        		 @csrf
	                                <div class="row">
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Date Created</label>
	                                            <input type="text" id="patient_name" class="form-control"
	                                                placeholder="" name="patient_name" value="{{$doctorDetails->created_at}}" disabled>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Patient Name</label>
	                                            <input type="text" id="patient_name" class="form-control"
	                                                placeholder="" name="patient_name" value="{{$doctorDetails->patient_name}}" disabled>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Lab Name</label>
	                                            <select  id="lab_name" class="form-control" name="lab_name" disabled>
													<option value="">Select Lab Name</option>
													@foreach($Lab as $lab)
													<option value="{{$lab->id}}">{{$lab->lab_name}}</option>
													@endforeach
												</select>
	                                        </div>
	                                    </div>
	                                   
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Type of Work</label>
	                                            <input type="text" id="tow" class="form-select" placeholder=" " name="tow" value="{{$doctorDetails->type_of_work}}" disabled>
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Expected Date of Delivery</label>
	                                            <input type="text" id="exp_date"  class="form-control dateofbirth" placeholder="" name="exp_date" value="{{$doctorDetails->excepted_date_of_deliver}}" disabled>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">To be Given</label>
												<select class="form-select" id="to_be_given" class="form-control" name="to_be_given">
													<option  class="text-red"value="0">Not Given</option>
													<option  class="text-green"value="1">Given</option>
												</select>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Given</label>
												<select class="form-select" id="given" class="form-control" name="given">
													<option class="text-red" value="0">Not Given</option>
													<option class="text-green" value="1">Given</option>
												</select>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Given On</label>
	                                            <input type="text" id="given_on" class="form-control dateofbirth" placeholder="" name="given_on" value="{{$doctorDetails->given_On}}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Received</label>
												<select class="form-select" id="Received" class="form-control" name="Received">
													<option class="text-red" value="0">Not Received</option>
													<option class="text-green" value="1">Received</option>
												</select>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Given appointment</label>
												<select class="form-select" id="given_appoint" class="form-control" name="given_appoint">
													<option class="text-red" value="0">No</option>
													<option  class="text-green"value="1">Yes</option>
												</select>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Checked</label>
												<select class="form-select" id="Checked" class="form-control" name="Checked">
													<option class="text-red" value="0">UnChecked</option>
													<option class="text-green" value="1">Checked</option>
												</select>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Redo/Repeat</label>
												<select class="form-select" id="redo_repeat" class="form-control" name="redo_repeat">
													<option  class="text-red" value="0">No</option>
													<option  class="text-green" value="1">Yes</option>
												</select>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Deliver to The Person</label>
												<select class="form-select" id="deliver" class="form-control" name="deliver">
													<option class="text-red" value="0">No</option>
													<option class="text-green" value="1">Yes</option>
												</select>
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Received Date</label>
	                                            <input type="text" id="receivedDate" class="form-control dateofbirth" placeholder="" name="receivedDate" value="{{$doctorDetails->receivedDate}}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Status</label>
												<select class="form-select" id="status" class="form-select" name="status">
													<option class="text-red" value="4">In Process</option>
													<option class="text-green" value="1">Completed</option>
													<option class="text-green" value="2">To be Paid</option>
													<option class="text-green" value="3">Paid</option>
												</select>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12" id="lab_bill_input">
	                                        <div class="form-group">
	                                            <label for="city-column">Lab Bill</label>
	                                            <input type="number" id="lab_bill" style="color: {{ ($doctorDetails->lab_bill == '0') ? 'red' : '#00cc00' }}" class="form-control" placeholder="" name="lab_bill" value="{{$doctorDetails->lab_bill}}">
	                                        </div>
	                                    </div>
	                                    <!-- <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Payment</label>
	                                            <input type="text" id="payment" style="color: {{ ($doctorDetails->payment == 'Not Received') ? 'red' : 'green' }}" class="form-control" placeholder="" name="payment" value="{{$doctorDetails->payment}}">
	                                        </div>
	                                    </div> -->
	                                    <div class="col-12 d-flex justify-content-end">
											<button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
	                                        <a href="{{ url()->previous() }}"class="btn btn-light-secondary me-1 mb-1">Close</a>
											<a href="{{ url('labenotedit'."/".$doctorDetails->id) }}" class="btn btn-info me-1 mb-1">Edit</a>
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    <!-- // Basic multiple Column Form section end -->
	</div>

	
@endsection

@section('jsscript')
    <script>
		$(document).ready(function() {

			const givenOnInput = document.getElementById("given_on");

			givenOnInput.value = (givenOnInput.value == "") ? "Not Given" : givenOnInput.value;

			const receivedDate = document.getElementById("receivedDate");

			receivedDate.value = (receivedDate.value == "") ? "Not Given" : receivedDate.value;

		    $("form").submit(function(e){
		    	var $this = $(this);
		    	var formData = $this.serializeArray();
		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ url('/updateReceptionist',[$doctorDetails->id]) }}",
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
	                            window.location.href = "{{ url()->previous() }}";
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

			$(function(){
                $(".dateofbirth").datepicker({ 
                    dateFormat: 'dd-M-yy',
                    changeYear: true,
                    changeMonth: true,
                    yearRange: "c-150:c+150"
                });
            });

			 // Check if 'show_field' is true and 'checked' is equal to 1
			 var showField = '{{ request()->query('show_field') }}';
				var isChecked = '{{ request()->query('checked') }}';

				if (showField == 'true' && isChecked == '1') {
					// Show the field
					$('#lab_bill_input').show();
				} else {
					// Hide the field
					$('#lab_bill_input').hide();
				}
				

				$("#lab_name").val("{{ $doctorDetails->lab_name }}"); 
				$("#to_be_given").val("{{ $doctorDetails->to_be_given }}"); 
				$("#given").val("{{ $doctorDetails->given }}"); 
				$("#Received").val("{{ $doctorDetails->received }}"); 
				$("#given_appoint").val("{{ $doctorDetails->given_appointment }}"); 
				$("#Checked").val("{{ $doctorDetails->checked }}"); 
				$("#redo_repeat").val("{{ $doctorDetails->redo_repeat }}"); 
				$("#deliver").val("{{ $doctorDetails->deliver_to_person }}"); 
				$("#status").val("{{ $doctorDetails->status }}"); 
				$("#lab_name").trigger("refresh");
				$("#to_be_given").trigger("refresh");
				$("#given").trigger("refresh");
				$("#Received").trigger("refresh");
				$("#given_appoint").trigger("refresh");
				$("#Checked").trigger("refresh");
				$("#redo_repeat").trigger("refresh");
				$("#deliver").trigger("refresh");
				$("#status").trigger("refresh");

		});      
    </script>
@endsection