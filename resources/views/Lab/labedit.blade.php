@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Edit Lab</h3>
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
												<label for="city-column">Lab Name</label>
												<input class="form-control" type="text" id="lab_name" name="lab_name" value="{{$labDetails->lab_name}}">
											</div>
										</div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">lab Contact No</label>
	                                            <input type="number" id="lab_contact_no" class="form-control" value="{{$labDetails->contact_no}}" placeholder="" name="lab_contact_no">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Lab Address</label>
	                                            <input type="text" id="lab_address" class="form-control" value="{{$labDetails->lab_address}}" placeholder="" name="lab_address">
	                                        </div>
	                                    </div>
	                                   
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Contact Person No </label>
	                                            <input type="number" id="contact_person_no" class="form-control" value="{{$labDetails->contact_person_no}}"placeholder="" name="contact_person_no">
	                                        </div>
	                                    </div>

										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Delivery Person Name </label>
	                                            <input type="text" id="delivery_name" class="form-control" value="{{$labDetails->delivery_name}}" placeholder="" name="delivery_name">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Delivery Person Contact No </label>
	                                            <input type="number" id="delivery_contct_no" class="form-control"  value="{{$labDetails->delivery_contct_no}}"placeholder="" name="delivery_contct_no">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Alternate Delivery Person Name</label>
	                                            <input type="text" id="alt_delivry_name" class="form-control" value="{{$labDetails->alt_delivry_name}}"placeholder="" name="alt_delivry_name">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Alternate Delivery Person Contact No </label>
	                                            <input type="number" id="alt_delivry_contct_no" class="form-control" value="{{$labDetails->alt_delivry_contct_no}}" placeholder="" name="alt_delivry_contct_no">
	                                        </div>
	                                    </div>

                                        <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Email Id</label>
	                                            <input type="email" id="email" value="{{$labDetails->email}}" class="form-control"
	                                                placeholder="" name="email">
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
		    		url: "{{ route('updateLab',[$labDetails->id]) }}",
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
                                window.location.href = "{{ url('/lablist') }}";
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

