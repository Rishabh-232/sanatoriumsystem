@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/choices.css') }}">
<style>

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
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Patient List</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                        @if (strpos($package[0]['access_to_page'], 'Send Message') !== false)   
                        <a type="button" id="sendButton" data-bs-toggle="modal" data-bs-target="#custmessage" id="" class="btn btn-info float-end" style="margin-right:10px" >Send Message</a>
                        @endif
                    @endif
                    <a href="{{ url('/patientadd') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger for login form modal -->
                    <!-- <a href="{{ url('/patientadd') }}"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a> -->
                </div>
                <div class="card-body table-responsive asd">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th class="table-min-width-small"><input type="checkbox" id="select-all"></th>
                                <th class="table-min-width-small">Sr. No.</th>
                                <th class="table-min-width-small">Patient Id</th>
                                <th class="table-min-width-small">Name</th>
                                <th>Date of Birth</th>
                                <th class="table-min-width-small">Age</th>
                                <th class="table-min-width-small">Attended By</th>
                                <th>Primary Number</th>
                                <th class="table-min-width-small">Insurance</th>
                                <th class="table-min-width-small">Consent Form</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($patientList as $patient)
                                <tr>
                                    <td class="table-min-width-small">
                                        <input type="checkbox" class="checkbox-class" data-id="{{ $patient->contact_1 }}">
                                    </td>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td class="table-min-width-small">{{ $patient->patient_uniq_id }}</td>
                                    <td class="table-min-width-small">{{ $patient->name }}</td>
                                    <td>@if($patient->date_of_birth == '')
                                        @else
                                        {{ date('d-M-Y', strtotime($patient->date_of_birth)) }}
                                        @endif
                                    </td>
                                    <td class="table-min-width-small">{{ $patient->age }}</td>
                                    <td class="table-min-width-small">{{ $patient->attended_by }}</td>
                                    <td>{{ $patient->contact_1 }}</td>
                                    <td class="table-min-width-small">{{ $patient->patient_insurance }}</td>
                                    <td class="table-min-width-small">{{ $patient->consent_form }}</td>
                                    <td class="button-holder">
                                        <a data-bs-toggle="modal" data-bs-target="#addQuoteModal" class="btn btn-outline-success add_quote" data-id="{{$patient->id}}">Treatment Plan</a>
                                        <a href="{{ url('patientview'."/".$patient->id) }}" class="btn btn-outline-info">View</a>
                                        <a href="{{ url('patientedit'."/".$patient->id) }}" class="btn btn-outline-warning">Edit</a>
                                        <!-- <a href="Javascript:void(0)" class="btn btn-outline-info x-ray-btn">X-Ray</a>
                                     -->
                                     <a href="{{ url('xrays'.'/'.$patient->id) }}" class="btn btn-outline-info mb-0">X-Ray</a>
                                        <a id="deleteperson" class="btn btn-outline-danger deletepatient" data-id="{{$patient->id}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic Tables end
    </div>

    <!-- Add Quote form Modal -->
    <div class="modal fade text-left" id="addQuoteModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content Qcustom">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Treatment plan</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="Quoteform">
                                 @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group pad">
                                <label for="quote_date">Date</label>
                                <input type="text" id="quote_date" class="form-control dateofbirth" placeholder="" name="quote_date">
                            </div>
                        </div> 
                        <div class="col-md-6 col-12">
                            <div class="form-group pad">
                                <label for="patient_name">Patient</label>
                                <fieldset class="form-group">
                                    <select class="form-select" style="pointer-events:none !important" id="patient_name" name="patient_name">
                                        @foreach($patientList as $patient)  
                                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                        </div> 
                        <div class="col-md-6 col-12">
                            <div class="form-group pad">
                                <label>Treatment</label>
                                <select class="js-example-basic-multiple form-select" id="treatment" name="treatment[]" multiple="multiple" required>
                                    @foreach($treatmentsWithCharges as $treatment)
                                        <option value="{{ $treatment->name }}" data-charges1="{{ $treatment->charge_one }}" data-charges2="{{ $treatment->charge_two }}" data-charges3="{{ $treatment->charge_three }}">{{ $treatment->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
 
                        <div class="col-md-6 col-12">
                            <div class="form-group pad">
                                <label for="lab_order_date">Teeth Numbers</label>
                                <div class="form-group mt-1">
                                    <a id="selectteeth" href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#selectteethModal">Select Teeth</a>
                                    <input type="hidden" name="selectedteeth" id="selectedteeth">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group pad">
                                <label for="doctor_name">Doctor</label>
                                <fieldset class="form-group">
                                    <select class="form-select" id="doctor_name" name="doctor_name">
                                        @foreach($doctorlist as $doctor)  
                                            <option value="{{ $doctor->id }}">{{ $doctor->doctor_name }}</option>

                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                        </div> 
                    </div>
                    <hr>

                <!-- Basic Tables start -->
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div id="prinQuoteTable" class="card-body table-responsive">
                            <table class="table table-min-width" id="chargesTable">
                                <thead>
                                    <tr>
                                        <th class="table-min-width-small">Sr. No.</th>
                                        <th class="table-min-width-small">Treatment</th>
                                        <th class="table-min-width-small">Charges Option1</th>
                                        <th class="table-min-width-small">Charges Option2</th>
                                        <th class="table-min-width-small">Charges Option3</th>
                                        <th class="table-min-width-small">Discount</th>
                                        <!-- <th class="table-min-width-small">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                            <tr>
                                <td colspan="2"><strong>Total:</strong></td>
                                <td><input type="text" id="chargeone" name="chargeone"  class="form-control total-charge1" readonly></td>
                                <td><input type="text" id="chargetwo" name="chargetwo"  class="form-control total-charge2" readonly></td>
                                <td><input type="text" id="chargethree" name="chargethree"  class="form-control total-charge3" readonly></td>
                                <td><input type="text" id="discount" name="discount"  class="form-control total-discount" readonly></td>
                                <td></td>
                            </tr>
                        </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                        <button  type="button" class="btn btn-light-secondary me-1 mb-1"  data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- custom message send  -->
        <div class="modal fade text-left" id="custmessage" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content Qcustom">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Send Custom Message</h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="content" id="emailpopup">
                        <div id="overlay">
                            <div class="cv-spinner">
                            <span class="spinner"></span>
                            </div>
                        </div>
                        <form class="form" id="custommessageform">
                        @csrf
                            <div class="col-md-6 col-12" style="margin:20px;width:90%">
                                <button type="button" id="clearimg" class="btn btn-light me-1 mb-1" style="float:right">Clear</button>
                                <div class="form-group">
                                    <label><b>Select Image (Max 5MB)</b></label>
                                    <img id="image_preview" src="#" alt="Preview" style="display: none; width: 100%; margin-bottom:20px; height: 200px;">
                                    <input type="file" class="form-control" id="image_file" name="image_file[]">
                                </div>
                                <div class="form-group">
                                    <label for="city-column"><b>Message</b></label>
                                    <textarea class="form-control" id="Cmessage" name="Cmessage" style="height:200px" placeholder="Enter Message Here"></textarea>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" id="sendCustomMessage" class="btn btn-primary me-1 mb-1">Send</button>
                                <button  type="button" class="btn btn-light-secondary me-1 mb-1"  data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
 


    <!--Select Teeth Modal -->
    <div class="modal fade text-left" id="selectteethModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Teeth Selection</h4>
                    <div>
                        <button type="button" id="selectUpperLeftTeeth" class="btn btn-outline-secondary">
                            UL
                        </button>
                        <button type="button" id="selectUpperRightTeeth" class="btn btn-outline-secondary">
                            UR
                        </button>
                        <button type="button" id="selectLowerLeftTeeth" class="btn btn-outline-secondary">
                            LL
                        </button>
                        <button type="button" id="selectLowerRightTeeth" class="btn btn-outline-secondary">
                            LR
                        </button>
                        <button type="button" id="selectUpperAllTeeth" class="btn btn-outline-secondary">
                            UR All
                        </button>
                        <button type="button" id="selectLowerAllTeeth" class="btn btn-outline-secondary">
                            LR All
                        </button>
                        <button type="button" id="selectallTeeth" class="btn btn-outline-secondary">
                            All
                        </button>
                        <button type="button" id="deselectallTeeth" class="btn btn-outline-secondary">
                            Uncheck All
                        </button>
                    </div>
                    <button type="button" class="close" data-bs-toggle="modal" data-bs-target="#newLabOrder">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="selectTeethform">
                    @csrf
                    <div class="modal-body">
                        <div class="teethBlock d-flex flex-column">
                            <div class="teethsection d-flex">
                                <div class="d-flex border-bottom border-end border-dark">
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/18.jpg') }}" data-id="18">
                                        <p>18</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/17.jpg') }}" data-id="17">
                                        <p>17</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/16.jpg') }}" data-id="16">
                                        <p>16</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/15.jpg') }}" data-id="15">
                                        <p>15</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/14.jpg') }}" data-id="14">
                                        <p>14</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/13.jpg') }}" data-id="13">
                                        <p>13</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/12.jpg') }}" data-id="12">
                                        <p>12</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/11.jpg') }}" data-id="11">
                                        <p>11</p>
                                    </div>
                                </div>
                                <div class="d-flex border-bottom border-dark">
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/21.jpg') }}" data-id="21">
                                        <p>21</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/22.jpg') }}" data-id="22">
                                        <p>22</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/23.jpg') }}" data-id="23">
                                        <p>23</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/24.jpg') }}" data-id="24">
                                        <p>24</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/25.jpg') }}" data-id="25">
                                        <p>25</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/26.jpg') }}" data-id="26">
                                        <p>26</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/27.jpg') }}" data-id="27">
                                        <p>27</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/28.jpg') }}" data-id="28">
                                        <p>28</p>
                                    </div>
                                </div>
                            </div>
                            <div class="teethsection d-flex">
                                <div class="d-flex border-end border-dark">
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/48.jpg') }}" data-id="48">
                                        <p>48</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/47.jpg') }}" data-id="47">
                                        <p>47</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/46.jpg') }}" data-id="46">
                                        <p>46</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/45.jpg') }}" data-id="45">
                                        <p>45</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/44.jpg') }}" data-id="44">
                                        <p>44</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/43.jpg') }}" data-id="43">
                                        <p>43</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/42.jpg') }}" data-id="42">
                                        <p>42</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/41.jpg') }}" data-id="41">
                                        <p>41</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/31.jpg') }}" data-id="31">
                                        <p>31</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/32.jpg') }}" data-id="32">
                                        <p>32</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/33.jpg') }}" data-id="33">
                                        <p>33</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/34.jpg') }}" data-id="34">
                                        <p>34</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/35.jpg') }}" data-id="35">
                                        <p>35</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/36.jpg') }}" data-id="36">
                                        <p>36</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/37.jpg') }}" data-id="37">
                                        <p>37</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/38.jpg') }}" data-id="38">
                                        <p>38</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="saveselectedTeeth" class="btn btn-primary ml-1" data-bs-toggle="modal" data-bs-target="#newLabOrder">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save & Close</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- X-Ray Image show start -->
    <!-- <div class="x-ray-images hide-xray">
        <div class="close-x-ray">
            <img src="{{URL::asset('/assets/images/close-icon.svg')}}" />
        </div>
        <div class="spotlight-group">
            <a class="spotlight" href="{{URL::asset('/assets/images/X-Ray/X-ray-1.png')}}">
                <img src="{{URL::asset('/assets/images/X-Ray/X-ray-1.png')}}" />
                <span>X-Ray 1</span>
            </a>
            <a class="spotlight" href="{{URL::asset('/assets/images/X-Ray/X-ray-2.png')}}">
                <img src="{{URL::asset('/assets/images/X-Ray/X-ray-2.png')}}" />
                <span>X-Ray 2</span>
            </a>
            <a class="spotlight" href="{{URL::asset('/assets/images/X-Ray/X-ray-3.png')}}">
                <img src="{{URL::asset('/assets/images/X-Ray/X-ray-3.png')}}" />
                <span>X-Ray 3</span>
            </a>
            <a class="spotlight" href="{{URL::asset('/assets/images/X-Ray/X-ray-4.png')}}">
                <img src="{{URL::asset('/assets/images/X-Ray/X-ray-4.png')}}" />
                <span>X-Ray 4</span>
            </a>
            <a class="spotlight" href="{{URL::asset('/assets/images/X-Ray/X-ray-5.png')}}">
                <img src="{{URL::asset('/assets/images/X-Ray/X-ray-5.png')}}" />
                <span>X-Ray 5</span>
            </a>
            <a class="spotlight" href="{{URL::asset('/assets/images/X-Ray/X-ray-6.png')}}">
                <img src="{{URL::asset('/assets/images/X-Ray/X-ray-6.png')}}" />
                <span>X-Ray 6</span>
            </a>
            <a class="spotlight" href="{{URL::asset('/assets/images/X-Ray/X-ray-7.png')}}">
                <img src="{{URL::asset('/assets/images/X-Ray/X-ray-7.png')}}" />
                <span>X-Ray 7</span>
            </a>
        </div>
    </div> -->
    <!-- X-Ray Image show end -->

@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
		var instantInstanceId = '{{ env('INSTANT_INSTANCE_ID') }}';
		var instantAccessToken = '{{ env('INSTANT_ACCESS_TOKEN') }}';
		console.log('zzzzzz',instantInstanceId)
	</script>

    <script>
        $(document).ready(function() {
            $("#select-all").on('click', function() {
                // Get the state of the "Select All" checkbox
                var isChecked = $(this).prop('checked');
    
                // Set the state of all checkboxes in the table
                $('input.checkbox-class').prop('checked', isChecked);
                
                var checkedIds = [];
                $('.checkbox-class:checked').each(function() {
                    checkedIds.push($(this).data('id'));
                });
    
                // Check if at least one checkbox is checked
                if (checkedIds.length > 0) {
                    $('#sendButton').removeClass('disabled'); // Enable the button
                } else {
                    $('#sendButton').addClass('disabled'); // Disable the button
                }
            });

            $('.checkbox-class').on('change', function() {
                var checkedIds = [];
                $('.checkbox-class:checked').each(function() {
                    checkedIds.push($(this).data('id'));
                });

                // Check if at least one checkbox is checked
                if (checkedIds.length > 0) {
                    $('#sendButton').removeClass('disabled'); // Enable the button
                } else {
                    $('#sendButton').addClass('disabled'); // Disable the button
                }
            });
            $('#sendButton').addClass('disabled'); // Disable the button

            // Function to handle checkbox clicks
            // $('#sendCustomMessage').on('click', function() {
            //     var checkedIds = [];
            //     $('.checkbox-class:checked').each(function() {
            //         checkedIds.push($(this).data('id'));
            //     });
            //     var message = $('#Cmessage').val();
            //     var imageFile = $('#imageUpload')[0].files[0]; // Get the selected image file

            //     console.log("...",imageFile['name']);
            //     var numbersToSend = checkedIds.map(function(id) {
            //         return '91' + id; // Assuming you want to prepend '91' to each ID
            //     });

            //     function sendMessagesSequentially(numbers, index) {
            //         if (index < numbers.length) {
            //             $.ajax({
            //                 url: 'https://allexpert.store/api/send',
            //                 type: "POST",
            //                 data: {
            //                     number: numbers[index],
            //                     type: "text",
            //                     message: message,
            //                     media_url: `https://demoadmsoft.in/admsoft-dental/public/customimages/${imageFile['name']}`,
            //                     instance_id: instantInstanceId,
            //                     access_token: instantAccessToken
            //                 },
            //                 dataType: "json",
            //                 success: function (response) {
            //                     console.log("Response for number", numbers[index], ":", response);
            //                     if (index === numbers.length - 1) {
            //                         // If this is the last message, reload the page
            //                         location.reload();
            //                     } else {
            //                         sendMessagesSequentially(numbers, index + 1); // Send the next message
            //                     }
            //                     sendMessagesSequentially(numbers, index + 1); // Send the next message
            //                 },
            //                 error: function (xhr, status, error) {
            //                     console.error("Error sending message to number", numbers[index], ":", error);
            //                     if (index === numbers.length - 1) {
            //                         // If this is the last message and an error occurs, reload the page
            //                         location.reload();
            //                     } else {
            //                         sendMessagesSequentially(numbers, index + 1); // Proceed to the next message
            //                     }
            //                     sendMessagesSequentially(numbers, index + 1); // Proceed to the next message
            //                 }
            //             });
            //         }
            //     }

            //     // Start sending messages sequentially
            //     sendMessagesSequentially(numbersToSend, 0);
            // });
            $("form").submit(function(e){
                var formData = new FormData(this);
                var checkedIds = [];
                $('.checkbox-class:checked').each(function() {
                    checkedIds.push($(this).data('id'));
                });

                formData.append('checkedIds', JSON.stringify(checkedIds));

		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ url('/custommessagesend') }}",
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
                                location.reload();
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

            document.getElementById('image_file').addEventListener('change', function() {
                var file = this.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) {
                        alert("File size exceeds the limit of 5MB.");
                        this.value = ""; // Clear the input field
                        return;
                    }

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imagePreview = document.getElementById('image_preview');
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('#clearimg').on('click', function() {
                $('#image_file').val('');
                // Empty the image preview
                $('#image_preview').attr('src', '#'); // Set the image src to a placeholder or empty string
                $('#image_preview').css('display', 'none');  // This line will clear the file input field
            });

        });
    </script>

    <script>
        var dataTable;

        $(document).ready(function () {
            dataTable = $("#tablelist").DataTable({
                dom: 'lBfrtip',
                buttons: [ {
                    title: 'Patient-List'
                } ],
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                lengthChange: true,
                'searching': true,
                'paging': true,  // Disable pagination
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [10], // column index (start from 0)
                'orderable': false // set orderable false for selected columns
                }]
            });

        });

    </script>

    <script>
        $(document).ready(function() {

            $('#treatment').on('change', function () {
                $('#chargesTable tbody').empty();

                $(this).find('option:selected').each(function () {
                    const srNo = $('#chargesTable tbody tr').length + 1; // Calculate SR No
                    const treatment = $(this).val();
                    const charge1 = parseFloat($(this).data('charges1'));
                    const charge2 = parseFloat($(this).data('charges2'));
                    const charge3 = parseFloat($(this).data('charges3'));
                    const discount = 0; // Initialize the discount to 0

                    updateChargesTable(srNo, treatment, charge1, charge2, charge3, discount);
                });

                updateTotals(); 
            });

            $('#chargesTable tbody').on('input', 'input.editable', function () {
                updateTotals();
            });

            function updateChargesTable(srNo, treatment, charge1, charge2, charge3, discount) {
                const newRow = `
                    <tr>
                        <td class="table-min-width-small">${srNo}</td>
                        <td class="table-min-width-small"><input type="hidden" class="treatment" value="${treatment}">${treatment}</td>
                        <td class="table-min-width-small">
                            <input type="number" class="form-control editable charge1" name="charges[][charge1]" value="${charge1}">
                        </td>
                        <td class="table-min-width-small">
                            <input type="number" class="form-control editable charge2" name="charges[][charge2]" value="${charge2}">
                        </td>
                        <td class="table-min-width-small">
                            <input type="number" class="form-control editable charge3" name="charges[][charge3]" value="${charge3}">
                        </td>
                        <td class="table-min-width-small">
                            <input type="number" class="form-control editable discount" name="charges[][discount]" value="${discount}">
                        </td>
                        <!-- ... other columns ... -->
                    </tr>
                `;

                $('#chargesTable tbody').append(newRow);
            }

             function updateTotals() {
                    let totalCharge1 = 0;
                    let totalCharge2 = 0;
                    let totalCharge3 = 0;
                    let totalDiscount = 0;

                    $('#chargesTable tbody tr').each(function () {
                        const charge1 = parseFloat($(this).find('.charge1').val()) || 0;
                        const charge2 = parseFloat($(this).find('.charge2').val()) || 0;
                        const charge3 = parseFloat($(this).find('.charge3').val()) || 0;
                        const discount = parseFloat($(this).find('.discount').val()) || 0;

                    // Check if the discount is greater than any of the charges
                    if (discount > charge1 + charge2 + charge3) {
                        // Display an error message or prevent further action
                        // For example, you can show a Bootstrap alert here
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: 'Discount cannot be greater than charges.'
                        });

                        // Set the discount to the maximum of charges
                        discount = Math.min(charge1, charge2, charge3);
                        $(this).find('.discount').val(discount);
                    }

                    totalCharge1 += charge1;
                    totalCharge2 += charge2;
                    totalCharge3 += charge3;
                    totalDiscount += discount;
                });

                $('.total-charge1').val(totalCharge1.toFixed(2));
                $('.total-charge2').val(totalCharge2.toFixed(2));
                $('.total-charge3').val(totalCharge3.toFixed(2));
                $('.total-discount').val(totalDiscount.toFixed(2));
            }

            // $("#treatment").select2({ dropdownParent: "#modal-view-event-add" });
            $('.js-example-basic-multiple').select2();
            // Add an event listener for changes in the treatment selection
             $('#treatment').on('change', function() {
                var selectedTreatments = $(this).find('option:selected');
                var totalCharges1 = 0;
                var totalCharges2 = 0;
                var totalCharges3 = 0;

                selectedTreatments.each(function() {
                    var charges1 = parseFloat($(this).data('charges1'));
                    var charges2 = parseFloat($(this).data('charges2'));
                    var charges3 = parseFloat($(this).data('charges3'));

                    totalCharges1 += charges1;
                    totalCharges2 += charges2;
                    totalCharges3 += charges3;
                });

                $('#chargeone').val(totalCharges1.toFixed(2));
                $('#chargetwo').val(totalCharges2.toFixed(2));
                $('#chargethree').val(totalCharges3.toFixed(2));
            });


            $("#Quoteform").submit(function(e){
                if($("#selectedteeth").val() != "")
                {
                    var $this = $(this);
                    var formData = $this.serializeArray();

                    var rowItems = [];
                    $('#chargesTable tbody tr').each(function () {
                        var row = $(this);
                        var rowData = {
                            treatment: row.find('.treatment').val(),
                            chargesOption1: row.find('.charge1').val(),
                            chargesOption2: row.find('.charge2').val(),
                            chargesOption3: row.find('.charge3').val(),
                            discount: row.find('.discount').val(),
                        };
                        rowItems.push(rowData);
                    });

                     // Include rowItems in formData
                    formData.push({ name: 'rowItems', value: JSON.stringify(rowItems) });

                    var totalCharge1 = parseFloat($('.total-charge1').val()) || 0;
                    var totalCharge2 = parseFloat($('.total-charge2').val()) || 0;
                    var totalCharge3 = parseFloat($('.total-charge3').val()) || 0;
                    var totalDiscount = parseFloat($('.total-discount').val()) || 0;

                    var totalAmount = totalCharge1 + totalCharge2 + totalCharge3 - totalDiscount;

                    if (totalAmount <= 0) {
                        Swal.fire({
                            icon: "warning",
                            title: "Warning",
                            text: 'Quote total cannot be zero or less.'
                        });
                    } else {

                    $("#overlay").fadeIn(300);
                    $.ajax({
                        url: "{{ route('addQuotePlan') }}",
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
                                    window.location.href = "{{ url('/quotelist') }}";
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
                    }else
                    {
                        Swal.fire({
                            icon: "warning",
                            title: "Warning",
                            text: 'Please select teeth'
                        });
                    }
                
                e.preventDefault();
            });

            
            // get data of view visit
            $(document).on("click", ".add_visit", function(){
                var id = $(this).data('id');
                $("#patientId").val(id);
            });

            // var table; // Declare the variable

            // getData = function(data) {
            //     // if ($.fn.DataTable.isDataTable('#tablelist')) {
            //     //     // If DataTable is already initialized, destroy it
            //     //     table.destroy();
            //     //     table.clear().draw(); // Clear the DataTable content
            //     // }
            //     table.destroy();

            //     // Create a new DataTable
            //     var counter = 1; // Initialize counter

            //     table = $("#tablelist").DataTable({
            //         dom: 'Bfrtip',
            //         responsive: true,
            //         buttons: [{
            //             title: 'Report-List'
            //         }],
            //         'lengthChange': false,
            //         'searching': true,
            //         'order': [[0, 'asc']],
            //         'data': data.data,
            //         'columns': [
            //             {
            //                 data: "null",
            //                 className: 'table-min-width-small', // Set the class for the column
            //                 render: function (data, type, row) {
            //                     // Render the checkbox input
            //                     return '<input type="checkbox" class="checkbox-class" data-id="' + row.contact_1 + '">';
            //                 }
            //             },
            //             {data: null, className: 'table-min-width-small', render: function () {
            //                 return counter++; // Increment counter for each row
            //             }},
            //             {data: "patient_uniq_id", className: 'table-min-width-small'},
            //             {data: "name", className: 'table-min-width-small'},
            //             {data: "date_of_birth"},
            //             {data: "age", className: 'table-min-width-small'},
            //             {data: "attended_by", className: 'table-min-width-small'},
            //             {data: "contact_1", className: 'table-min-width-small'},
            //             {data: "patient_insurance" , className: 'table-min-width-small'},
            //             {data: "consent_form" ,className: 'table-min-width-small'},
            //             {
            //                 data: "action",
            //                 align: "center",
            //                 render: function (data, type, row) {
            //                     var buttonsHtml = '<td class="button-holder">' +
            //                         '<a data-bs-toggle="modal" data-bs-target="#addQuoteModal" class="btn btn-outline-success add_quote" data-id="' + row.id + '">Treatment Plan</a>' +
            //                         '<a href="{{ url('patientview') }}/' + row.id + '" class="btn btn-outline-info">View</a>' +
            //                         '<a href="{{ url('patientedit') }}/' + row.id + '" class="btn btn-outline-warning">Edit</a>' +
            //                         '<a href="{{ url('xrays') }}/' + row.id + '" class="btn btn-outline-info mb-0">X-Ray</a>' +
            //                         '<a id="deleteperson" class="btn btn-outline-danger deletepatient" data-id="' + row.id + '">Delete</a>' +
            //                         '</td>';

            //                     // Check if the 'action' property of the row is not equal to zero
            //                     if (row.action !== 0) {
            //                         return buttonsHtml;
            //                     } else {
            //                         return ''; // Empty string if action is zero
            //                     }
            //                 }
            //             }
            //         ],
            //         "rowCallback": function (nRow, aData, iDisplayIndex) {
            //             var oSettings = this.fnSettings();
            //             $("td:eq(1)", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
            //             return nRow;
            //         },
            //         'columnDefs': [{
            //             'targets': [10], // column index (start from 0)
            //             'orderable': false, // set orderable false for selected columns
            //         },
            //         {
            //             "targets": [10],
            //             "className": "",
            //         }]
            //     });

            //     // Attach a click event listener to the checkboxes with class 'checkbox-class'
            //     $('#tablelist').on('click', '.checkbox-class', function () {
            //         var checkedIds = [];

            //         // Iterate through the checked checkboxes
            //         $('#tablelist tbody tr .checkbox-class:checked').each(function () {
            //             // Get the data-id attribute value and add it to the array
            //             checkedIds.push($(this).data('id'));
            //         });

            //         // Check if at least one checkbox is checked
            //         if (checkedIds.length > 0) {
            //             $('#sendButton').removeClass('disabled'); // Enable the button
            //         } else {
            //             $('#sendButton').addClass('disabled'); // Disable the button
            //         }

            //         // Log or use the array of checked data-id values as needed
            //         console.log(checkedIds);
            //     });
            // };

            
            // $('#tablelist').DataTable({    
                
                
            //     dom: 'Bfrtip',
            //     destroy:true,
            //     processing:true,
            //     select:true,
            //     buttons: [ {
            //         extend: 'csv',
            //         title: 'Partition-List'
            //     } ],
            //     paging:false,
            //     lengthChange:true,
            //     "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100,"All"]],
            //     searching:true,
            //     "order": [],
            //     info:false,
            //     responsive:true,
            //     columnDefs: [ {
            //         'targets': [4], // column index (start from 0)
            //         'orderable': false, // set orderable false for selected columns
            //     }],
            //     autoWidth:false
            // });

            //to submit visit
            $("form#addVisitForm").submit(function(e){
                var id = $("#patientId").val();
                var $this = $(this);
                var formData = $this.serializeArray();
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addVisit') }}/"+id,
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
                                window.location.reload();
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

            //to submit quote
            $("form#addQuoteForm").submit(function(e){
                var id = $("#patientQuoteId").val();
                var $this = $(this);
                var formData = $this.serializeArray();
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addQuote') }}/"+id,
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
                                window.location.reload();
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

            // to pass id to visit modal
            $(document).on("click", ".add_visit", function(){
                var id = $(this).data('id');
                $("#patientId").val(id);
            });

            // to pass id to quote modal
            $(document).on("click", ".add_quote", function(){
                var id = $(this).data('id');
                $("#patientQuoteId").val(id);
                $("#patient_name").val(id);
                $("#patient_name").trigger('refresh');
            });

            // to pass id to lab order modal
            $(document).on("click", ".add_laborder", function(){
                var id = $(this).data('id');
                $("#patientIdLabOrder").val(id);
            });

            //to submit Lab order
            $("form#LaborderForm").submit(function(e){
                var id = $("#patientIdLabOrder").val();
                var $this = $(this);
                var formData = $this.serializeArray();
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addLabOrder') }}/"+id,
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
                                window.location.reload();
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

            // to delete patient data from patient list 
            $(document).on("click", ".deletepatient", function(){ 
                var patientid = $(this).data('id');

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

            // Function to select all teeth
            $('#selectallTeeth').click(function () {
                $('.teethsection img').addClass('selected');
                $('.teethsection img').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                    

                });
                pushselectedteethtoArray();
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');
                $('#selectallTeeth').addClass('active-button');
            });

            // Function to deselect all teeth
            $('#deselectallTeeth').click(function () {
                $('.teethsection img').removeClass('selected');
                $('.teethsection img').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/normal') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);

                });
                pushselectedteethtoArray();
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');
                $('#deselectallTeeth').addClass('active-button');
                
            });

            // Add this code below your existing JavaScript code

            // Function to select upper all teeth
            $('#selectUpperAllTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="11"]').addClass('selected');
                $('.teethsection img[data-id="12"]').addClass('selected');
                $('.teethsection img[data-id="13"]').addClass('selected');
                $('.teethsection img[data-id="14"]').addClass('selected');
                $('.teethsection img[data-id="15"]').addClass('selected');
                $('.teethsection img[data-id="16"]').addClass('selected');
                $('.teethsection img[data-id="17"]').addClass('selected');
                $('.teethsection img[data-id="18"]').addClass('selected');
                $('.teethsection img[data-id="21"]').addClass('selected');
                $('.teethsection img[data-id="22"]').addClass('selected');
                $('.teethsection img[data-id="23"]').addClass('selected');
                $('.teethsection img[data-id="24"]').addClass('selected');
                $('.teethsection img[data-id="25"]').addClass('selected');
                $('.teethsection img[data-id="26"]').addClass('selected');
                $('.teethsection img[data-id="27"]').addClass('selected');
                $('.teethsection img[data-id="28"]').addClass('selected');
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').addClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');


                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                    
                });
                pushselectedteethtoArray();
            });

            // Function to select lower All  teeth
            $('#selectLowerAllTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="31"]').addClass('selected');
                $('.teethsection img[data-id="32"]').addClass('selected');
                $('.teethsection img[data-id="33"]').addClass('selected');
                $('.teethsection img[data-id="34"]').addClass('selected');
                $('.teethsection img[data-id="35"]').addClass('selected');
                $('.teethsection img[data-id="36"]').addClass('selected');
                $('.teethsection img[data-id="37"]').addClass('selected');
                $('.teethsection img[data-id="38"]').addClass('selected');
                $('.teethsection img[data-id="41"]').addClass('selected');
                $('.teethsection img[data-id="42"]').addClass('selected');
                $('.teethsection img[data-id="43"]').addClass('selected');
                $('.teethsection img[data-id="44"]').addClass('selected');
                $('.teethsection img[data-id="45"]').addClass('selected');
                $('.teethsection img[data-id="46"]').addClass('selected');
                $('.teethsection img[data-id="47"]').addClass('selected');
                $('.teethsection img[data-id="48"]').addClass('selected');
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').addClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');

                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                    
                });
                pushselectedteethtoArray();
            });

            // Function to select upper left teeth
            $('#selectUpperLeftTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="11"]').addClass('selected');
                $('.teethsection img[data-id="12"]').addClass('selected');
                $('.teethsection img[data-id="13"]').addClass('selected');
                $('.teethsection img[data-id="14"]').addClass('selected');
                $('.teethsection img[data-id="15"]').addClass('selected');
                $('.teethsection img[data-id="16"]').addClass('selected');
                $('.teethsection img[data-id="17"]').addClass('selected');
                $('.teethsection img[data-id="18"]').addClass('selected');
                $('#selectUpperLeftTeeth').addClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');


                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                    

                });
                pushselectedteethtoArray();
            });

            // Add this code below your existing JavaScript code

            // Function to select upper right teeth
            $('#selectUpperRightTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="21"]').addClass('selected');
                $('.teethsection img[data-id="22"]').addClass('selected');
                $('.teethsection img[data-id="23"]').addClass('selected');
                $('.teethsection img[data-id="24"]').addClass('selected');
                $('.teethsection img[data-id="25"]').addClass('selected');
                $('.teethsection img[data-id="26"]').addClass('selected');
                $('.teethsection img[data-id="27"]').addClass('selected');
                $('.teethsection img[data-id="28"]').addClass('selected');
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').addClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');

                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                    

                });
                pushselectedteethtoArray();
            });
            // Function to select upper right teeth
            $('#selectLowerRightTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="31"]').addClass('selected');
                $('.teethsection img[data-id="32"]').addClass('selected');
                $('.teethsection img[data-id="33"]').addClass('selected');
                $('.teethsection img[data-id="34"]').addClass('selected');
                $('.teethsection img[data-id="35"]').addClass('selected');
                $('.teethsection img[data-id="36"]').addClass('selected');
                $('.teethsection img[data-id="37"]').addClass('selected');
                $('.teethsection img[data-id="38"]').addClass('selected');
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').addClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');

                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                    

                });
                pushselectedteethtoArray();
            });


            $('#selectLowerLeftTeeth').click(function () {
            $('#deselectallTeeth').click();
            $('.teethsection img').removeClass('selected');
            $('.teethsection img[data-id="41"]').addClass('selected');
            $('.teethsection img[data-id="42"]').addClass('selected');
            $('.teethsection img[data-id="43"]').addClass('selected');
            $('.teethsection img[data-id="44"]').addClass('selected');
            $('.teethsection img[data-id="45"]').addClass('selected');
            $('.teethsection img[data-id="46"]').addClass('selected');
            $('.teethsection img[data-id="47"]').addClass('selected');
            $('.teethsection img[data-id="48"]').addClass('selected');
            
            // Update the images and select elements to the infected state
            $('.teethsection img.selected').each(function () {
                var toothId = $(this).attr('data-id');
                var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                $(this).attr('src', tempSrc);
                
                
            });
            
            // Update the UI for button states
            $('#selectUpperLeftTeeth').removeClass('active-button');
            $('#selectUpperRightTeeth').removeClass('active-button');
            $('#selectLowerLeftTeeth').addClass('active-button');
            $('#selectLowerRightTeeth').removeClass('active-button');
            $('#selectallTeeth').removeClass('active-button');
            $('#deselectallTeeth').removeClass('active-button');
            $('#selectLowerAllTeeth').removeClass('active-button');
            $('#selectUpperAllTeeth').removeClass('active-button');
            
            pushselectedteethtoArray();
        });

             // To push selected teeth no to array
             pushselectedteethtoArray = function(){
                selectedTeethArr = [];
                $('.teethsection img.selected').each(function() {
                    selectedTeethArr.push($(this).attr('data-id'));
                });
                if(selectedTeethArr.length != 0)
                {
                    $("#selectteeth").html("Selected Teeth "+selectedTeethArr);
                    $("#selectteeth").addClass("text-success").removeClass("text-danger");
                    $("#selectedteeth").val(JSON.stringify(selectedTeethArr, null, 2));
                }
                else
                {
                    $("#selectteeth").html("Select Teeth");
                    $("#selectteeth").addClass("text-danger").removeClass("text-success");
                    $("#selectedteeth").val("");
                }
            }

            // To select Image
            $('.teethsection img').click(function () {
                $(this).toggleClass('selected');
                var toothId = $(this).attr('data-id');
                if($(this).hasClass('selected'))
                {
                    var tempSrc = '{{ asset('assets/images/infected') }}/'+toothId+".jpg";
                }
                else
                {
                    var tempSrc = '{{ asset('assets/images/normal') }}/'+toothId+".jpg";   
                }
                $(this).attr('src', tempSrc);
                pushselectedteethtoArray();
            });

            $('#selectteethModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#addVisitModal, #newLabOrder, #selectteethModal, #addQuoteModal').modal({
                backdrop: 'static',
                keyboard: false
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

            //X-ray
            $(document).on("click", ".x-ray-btn", function() {
                $('.x-ray-images').removeClass('hide-xray');
                $('.x-ray-images').addClass('show-xray');
            });
            $(document).on("click", ".close-x-ray", function() {
                $('.x-ray-images').addClass('hide-xray');
                $('.x-ray-images').removeClass('show-xray');
            });

           
            // Listen for changes in the checkboxes
            $('.checkbox-value').on('change', function() {
                updatePaidAmount(); // Call the function to update the paid amount
            });

            function updatePaidAmount() {
                var totalAmount = 0;

                // Loop through the checkboxes and sum up the selected amounts
                $('.checkbox-value:checked').each(function() {
                    var amount = parseFloat($(this).data('amount'));
                    totalAmount += amount;
                });

                // Set the total amount in the Paid Amount input field
                $('#paid_amount').val(totalAmount.toFixed(2));
            }

            // Function to calculate and update the Total Amount based on Paid Amount and Discount Amount
            function calculateTotalAmount() {
                var paidAmount = parseFloat($("#paid_amount").val());
                var discountAmount = parseFloat($("#discount_amount").val());
                var totalAmount = paidAmount - discountAmount;
                if (isNaN(totalAmount)) {
                    totalAmount = 0; // Set to 0 if the result is not a number (e.g., when the fields are empty)
                }
                $("#total_amount").val(totalAmount);
            }

            // Call the calculateTotalAmount function when Paid Amount or Discount Amount changes
            $("#paid_amount, #discount_amount").on("input", function () {
                calculateTotalAmount();
            });

            // Call the calculateTotalAmount function once initially to set the initial value of Total Amount
            calculateTotalAmount();

            $("#saveselectedTeeth").click(function () {
            // Show the modal
                $("#addQuoteModal").modal("show");
            });


        });
    </script>
@endsection