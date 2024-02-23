@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Add Consent Master</h3>
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
												<label for="city-column">Consent Name</label>
												<input class="form-control" type="text" id="consentname" name="consentname" placeholder="Consent Name" value="">
											</div>
										</div>
										<div class="col-md-6 col-12">
											<div class="form-group">
												<label for="city-column">Heading</label>
												<input class="form-control" type="text" id="heading" name="heading" placeholder="Heading" value="">
											</div>
										</div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Consent</label>
                                                <textarea id="consent" class="form-control" placeholder="Enter Consent Here" name="consent"></textarea>
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
@endsection

@section('jsscript')
 
    <script>
		$(document).ready(function() {

		    $("form").submit(function(e){
		    	var $this = $(this);
		    	var formData = $this.serializeArray();

		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ url('/addconsentmaster') }}",
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
                                // window.location.href = "{{ url('/labview') }}/"+response.id;
                                window.location.href = "{{ url('/consentmasterlist') }}";
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

