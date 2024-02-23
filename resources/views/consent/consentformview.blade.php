@extends('layouts.app')

@section('content')
<style>
    .dconsult li{
    font-size:12px;
    }
</style>
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    {{-- <h3>Consent List</h3> --}}
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

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="buttons text-center">
                        <a href="{{ url('consentedit'.'/'.$consentDetails->id) }}" class="btn btn-outline-info mb-0">Edit</a>
                        <a id="deleteperson" class="btn btn-outline-danger deleteconsent mb-0">Delete</a>
                        <button id="print" data-bs-toggle="modal" data-bs-target="#previewtable"  type="button" class="btn btn-outline-primary">Print</button>
                         <a href="{{ url('sendConsent'.'/'.$consentDetails->id) }}" class="btn btn-outline-success mb-0">Send on Whatsapp</a>
                        <a href="{{ url('patientview'.'/'.$consentDetails->patientId) }}" class="btn btn-outline-secondary mb-0">Back</a>
                    </div>
                </div>
            </div>
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
										<span><b>Full Name</b></span><input type="text" id="name" class="form-control" style="width:40%" name="name" value="{{$consentDetails->name}}" disabled>&nbsp;&nbsp;
										<span><b>Date</b></span><input type="text" id="date" class="form-control dateofbirth" name="date" value="{{ date('d-M-Y', strtotime($consentDetails->date)) }}" disabled>
									</div>
									<div class="patient-consent-form" style="justify-content:flext-start;margin-left:10%">
										<span><b>Address</b></span><input type="text" id="address" class="form-control" style="width:40%" name="address" value="{{$consentDetails->address}}" disabled>&nbsp;&nbsp;
										<span><b>Contact Phone</b></span><input type="text" id="contact" class="form-control" name="contact" value="{{$consentDetails->contact}}" disabled>
									</div>
									<div class="patient-consent-form" style="justify-content:flext-start;margin-left:10%">
										<span><b>Email Address</b></span><input type="text" id="email" class="form-control" style="width:40%" name="email" value="{{$consentDetails->email}}" disabled>
									</div>
									<hr>
								</div>
								<div class="d-flex  justify-content-around">
									<h5>Chief Complaint:</h5>
									<textarea style="width:80%;height:70px;" id="chiefcomplain" name="chiefcomplain" disabled>{{$consentDetails->chiefcomplain}}</textarea>
								</div>
								<br>
								<div class="d-flex  justify-content-around">
									<h5>Medical History:</h5>
									<textarea style="width:80%;height:70px;" id="medicalhistory" name="medicalhistory" disabled>{{$consentDetails->medicalhistory}}</textarea>
								</div>
								<br>
								<div class="d-flex  justify-content-around">
									<h5>Dental History:</h5>
									<textarea style="width:80%;height:70px;" id="dentalhistory" name="dentalhistory" disabled>{{$consentDetails->dentalhistory}}</textarea>
								</div>
								<br>
								<div class="d-flex  justify-content-around">
									<h5>Under Medication:<br>(If Any)</h5>
									<textarea style="width:80%;height:70px;" id="undermedication" name="undermedication" disabled>{{$consentDetails->undermedication}}</textarea>
								</div>
								<br>
								<br>
                                <div class="">
									<h5>Denta Consultation:</h5>
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
													<td class=""><input type="text" value="{{$consentDetails->maxrightcaries}}" disabled name="maxrightcaries" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->maxleftcaries}}" disabled name="maxleftcaries" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manrightcaries}}" disabled name="manrightcaries" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manleftcaries}}" disabled name="manleftcaries" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">2</th>
													<th class="text-bold-500">CERVICAL ABRASION</th>
													<td class=""><input type="text" value="{{$consentDetails->maxrightcervical}}" disabled name="maxrightcervical" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->maxleftcervical}}" disabled name="maxleftcervical" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manrightcervical}}" disabled name="manrightcervical" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manleftcervical}}" disabled name="manleftcervical" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">3</th>
													<th class="text-bold-500">ROOT PIECES</th>
													<td class=""><input type="text" value="{{$consentDetails->maxrightroot}}" disabled name="maxrightroot" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->maxleftroot}}" disabled name="maxleftroot" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manrightroot}}" disabled name="manrightroot" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manleftroot}}" disabled name="manleftroot" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">4</th>
													<th class="text-bold-500">MISSING TEETH</th>
													<td class=""><input type="text" value="{{$consentDetails->maxrightmissing}}" disabled name="maxrightmissing" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->maxleftmissing}}" disabled name="maxleftmissing" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manrightmissing}}" disabled name="manrightmissing" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manleftmissing}}" disabled name="manleftmissing" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">5</th>
													<th class="text-bold-500">RESTORED TEETH</th>
													<td class=""><input type="text" value="{{$consentDetails->maxrightrestored}}" disabled name="maxrightrestored" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->maxleftrestored}}" disabled name="maxleftrestored" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manrightrestored}}" disabled name="manrightrestored" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manleftrestored}}" disabled name="manleftrestored" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">6</th>
													<th class="text-bold-500">CROWNED TEETH</th>
													<td class=""><input type="text" value="{{$consentDetails->maxrightcrowned}}" disabled name="maxrightcrowned" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->maxleftcrowned}}" disabled name="maxleftcrowned" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manrightcrowned}}" disabled name="manrightcrowned" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manleftcrowned}}" disabled name="manleftcrowned" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">7</th>
													<th class="text-bold-500">BRIDGE</th>
													<td class=""><input type="text" value="{{$consentDetails->maxrightbridge}}" disabled name="maxrightbridge" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->maxleftbridge}}" disabled name="maxleftbridge" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manrightbridge}}" disabled name="manrightbridge" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manleftbridge}}" disabled name="manleftbridge" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">8</th>
													<th class="text-bold-500">CALCULAS AND STAINS</th>
													<td class=""><input type="text" value="{{$consentDetails->maxrightcalculas}}" disabled name="maxrightcalculas" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->maxleftcalculas}}" disabled name="maxleftcalculas" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manrightcalculas}}" disabled name="manrightcalculas" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manleftcalculas}}" disabled name="manleftcalculas" class="form-control"></td>
												</tr>
												<tr>
													<th class="text-bold-500">9</th>
													<th class="text-bold-500">IMPACTED</th>
													<td class=""><input type="text" value="{{$consentDetails->maxrightimpacted}}" disabled name="maxrightimpacted" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->maxleftimpacted}}" disabled name="maxleftimpacted" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manrightimpacted}}" disabled name="manrightimpacted" class="form-control"></td>
													<td class=""><input type="text" value="{{$consentDetails->manleftimpacted}}" disabled name="manleftimpacted" class="form-control"></td>
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
												@php
													$selectedValues = explode(',', $consentDetails->advice);
													$isChecked = in_array('Single Dental Implant', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="Single Dental Implant" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_cheked">Single Dental Implant</label>
											</div>
											&nbsp;
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->advice);
													$isChecked = in_array('All on 6 Implants', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="All on 6 Implants" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_cheked">All on 6 Implants</label>
											</div>
										</div>
										<div style="font-size:18px">
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->advice);
													$isChecked = in_array('Multiple Dental Implants', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="Multiple Dental Implants" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_cheked">Multiple Dental Implants</label>
											</div>
											&nbsp;
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->advice);
													$isChecked = in_array('Sinus/ bone grafting', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="Sinus/ bone grafting" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_cheked">Sinus/ bone grafting </label>
											</div>
										</div>
										<div style="font-size:18px">
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->advice);
													$isChecked = in_array('All on 4 Implants', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="All on 4 Implants" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_cheked">All on 4 Implants</label>
											</div>
											&nbsp;
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->advice);
													$isChecked = in_array('Full Mouth Rehabilitation', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_cheked" name="past[]" value="Full Mouth Rehabilitation" @if($isChecked) checked @endif disabled>
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
												@php
													$selectedValues = explode(',', $consentDetails->bloodinvestigate);
													$isChecked = in_array('CBC', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="CBC" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_bloodcheked">CBC</label>
											</div>
											&nbsp;
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->bloodinvestigate);
													$isChecked = in_array('CB / CT', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="CB / CT" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_bloodcheked">CB / CT</label>
											</div>
										</div>
										<div style="font-size:18px">
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->bloodinvestigate);
													$isChecked = in_array('BT / CT', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="BT / CT" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_bloodcheked">BT / CT</label>
											</div>
											&nbsp;
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->bloodinvestigate);
													$isChecked = in_array('RBS', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="RBS" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_bloodcheked">RBS</label>
											</div>
										</div>
										<div style="font-size:18px">
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->bloodinvestigate);
													$isChecked = in_array('Rapid HIV', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="Rapid HIV" @if($isChecked) checked @endif disabled>
												<label class="form-check-label" for="selected_bloodcheked">Rapid HIV</label>
											</div>
											&nbsp;
											<div class="form-check">
												@php
													$selectedValues = explode(',', $consentDetails->bloodinvestigate);
													$isChecked = in_array('PT / INR', $selectedValues);
												@endphp
												<input type="checkbox" class="form-check-input" id="selected_bloodcheked" name="pastblood[]" value="PT / INR" @if($isChecked) checked @endif disabled>
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
									<textarea style="width:80%;margin-left:10%;height:500px;" id="specialinstruction" name="specialinstruction" disabled>{{$consentDetails->specialinstruction}}</textarea>
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
							</form>
						</div>
					</div>
				</div>
			</div>
        </section>
        <!-- Basic Tables end -->
    </div>

    <div class="modal fade text-left" id="previewtable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document" style="max-width: max-content;">
                <div class="modal-content concentpop" id="printConsent">
                            <div class="modal-header">
                                <h6></h6>
                                <a href="#"><button id="printDiv" type="button" class="btn btn-outline-primary float-end print-button" onclick="printConsentDiv('printConsent')">Print</button></a>
                            </div>
                            <div class="card">
                                <div class="card-content">
                                    <div class="">
                                        <div class="consent-form-holder">
                                            <form action="" class="">
                                                @csrf
                                                <div class="" id="">
                                                    <div class="card-header header-center" style="text-align:center;">
                                                        <h5>CONSULTATION FORM</h5>
                                                    </div>
                                                    <ul class="patient-details-list d-flex justify-content-around" style="list-style:none">
                                                        <li><b>Full Name:</b> {{$consentDetails->name}}</li>
                                                        <li><b>Date:</b> {{ date('d-M-Y', strtotime($consentDetails->date)) }}</li>
                                                        <li><b>Address:</b> {{$consentDetails->address}}</li>
                                                        <li><b>Contact Phone:</b> {{$consentDetails->contact}}</li>
                                                        <li><b>Email Address:</b> {{$consentDetails->email}}</li>
                                                    </ul>
                                                    <hr>
                                                </div>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Chief Complaint</th>
                                                            <td>{{$consentDetails->chiefcomplain}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Medical History</th>
                                                            <td>{{$consentDetails->medicalhistory}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dental History</th>
                                                            <td>{{$consentDetails->dentalhistory}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Under Medication (If Any)</th>
                                                            <td>{{$consentDetails->undermedication}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                
                                                <div class="col-md-12 col-12 d-flex">
                                                    <div class="col-md-6 col-6">
                                                        <div class="">
                                                            <h6>Advice(please Tick)</h6>
                                                        </div>
                                                        <div class="">
                                                            <div class="form-group">
                                                                <div style="font-size:14px">
                                                                    @php
                                                                    $checkboxNames = [
                                                                        'Single Dental Implant',
                                                                            'All on 6 Implants',
                                                                            'Multiple Dental Implants',
                                                                            'Sinus/ bone grafting',
                                                                            'All on 4 Implants',
                                                                            'Full Mouth Rehabilitation',
                                                                        ];
                                                                        $selectedValues = [];
                                                                    @endphp

                                                                    @foreach ($checkboxNames as $name)
                                                                        @php
                                                                            $isChecked = in_array($name, explode(',', $consentDetails->advice));
                                                                        @endphp

                                                                        @if ($isChecked)
                                                                            <div class="form-check">
                                                                                {{ $name }}
                                                                            </div>
                                                                            @php
                                                                                $selectedValues[] = $name;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="">
                                                            <h6>Blood investigations For Implant</h6>
                                                        </div>
                                                        <div class="">
                                                            <div class="form-group">
                                                                <div style="font-size:14px">
                                                                    @php
                                                                        $bloodInvestigations = [
                                                                            'CBC',
                                                                            'CB / CT',
                                                                            'BT / CT',
                                                                            'RBS',
                                                                            'Rapid HIV',
                                                                            'PT / INR',
                                                                        ];
                                                                        $selectedBloodValues = [];
                                                                    @endphp

                                                                    @foreach ($bloodInvestigations as $investigation)
                                                                        @php
                                                                            $selectedValues = explode(',', $consentDetails->bloodinvestigate);
                                                                            $isChecked = in_array($investigation, $selectedValues);
                                                                        @endphp

                                                                        @if ($isChecked)
                                                                            <div class="form-check">
                                                                                {{ $investigation }}
                                                                            </div>
                                                                            @php
                                                                                $selectedBloodValues[] = $investigation;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <h6>Dental Consultation:</h6>
                                                    <div class="table-responsive">
                                                        <ul class="dconsult" style="display:flex;flex-wrap:wrap;list-style:none;justify-content:space-around">
                                                            <!-- Row 1 -->
                                                            @if(!empty($consentDetails->maxrightcaries) || !empty($consentDetails->maxleftcaries) || !empty($consentDetails->manrightcaries) || !empty($consentDetails->manleftcaries))
                                                                <li><strong>1. Caries:</strong>
                                                                    <ul>
                                                                        @if(!empty($consentDetails->maxrightcaries))
                                                                            <li>Maxillary Right: {{ $consentDetails->maxrightcaries }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->maxleftcaries))
                                                                            <li>Maxillary Left: {{ $consentDetails->maxleftcaries }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manrightcaries))
                                                                            <li>Mandibular Right: {{ $consentDetails->manrightcaries }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manleftcaries))
                                                                            <li>Mandibular Left: {{ $consentDetails->manleftcaries }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                            @endif

                                                            <!-- Row 2 -->
                                                            @if(!empty($consentDetails->maxrightcervical) || !empty($consentDetails->maxleftcervical) || !empty($consentDetails->manrightcervical) || !empty($consentDetails->manleftcervical))
                                                                <li><strong>2. Cervical Abrasion:</strong>
                                                                    <ul>
                                                                        @if(!empty($consentDetails->maxrightcervical))
                                                                            <li>Maxillary Right: {{ $consentDetails->maxrightcervical }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->maxleftcervical))
                                                                            <li>Maxillary Left: {{ $consentDetails->maxleftcervical }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manrightcervical))
                                                                            <li>Mandibular Right: {{ $consentDetails->manrightcervical }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manleftcervical))
                                                                            <li>Mandibular Left: {{ $consentDetails->manleftcervical }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                            @endif

                                                            <!-- Row 3 -->
                                                            @if(!empty($consentDetails->maxrightroot) || !empty($consentDetails->maxleftroot) || !empty($consentDetails->manrightroot) || !empty($consentDetails->manleftroot))
                                                                <li><strong>3. Root Pieces:</strong>
                                                                    <ul>
                                                                        @if(!empty($consentDetails->maxrightroot))
                                                                            <li>Maxillary Right: {{ $consentDetails->maxrightroot }}</li>
                                                                        @endif
                                                                        @IF(!empty($consentDetails->maxleftroot))
                                                                            <li>Maxillary Left: {{ $consentDetails->maxleftroot }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manrightroot))
                                                                            <li>Mandibular Right: {{ $consentDetails->manrightroot }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manleftroot))
                                                                            <li>Mandibular Left: {{ $consentDetails->manleftroot }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                            @endif

                                                            <!-- Row 4 -->
                                                            @if(!empty($consentDetails->maxrightcervical) || !empty($consentDetails->maxleftcervical) || !empty($consentDetails->manrightcervical) || !empty($consentDetails->manleftcervical))
                                                                <li><strong>4. Cervical Abrasion:</strong>
                                                                    <ul>
                                                                        @if(!empty($consentDetails->maxrightcervical))
                                                                            <li>Maxillary Right: {{ $consentDetails->maxrightcervical }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->maxleftcervical))
                                                                            <li>Maxillary Left: {{ $consentDetails->maxleftcervical }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manrightcervical))
                                                                            <li>Mandibular Right: {{ $consentDetails->manrightcervical }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manleftcervical))
                                                                            <li>Mandibular Left: {{ $consentDetails->manleftcervical }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                            @endif

                                                            <!-- Row 5 -->
                                                            @if(!empty($consentDetails->maxrightroot) || !empty($consentDetails->maxleftroot) || !empty($consentDetails->manrightroot) || !empty($consentDetails->manleftroot))
                                                                <li><strong>5. Root Pieces:</strong>
                                                                    <ul>
                                                                        @if(!empty($consentDetails->maxrightroot))
                                                                            <li>Maxillary Right: {{ $consentDetails->maxrightroot }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->maxleftroot))
                                                                            <li>Maxillary Left: {{ $consentDetails->maxleftroot }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manrightroot))
                                                                            <li>Mandibular Right: {{ $consentDetails->manrightroot }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manleftroot))
                                                                            <li>Mandibular Left: {{ $consentDetails->manleftroot }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                            @endif

                                                            <!-- Row 6 -->
                                                            @if(!empty($consentDetails->maxrightmissing) || !empty($consentDetails->maxleftmissing) || !empty($consentDetails->manrightmissing) || !empty($consentDetails->manleftmissing))
                                                                <li><strong>6. Missing Teeth:</strong>
                                                                    <ul>
                                                                        @if(!empty($consentDetails->maxrightmissing))
                                                                            <li>Maxillary Right: {{ $consentDetails->maxrightmissing }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->maxleftmissing))
                                                                            <li>Maxillary Left: {{ $consentDetails->maxleftmissing }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manrightmissing))
                                                                            <li>Mandibular Right: {{ $consentDetails->manrightmissing }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manleftmissing))
                                                                            <li>Mandibular Left: {{ $consentDetails->manleftmissing }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                            @endif

                                                            <!-- Row 7 -->
                                                            @if(!empty($consentDetails->maxrightrestored) || !empty($consentDetails->maxleftrestored) || !empty($consentDetails->manrightrestored) || !empty($consentDetails->manleftrestored))
                                                                <li><strong>7. Restored Teeth:</strong>
                                                                    <ul>
                                                                        @if(!empty($consentDetails->maxrightrestored))
                                                                            <li>Maxillary Right: {{ $consentDetails->maxrightrestored }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->maxleftrestored))
                                                                            <li>Maxillary Left: {{ $consentDetails->maxleftrestored }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manrightrestored))
                                                                            <li>Mandibular Right: {{ $consentDetails->manrightrestored }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manleftrestored))
                                                                            <li>Mandibular Left: {{ $consentDetails->manleftrestored }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                            @endif

                                                            <!-- Row 8 -->
                                                            @if(!empty($consentDetails->maxrightcrowned) || !empty($consentDetails->maxleftcrowned) || !empty($consentDetails->manrightcrowned) || !empty($consentDetails->manleftcrowned))
                                                                <li><strong>8. Crowned Teeth:</strong>
                                                                    <ul>
                                                                        @if(!empty($consentDetails->maxrightcrowned))
                                                                            <li>Maxillary Right: {{ $consentDetails->maxrightcrowned }}</li>
                                                                        @endif
                                                                        @IF(!empty($consentDetails->maxleftcrowned))
                                                                            <li>Maxillary Left: {{ $consentDetails->maxleftcrowned }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manrightcrowned))
                                                                            <li>Mandibular Right: {{ $consentDetails->manrightcrowned }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manleftcrowned))
                                                                            <li>Mandibular Left: {{ $consentDetails->manleftcrowned }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                            @endif

                                                            <!-- Row 9 -->
                                                            @if(!empty($consentDetails->maxrightbridge) || !empty($consentDetails->maxleftbridge) || !empty($consentDetails->manrightbridge) || !empty($consentDetails->manleftbridge))
                                                                <li><strong>9. Bridge:</strong>
                                                                    <ul>
                                                                        @if(!empty($consentDetails->maxrightbridge))
                                                                            <li>Maxillary Right: {{ $consentDetails->maxrightbridge }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->maxleftbridge))
                                                                            <li>Maxillary Left: {{ $consentDetails->maxleftbridge }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manrightbridge))
                                                                            <li>Mandibular Right: {{ $consentDetails->manrightbridge }}</li>
                                                                        @endif
                                                                        @if(!empty($consentDetails->manleftbridge))
                                                                            <li>Mandibular Left: {{ $consentDetails->manleftbridge }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>



                                                <div class="">
                                                    <h6>Special Instructions:</h6>
                                                    <p>{{$consentDetails->specialinstruction}}</p>
                                                </div>
                                                <div class="">
                                                    <p style="color:black;text-align:center">**I declare that I have read this consultation form thoroughly and I understand every question asked. I
                                                    believe I have no medical condition that may affect the treatment. All of the given answer is correct and
                                                    true to the best of my knowledge.
                                                    </p>
                                                </div>
                                                <div class="d-flex  justify-content-around">
                                                    <div class="patient-consent-bottom">
                                                        <p style="position:relative;top:86%;border-top:1px solid;">Patient's Signature</p>
                                                    </div>
                                                    <div class="patient-consent-bottom">
                                                    <!-- Display the signature image -->
                                                        @if($signature)
                                                            <img src="{{ $signature }}" alt="Signature" style="border-bottom:1px solid;" width="120px">
                                                        @else
                                                            <p>No signature available</p>
                                                        @endif
                                                        <h6 style="margin-top:15px">Dr Ishita Jakhanwal</h6>
                                                        <p>MDS, prosthodontist & Implantologist</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="modal-body" style="height:70px;background:aliceblue;padding:10px">
                                                    <div class="modal-body modal-title" style="text-align:center;background:aliceblue;" id="">
                                                            <p><i class="fas fa-phone"></i>&nbsp;Appointment No.: 9535751921 / 9960375503</p>
                                                            <p><i class="fas fa-map-marker-alt"></i>&nbsp;Office 7, B wing, 1st floor, Siddhesh optimus, opp Lunkad Queensland, Viman Nagar, Pune - 411014</p>
                                                    </div>
                                                </div>
                                                <hr>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal" class="closepreviewmodal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block modal-close-btn">Close</span>
                </button>
            </div>
        </div>
    </div>
@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.drname').text('Dr. Gowthaman P. R.')
                $('.drnumber').text('9940066956')
                $('.drdeg').text('M.D.S., Oral And Maxillofacial Surgeon')
                $('.dremail').text('brammacbe@gmail.com')

            var hiddenValue = '{{ request()->query('print') }}';
            if(hiddenValue == 'yes'){
                $("#print").click();
            }

            // To delete patient
            $(document).on("click", ".deleteconsent", function(){ 
                var consentid = {{$consentDetails->id}};
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Consent\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) { 
                        $("#overlay").fadeIn(300);   
                        $.ajax({
                            url: "{{ route('deleteconsentdata') }}",
                            type: "DELETE",
                            data: {"consentid": consentid, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/patientview',[$consentDetails->patientId]) }}";
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
                    }
                });
            });
            //
            printConsentDiv = function (divName) {
			    var printContents = document.getElementById(divName).innerHTML;
			    var originalContents = document.body.innerHTML;
			     document.body.innerHTML = printContents;
			     window.print();
			     window.location.reload(true);
			     document.body.innerHTML = originalContents;
			}
        });
    </script>
     <script>
		var pre_text_logo = '{{ env('TEXT_LOGO') }}';
		var add_pre_logo = '{{ env('IMG_LOGO') }}';
        var imgElement = document.getElementById('add_pre_logo');
        var imgElement2 = document.getElementById('add_pre_logo2');
        imgElement.src = add_pre_logo;
        imgElement2.src = add_pre_logo;
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