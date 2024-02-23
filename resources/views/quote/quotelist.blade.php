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
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Treatment Plan</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lab Orders</li>
                        </ol>
                    </nav> -->
                    <!-- <a href="{{ url('/laborderadd') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a> -->
                    <a href="{{ url('/quoteadd') }}"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a>
                </div>
            </div>
        </div>


        
        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger for login form modal -->
                   <!--  <a href="javascript:void(0)" class="new-button float-end print-btn" onclick="printTable('prinQuoteTable')">
                        <button id="" type="button" class="btn btn-outline-primary">Print</button>
                    </a> -->
                </div>
                <div id="prinQuoteTable" class="card-body table-responsive">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th class="table-min-width-small">Sr. No.</th>
                                <th class="table-min-width-small">Date</th>
                                <th class="table-min-width-small">Patient Name</th>
                                <th class="table-min-width-small">Treatment</th>
                                <th class="table-min-width-small">Teeth Numbers</th>
                                <th class="table-min-width-small">Doctor</th>
                                <th class="table-min-width-small">Charges Option1</th>
                                <th class="table-min-width-small">Charges Option2</th>
                                <th class="table-min-width-small">Charges Option3</th>
                                <th class="table-min-width-small">Discount</th>
                                <th class="table-min-width-small">Status</th>
                                <th class="table-min-width-small">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($quotelist as $quote)
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td class="table-min-width-small">@if($quote->quote_date == '')
                                        @else
                                        {{ date('d-M-Y', strtotime($quote->quote_date)) }}
                                        @endif
                                    </td>
                                    <td class="table-min-width-small">{{ $quote->name }}</td>
                                    <td class="table-min-width-small">{{ $quote->treatment }}</td>
                                    <td class="table-min-width-small">{{ $quote->teeth }}</td>
                                    <td class="table-min-width-small">{{ $quote->doctor_name }}</td>
                                    <td class="table-min-width-small">{{ $quote->charge_opt_one }}</td>
                                    <td class="table-min-width-small">{{ $quote->charge_opt_two }}</td>
                                    <td class="table-min-width-small">{{ $quote->charge_opt_three }}</td>
                                    <td class="table-min-width-small">{{ $quote->discount }}</td>
                                    <td>
                                        @if ($quote->status == 'open')
                                            <span class="badge bg-success">Open</span>
                                        @else
                                            <span class="badge bg-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td class="button-holder table-min-width-small">
                                        <a href="{{ url('quoteview'."/".$quote->id) }}" class="btn btn-outline-info">View</a>
                                        <a id="deleteperson" class="btn btn-outline-danger deletequote" data-id="{{$quote->id}}">Delete</a>
                                        @if ($quote->approve !=1)
                                        <a data-bs-toggle="modal" data-bs-target="#addVisitModal" class="btn btn-outline-success add_visit"data-id="{{$quote->id}}" data-patient-id="{{$quote->patient_id}}" data-patient-name="{{$quote->name}}" data-patient-charge1="{{$quote->charge_opt_one}}" data-patient-charge2="{{$quote->charge_opt_two}}" data-patient-charge3="{{$quote->charge_opt_three}}" data-patient-treat="{{$quote->treatment}}">Approve</a>
                                        @else
                                        <a class="btn disabled btn-outline-success add_visit">Approve</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>

    <!--Add Visit form Modal -->
    <div class="modal fade text-left" id="addVisitModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Treatment</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="addVisitForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="QuoteId" id="QuoteId">
                        <input type="hidden" name="patient_id" id="modal_patient_id">


                        <label>Date Of Visit</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control dateofbirth" id="date_of_visit" name="date_of_visit" style="pointer-events: none;">
                        </div>
                       <label>Patient</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="patient_name" name="patient_name" readonly>
                        </div>

                        <label>Treatment Type</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="work_done" name="work_done" readonly>
                        </div>
                       <!--  <label id="treatment_label">Treatment Type</label>
                        <div class="form-group">
                            <select class="form-control" id="work_done" name="work_done">
                                <option value="">Select Treatment</option>
                            </select>

                        </div> -->
                        <label id="charges_opt_label">Charges</label>
                        <div class="form-group">
                            <select class="form-control onlynumbers" id="charges_opt" name="charges_opt" required>
                                <option value="">Select Charge</option>
                            </select>

                        </div>
                         <!-- <div class="form-group">
                            <label for="city-column">Fees</label>
                            <div class="checkbox-row">
                                <div class="checkbox-holder">
                                    <input type="checkbox" id="consultation_fee" class="checkbox-value" name="consultation_fee" data-amount="500" value="Consultation fee">&nbsp;
                                    <label for="consultation-fee">Consultation fee</label>
                                </div>
                                <div class="checkbox-holder">
                                    <input type="checkbox" id="x_ray" class="checkbox-value" name="x_ray" data-amount="500" value="X-ray">&nbsp;
                                    <label for="x-ray">X-ray</label>
                                </div>
                                <div class="checkbox-holder">
                                    <input type="checkbox" id="root_canal" class="checkbox-value" name="root_canal"  data-amount="500"value="Root canal">&nbsp;
                                    <label for="root-canal">Root canal</label>
                                </div>
                            </div>
                        </div>
                        <label id="paid_amount_label">Paid Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="paid_amount" name="paid_amount">
                        </div>
                        <label>Discount Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="discount_amount" name="discount_amount">
                        </div>
                        <label for="city-column">Total Paid Amount</label>
                            <div class="form-group">
                                <input type="text" id="total_amount" class="form-control onlynumbers" placeholder="" name="total_amount">
                            </div>
                        <label for="city-column">Balance Amount</label>
                            <div class="form-group">
                                <input type="text" id="balance_amount" class="form-control onlynumbers" placeholder="" name="balance_amount">
                            </div> -->
                        <label>Remarks</label>
                        <div class="form-group">
                        <textarea placeholder=""class="form-control" id="remarks" name="remarks"></textarea>
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

    <!--Select Teeth Modal -->
    <div class="modal fade text-left" id="selectteethModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Teeth Selection</h4>
                    <button type="button" class="close teethPopupclose" data-bs-toggle="modal" data-bs-target="#newLabOrder">
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
                        <button type="button" id="saveselectedTeeth" class="btn btn-primary ml-1 teethPopupclose" data-bs-toggle="modal" data-bs-target="#newLabOrder">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save & Close</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script>
        $(document).ready(function() {
            // To apply datatable
            table = $("#tablelist").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    extend: 'csv',
                    title: 'Quote-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                    'targets': [10], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            });

            // Event listener for checkbox changes
            // $('.checkbox-value').change(function () {
            //     var consultationChecked = $('#consultation_fee').is(':checked');
            //     var xRayChecked = $('#x_ray').is(':checked');
            //     var rootCanalChecked = $('#root_canal').is(':checked');
            //     var otherChecked = $('#other_fee').is(':checked');

            //     // Hide/show "Charges" based on selected checkboxes
            //     if (consultationChecked || xRayChecked || rootCanalChecked) {
            //         $('#charges_opt').closest('.form-group').hide();
            //         $('#charges_opt_label').hide();
            //     } else {
            //         $('#charges_opt').closest('.form-group').show();
            //         $('#charges_opt_label').show();
            //     }

            //     // Hide/show "Paid Amount" based on the "Other" checkbox
            //     if (otherChecked) {
            //         $('#paid_amount').closest('.form-group').hide();
            //         $('#paid_amount_label').hide();
            //     } else {
            //         $('#paid_amount').closest('.form-group').show();
            //         $('#paid_amount_label').show();
            //     }
            // });

            //to submit visit
            $("form#addVisitForm").submit(function(e){
                var id = $("#QuoteId").val();
                var patientId = parseInt($("#modal_patient_id").val()); // Parse the patient ID as an integer
                var $this = $(this);
                var formData = $this.serializeArray();
                formData.push({ name: "patient_id", value: patientId });
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addQuotePlanTreatment') }}/"+id,
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
                                window.location.href =  "{{ url('patientview') }}/"+patientId;
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

           // Open Add Visit Modal and pass data
            $(document).on("click", ".add_visit", function() {
                var id = $(this).data('id');
                var patientId = $(this).data('patient-id');
                var patientName = $(this).data('patient-name');
                var patientTreat = $(this).data('patient-treat');

                var patientcharge1 = $(this).data('patient-charge1');
                var patientcharge2 = $(this).data('patient-charge2');
                var patientcharge3 = $(this).data('patient-charge3');
                $("#QuoteId").val(id);
                $("#modal_patient_id").val(patientId); // Set the patient ID in the modal
                $("#patient_name").val(patientName);   // Remove this line if you don't want to set the patient name
                $("#work_done").val(patientTreat);


                var select = $("#charges_opt");
    
                // Clear existing options
                select.empty();
                
                // Add default option
                select.append($('<option>', {
                    value: '',
                    text: 'Select Charge'
                }));
                
                // Add charge options if available
                if (patientcharge1) {
                    select.append($('<option>', {
                        value: 0,
                        // value: patientcharge1,
                        text: patientcharge1
                    }));
                }
                if (patientcharge2) {
                    select.append($('<option>', {
                        value: 1,
                        // value: patientcharge2,
                        text: patientcharge2
                    }));
                }
                if (patientcharge3) {
                    select.append($('<option>', {
                        value: 2,
                        // value: patientcharge3,
                        text: patientcharge3
                    }));
                }
            });

            // to delete patient data from patient list 
            $(document).on("click", ".deletequote", function(){ 
                var quoteplanid = $(this).data('id');

                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Quote\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);    
                        $.ajax({
                            url: "{{ route('deleteQuotedata') }}",
                            type: "DELETE",
                            data: {"quoteplanid": quoteplanid, "_token": $("input[name='_token']").val()},
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
                });
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
                    $("#Eselectedteeth").val(JSON.stringify(selectedTeethArr, null, 2));
                }
                else
                {
                    $("#selectteeth").html("Select Teeth");
                    $("#selectteeth").addClass("text-danger").removeClass("text-success");
                    $("#Eselectedteeth").val("");
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

            // On close popup
            $(".labeditPopupclose").click(function(){
                $("#selectteeth").html("Select Teeth");
                $("#selectteeth").addClass("text-danger").removeClass("text-success");
                $("#Eselectedteeth").val("");
                $('.teethsection img.selected').each(function() {
                    $(this).trigger('click');
                });
                selectedTeethArr = [];
            });

            //Disable popup on click out side to page

            $('#addVisitModal, #newLabOrder, #selectteethModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            
            // $(function(){
            //     $(".dateofbirth").datepicker({ dateFormat: 'dd-M-yy' });
            // });

            $(function(){
                $(".dateofbirth").datepicker({ 
                    dateFormat: 'dd-M-yy',
                    changeYear: true,
                    changeMonth: true,
                    yearRange: "c-150:c+150"
                });
                $(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
            });

            //Print
            printTable = function (tableName) {
			    var printContents = document.getElementById(tableName).innerHTML;
			    var originalContents = document.body.innerHTML;
			    document.body.innerHTML = printContents;
			    window.print();
			    document.body.innerHTML = originalContents;
			}



       // Function to calculate and update the Total Amount based on Paid Amount and Discount Amount
        function calculateTotalAmount() {
            var paidAmount = parseFloat($("#paid_amount").val());
            var discountAmount = parseFloat($("#discount_amount").val());

            // Set paidAmount and discountAmount to 0 if they are not valid numbers
            if (isNaN(paidAmount) || !isFinite(paidAmount)) {
                paidAmount = 0;
            }
            if (isNaN(discountAmount) || !isFinite(discountAmount)) {
                discountAmount = 0;
            }

            var totalAmount = paidAmount - discountAmount;

            // Set the total amount in the Total Amount input field
            $("#total_amount").val(totalAmount.toFixed(2));
        }

        // Function to update the Paid Amount based on selected checkboxes and update the Total Amount
        function updatePaidAmount() {
            var totalAmount = 0;

            // Loop through the checkboxes and sum up the selected amounts
            $('.checkbox-value:checked').each(function() {
                var amount = parseFloat($(this).data('amount'));
                totalAmount += amount;
            });

            // Set the total amount in the Paid Amount input field
            $('#paid_amount').val(totalAmount.toFixed(2));

            // Update the Total Amount based on the new Paid Amount
            calculateTotalAmount();
        }

        // Call the updatePaidAmount function when checkboxes change
        $('.checkbox-value').on('change', function() {
            updatePaidAmount();
        });

        // Call the calculateTotalAmount function when Paid Amount or Discount Amount changes
        $("#paid_amount, #discount_amount").on("input", function () {
            calculateTotalAmount();
        });

        // Call the calculateTotalAmount function once initially to set the initial value of Total Amount
        calculateTotalAmount();

      // Function to calculate and update the Balance Amount based on Charges and Paid Amount
        function calculateChargeTotalAmount() {
            var chargesAmount = parseFloat($("#charges_opt").val());
            var paidAmount = parseFloat($("#paid_amount").val());

            if (isNaN(chargesAmount)) {
                chargesAmount = 0;
            }
            if (isNaN(paidAmount)) {
                paidAmount = 0;
            }

            var balanceAmount = chargesAmount - paidAmount;
            $("#balance_amount").val(balanceAmount.toFixed(2));
        }

    // Function to update the Paid Amount based on selected checkboxes and update the Balance Amount
        function updateChargePaidAmount() {
            var totalAmount = 0;

            // Loop through the checkboxes and sum up the selected amounts
            $('.checkbox-value:checked').each(function() {
                var amount = parseFloat($(this).data('amount'));
                totalAmount += amount;
            });

            // Set the total amount in the Paid Amount input field
            $('#paid_amount').val(totalAmount.toFixed(2));

            // Update the Balance Amount based on the new Paid Amount
            calculateChargeTotalAmount();
        }

        // Call the updateChargePaidAmount function when checkboxes change
            $('.checkbox-value').on('change', function() {
                updateChargePaidAmount();
            });

        // Call the calculateChargeTotalAmount function when Paid Amount or Charges change
            $("#charges_opt, #paid_amount").on("input", function () {
                calculateChargeTotalAmount();
            });

        // Initial calculation of Balance Amount
                calculateChargeTotalAmount();

        });
    </script>
@endsection