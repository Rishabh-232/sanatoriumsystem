@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('assets/css/pages/choices.css') }}">

	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Add Patient</h3>
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
	                                            <label for="first-name-column">Full Name</label>
	                                            <input type="text" id="full_name" class="form-control"
	                                                placeholder="" name="full_name" required>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="last-name-column">Date Of Birth</label>
	                                            <input type="text" id="dob" class="form-control date dateofbirth"
	                                                placeholder="" name="dob" value ="">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Age</label>
	                                            <input type="text" id="age" class="form-control" placeholder="" name="age" >
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                    	<div class="form-group">
	                                            <label for="gender">Gender</label>
			                                    <fieldset class="form-group">
			                                        <select class="form-select" id="gender" name="gender">
			                                            <option value="1">Male</option>
			                                            <option value="2">Female</option>
			                                        </select>
			                                    </fieldset>
			                                </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Address</label>
	                                            <input type="text" id="address" class="form-control" placeholder="" name="address">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Primary Number</label>
	                                            <input type="text" id="contact_number1" class="form-control onlynumbers" maxlength="13" placeholder="" name="contact_number1">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Contact Number 2</label>
	                                            <input type="text" id="contact_number2" class="form-control onlynumbers" maxlength="13" placeholder="" name="contact_number2">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="email-id-column">Email ID</label>
	                                            <input type="email" id="email_id" class="form-control"
	                                                name="email_id" placeholder="" >
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Drug Allergies</label>
	                                            <input type="text" id="drug_allergies" class="form-control" placeholder="" name="drug_allergies">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Attended By</label>
	                                            <input type="text" id="attended_by" class="form-control" placeholder="" name="attended_by">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Past Medical History</label>
	                                            <input type="text" id="past_medical_history" class="form-control" placeholder="" name="past_medical_history">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Anniversary</label>
	                                            <input type="text" id="anniversary" class="form-control onlynumbers date" placeholder="" name="anniversary">
	                                        </div>
	                                    </div>

										<div class="col-md-6 col-12">
	                                    	<div class="form-group">
	                                            <label for="insurance">Insurance</label>
			                                    <fieldset class="form-group">
			                                        <select class="form-select" id="insurance" name="insurance">
			                                            <option value="Yes">Yes</option>
			                                            <option value="No">No</option>
			                                        </select>
			                                    </fieldset>
			                                </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                    	<div class="form-group">
	                                            <label for="consent_form">Consent Form</label>
			                                    <fieldset class="form-group">
			                                        <select class="form-select" id="consent_form" name="consent_form">
			                                            <option value="No">No</option>
			                                            <option value="Yes">Yes</option>
			                                        </select>
			                                    </fieldset>
			                                </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Chief Complaint</label>
	                                            <input type="text" id="chiefcomplaint" class="form-control" placeholder="" name="chiefcomplaint">
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Past Dental History</label>
	                                            <input type="text" id="pastdental" class="form-control" placeholder="" name="pastdental">
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Investigations </label>
												<select id="investigation" class="form-select" placeholder="" name="investigation">
													<option value="" selected>Select Investigations</option>
													<option value="Iopa/xray">Iopa/xray</option>
													<option value="CBCT">CBCT</option>
													<option value="OPG">OPG</option>
													<option value="Any other">Any other</option>
												</select>
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Blood investigations </label>
												<select id="bloodinvestigation" class="js-example-basic-multiple form-select" placeholder="" name="bloodinvestigation[]" multiple="multiple">
													<option value="None">None</option>
													<option value="CBC">CBC</option>
													<option value="BT/CT">BT/CT</option>
													<option value="Rapid HIV">Rapid HIV</option>
													<option value="CB/CT">CB/CT</option>
													<option value="RBS">RBS</option>
													<option value="PT/INR">PT/INR</option>
												</select>
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
											<div class="form-group">
												<label for="city-column">Upload Patient Image (Max 5MB)</label>
												<input class="form-control" type="file" id="image_file" accept="image/*" name="image_file[]"  multiple >
											</div>
										</div>
	                                    <div class="col-12 d-flex justify-content-end">
	                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
	                                        <a href="{{ url()->previous() }}"class="btn btn-light-secondary me-1 mb-1">Close</a>
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
	<div class="content" id="emailpopup">
        <div id="overlay">
            <div class="cv-spinner">
              <span class="spinner"></span>
            </div>
        </div>
    </div>
@endsection

@section('jsscript')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
		$(document).ready(function() {
            $('.js-example-basic-multiple').select2();

		    $("form").submit(function(e){
				
				var formData = new FormData(this);

		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ route('addPatient') }}",
		    		type: "POST",
		    		data: formData,
		    		processData: false,
            		contentType: false,  
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
                                window.location.href = "{{ url('/patientview') }}/"+response.id;
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
    			$(".date").datepicker({ 
    				dateFormat: 'dd-M-yy',
    				changeYear: true,
    				changeMonth: true,
    				yearRange: "c-150:c+150"
    			});
    			// $(".date").val($.datepicker.formatDate('dd-M-yy', new Date()));
			});

			$(function() {
				$(".dateofbirth").datepicker({
					dateFormat: 'dd-M-yy',
					changeYear: true,
					changeMonth: true,
					yearRange: "c-150:c+150"
				});

				// Add an event listener to the date picker input field
				$(".dateofbirth").on('change', function() {
					// Get the selected date
					var selectedDate = new Date($(".dateofbirth").datepicker("getDate"));

					// Calculate age based on the current date
					var currentDate = new Date();
					var age = currentDate.getFullYear() - selectedDate.getFullYear();

					// Check if the birthday has occurred this year
					if (currentDate.getMonth() < selectedDate.getMonth() || (currentDate.getMonth() === selectedDate.getMonth() && currentDate.getDate() < selectedDate.getDate())) {
						age--;
					}

					// Store the age in a variable
					var ageValue = age;

					// You can use the 'ageValue' variable as needed
					console.log('Age:', ageValue);
					$('#age').val(ageValue);
				});

				// Set the default date in the date picker
				$(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
			});

		});      
    </script>
@endsection