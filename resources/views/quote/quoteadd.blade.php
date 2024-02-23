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
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Add Treatment Plan</h3>
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
                                                <label for="quote_date">Date</label>
                                                <input type="text" id="quote_date" class="form-control dateofbirth" placeholder="" name="quote_date">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="patient_name">Patient</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="patient_name" name="patient_name">
                                                        @foreach($PatientList as $patient)  
                                                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Treatment</label>
                                                <select class="js-example-basic-multiple form-select" id="treatment" name="treatment[]" multiple="multiple" required>
                                                    @foreach($treatmentsWithCharges as $treatment)
                                                        <option value="{{ $treatment->name }}" data-charges1="{{ $treatment->charge_one }}" data-charges2="{{ $treatment->charge_two }}" data-charges3="{{ $treatment->charge_three }}">{{ $treatment->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="lab_order_date">Teeth Numbers</label>
                                            <div class="form-group mt-1">
                                                <a id="selectteeth" href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#selectteethModal">Select Teeth</a>
                                                <input type="hidden" name="selectedteeth" id="selectedteeth">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
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
                                     <!--    <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="chargeone">Charges Option 1</label>
                                                    <input type="text" id="chargeone" class="form-control" placeholder="" name="chargeone" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="chargetwo">Charges Option 2</label>
                                                    <input type="text" id="chargetwo" class="form-control" placeholder="" name="chargetwo" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="chargethree">Charges Option 3</label>
                                                    <input type="text" id="chargethree" class="form-control" placeholder="" name="chargethree" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="discount">Discount</label>
                                                    <input type="text" id="discount" class="form-control onlynumbers" placeholder="" name="discount"required>
                                                </div>
                                            </div>
                                        </div> -->
                                       <!--  <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <a href="{{ url()->previous() }}"class="btn btn-light-secondary me-1 mb-1">Close</a>
                                        </div> -->
                                    </div>

                                <!-- Basic Tables start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <!-- Button trigger for login form modal -->
                                           <!--  <a href="javascript:void(0)" class="new-button float-end print-btn" onclick="printTable('prinQuoteTable')">
                                                <button id="" type="button" class="btn btn-outline-primary">Print</button>
                                            </a> -->
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
                                        <a href="{{ url('/quotelist') }}"class="btn btn-light-secondary me-1 mb-1">Close</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->

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


    </div>
@endsection

@section('jsscript')
  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
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

            $("form").submit(function(e){
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
                            success: function (response) {
                                $("#overlay").fadeOut(300);
                                if (response.result) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Success",
                                        timer: 2000,
                                        button: "OK",
                                        showConfirmButton: true
                                    }).then(function () {
                                        window.location.href = "{{ url('/quotelist') }}";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error"
                                    });
                                }
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Warning",
                        text: 'Please select teeth'
                    });
                }

                e.preventDefault();
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

            $(function(){
                $(".dateofbirth").datepicker({ 
                    dateFormat: 'dd-M-yy',
                    changeYear: true,
                    changeMonth: true,
                    yearRange: "c-150:c+150"
                });
                $(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
            });

            $('#selectteethModal').modal({
                backdrop: 'static',
                keyboard: false
            });

        });      
    </script>
@endsection