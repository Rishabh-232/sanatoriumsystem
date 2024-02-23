@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Edit User</h3>
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
	                            <form class="form" id="resetform">
                        		 @csrf
	                                <div class="row">
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Name</label>
	                                            <input type="text" id="name" class="form-control"
	                                                placeholder="" name="name" value="{{$user->name}}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Email</label>
	                                            <input type="email" id="email" class="form-control"
	                                                placeholder="" name="email" value="{{$user->email}}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Password</label>
	                                            <input type="password" id="password" class="form-control"
	                                                placeholder="" name="password" value="" required>
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12 mb-1 pack">
											<label for="gender" class="form-label">Package</label>
											<select class="form-select" id="package" name="package">
												<option value="">Select Pakage Name</option>
												@foreach($pakagelist as $pakage)
												<option value="{{$pakage->id}}">{{$pakage->plan_name}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-6 col-12 mb-1 pack">
											<label for="gender" class="form-label">User Role </label>
											<select class="form-select" id="roleNo" name="roleNo">
												<ul>
												<option value="">Select Role</option>
												<option value="1">Superadmin</option>
												<option value="2">Admin</option>
												<option value="3">Branch Manager</option>
												<option value="4">Doctors</option>
												<option value="5">Receptionist</option>
												</ul>
											</select>
										</div>
	                                    <div class="col-12 d-flex justify-content-end">
	                                        <button type="submit" class="btn btn-primary me-1 mb-1" id="submit_btn">Submit</button>
                        									<a href="{{ url('/home') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
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
		    $("#resetform").submit(function(e){
			    	var $this = $(this);
			    	var formData = $this.serializeArray();
			    	$("#overlay").fadeIn(300);
				    	$.ajax({
				    		url: "{{ route('updatePassword', [$user->id]) }}",
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
	                            window.location.href = "{{ url('/login') }}";
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

			var showField = '{{ request()->query('Value') }}';

			if (showField == '1') {
				// Show the field
				$('.pack').hide();
			} else {
				// Hide the field
				$('.pack').hide();
			}

			<?php if (!empty($hidden)) { ?>
				$('.pack').show();
			<?php } ?>

			$('#package').val("{{$user->package}}");
			$('#roleNo').val("{{$user->roleNo}}");
			$('#package').trigger('refresh');
			$('#roleNo').trigger('refresh');
		});   
    </script>
@endsection