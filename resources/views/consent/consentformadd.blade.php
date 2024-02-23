@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Add Consent</h3>
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

	    <!-- // Basic multiple Column Form section end -->
		<section class="consent-form-section">
			<div class="card">
				<div class="card-content">
					<div class="card-body">
						<div class="consent-form-holder">
							<form action="" class="form">
								@csrf
								<div class="modal-body" style="background:aliceblue;">
									<div class="modal-body modal-title" style="display:flex;justify-content:space-around;flex-wrap:wrap;align-items:center;" id="">
										<img id="add_pre_logo"  alt="Logo" srcset="" style="height: 150px; width: 300px; object-fit: contain;">
										<div>
											<h4>Dr. Ishita Jakhanwal</h4><br>
											<h6>MDS, prosthodontist & Implantologist</h6>
											<h6>(Reg : A-26110)</h6>
										</div>
									</div>
								</div>
								<div class="card" id="">
									<hr>
									<div class="card-header header-center">
										<h2>CONSULTATION FORM</h2>
									</div>
									<div class="patient-consent-form" style="justify-content:flext-start;margin-left:10%">
										<span><b>Full Name</b></span><input type="text" id="name" class="form-control" style="width:40%" name="name" value="{{$pname}}">&nbsp;&nbsp;
										<span><b>Date</b></span><input type="text" id="date" class="form-control dateofbirth" name="date" value="">
									</div>
									<div class="patient-consent-form" style="justify-content:flext-start;margin-left:10%">
										<span><b>Address</b></span><input type="text" id="address" class="form-control" style="width:40%" name="address" value="{{$paddress}}">&nbsp;&nbsp;
										<span><b>Contact Phone</b></span><input type="text" id="contact" class="form-control" name="contact" value="{{$pcontact}}">
									</div>
									<div class="patient-consent-form" style="justify-content:flext-start;margin-left:10%">
										<span><b>Email Address</b></span><input type="text" id="email" class="form-control" style="width:40%" name="email" value="{{$pemail}}">
									</div>
									<hr>
								</div>
								<div class="d-flex  justify-content-around">
									<h5>Chief Complaint:</h5>
									<textarea style="width:80%;height:70px;" id="chiefcomplain" name="chiefcomplain"></textarea>
								</div>
								<input type="hidden" id="patientId" name="patientId" value={{$patientId}}>
								<br>
								<div class="d-flex  justify-content-around">
									<h5>Medical History:</h5>
									<textarea style="width:80%;height:70px;" id="medicalhistory" name="medicalhistory"></textarea>
								</div>
								<br>
								<div class="d-flex  justify-content-around">
									<h5>Dental History:</h5>
									<textarea style="width:80%;height:70px;" id="dentalhistory" name="dentalhistory"></textarea>
								</div>
								<br>
								<div class="d-flex  justify-content-around">
									<h5>Under Medication:<br>(If Any)</h5>
									<textarea style="width:80%;height:70px;" id="undermedication" name="undermedication"></textarea>
								</div>
								<br>
								<br>
								<div class="">
									<h5>Dental Consultation:</h5>
									<div class="table-responsive">
										<table class="table table-bordered dataTable table-min-width-xl mb-0">
											<tbody>
												<tr>
													<th class="text-bold-500">S.No</th>
													<th class="text-bold-500">FINDINGS</th>
													<th class="text-bold-500" colspan="2">MAXILLARY</th>
													<th class="text-bold-500" colspan="2">MANDIBULAR</th>
												</tr>
												<tr>
													<th class="text-bold-500"></th>
													<td class=""></td>
													<td class="text-bold-500">RIGHT</td>
													<td class="text-bold-500">LEFT</td>
													<td class="text-bold-500">RIGHT</td>
													<td class="text-bold-500">LEFT</td>
												</tr>
												<tr>
													<th class="text-bold-500">1</th>
													<th class="text-bold-500">CARIES</th>
													<td class=""><input type="text" name="maxrightcaries" class="form-control"></td>
													<td class=""><input type="text" name="maxleftcaries" class="form-control"></td>
													<td class=""><input type="text" name="manrightcaries" class="form-control"></td>
													<td class=""><input type="text" name="manleftcaries" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">2</th>
													<th class="text-bold-500">CERVICAL ABRASION</th>
													<td class=""><input type="text" name="maxrightcervical" class="form-control"></td>
													<td class=""><input type="text" name="maxleftcervical" class="form-control"></td>
													<td class=""><input type="text" name="manrightcervical" class="form-control"></td>
													<td class=""><input type="text" name="manleftcervical" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">3</th>
													<th class="text-bold-500">ROOT PIECES</th>
													<td class=""><input type="text" name="maxrightroot" class="form-control"></td>
													<td class=""><input type="text" name="maxleftroot" class="form-control"></td>
													<td class=""><input type="text" name="manrightroot" class="form-control"></td>
													<td class=""><input type="text" name="manleftroot" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">4</th>
													<th class="text-bold-500">MISSING TEETH</th>
													<td class=""><input type="text" name="maxrightmissing" class="form-control"></td>
													<td class=""><input type="text" name="maxleftmissing" class="form-control"></td>
													<td class=""><input type="text" name="manrightmissing" class="form-control"></td>
													<td class=""><input type="text" name="manleftmissing" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">5</th>
													<th class="text-bold-500">RESTORED TEETH</th>
													<td class=""><input type="text" name="maxrightrestored" class="form-control"></td>
													<td class=""><input type="text" name="maxleftrestored" class="form-control"></td>
													<td class=""><input type="text" name="manrightrestored" class="form-control"></td>
													<td class=""><input type="text" name="manleftrestored" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">6</th>
													<th class="text-bold-500">CROWNED TEETH</th>
													<td class=""><input type="text" name="maxrightcrowned" class="form-control"></td>
													<td class=""><input type="text" name="maxleftcrowned" class="form-control"></td>
													<td class=""><input type="text" name="manrightcrowned" class="form-control"></td>
													<td class=""><input type="text" name="manleftcrowned" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">7</th>
													<th class="text-bold-500">BRIDGE</th>
													<td class=""><input type="text" name="maxrightbridge" class="form-control"></td>
													<td class=""><input type="text" name="maxleftbridge" class="form-control"></td>
													<td class=""><input type="text" name="manrightbridge" class="form-control"></td>
													<td class=""><input type="text" name="manleftbridge" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">8</th>
													<th class="text-bold-500">CALCULAS AND STAINS</th>
													<td class=""><input type="text" name="maxrightcalculas" class="form-control"></td>
													<td class=""><input type="text" name="maxleftcalculas" class="form-control"></td>
													<td class=""><input type="text" name="manrightcalculas" class="form-control"></td>
													<td class=""><input type="text" name="manleftcalculas" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">9</th>
													<th class="text-bold-500">IMPACTED</th>
													<td class=""><input type="text" name="maxrightimpacted" class="form-control"></td>
													<td class=""><input type="text" name="maxleftimpacted" class="form-control"></td>
													<td class=""><input type="text" name="manrightimpacted" class="form-control"></td>
													<td class=""><input type="text" name="manleftimpacted" class="form-control"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<br>
								<br>
								<div class="d-flex  justify-content-center" style="background:aliceblue">
									<h4>Advice(please Tick)</h4>
								</div>
								<br>
								<br>
								<div class="col-md-12 col-12">
									<div class="form-group d-flex  justify-content-around">
										<div style="font-size:18px">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="Single Dental Implant">
												<label class="form-check-label" for="selected_cheked">Single Dental Implant</label>
											</div>
											&nbsp;
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="All on 6 Implants">
												<label class="form-check-label" for="selected_cheked">All on 6 Implants</label>
											</div>
										</div>
										<div style="font-size:18px">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="Multiple Dental Implants">
												<label class="form-check-label" for="selected_cheked">Multiple Dental Implants</label>
											</div>
											&nbsp;
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="Sinus/ bone grafting">
												<label class="form-check-label" for="selected_cheked">Sinus/ bone grafting </label>
											</div>
										</div>
										<div style="font-size:18px">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="All on 4 Implants">
												<label class="form-check-label" for="selected_cheked">All on 4 Implants</label>
											</div>
											&nbsp;
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="Full Mouth Rehabilitation">
												<label class="form-check-label" for="selected_cheked">Full Mouth Rehabilitation</label>
											</div>
										</div>
									</div>
								</div>
								<br>
								<br>
								<div class="d-flex  justify-content-center" style="background:aliceblue">
									<h4>Blood investigations For Implant</h4>
								</div>
								<br>
								<br>
								<div class="col-md-12 col-12">
									<div class="form-group d-flex  justify-content-around">
										<div style="font-size:18px">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="CBC">
												<label class="form-check-label" for="selected_bloodcheked">CBC</label>
											</div>
											&nbsp;
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="CB / CT">
												<label class="form-check-label" for="selected_bloodcheked">CB / CT</label>
											</div>
										</div>
										<div style="font-size:18px">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="BT / CT">
												<label class="form-check-label" for="selected_bloodcheked">BT / CT</label>
											</div>
											&nbsp;
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="RBS">
												<label class="form-check-label" for="selected_bloodcheked">RBS</label>
											</div>
										</div>
										<div style="font-size:18px">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="Rapid HIV">
												<label class="form-check-label" for="selected_bloodcheked">Rapid HIV</label>
											</div>
											&nbsp;
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="PT / INR">
												<label class="form-check-label" for="selected_bloodcheked">PT / INR</label>
											</div>
										</div>
									</div>
								</div>
								<br>
								<br>
								<br>
								<div class="">
									<h5>Special Instructions:</h5>
									<textarea style="width:80%;margin-left:10%;height:500px;" id="specialinstruction" name="specialinstruction"></textarea>
								</div>
								<br>
								<br>
								<br>
								<div class="">
									<h6 style="color:black;margin-left:10%;margin-right:10%;">**I declare that I have read this consultation form thoroughly and I understand every question asked. I
									believe I have no medical condition that may affect the treatment. All of the given answer is correct and
									true to the best of my knowledge.
									</h6>
								</div>
								<br>
								<br>
								<br>
								<br>
								<br>
								<div class="d-flex  justify-content-around">
									<div class="patient-consent-bottom">
										<h6 style="position:relative;top:86%;border-top:1px solid;">Patient's Signature</h6>
									</div>
									<div class="patient-consent-bottom">
										<!-- Display the signature image -->
										@if($signature)
											<img src="{{ $signature }}" alt="Signature" style="border-bottom:1px solid;">
										@else
											<p>No signature available</p>
										@endif
										<h5 style="margin-top:15px">Dr Ishita Jakhanwal</h5>
										<h6>MDS, prosthodontist & Implantologist</h6>
									</div>
								</div>
								<br>
								<br>
								<hr>
								<div class="modal-body" style="height:70px;background:aliceblue;padding:10px">
									<div class="modal-body modal-title" style="text-align:center;background:aliceblue;" id="">
											<h6><i class="fas fa-phone"></i>&nbsp;Appointment No.: 9535751921 / 9960375503</h6>
											<h6><i class="fas fa-map-marker-alt"></i>&nbsp;Office 7, B wing, 1st floor, Siddhesh optimus, opp Lunkad Queensland, Viman Nagar, Pune - 411014</h6>
									</div>
								</div>
								<hr>
								<br>
								<br>
								<br>
								<div class="row">
									<div class="col-12 d-flex justify-content-end">
	                                    <button type="submit" class="btn btn-primary me-1 mb-1">Save & Print</button>
	                                    <a href="{{ url()->previous() }}"class="btn btn-light-secondary me-1 mb-1">Close</a>
	                                </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection

