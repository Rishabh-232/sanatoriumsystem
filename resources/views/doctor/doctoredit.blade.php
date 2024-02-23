@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Edit Doctor</h3>
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
	                                            <label for="first-name-column">Name of the Doctor</label>
	                                            <input type="text" id="doctor_name" class="form-control"
	                                                placeholder="" name="doctor_name" value="{{ $doctorDetails->doctor_name }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
											<div class="form-group">
												<label for="city-column">Profile Photo (Max 5MB)</label>
												<input class="form-control" type="file" id="image_file"  accept="image/*" name="image_file[]"  multiple>
											</div>
										</div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Age</label>
	                                            <input type="text" id="age" class="form-control" placeholder="" name="age" value="{{ $doctorDetails->age }}">
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
	                                            <label for="city-column">Degree</label>
	                                            <input type="text" id="degree" class="form-control" placeholder="" name="degree" value="{{ $doctorDetails->degree }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Experience (Years)</label>
	                                            <input type="text" id="experience" class="form-control" maxlength="13" placeholder="" name="experience" value="{{ $doctorDetails->experience }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="email-id-column">Medical Registration Verified (Verified/Not Verified)</label>
	                                            <input type="text" id="medical_reg_verified" class="form-control" maxlength="13" placeholder="" name="medical_reg_verified" value="{{ $doctorDetails->medical_reg_verified }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Doctor Registration Number</label>
	                                            <input type="text" id="doctor_reg_no" class="form-control" placeholder="" name="doctor_reg_no" value="{{ $doctorDetails->doctor_reg_no }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Available time slot with days</label>
	                                            <input type="text" id="time_slot_day" class="form-control" placeholder="" name="time_slot_day" value="{{ $doctorDetails->time_slot_day }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Clinic name</label>
	                                            <input type="text" id="clinic_name" class="form-control" placeholder="" name="clinic_name" value="{{ $doctorDetails->clinic_name }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Contact Number</label>
	                                            <input type="text" id="contact" class="form-control" maxlength="13" placeholder="" name="contact" value="{{ $doctorDetails->contact }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Consultations Fees</label>
	                                            <input type="text" id="consultation_fees" class="form-control " placeholder="" name="consultation_fees" value="{{ $doctorDetails->consultation_fees }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Book Video Consultations (Yes/NO)</label>
	                                            <input type="text" id="book_video_consult" class="form-control " placeholder="" name="book_video_consult" value="{{ $doctorDetails->book_video_consult }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Book Hospital Appointment</label>
	                                            <input type="text" id="book_hospital_app" class="form-control" placeholder="" name="book_hospital_app" value="{{ $doctorDetails->book_hospital_app }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Rating(Patient Feedback)</label>
	                                            <input type="text" id="rating" class="form-control" placeholder="" name="rating" value="{{ $doctorDetails->rating }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Online Payment available</label>
	                                            <input type="text" id="online_payment" class="form-control" placeholder="" name="online_payment" value="{{ $doctorDetails->online_payment }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Language Know (Like, English, Hindi, Marathi)</label>
	                                            <input type="text" id="language_know" class="form-control" placeholder="" name="language_know" value="{{ $doctorDetails->language_know }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Location</label>
	                                            <input type="text" id="location" class="form-control" placeholder="" name="location" value="{{ $doctorDetails->location }}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Frequently Ask Questions (FAQ)</label>
	                                            <input type="text" id="faq" class="form-control" placeholder="" name="faq" value="{{ $doctorDetails->faq }}">
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Color Identifier</label>
	                                            <input type="color" id="color" class="form-control" value="{{ $doctorDetails->color }}" name="color">
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
		    		url: "{{ route('updateDoctor',[$doctorDetails->id]) }}",
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
	                            window.location.href = "{{ url('/doctorview',[$doctorDetails->id]) }}";
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
    // 					yearRange: "c-150:c+150"
	   //  			});
				// });

				$("#sex").val("{{ $doctorDetails->sex }}"); 
				// $("#gender").selectpicker("refresh");

		});      
    </script>
@endsection