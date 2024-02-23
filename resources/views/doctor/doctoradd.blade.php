@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Add Doctor</h3>
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
	                                            <label for="first-name-column">Name of the Doctor</label>
	                                            <input type="text" id="doctor_name" class="form-control onlynumbers"
	                                                placeholder="" name="doctor_name" required>
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
											<div class="form-group">
												<label for="city-column">Profile Photo (Max 5MB)</label>
												<input class="form-control" type="file" id="image_file" name="image_file[]" accept="image/*"  multiple>
											</div>
										</div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Age</label>
	                                            <input type="text" id="age" class="form-control" placeholder="" name="age">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                    	<div class="form-group">
	                                            <label for="gender">Sex</label>
			                                    <fieldset class="form-group">
			                                        <select class="form-select" id="sex" name="sex">
			                                            <option value="1">Male</option>
			                                            <option value="2">Female</option>
			                                        </select>
			                                    </fieldset>
			                                </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Degree </label>
	                                            <input type="text" id="degree" class="form-control" placeholder="" name="degree"onlynumbers>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Experience (Years)</label>
	                                            <input type="text" id="experience" class="form-control onlynumbers" maxlength="13" placeholder="" name="experience"onlynumbers>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Medical Registration Verified (Verified/Not Verified)</label>
	                                            <input type="text" id="medical_reg_verified" class="form-control" maxlength="13" placeholder="" name="medical_reg_verified" >
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Doctor Registration Number</label>
	                                            <input type="text" id="doctor_reg_no" class="form-control" maxlength="13" placeholder="" name="doctor_reg_no">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Available time slot with days</label>
	                                            <input type="text" id="time_slot_day" class="form-control" maxlength="13" placeholder="" name="time_slot_day">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Clinic name</label>
	                                            <input type="text" id="clinic_name" class="form-control" maxlength="13" placeholder="" name="clinic_name">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Contact Number</label>
	                                            <input type="text" id="contact" class="form-control onlynumbers" maxlength="13" placeholder="" name="contact">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Consultations Fees</label>
	                                            <input type="text" id="consultation_fees" class="form-control onlynumbers" maxlength="13" placeholder="" name="consultation_fees">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Book Video Consultations (Yes/NO)</label>
	                                            <input type="text" id="book_video_consult" class="form-control" maxlength="13" placeholder="" name="book_video_consult">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Book Hospital Appointment</label>
	                                            <input type="text" id="book_hospital_app" class="form-control" maxlength="13" placeholder="" name="book_hospital_app">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Rating(Patient Feedback)</label>
	                                            <input type="text" id="rating" class="form-control" maxlength="13" placeholder="" name="rating">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Online Payment available</label>
	                                            <input type="text" id="online_payment" class="form-control" maxlength="13" placeholder="" name="online_payment">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Language Know (Like, English, Hindi, Marathi)</label>
	                                            <input type="text" id="language_know" class="form-control" maxlength="13" placeholder="" name="language_know">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Location</label>
	                                            <input type="text" id="location" class="form-control" maxlength="13" placeholder="" name="location">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Frequently Ask Questions (FAQ)</label>
	                                            <input type="text" id="faq" class="form-control" maxlength="13" placeholder="" name="faq">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Color Identifier</label>
	                                            <input type="color" id="color" class="form-control" name="color">
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
		    		url: "{{ route('addDoctor') }}",
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
                                window.location.href = "{{ url('/doctorview') }}/"+response.id;
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
		 // 	$(function(){
   //  			$(".dateofbirth").datepicker({ 
   //  				dateFormat: 'dd-M-yy',
   //  				changeYear: true,
   //  				changeMonth: true,
   //  				yearRange: "c-150:c+150"
   //  			});
   //  			$(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
			// });
		});      
    </script>
@endsection