@section('jsscript')

    <script>
		$(document).ready(function() {

		    $("form").submit(function(e){

				const checkboxes = document.querySelectorAll('input[name="past[]"]:checked');
				const opdcheckbox = document.querySelectorAll('input[name="pastblood[]"]:checked');

				const selectedValues = [];
				const opdValues = [];

				checkboxes.forEach((checkbox) => {
					selectedValues.push(checkbox.value);
				});

				opdcheckbox.forEach((checkbox) => {
					opdValues.push(checkbox.value);
				});


				var formData = new FormData(this);
				formData.append('past', selectedValues);
				formData.append('pastblood', opdValues);


		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ route('addConsent') }}",
		    		type: "POST",
		    		data: formData,
					processData: false,
            		contentType: false, 
		    		success: function(response) {
						console.log("66666",response);

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
                                // window.location.href = "{{ url('/patientview') }}/"+response.patientId;
								window.location.href = "{{ url('/consentview') }}/" + response.id + "?print=" + encodeURIComponent('yes');

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
	<script>
		var pre_text_logo = '{{ env('TEXT_LOGO') }}';
		var add_pre_logo = '{{ env('IMG_LOGO') }}';
        var imgElement = document.getElementById('add_pre_logo');
        imgElement.src = add_pre_logo;
        $('#pre_text_logo').text(pre_text_logo);

        if (pre_text_logo && pre_text_logo.trim() !== '') {
        // If textLogo is not empty, hide the image elements
            imgElement.style.display = 'none';
        } else {
            // If textLogo is empty or null, display the image elements
            imgElement.src = imgLogo;
        }
	</script>
@endsection


