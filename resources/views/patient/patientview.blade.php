@extends('layouts.app')

@section('content')
<style>
    .checkbox-row {
        display: flex;
        align-items: center;
        gap: 20px; /* Adjust the gap as needed */
    }

    .checkbox-holder {
        display: flex;
        align-items: center;
    }
</style>
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    {{-- <h3>Patient List</h3> --}}
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
                <div class="card-body card-body-mobile">
                    <div class="buttons text-center card-head-btn-holder">
                        <a href="{{ url('patientedit'.'/'.$patientDetails->id) }}" class="btn btn-outline-info mb-0">Edit</a>
                        <a href="{{ url('patienttreatment'.'/'.$patientDetails->id) }}" class="btn btn-outline-warning mb-0">Add Treatment</a>
                        <a href="#" class="btn btn-outline-success mb-0" data-bs-toggle="modal"
                        data-bs-target="#inlineForm">
                        Add Visit
                        </a>
                        @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4)
                            @if (strpos($package[0]['access_to_page'], 'Lab Note') !== false)
                            <a href="{{ url('labnoteadding'.'/'.$patientDetails->id) }}" class="btn btn-outline-primary mb-0">New Lab Order</a>
                            @endif
                        @endif
                        <a href="{{url('patientprescription'.'/'.$patientDetails->id)}}" class="btn btn-outline-info mb-0">Create Prescription</a>
                        @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 ||Auth::user()->roleNo == 5)
                            @if (strpos($package[0]['access_to_page'], 'Consent') !== false)
                            <a href="{{url('consentformadd'.'/'.$patientDetails->id)}}" class="btn btn-outline-primary mb-0">Consent Form</a>
                            @endif
                        @endif

                        <a id="deleteperson" class="btn btn-outline-danger deletepatient mb-0">Delete</a>
                        <a href="{{ url('patientlist') }}" class="btn btn-outline-secondary mb-0">Back</a>
                        <a href="{{ url('xrays'.'/'.$patientDetails->id) }}" class="btn btn-outline-warning mb-0">Investigation</a>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Patient Information</h4>
                </div>
                <div class="card-body">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable table-min-width-xl mb-0">
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
                                    <th class="text-bold-500">Patient Image</th>
                                    <!-- <td> 
                                        @foreach ($file as $report)
                                            <img src="{{ asset('upload/' . $report) }}" style="height:100px !important; width:150px !important" alt="Image"  />
                                        @endforeach
                                    </td> -->
                                    <td>
                                        @foreach ($file as $report)
                                            <div class="image-container">
                                                <img
                                                    src="{{ asset('upload/' . $report) }}"
                                                    style="height: 100px !important; width: 150px !important"
                                                    alt="Image"
                                                    class="thumbnail"
                                                />
                                                <div class="full-screen-image">
                                                    <img src="{{ asset('upload/' . $report) }}" alt="Image" />
                                                    <i class="fas fa-undo rotate-icon" style="margin-left:20px;font-size:20px; cursor:pointer;position:fixed;top:2%;left:50%;"></i> <!-- Add a rotation icon -->
                                                </div>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active tabular" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Visit</button>
                <button class="nav-link tabular" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Treatment</button>
                @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4)
                    @if (strpos($package[0]['access_to_page'], 'Lab Note') !== false)
                <button class="nav-link tabular" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Lab Order</button>
                    @endif
                @endif
                <button class="nav-link tabular" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">Prescription</button>
                @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 ||Auth::user()->roleNo == 5)
                    @if (strpos($package[0]['access_to_page'], 'Consent') !== false)
                <button class="nav-link tabular" id="nav-consent-tab" data-bs-toggle="tab" data-bs-target="#nav-consent" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">Consent Form</button>
                    @endif
                @endif
            </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <br>
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <div class="card">
                        <div class="card-header">
                            <h4>Visits</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-min-width" id="tablelist">
                                <thead>
                                    <tr>
                                        <th>Visit Date</th>
                                        <th>Remarks</th>
                                        <th>Treatment Done</th>
                                        <th>Total Paid Amount</th>
                                        <th>Balance Amount</th>
                                        <th>Total Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($visitlist as $visit)
                                        <tr>
                                            <!-- <td>{{ date('d-M-Y', strtotime($visit->date_of_visit)) }}</td> -->
                                            <td>{{ $visit->created_at }}</td>
                                            <td>{{ $visit->remark }}</td>
                                            <?php
                                                $jsonData = $visit->treatinfo;

                                                // Decode the JSON data into a PHP array
                                                $data = json_decode($jsonData, true);

                                                                                        // Get the keys from the array and join them with commas
                                                $keys = implode(', ', array_keys($data));

                                            ?>
                                            <td><?php echo $keys; ?></td>
                                            <!-- <td>{{ $visit->treatinfo }}</td> -->
                                            <td>{{ $visit->total_amount }}</td>
                                            <td>{{ $visit->remaining_amount }}</td>
                                            <td>{{ $visit->balance_amount }}</td>
                                            <td class="button-holder">
                                                <a class="btn btn-outline-info view_details" data-bs-toggle="modal" data-bs-target="#visitdetails" data-id="{{ $visit->id }}">Details</a>
                                                <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#confirmdownloadsummary"  class="btn btn-outline-primary">Summary</a> -->
                                                <a class="btn btn-outline-info view_visit" data-bs-toggle="modal" data-bs-target="#visitinfo" data-id="{{ $visit->id }}">View</a>
                                                <a class="btn btn-outline-warning edit_visit mb-0" data-bs-toggle="modal" data-bs-target="#visitedit" data-id="{{ $visit->id }}">Edit</a>
                                                <a id="deletevisit" class="btn btn-outline-danger delete_visit" data-id="{{ $visit->id }}" data-patient-id="{{ $visit->patient_id }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <div class="card">
                        <div class="card-header">
                            <h4>Treatments</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-min-width" id="tablelist1">
                                <thead>
                                    <tr>
                                        <th>Treatment Date</th>
                                        <th>Tooth Number</th>
                                        <th>Summary</th>
                                        <th>Diagnosis</th>
                                        <th>Quotation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($treatmentlist as $treatment)
                                        <tr>
                                            <td>{{ date('d-M-Y', strtotime($treatment->treatment_date)) }}</td>
                                            <td>{{ $treatment->tooth_number }}</td>
                                            <?php
                                                $jsonData = $treatment->treatmentStr;

                                                // Decode the JSON data into a PHP array
                                                $data = json_decode($jsonData, true);

                                                                                        // Get the keys from the array and join them with commas
                                                $keys = implode(', ', array_keys($data));

                                            ?>
                                            <!-- <td>{{ $treatment->treatmentStr }}</td> -->
                                            <td><?php echo $keys; ?></td>
                                            <td>{{ $treatment->diagnosis }}</td>
                                            @if ($treatment->quote_id != '')
                                                <td><a href="{{ url('quoteview'.'/'.$treatment->quote_id) }}">Quote No&nbsp;{{ str_pad($treatment->quote_id, 2, '0', STR_PAD_LEFT) }}</a></td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td class="button-holder">
                                                <a class="btn btn-outline-info view_tratment" data-bs-toggle="modal" data-bs-target="#treatmentinfo" data-id="{{ $treatment->id }}">View</a>
                                                <a  href="{{ url('editpatienttreatment'.'/'.$treatment->id) }}" class="btn btn-outline-warning">Edit</a>
                                                <a id="deletetreatment" class="btn btn-outline-danger delete_treatment" data-id="{{ $treatment->id }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                    @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4)
                        @if (strpos($package[0]['access_to_page'], 'Lab Note') !== false)
                        <div class="card">
                            <div class="card-header">
                                <h4>Lab Orders</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-min-width" id="tablelist2">
                                    <thead>
                                        <tr>
                                            <th>Lab Name</th>
                                            <th>teeth/Tooth</th>
                                            <th>Type Of Work</th>
                                            <th>Expected Date Of Delivery</th>
                                            <th>Intructions</th>
                                            <th>Work Given In the Form</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($laborder as $order)
                                            <tr>
                                                <td>{{ $order->lab_name }}</td>
                                                <td>{{ $order->teeth_tooth }}</td>
                                                <td>{{ $order->type_of_work }}</td>
                                                <td>{{ $order->excepted_date_of_deliver }}</td>
                                                <td>
                                                    <?php
                                                    $noteValues = explode(',', $order->note); // Split the note field by commas
                                                    foreach ($noteValues as $noteValue) {
                                                        echo $noteValue . "<br>"; // Add a line break to display each value on a new line
                                                    }
                                                    ?>
                                                    {{$order->additional}}
                                                </td>
                                                <td>{{ $order->selectedOption }}</td>
                                                <td class="button-holder">
                                                    <a href="{{ url('labnoteview'.'/'.$order->id) }}" class="btn btn-outline-info">View</a>
                                                    <a href="{{ url('labenotedit'.'/'.$order->id) }}" class="btn btn-outline-warning">Edit</a>
                                                    <a class="btn btn-outline-danger delete_lab_order" data-id="{{ $order->id }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>

                <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">
                    <div class="card">
                        <div class="card-header">
                            <h4>Prescription</h4>
                            <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#previewtable"><button id="previewBtn" type="button" class="btn btn-outline-primary float-end">Preview</button></a> -->
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-min-width" id="tablelist3">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    @foreach($prescriptionlist as $prescription)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $prescription->created_at }}</td>
                                            <td class="button-holder">
                                                <a class="btn btn-outline-info view_prescription" data-bs-toggle="modal" data-bs-target="#viewPrescription" data-id="{{ $prescription->id }}">View</a>
                                                <a id="deletelaborder" class="btn btn-outline-danger delete_prescription" data-id="{{ $prescription->id }}">Delete</a>
                                                <a href="{{ url('sendPrescription'.'/'.$prescription->id) }}" class="btn btn-outline-success mb-0">Send on Whatsapp</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-consent" role="tabpanel" aria-labelledby="nav-consent-tab" tabindex="0">
                @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 ||Auth::user()->roleNo == 5)
                    @if (strpos($package[0]['access_to_page'], 'Consent') !== false)
                    <div class="card">
                        <div class="card-header">
                            <h4>Consent Form</h4>
                            <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#previewtable"><button id="previewBtn" type="button" class="btn btn-outline-primary float-end">Preview</button></a> -->
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-min-width" id="tablelist4">
                                <thead>
                                    <tr>
                                        <th class="table-min-width-small padding-small">Sr. No.</th>
                                        <th>Date</th>
                                        <th>Full Name</th>
                                        <th>Contact</th>
                                        <th>Email Id</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($consentlist as $consent)
                                        <tr>
                                            <td class="table-min-width-small">{{ $i++; }}</td>
                                            <td>{{ $consent->date }}</td>
                                            <td>{{ $consent->name }}</td>
                                            <td>{{ $consent->contact }}</td>
                                            <td>{{ $consent->email }}</td>
                                            <td class="button-holder">
                                                <a href="{{ url('consentview'."/".$consent->id) }}" class="btn btn-outline-info">View</a>
                                                <a href="{{ url('consentedit'."/".$consent->id) }}" class="btn btn-outline-warning">Edit</a>
                                                <a id="deleteperson" class="btn btn-outline-danger deleteconsent" data-id="{{$consent->id}}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                @endif
                </div>

            </div>
        </section>
        <!-- Basic Tables end -->
    </div>

    
    <!--Add Visit form Modal -->
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content Qcustom">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Visit</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="addVisitForm">
                    @csrf
                    <div class="modal-body">
                        <label>Date Of Visit</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control dateofbirth" id="date_of_visit" name="date_of_visit">
                        </div>
                        <div class="form-group">
                        <a href="{{ url('patienttreatment/' . $patientDetails->id . '?addTreat=true') }}" class="btn btn-outline-warning mb-0">Add Treatment</a>
                        </div>
                        <p>If Treatment is Not,Click Here To Add New Treatment</p>
                        <div class="form-group">
                            <label>Treatment</label>
                            <select class="form-select" id="treatment" name="treatment">
                            <option value="">Please Select Treatment</option>
                                @foreach($treatmentlist as $treatment)
                                @php
                                    // Parse the JSON data from $treatment->treatment_info
                                    $data = json_decode($treatment->treatment_info, true);

                                    // Get the keys from the parsed JSON data and join them with commas
                                    $keys = implode(', ', array_keys($data));
                                @endphp
                                <option value="{{ $treatment->id }}">{{ $keys }} - {{ $treatment->treatment_date }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="city-column">Treatment Info</label>
                                <div class="row">
                                    <?php $i = 0; ?>
                                        @foreach($ReftreatmentList as $index => $treatment)
                                            <div class="col-md-12 col-12 d-flex checkboxinputBlock hideshowtreatment">
                                                <div class="col-md-4 col-12 col-sm-12 checkboxBlock mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="form-check-input form-check-primary" name="refTreat[{{$treatment['id']}}][checktreatment][]" id="{{$treatment['id']}}" value="{{$treatment['name']}}">
                                                        <!-- <input type="checkbox" class="form-check-input form-check-primary" name="refTreat[{{$treatment['id']}}][checktreatment][]" id="{{$treatment['id']}}" value="{{$treatment['name']."-".$index}}"> -->
                                                        <label class="form-check-label" for="{{$treatment['id']}}">{{$treatment['name']}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12 col-sm-12 px-2 inputBlock mb-3">
                                                    <label class="form-check-label" for="">Charge Amount</label>
                                                    <input type="text" class="form-control treatmentcharges" placeholder="Charges" name="refTreat[{{$treatment['id']}}][charges][]">
                                                </div>
                                                <div class="col-md-2 col-12 col-sm-12 inputBlock px-2 mb-3">
                                                    <label class="form-check-label" for="">Balance Amount</label>
                                                    <input type="text" class="form-control disab treatmentbalamount" placeholder="Balance Amount" name="refTreat[{{$treatment['id']}}][balance][]">
                                                </div>
                                                <div class="col-md-2 col-12 col-sm-12 inputBlock px-2 mb-3" style="display:none">
                                                    <input type="hidden" class="form-control disab treatmentoriginalbalamount" placeholder="Balance Amount" name="refTreat[{{$treatment['id']}}][originalbalance][]">
                                                </div>
                                                <div class="col-md-2 col-12 col-sm-12 inputBlock px-2 mb-3">
                                                    <label class="form-check-label" for="">Total Amount</label>
                                                    <input type="text" class="form-control disab treatmenttotalamount" placeholder="Total Amount" name="refTreat[{{$treatment['id']}}][remark][]">
                                                </div>
                                            </div>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                     
                        <label for="city-column">Total Paid Amount</label>
                            <div class="form-group">
                                <input type="text" id="total_amount" class="form-control onlynumbers disab" placeholder="" name="total_amount">
                            </div>
                        <label for="city-column">Balance Amount</label>
                            <div class="form-group">
                                <input type="text" id="remaining_amount" class="form-control onlynumbers disab" placeholder="" name="remaining_amount">
                            </div>
                        <label for="city-column">Total Amount</label>
                            <div class="form-group">
                                <input type="text" id="balance_amount" class="form-control onlynumbers disab" placeholder="" name="balance_amount">
                            </div>
                            <label for="city-column">Upload X-Rays</label>
                            <div class="form-group">
                                <input class="form-control" type="file" id="xrays_file" name="xrays_file[]"  multiple >
                            </div>
                        <label>Remarks</label>
                        <div class="form-group">
                            <textarea class="form-control" id="remarks" name="remarks"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closevisit" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1"
                            data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!--Edit Visit form Modal -->
    <div class="modal fade text-left" id="visitedit" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content Qcustom">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Visit</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="editvisitform">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="Evisit_id" id="Evisit_id">
                        <input type="hidden" name="EPatientvisit_id" id="EPatientvisit_id" value="{{$patientDetails->id}}">
                        <label>Date Of Visit</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control dateofbirth" id="Edate_of_visit" name="Edate_of_visit">
                        </div>
                        <div class="form-group">
                            <label>Treatment</label>
                            <select class="form-select" id="Etreatment" name="Etreatment">
                            <option value="">Please Select Treatment</option>
                                @foreach($treatmentlist as $treatment)
                                @php
                                    // Parse the JSON data from $treatment->treatment_info
                                    $data = json_decode($treatment->treatment_info, true);

                                    // Get the keys from the parsed JSON data and join them with commas
                                    $keys = implode(', ', array_keys($data));
                                @endphp
                                <option value="{{ $treatment->id }}">{{ $keys }} - {{ $treatment->treatment_date }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label>Total Paid Amount</label>
                            <div class="form-group">
                                <input type="text" id="Etotal_amount" class="form-control onlynumbers" placeholder="" name="Etotal_amount">
                                <input type="hidden" id="Echargetotal_amount" class="form-control onlynumbers" placeholder="" name="Echargetotal_amount">
                            </div>
                            <label for="city-column">Balance Amount</label>
                            <div class="form-group">
                                <input type="text" id="Eremaining_amount" class="form-control onlynumbers disab" placeholder="" name="Eremaining_amount">
                                <input type="hidden" id="Eoriginalremaining_amount" class="form-control onlynumbers disab" placeholder="" name="Eoriginalremaining_amount">

                            </div>
                        <label>Total Amount</label>
                            <div class="form-group">
                                <input type="text" id="Ebalance_amount" class="form-control onlynumbers disab" placeholder="" name="Ebalance_amount">
                            </div>
                            <label for="city-column">Upload X-Rays</label>
                            <div class="form-group">
                                <input class="form-control" type="file" id="Exrays_file" name="Exrays_file[]"  multiple >
                            </div>
                        <label>Remarks</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Eremarks" name="Eremarks">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1"
                            data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!--View Visit form Modal -->
    <div class="modal fade text-left" id="visitinfo" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content Qcustom">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">View Visit</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="viewvisitform">
                    @csrf
                    <div class="modal-body">
                        <label>Date Of Visit</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Vdate_of_visit" name="Vdate_of_visit" disabled>
                        </div>
                        <label>Treatment Done</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Vwork_done" name="Vwork_done" disabled>
                        </div>
                        <label>Total Paid Amount</label>
                            <div class="form-group">
                                <input type="text" id="Vtotal_amount" class="form-control onlynumbers" placeholder="" name="Vtotal_amount" disabled>
                            </div>
                        <label for="city-column">Balance Amount</label>
                            <div class="form-group">
                                <input type="text" id="Vremaining_amount" class="form-control onlynumbers" placeholder="" name="Vremaining_amount" disabled>
                            </div>
                        <label>Total Amount</label>
                            <div class="form-group">
                                <input type="text" id="Vbalance_amount" class="form-control onlynumbers" placeholder="" name="Vbalance_amount" disabled>
                            </div>
                            <label>X-Ray</label>
                            <div class="form-group" id="xrayContainer">
                                <!-- Images will be appended here -->
                            </div>
                        <label>Remarks</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Vremarks" name="Vremarks" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--View view_details form Modal -->
    <div class="modal fade text-left" id="visitdetails" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content Qcustom">
            <div class="card">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Visits</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-min-width" id="viewdetailtablelist">
                        <thead>
                            <tr>
                                <th>Visit Id</th>
                                <th>Treatments</th>
                                <th>Paid</th>
                                <th>Balance Amount</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Treatment view form model -->
    <div class="modal fade text-left" id="treatmentinfo" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">View Treatments</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="viewtreatmentform">
                    @csrf
                    <div class="modal-body">
                        <label>Treatment Date</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Vtreatment_date" name="Vtreatment_date" disabled>
                        </div>
                        <label>Tooth Number</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Vtooth_number" name="Vtooth_number" disabled>
                        </div>
                        <label>Treatment Info</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="Vtreatment_info" name="Vtreatmentinfo" disabled>
                        </div>
                        <label>Diagnosis</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="Vtreatment_diagnosis" name="Vtreatmentdiagnosis" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
 
    <!--View Lab Order form Modal -->
    <div class="modal fade text-left" id="viewPrescription" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content Qcustom">
                <div class="card" id="printTbl">
                    <div class="modal-header">
                	<!-- <img id="pre_logo"  alt="Logo" srcset="" style="height: 60px; width: 140px; object-fit: contain;"> -->
                    <h6></h6>
                    <a href="#"><button id="printDiv" type="button" class="btn btn-outline-primary float-end print-button" onclick="printDiv('printTbl')">Print</button></a>
                    </div>
                    <div style="display:flex;">
		                <div class="modal-body modal-title" style="display:flex;justify-content:center;visibility: hidden;" id="">
                            <img id="pre_logo"  alt="Logo" srcset="" style="height: 150px; width: 300px; object-fit: contain; border-bottom :1px solid">
                            <h6 class="modal-title" id="pview_textlogo"  style="font-size: 1.8rem;"></h6>
		                </div>
	            	</div>
                    <br>
                    <br>
                    <br>
                    <div style="font-size:16px; display:flex;justify-content:flex-end;" ><b style="">Date :</b><span style="margin-left:30px"> {{  date('d-M-Y') }}</span></div>
                    <div style="font-size:16px;margin-top:12px;" ><b style="">Name :</b><span style="margin-left:30px">{{ $patientDetails->name }}</span></div>
                    <div style="margin-top:12px;font-size:16px;"><b style="">Age :</b><span style="margin-left:30px">{{ $patientDetails->age }}</span><span style="margin-left:100px" ><b style="">Sex :</b><span style="margin-left:30px">{{ $patientDetails->sex == 1 ? 'Male' : 'Female ' }}</span></span> <span style="margin-left:100px"><b style="">Email Id :</b><span style="margin-left:30px">{{ $patientDetails->email }}</span></span></div>
                    <div style="margin-top:12px;font-size:16px;"><b style="">Address :</b><span style="margin-left:30px">{{ $patientDetails->address }}</span></div>
                    <div style="margin-top:12px;font-size:16px;"><b style="">Phone No :</b><span style="margin-left:30px">{{ $patientDetails->contact_1 }}</span></div>
                    <br>
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel33">Prescriptions</h5>
                        <button type="button" class="close print-button" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-min-width" id="viewdetailprescription">
                            <thead>
                                <tr>
                                    <th  style="border: 0; border-bottom: 1px solid !important; padding: 16px 16px;text-align:left">Medicine Name</th>
                                    <th  style="border: 0; border-bottom: 1px solid !important; padding: 16px 16px;text-align:left">Number Of Times</th>
                                    <!-- <th  style="border: 0; border-bottom: 1px solid !important; padding: 16px 16px;text-align:center">Before/After</th> -->
                                    <th  style="border: 0; border-bottom: 1px solid !important; padding: 16px 16px;text-align:left">Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        @if($signature)
                            <img src="{{ $signature }}" style="float:right;position:absolute;bottom:80px;right:5px; font-size:15px;" alt="Signature" height="80px" width="180px">
                        @else
                            <p style="float:right;position:absolute;bottom:80px;right:5px; font-size:15px;">No signature available</p>
                        @endif
                        <span style="float:right;position:absolute;bottom:80px;right:5px; font-size:15px;"><b>Doctor's Signature</b></span>
                        <div style="border-top: 1px solid #000;padding-top: 8px;position:absolute;bottom:0px;width:100vw" >
                            <p style="color: #000; text-align:center; font-family:Times New Roman">Siddhesh Optimus, Office No. 7, B Wing, First Floor, Sr.No. 211/1/7, Opposite Lunkad Queensland Society, Near Konark Epitome, Vimannagar, Pune - 14.</p> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="confirmdownloadsummary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Are You Really Want to Download Summary</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">No</span>
                        </button>
                        <button type="button" onclick=downloadDB() class="btn btn-primary ml-1"
                            data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Yes</span>
                        </button>
                    </div>
            </div>
        </div>
    </div>
  

@endsection
@section('jsscript')
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script>
        function downloadDB(){
            window.location.href = "{{ url('visitsummary'.'/'.$patientDetails->id) }}";
        }
    </script>

    <script>
        $(document).ready(function () {

            var showField = '{{ request()->query('addTreat') }}';
            if (showField === 'yes') {
                var myModal = new bootstrap.Modal(document.getElementById('inlineForm'));
                 myModal.show();
            }

                $('.drname').text('Dr. Gowthaman P. R.')
                $('.drnumber').text('9940066956')
                $('.drdeg').text('M.D.S., Oral And Maxillofacial Surgeon')
                $('.dremail').text('brammacbe@gmail.com')
        });
    </script>
    
    <!-- for full screen image -->
    <!-- <script>
        document.querySelectorAll('.thumbnail').forEach((thumbnail) => {
            thumbnail.addEventListener('click', () => {
                const fullScreenImage = thumbnail.nextElementSibling;
                fullScreenImage.style.display = 'flex';
            });

            thumbnail.nextElementSibling.addEventListener('click', () => {
                thumbnail.nextElementSibling.style.display = 'none';
            });
        });
    </script> -->
    <script>
        document.querySelectorAll('.thumbnail').forEach((thumbnail) => {
            thumbnail.addEventListener('click', () => {
                const fullScreenImage = thumbnail.nextElementSibling;
                fullScreenImage.style.display = 'flex';

                // Add a click event listener to the rotation icon
                const rotateIcon = fullScreenImage.querySelector('.rotate-icon');
                rotateIcon.addEventListener('click', () => {
                    // Toggle a CSS class to rotate the image
                    fullScreenImage.classList.toggle('rotate');
                });
            });

            thumbnail.nextElementSibling.addEventListener('click', () => {
                thumbnail.nextElementSibling.style.display = 'none';
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Function to calculate total paid amount
           
            $(document).on("change", "input.treatmentcharges", function () {
                var chargesInput = $(this).val();
                var chargesValue = parseFloat(chargesInput) || 0;

                var balInput = $(this).closest(".checkboxinputBlock").find(".treatmentbalamount");
                var balValue = parseFloat(balInput.val()) || 0;

                var originalbalInput = $(this).closest(".checkboxinputBlock").find(".treatmentoriginalbalamount");
                var originalbalValue = parseFloat(originalbalInput.val()) || 0;

                var remainingInput = $(this).closest(".checkboxinputBlock").find(".treatmentbalamount");

                var balance = originalbalValue - chargesValue;
                
                remainingInput.val(balance);

                // ------
                if(chargesValue > balValue ){
                    alert("Charge Amount is Greater Than Balance Amount");
                    var chargeInput = $(this).closest(".checkboxinputBlock").find(".treatmentcharges");
                    var chargesValue = parseFloat(chargesInput) || 0;
                    var balInput = $(this).closest(".checkboxinputBlock").find(".treatmentbalamount");
                    var balValue = parseFloat(balInput.val()) || 0;
                    var remainingInput = $(this).closest(".checkboxinputBlock").find(".treatmentbalamount");
                    tot = chargesValue + balValue;
                    remainingInput.val(tot);
                    chargeInput.val('');
                    $('#treatment').trigger('refresh');
                }

                // ------
                
                var totalAmount = 0;
                var balAmount = 0;
                var remAmount = 0;
                
                // Loop through each checkbox input with name attribute starting with "refTreat"
                $("input[name^='refTreat']:checked").each(function () {
                    var chargesInput = $(this).closest(".checkboxinputBlock").find("input[name$='[charges][]']");
                    var chargesValue = parseFloat(chargesInput.val()) || 0;
                    
                    totalAmount += chargesValue;
                });

                $("input[name$='[remark][]']").each(function () {
                    var balInput = $(this).closest(".checkboxinputBlock").find("input[name$='[remark][]']");
                    var balValue = parseFloat(balInput.val()) || 0;
                    
                    balAmount += balValue;
                });
                 $("input[name$='[balance][]']").each(function () {
                    var remInput = $(this).closest(".checkboxinputBlock").find("input[name$='[balance][]']");
                    var remValue = parseFloat(remInput.val()) || 0;
                    
                    remAmount += remValue;
                });
                
                // Update the total_amount input field
                $("#total_amount").val(totalAmount.toFixed(2));
                $("#balance_amount").val(balAmount.toFixed(2));
                $("#remaining_amount").val(remAmount.toFixed(2));

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Attach a change event listener
            $('#treatment').on('change', function() {
                // Get the selected value
                var selectedValue = $(this).val();
                console.log(selectedValue);

                $.ajax({
                    type: 'GET', // Change the HTTP method as needed
                    url: "{{ url('/gettreatdata') }}/" + selectedValue, // Concatenate the selected value to the URL
                    data: {"Id": selectedValue, "_token": $("input[name='_token']").val()},
                    success: function(response) {
                        var keys = Object.keys(response.data);

                        @foreach($ReftreatmentList as $index => $treatment)
                            // Check if the treatment name is in the keys array
                            var treatmentName = '{{$treatment['name']}}';
                            if (keys.includes(treatmentName)) {
                                // Find the corresponding input field and set its value
                                var chargesInput = $('input[name="refTreat[{{$treatment['id']}}][remark][]"]');
                                var balInput = $('input[name="refTreat[{{$treatment['id']}}][balance][]"]');
                                var originalbalInput = $('input[name="refTreat[{{$treatment['id']}}][originalbalance][]"]');
                                var chargesValue = response.data[treatmentName]; // Replace with the actual data structure from your response
                                var balValue = response.data[treatmentName]; // Replace with the actual data structure from your response
                                var originalbalValue = response.data[treatmentName]; // Replace with the actual data structure from your response
                                // console.log("sasasasasa",chargesValue)
                                // Update the charges input field with the value
                                chargesInput.val(chargesValue.charges);
                                balInput.val(balValue.balance);
                                originalbalInput.val(originalbalValue.balance);

                                // Add a class to the corresponding div element
                                $('div.checkboxinputBlock:eq({{$index}})').removeClass('hideshowtreatment');
                            } else {
                                // Check if the checkbox is checked
                                var isChecked = $('input[name="refTreat[{{$treatment['id']}}][checktreatment][]"]').prop('checked');

                                // If the checkbox is checked, uncheck it
                                if (isChecked) {
                                    $('input[name="refTreat[{{$treatment['id']}}][checktreatment][]').prop('checked', false);
                                    $('input[name="refTreat[{{$treatment['id']}}][charges][]').prop('disabled', true);
                                }
                                $('#treatment').trigger('refresh');
                                // If the treatment is not in the response data, you can clear the input field
                                $('input[name="refTreat[{{$treatment['id']}}][charges][]"]').val('');
                                $('input[name="refTreat[{{$treatment['id']}}][remark][]"]').val('');
                                $('input[name="refTreat[{{$treatment['id']}}][balance][]"]').val('');

                                $("#total_amount").val('');
                                $("#balance_amount").val('');
                                $("#remaining_amount").val('');

                                // Add or remove the class based on your logic
                                $('div.checkboxinputBlock:eq({{$index}})').addClass('hideshowtreatment');
                            }
                        @endforeach
                        console.log(keys);
                    }
                });
               
            }); 
            printDiv = function (divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();
            window.location.reload(true);

            document.body.innerHTML = originalContents;
            $(".modal-backdrop").css("display", "none");
            $('body').removeAttr("style");
            $('#previewtable').modal('show');
        }
        });
        </script>


    <script>
        $(document).ready(function() {


        // Get all treatment checkboxes
            const treatmentCheckboxes = document.querySelectorAll('input[name^="refTreat["][name$="][checktreatment][]"]');

            // Get all charges and remark fields
            const chargesFields = document.querySelectorAll('input[name^="refTreat["][name$="][charges][]"]');
            const remarkFields = document.querySelectorAll('input[name^="refTreat["][name$="][remark][]"]');

            // Disable all charges and remark fields by default
            chargesFields.forEach((field) => {
                field.disabled = true;
            });

            remarkFields.forEach((field) => {
                field.disabled = true;
            });

            // Add an event listener to each checkbox
            treatmentCheckboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', function () {
                    // Get the corresponding charges and remark fields
                    const chargesField = this.closest('.checkboxinputBlock').querySelector('input[name^="refTreat["][name$="][charges][]"]');
                    const remarkField = this.closest('.checkboxinputBlock').querySelector('input[name^="refTreat["][name$="][remark][]"]');

                    if (this.checked) {
                        // If the checkbox is checked, enable the fields
                        chargesField.disabled = false;
                        remarkField.disabled = false;
                    } else {
                        // If the checkbox is unchecked, disable the fields
                        var chargeInput = $(this).closest(".checkboxinputBlock").find(".treatmentcharges");
                        chargeInput.val('');
                        chargesField.disabled = true;
                        remarkField.disabled = true;
                    }
                });
            });

            //to submit visit
            $("form#addVisitForm").submit(function(e){
                var $this = $(this);
                var formData = new FormData(this);

                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ route('addVisit', [ Request::segment(2) ]) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false, 
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
                                window.location.href = "{{ url('/patientview').'/'.Request::segment(2) }}";
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

            // get data of edit visit
            $(document).on("click", ".edit_visit", function(){    
                var id = $(this).data('id');
                console.log(id);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ route('getvisitdata') }}",
                    type: "GET",
                    data: {"visitid": id, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                         $("#overlay").fadeOut(300);
                        $("#Evisit_id").val(response.data.id);
                        $("#Edate_of_visit").val(response.data.date_of_visit);
                        $("#Etreatment").val(response.data.work_done);
                        $("#Etotal_amount").val(response.data.total_amount);
                        $("#Echargetotal_amount").val(response.data.total_amount);
                        $("#Ebalance_amount").val(response.data.balance_amount);
                        $("#Eremaining_amount").val(response.data.remaining_amount);
                        $("#Eoriginalremaining_amount").val(response.data.remaining_amount);
                        $("#Eremarks").val(response.data.remark);
                        // Handling "Number Of Times" checkboxes
                        var selectedTimes = response.data.consultation_fee.split(', ');

                        $("#Econsultation_fee").prop('checked', selectedTimes.includes('Consultation fee'));
                        $("#Ex_ray").prop('checked', selectedTimes.includes('X-ray'));
                        $("#Eroot_canal").prop('checked', selectedTimes.includes('Root canal'));

                     
                    }
                });
            });

            // To Update visit
            $("form#editvisitform").submit(function(e){
                var $this = $(this);
                var formData = new FormData(this);
                var paiAmt = parseFloat($('#Epaid_amount').val()); // Parse as float
                    paiAmt = Math.floor(paiAmt);

                    $("#overlay").fadeIn(300);
                    $.ajax({
                        url: "{{ route('updateVisit') }}",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false, 
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
                                    window.location.href = "{{ url('/patientview').'/'.Request::segment(2) }}";
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


            // get data of view visit
            $(document).on("click", ".view_visit", function(){    
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "{{ route('viewvisitdata') }}",
                    type: "GET",
                    data: {"visitid": id, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {

                        var xraysArray = JSON.parse(response.data.xrays);
                        console.log("response",xraysArray[0]);

                        $("#Vvisit_id").val(response.data.id);
                        $("#Vdate_of_visit").val(response.data.date_of_visit);
                        $("#Vtotal_amount").val(response.data.total_amount);
                        $("#Vbalance_amount").val(response.data.balance_amount);
                        $("#Vremaining_amount").val(response.data.remaining_amount);
                        $("#Vremarks").val(response.data.remark);

                        $("#xrayContainer").html('');
                        $.each(xraysArray, function (index, report) {
                            var imageUrl = "{{ asset('Xrays/') }}" + '/' + report;
                            var imageElement = '<img src="' + imageUrl + '" style="height:100px !important; width:150px !important; border:1px solid" alt="Image" />';
                            $("#xrayContainer").append(imageElement);
                        });
                        // Decode the JSON data into a PHP array
                        var data = JSON.parse(response.data.treatinfo);
                        // Get the keys from the array and join them with commas
                        var keys = Object.keys(data).join(', ');
                        $("#Vwork_done").val(keys);
                    }
                });
            });

            // get data of view visit
            $(document).on("click", ".view_details", function(){    
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "{{ route('viewdetailsvisitdata') }}",
                    type: "GET",
                    data: {"visitid": id, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {

                        var tableBody = $("body #viewdetailtablelist tbody");
                        tableBody.empty();
                        // Iterate over the response data and append rows to the table
                        $.each(response.data, function(index, data) {
                            // console.log(data);
                            var row = $("<tr>");
                            row.append($("<td>").text(data.id));
                            row.append($("<td>").text(data.treatment));
                            row.append($("<td>").text(data.charges));
                            row.append($("<td>").text(data.balance_amt));
                            row.append($("<td>").text(data.total_amount));
                            tableBody.append(row);
                        });

                        // console.log(response.data);
                    }
                });
            });

            //to delete visit
            $(document).on("click", ".delete_visit", function(){    
                var id = $(this).data('id');
                var patientid = $(this).data('patient-id');
                console.log(id);
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Visit\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);
                        $.ajax({
                            url: "{{ route('deleteVisitdata') }}",
                            type: "DELETE",
                            data: {"visitedid": id, "patientsid": patientid, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/patientview').'/'.Request::segment(2) }}";
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

            // get data of view treatment
            $(document).on("click", ".view_tratment", function(){    
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "{{ route('get_treatmentdata') }}",
                    type: "GET",
                    data: {"Treatmentid": id, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {

                        $("#Vtreatment_id").val(response.data.id);
                        $("#Vtreatment_date").val(response.data.treatment_date);
                        $("#Vtooth_number").val(response.data.tooth_number);
                        
                        // Decode the JSON data into a PHP array
                        var data = JSON.parse(response.data.treatment_info);
                        // Get the keys from the array and join them with commas
                        var keys = Object.keys(data).join(', ');

                        $("#Vtreatment_info").val(keys);
                        $("#Vtreatment_diagnosis").val(response.data.diagnosis);
                    }
                });
            });
           
            // get data of view lab order
            $(document).on("click", ".view_prescription", function(){    
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "{{ route('getinfoprescriptiondata') }}",
                    type: "GET",
                    data: {"prescriptionid": id, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                        $('#billNo').text(response.data[0]['master_id']);

                        var tableBody = $("body #viewdetailprescription tbody");
                        tableBody.empty();
                        // Iterate over the response data and append rows to the table
                        $.each(response.data, function(index, data) {
                            // console.log(data);
                            var row = $("<tr>");
                            row.append($("<td>").text(data.medicine_name).css("text-align", "left"));
                            row.append($("<td>").text(data.number_of_times).css("text-align", "left"));
                            // row.append($("<td>").text(data.before_after).css("text-align", "center"));
                            row.append($("<td>").text(data.remarks).css("text-align", "left"));
                            tableBody.append(row);
                        });

                        
                    }
                });
            });

           
           
            //to delete Treatment
            $(document).on("click", ".delete_treatment", function(){    
                var id = $(this).data('id');
                console.log(id);
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Treatment\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);
                        $.ajax({
                            url: "{{ route('deletetreatmentdata') }}",
                            type: "DELETE",
                            data: {"treatmentdid": id, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/patientview').'/'.Request::segment(2) }}";
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

            // to delete doctor data from doctor list 
            $(document).on("click", ".delete_lab_order", function(){ 
                var doctorid = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Treatment\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);    
                        $.ajax({
                            url: "{{ url('/deletelabnotedata') }}",
                            type: "DELETE",
                            data: {"doctorid": doctorid, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/patientview').'/'.Request::segment(2) }}";
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

            

            //to delete Lab order
            $(document).on("click", ".delete_prescription", function(){    
                var id = $(this).data('id');
                console.log(id);
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Prescription\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);
                        $.ajax({
                            url: "{{ route('deletePrescriptiondata') }}",
                            type: "DELETE",
                            data: {"prescriptionid": id, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/patientview').'/'.Request::segment(2) }}";
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


            // To apply datatable Visit Table
            table = $("#tablelist").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    title: 'Visit-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'desc']],
                'columnDefs': [ {
                'targets': [5], // column index (start from 0)
                'orderable': true, // set orderable false for selected columns
                }]
            });

            // To apply datatable Treatment Table
            table = $("#tablelist1").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    extend: 'csv',
                    title: 'Treatment-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [5], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });

            // To apply datatable Treatment Table
            table = $("#tablelist2").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    extend: 'csv',
                    title: 'Lab-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [6], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });

            // To apply datatable Treatment Table
            table = $("#tablelist3").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    extend: 'csv',
                    title: 'Lab-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [2], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });

            table = $("#tablelist4").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    title: 'Consent-List'
                } ],
                'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                'pageLength': 50, // sets the default number of rows per page to 50
                'searching': true,
                'ordering': true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [5], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });

            // To delete patient
            $(document).on("click", ".deletepatient", function(){ 
                var patientid = {{$patientDetails->id}};
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this patient\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) { 
                        $("#overlay").fadeIn(300);   
                        $.ajax({
                            url: "{{ route('deletepatientdata') }}",
                            type: "DELETE",
                            data: {"patientid": patientid, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/patientlist') }}";
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
           
            $(function(){
                $(".dateofbirth").datepicker({ 
                    dateFormat: 'dd-M-yy',
                    changeYear: true,
                    changeMonth: true,
                    yearRange: "c-150:c+150"
                });
                $(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
            });

            $('#inlineForm, #newLabOrder, #EnewLabOrder,#laborderedit, #visitinfo, #visitedit, #treatmentinfo, #selectteethModal, #EselectteethModal, #viewLabOrder, #viewPrescription').modal({
                backdrop: 'static',
                keyboard: false
            });

            $("#EsaveselectedTeeth").click(function () {
            // Show the modal
                $("#laborderedit").modal("show");
            });

            $("#closevisit").click(function() {
                // Reload the page when the button is clicked
                location.reload();
            });

            // to delete patient data from patient list 
            $(document).on("click", ".deleteconsent", function(){ 
                var consentid = $(this).data('id');
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
                                        window.location.href = "{{ url('/patientview').'/'.Request::segment(2) }}";
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

          
    });
        
    </script>
    <script>
        $(document).ready(function() {
        // Function to calculate balance amount
        
        function calculateBalance() {
            var charge = parseFloat($("#Echargetotal_amount").val()) || 0;
            var totalAmount = parseFloat($("#Etotal_amount").val()) || 0;
            var remainingAmount = parseFloat($("#Eremaining_amount").val()) || 0;
            var originalremainingAmount = parseFloat($("#Eoriginalremaining_amount").val()) || 0;

            var chargeamount =  totalAmount - charge ;
            // Calculate balance amount
            var balanceAmount = originalremainingAmount - chargeamount;

            // Update the Balance Amount field
            $("#Eremaining_amount").val(balanceAmount.toFixed(2));
        }

        // Attach the function to the input change event
        $("#Etotal_amount").on("change", calculateBalance);
        });
    </script>
     <script>
		var pview_textlogo = '{{ env('TEXT_LOGO') }}';
		var pre_logo = '{{ env('IMG_LOGO') }}';
        var imgElement = document.getElementById('pre_logo');
        imgElement.src = pre_logo;
        $('#pview_textlogo').text(pview_textlogo);

        if (pview_textlogo && pview_textlogo.trim() !== '') {
        // If textLogo is not empty, hide the image elements
            imgElement.style.display = 'none';
        } else {
            // If textLogo is empty or null, display the image elements
            imgElement.src = imgLogo;
        }
	</script>
@endsection