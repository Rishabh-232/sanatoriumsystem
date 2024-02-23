@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Add Insurance</h3>
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
	                            <form class="form" enctype="multipart/form-data">
                        		 @csrf
	                                <div class="row">
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Name of Insurance</label>
	                                            <input type="text" id="claim_name" class="form-control"
	                                                placeholder="" name="claim_name" required>
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
											<div class="form-group">
												<label for="city-column">Type of Insurance</label>
	                                            <input type="text" id="type_of_claim" class="form-control"
	                                                placeholder="" name="type_of_claim">
											</div>
										</div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Patient Name</label>
												<select name="patient_name" id="patient_name" class="form-select">
													@foreach($patientList as $patient)
														<option value="{{ $patient->name }}">{{ $patient->name }}</option>
													@endforeach
												</select>
	                                            <!-- <input type="text" id="patient_name" class="form-control" placeholder="" name="patient_name" value="{{ $patient->name }}"> -->
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                    	<div class="form-group">
	                                            <label for="gender">What Diseases</label>
	                                            <input type="text" id="diseases" class="form-control" placeholder="" name="diseases">
			                                </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Name of Doctor</label>
	                                            <input type="text" id="doctor_name" class="form-control" placeholder="" name="doctor_name">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Name of Hospital</label>
	                                            <input type="text" id="hospital_name" class="form-control" placeholder="" name="hospital_name">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="last-name-column">Admitted Date</label>
	                                            <input type="text" id="admitted_date" class="form-control dateofbirth"
	                                                placeholder="" name="admitted_date" value ="">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="last-name-column">Discharged Date</label>
	                                            <input type="text" id="discharged_date" class="form-control dateofbirth"
	                                                placeholder="" name="discharged_date" value ="">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Hospital Bills</label>
	                                            <input type="text" id="hospital_bills" class="form-control onlynumbers" maxlength="13" placeholder="" name="hospital_bills">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Lab Bills</label>
	                                            <input type="text" id="lab_bills" class="form-control onlynumbers" maxlength="13" placeholder="" name="lab_bills">
	                                        </div>
	                                    </div>
	                                    <!-- <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Reports of treatment</label>
	                                            <input type="text" id="reports_of_treatment" class="form-control" maxlength="13" placeholder="" name="reports_of_treatment">
	                                        </div>
	                                    </div> -->
										<div class="col-md-6 col-12">
											<div class="form-group">
												<label for="city-column">Reports of treatment (Max 5MB)</label>
												<input class="form-control" type="file" id="image_file" name="image_file[]" accept="image/*" multiple >
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
 
    <script>
		$(document).ready(function() {

		    $("form").submit(function(e){

		    	var formData = new FormData(this);

		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ route('addClaim') }}",
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
                                window.location.href = "{{ url('/claimview') }}/"+response.id;
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
    			$(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
			});
		});      
    </script>
@endsection

