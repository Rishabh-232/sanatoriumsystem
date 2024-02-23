@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/choices.css') }}">
    <style type="text/css">

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            width: 450px;
        }

        .select2-container--default .select2-selection--single {
            height: 50px;
            padding: 8px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            padding: 22px;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da !important;
        }

    </style>
	<div class="page-heading">
	    <div class="page-title">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Add Type Of Work</h3>
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
												<label for="city-column">Type Of Work</label>
												<input class="form-control" type="text" id="type_of_work" name="type_of_work" value="">
											</div>
										</div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Lab Name</label>
	                                            <select  id="lab_name" class="js-example-basic-multiple form-select" name="lab_name[]"multiple="multiple">
													<option value="">Select Lab Name</option>
													@foreach($Lab as $lab)
													<option value="{{$lab->lab_name}}">{{$lab->lab_name}}</option>
													@endforeach
												</select>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Charges</label>
	                                            <input type="text" id="charges" class="form-control" placeholder="" name="charges">
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
  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
 
    <script>
		$(document).ready(function() {
            $('.js-example-basic-multiple').select2();

		    $("form").submit(function(e){
		    	var $this = $(this);
		    	var formData = $this.serializeArray();
		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ route('addTOW') }}",
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
                                window.location.href = "{{ url('/TOWlist') }}";
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
		});      
    </script>
@endsection

