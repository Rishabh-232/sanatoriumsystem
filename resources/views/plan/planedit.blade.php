@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Edit Plan</h3>
	            </div>
	            <div class="col-12 col-md-6 order-md-2 order-first">
	               
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
	                                            <label for="first-name-column">Plan Name</label>
	                                            <input type="text" id="plan_name" class="form-control"
	                                                placeholder="" name="plan_name" value="{{ $planDetails->plan_name }}">
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Plan Price</label>
	                                            <input type="number" id="plan_price" class="form-control"
	                                                placeholder="" name="plan_price" value="{{ $planDetails->plan_price }}">
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city-column">Assign To Pages</label>
                                                @foreach($page as $key => $page)
                                                    <div class="form-check">
														@php
                                                            $selectedValues = explode(',', $planDetails->access_to_page);
                                                            $isChecked = in_array($page->page, $selectedValues);
                                                        @endphp
                                                        <input type="checkbox" class="form-check-input" id="page{{ $key + 1 }}" name="page[]" value="{{ $page->page }}" @if($isChecked) checked @endif>
                                                        <label class="form-check-label" for="page{{ $key + 1 }}">{{ $key + 1 }}. {{ $page->page }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

										<div class="col-md-6 col-12">
											<div class="form-group">
	                                            <label for="first-name-column">Number Of Days</label>
												<select  id="days" class="form-select" name="days">
													<option value="">Select Days</option>
													<option value="30">30 Days</option>
													<option value="60">60 Days</option>
													<option value="90">90 Days</option>
													<option value="120">120 Days</option>
													<option value="150">150 Days</option>
													<option value="180">180 Days</option>
													<option value="210">210 Days</option>
													<option value="240">240 Days</option>
													<option value="270">270 Days</option>
													<option value="300">300 Days</option>
													<option value="330">330 Days</option>
													<option value="360">360 Days</option>
												</select>
	                                        </div>
	                                    </div>
										<div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">From Date</label>
	                                            <input type="date" id="from_date" class="form-control"
	                                                placeholder="" name="from_date" value="{{ $planDetails->fromdate }}">
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
				const formData = new FormData(this);

            const checkedNoteCheckboxes = $('input[name="page[]"]:checked');
            const checkedNoteValues = checkedNoteCheckboxes.map(function() {
                return this.value;
            }).get();

            formData.append("checked_notes", checkedNoteValues);
		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ route('updatePlan',[$planDetails->id]) }}",
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
	                            window.location.href = "{{ url('/planview',[$planDetails->id]) }}";
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

		$('#days').val("{{ $planDetails->number_of_days }}");
		$('#days').trigger('refresh');

		});      
    </script>
@endsection