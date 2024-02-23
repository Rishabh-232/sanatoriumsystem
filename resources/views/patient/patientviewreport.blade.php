@extends('layouts.app')

@section('content')
	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Report</h3>
	            </div>
	            <div class="col-12 col-md-6 order-md-2 order-first">
                <button id="print" style="float:right" type="button" class="btn btn-outline-primary" onclick="printConsentDiv('printConsent')">Print</button>
	            </div>
	        </div>
	    </div>

	    <!-- // Basic multiple Column Form section end -->
		<section class="consent-form-section">
			<div class="card" id="printConsent">
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
                                <div class="card-header header-center">
                                    <h4>Patient Medical Record</h4>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <!-- table bordered -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataTable  mb-0">
                                            <tbody>
                                                <tr colspan=2>
                                                    <th class="text-bold-500">Id</th>
                                                    <td>{{ $patientDetails->id }}</td>
                                                    <th class="text-bold-500"></th>
                                                    <td></td>
                                                </tr>
                                                <tr colspan=2>
                                                <th class="text-bold-500">Patient Id</th>
                                                    <td>{{ $patientDetails->patient_uniq_id }}</td>
                                                    <th class="text-bold-500">Name</th>
                                                    <td>{{ $patientDetails->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-bold-500">Date Of Birth</th>
                                                    <td>@if($patientDetails->date_of_birth != '1970-01-01')
                                                        {{ date('d-M-Y', strtotime($patientDetails->date_of_birth)) }} (Age: {{$patientDetails->actualAge}} Years)
                                                        @endif
                                                    </td>
                                                    <th class="text-bold-500">Age (In Years)</th>
                                                    <td>@if($patientDetails->date_of_birth == '1970-01-01')
                                                        {{ $patientDetails->age }}
                                                        @else
                                                        {{ $patientDetails->actualAge }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-bold-500">Gender</th>
                                                    <td>{{ $patientDetails->sex == 1 ? 'Male' : 'Female ' }}</td>
                                                    <th class="text-bold-500">Address</th>
                                                    <td>{{ $patientDetails->address }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-bold-500">Primary Number</th>
                                                    <td>{{ $patientDetails->contact_1 }}</td>
                                                    <th class="text-bold-500">Contact No 2.</th>
                                                    <td>{{ $patientDetails->contact_2 }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-bold-500">Email</th>
                                                    <td>{{ $patientDetails->email }}</td>
                                                    <th class="text-bold-500">Attended By</th>
                                                    <td>{{ $patientDetails->attended_by }}</td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                    <th class="text-bold-500">Drug Allergy</th>
                                                    <td>{{ $patientDetails->drug_allergy }}</td>
                                                    <th class="text-bold-500">Past Medical History</th>
                                                    <td>{{ $patientDetails->past_medical_history }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-bold-500">Anniversary</th>
                                                    <td>{{ $patientDetails->anniversary ? date('d-M-Y', strtotime($patientDetails->anniversary)) : '' }}</td>
                                                    <th class="text-bold-500">Insurance</th>
                                                    <td>{{ $patientDetails->patient_insurance }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-bold-500">Chief Complaint</th>
                                                    <td>{{ $patientDetails->chiefcomplaint }}</td>
                                                    <th class="text-bold-500">Past Dental History</th>
                                                    <td>{{ $patientDetails->pastdental }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-bold-500">Investigations</th>
                                                    <td>{{ $patientDetails->investigation }}</td>
                                                    <th class="text-bold-500">Consent Form</th>
                                                    <td>{{ $patientDetails->consent_form }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-bold-500">Blood Investigation</th>
                                                    <td>{{ $patientDetails->bloodinvestigation }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-header header-center">
                                    <h4>Treatment Record</h4>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <!-- table bordered -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataTable  mb-0">
                                            <tbody>
                                                @foreach($treatmentlist as $treat)
                                                <tr colspan=2>
                                                    <th class="text-bold-500">Treatment Date</th>
                                                    <td>{{ date('d-M-Y', strtotime($treat->treatment_date)) }}</td>
                                                    <th class="text-bold-500">Tooth Number</th>
                                                    <td>{{$treat->tooth_number}}</td>
                                                    <th class="text-bold-500">Summary</th>
                                                    <?php
                                                        $jsonData = $treat->treatmentStr;

                                                        // Decode the JSON data into a PHP array
                                                        $data = json_decode($jsonData, true);

                                                                                                // Get the keys from the array and join them with commas
                                                        $keys = implode(', ', array_keys($data));

                                                    ?>
                                                    <td><?php echo $keys; ?></td>
                                                    <th class="text-bold-500">Diagnosis</th>
                                                    <td>{{$treat->diagnosis}}</td>
                                                    <th class="text-bold-500">Quotation</th>
                                                    @if ($treat->quote_id != '')
                                                    <td>{{ str_pad($treat->quote_id, 2, '0', STR_PAD_LEFT) }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-header header-center">
                                    <h4>Visits Record</h4>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <!-- table bordered -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataTable  mb-0">
                                            <tbody>
                                                @foreach($visitlist as $visit)
                                                <tr colspan=2>
                                                    <th class="text-bold-500">Visit Date</th>
                                                    <td>{{ date('d-M-Y', strtotime($visit->date_of_visit)) }}</td>
                                                    <th class="text-bold-500">Work Done</th>
                                                    <?php
                                                        $jsonData = $visit->treatinfo;

                                                        // Decode the JSON data into a PHP array
                                                        $data = json_decode($jsonData, true);

                                                                                                // Get the keys from the array and join them with commas
                                                        $keys = implode(', ', array_keys($data));

                                                    ?>
                                                    <td><?php echo $keys; ?></td>
                                                    <th class="text-bold-500">Total Paid Amount</th>
                                                    <td>{{$visit->total_amount}}</td>
                                                    <th class="text-bold-500">Balance Amount</th>
                                                    <td>{{$visit->remaining_amount}}</td>
                                                    <th class="text-bold-500">Total Amount</th>
                                                    <td>{{$visit->balance_amount}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-header header-center">
                                    <h4>Prescription Record</h4>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <!-- table bordered -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataTable  mb-0">
                                            <tbody>
                                                @foreach($prescriptionlist as $prescription)
                                                <tr colspan=2>
                                                    <th class="text-bold-500">Date</th>
                                                    <td>{{$prescription->date}}</td>
                                                    <th class="text-bold-500">Medicine Name</th>
                                                    <td>{{$prescription->medicine_name}}</td>
                                                    <th class="text-bold-500">Number Of Times</th>
                                                    <td>{{$prescription->number_of_times}}</td>
                                                    <th class="text-bold-500">Before/After</th>
                                                    <td>{{$prescription->before_after}}</td>
                                                    <th class="text-bold-500">Remarks</th>
                                                    <td>{{$prescription->remarks}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-header header-center">
                                    <h4>Consent Record</h4>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <!-- table bordered -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered dataTable mb-0">
                                            <tbody>
                                                @foreach($consentlist as $consent)
                                                <tr colspan=2>
                                                    <th class="text-bold-500">Date</th>
                                                    <td>{{ date('d-M-Y', strtotime($consent->date)) }}</td>
                                                    <th class="text-bold-500">Full Name</th>
                                                    <td>{{$consent->name}}</td>
                                                    <th class="text-bold-500">Address</th>
                                                    <td>{{$consent->address}}</td>
                                                </tr>
                                                <tr colspan=2>
                                                    <th class="text-bold-500">Contact</th>
                                                    <td>{{$consent->contact}}</td>
                                                    <th class="text-bold-500">Email Id</th>
                                                    <td>{{$consent->email}}</td>
                                                    <th class="text-bold-500">Chief Complaint</th>
                                                    <td>{{$consent->chiefcomplain}}</td>
                                                </tr>
                                                <tr colspan=2>
                                                    <th class="text-bold-500">Medical History</th>
                                                    <td>{{$consent->medicalhistory}}</td>
                                                    <th class="text-bold-500">Dental History</th>
                                                    <td>{{$consent->dentalhistory}}</td>
                                                    <th class="text-bold-500">under Medication</th>
                                                    <td>{{$consent->undermedication}}</td>
                                                </tr>
                                                <tr colspan=2>
                                                    <th class="text-bold-500">Special Instruction</th>
                                                    <td>{{$consent->specialinstruction}}</td>
                                                    <th class="text-bold-500">Advice</th>
                                                    <td>{{$consent->advice}}</td>
                                                    <th class="text-bold-500">Blood Investigate</th>
                                                    <td>{{$consent->bloodinvestigate}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-body" style="height:70px;background:aliceblue;padding:10px">
									<div class="modal-body modal-title" style="text-align:center;background:aliceblue;" id="">
											<h6><i class="fas fa-phone"></i>&nbsp;Appointment No.: 9535751921 / 9960375503</h6>
											<h6><i class="fas fa-map-marker-alt"></i>&nbsp;Office 7, B wing, 1st floor, Siddhesh optimus, opp Lunkad Queensland, Viman Nagar, Pune - 411014</h6>
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
         printConsentDiv = function (divName) {
			    var printContents = document.getElementById(divName).innerHTML;
			    var originalContents = document.body.innerHTML;
			     document.body.innerHTML = printContents;
			     window.print();
			     window.location.reload(true);
			     document.body.innerHTML = originalContents;
			}


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


