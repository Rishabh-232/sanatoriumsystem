@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('assets/css/pages/choices.css') }}">

	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row page-title-row">
	            <div class="col-md-6 page-title-left">
	                <h3>Edit Patient</h3>
	            </div>
	            <div class="col-md-6 page-title-right">
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
	                                                placeholder="" name="full_name" value="{{ $patientDetails->name }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="last-name-column">Date Of Birth</label>
	                                            <input type="text" id="dob" class="form-control dateofbirth"
	                                                placeholder="" name="dob" value="{{ date('d-M-Y', strtotime($patientDetails->date_of_birth)) }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Age</label>
	                                            <input type="text" id="age" class="form-control" placeholder="" name="age" value="{{ $patientDetails->age }}">
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
	                                            <input type="text" id="address" class="form-control" placeholder="" name="address" value="{{ $patientDetails->address }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Primary Number</label>
	                                            <input type="text" id="contact_number1" class="form-control" maxlength="13" placeholder="" name="contact_number1" value="{{ $patientDetails->contact_1 }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Contact Number 2</label>
	                                            <input type="text" id="contact_number2" class="form-control" maxlength="13" placeholder="" name="contact_number2" value="{{ $patientDetails->contact_2 }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="email-id-column">Email ID</label>
	                                            <input type="email" id="email_id" class="form-control"
	                                                name="email_id" placeholder="" value="{{ $patientDetails->email }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Drug Allergies</label>
	                                            <input type="text" id="drug_allergies" class="form-control" placeholder="" name="drug_allergies" value="{{ $patientDetails->drug_allergy }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Attended By</label>
	                                            <input type="text" id="attended_by" class="form-control" placeholder="" name="attended_by" value="{{ $patientDetails->attended_by }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Past Medical History</label>
	                                            <input type="text" id="past_medical_history" class="form-control" placeholder="" name="past_medical_history" value="{{ $patientDetails->past_medical_history }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Anniversary</label>
												<input type="text" id="anniversary" class="form-control dateofbirth" placeholder="" name="anniversary" value="{{ $patientDetails->anniversary ? date('d-M-Y', strtotime($patientDetails->anniversary)) : '' }}">
	                                        </div>
	                                    </div><!-- 
										<div class="col-md-6 col-12 dr-fee">
	                                        <div class="form-group">
	                                            <label for="city-column">Fees</label>
	                                            <div class="checkbox-holder">
													<input type="checkbox" id="consultation-fee" class="checkbox-value"  value="500">
													<label for="consultation-fee">Consultation fee</label>
												</div>
												<div class="checkbox-holder">
													<input type="checkbox" id="x-ray" class="checkbox-value"  value="500">
													<label for="x-ray">X-ray</label>
												</div>
												<div class="checkbox-holder">
													<input type="checkbox" id="root-canal" class="checkbox-value"  value="500">
													<label for="root-canal">Root canal</label>
												</div>
	                                        </div>
	                                    </div> -->
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
	                                            <label for="insurance">Consent Form</label>
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
	                                            <input type="text" id="chiefcomplaint" class="form-control" placeholder="" name="chiefcomplaint" value="{{ $patientDetails->chiefcomplaint }}">
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Past Dental History</label>
	                                            <input type="text" id="pastdental" class="form-control" placeholder="" name="pastdental" value="{{ $patientDetails->pastdental }}">
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Investigations </label>
												<select id="investigation" class="form-select" placeholder="" name="investigation">
													<option value="">Select Investigations</option>
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
													<option value="None" {{ in_array('None', $TOWIds) ? 'selected' : '' }}>None</option>
													<option value="CBC" {{ in_array('CBC', $TOWIds) ? 'selected' : '' }}>CBC</option>
													<option value="BT/CT" {{ in_array('BT/CT', $TOWIds) ? 'selected' : '' }}>BT/CT</option>
													<option value="Rapid HIV" {{ in_array('Rapid HIV', $TOWIds) ? 'selected' : '' }}>Rapid HIV</option>
													<option value="CB/CT" {{ in_array('CB/CT', $TOWIds) ? 'selected' : '' }}>CB/CT</option>
													<option value="RBS" {{ in_array('RBS', $TOWIds) ? 'selected' : '' }}>RBS</option>
													<option value="PT/INR" {{ in_array('PT/INR', $TOWIds) ? 'selected' : '' }}>PT/INR</option>
												</select>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
											<div class="form-group">
												<label for="city-column">Upload Patient Image (Max 5MB)</label>
												<input class="form-control" type="file" id="image_file" accept="image/*" name="image_file[]"  multiple>
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
		    		url: "{{ route('updatePatient',[$patientDetails->id]) }}",
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
	                            window.location.href = "{{ url('/patientview',[$patientDetails->id]) }}";
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

				$("#gender").val("{{ $patientDetails->sex }}"); 
				// $("#gender").selectpicker("refresh");
				$("#insurance").val("{{ $patientDetails->patient_insurance }}");
				$("#consent_form").val("{{ $patientDetails->consent_form }}");
            
			//
			let $total = 0;
			$('.checkbox-value').on('change', function() {
				if (this.checked)
					$total += +this.value;
				else
					$total -= +this.value;
				$('#total_amount').val($total).change();
				console.log($total);
			});

			$('#investigation').val('{{$patientDetails->investigation}}');
			$('#bloodinvestigation').val('{{$patientDetails->bloodinvestigation}}');
			$('#investigation').trigger('change');
			$('#investigation').trigger('change');
		});      
    </script>
@endsection