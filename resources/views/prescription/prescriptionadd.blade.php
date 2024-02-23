@extends('layouts.app')

@section('content')
    <style type="text/css">
        .checkboxinputBlock {
            align-items: center;
        }

        @media screen and (max-width: 940px) {
            .checkboxinputBlock {
                flex-direction: column;
                justify-content: flex-start;
            }
            .checkboxinputBlock .checkboxBlock,
            .checkboxinputBlock .inputBlock {
                width: 100%;
            }
        }

        #myBtn {
            display: none;          
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: #4057ab;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }

        #myBtn:hover {
            background-color: #555;
        }
    </style>
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Create Prescription</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lab Orders</li>
                        </ol>
                    </nav> -->
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                    <a href="{{ url('/patientview/' . $patientId) }}" class="btn btn-outline-success mb-0">
                    Back
                    </a>
                    <h4 class="card-title">Create Prescription for {{ $patientList->name }} Age : @if($patientList->date_of_birth == '1970-01-01') {{ $patientList->age }} Years @else {{ $patientList->actualAge }} Years @endif</h4> <!-- {{$patientList->age}} Years -->
                    <div>
                        <a href="#"><button id="printBtn" type="button" class="btn btn-outline-info float-end">Save and Print</button></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#previewtable"><button id="previewBtn" type="button" class="btn btn-outline-primary float-end">Save and Preview</button></a>
                    </div>
	            </div>
                <div class="card-header">
                    <!-- Button trigger for login form modal -->
                    <!-- <a href="{{ url('/patientadd') }}"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a> -->
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Medicine Category</th>
                                <th>Medicine Name</th>
                                <th>Number Of Times</th>
                                <!-- <th>Before/After</th> -->
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicine as $medicine)
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>{{ $medicine->medicatename }}</td>
                                <td>{{ $medicine->name }}</td>
                                <td>
                                    <input type="checkbox" class="select-checkbox" id="LmorningCheckbox" name="LmorningCheckbox" {{ strpos($medicine->number_of_times, 'M') !== false ? 'checked' : '' }}> M
                                    <input type="checkbox" class="select-checkbox" id="LafternoonCheckbox" name="LafternoonCheckbox" {{ strpos($medicine->number_of_times, 'A') !== false ? 'checked' : '' }}> A
                                    <input type="checkbox" class="select-checkbox" id="LeveningCheckbox" name="LeveningCheckbox" {{ strpos($medicine->number_of_times, 'E') !== false ? 'checked' : '' }}> N
                                    <input type="checkbox" class="select-checkbox" id="LsosCheckbox" name="LsosCheckbox" {{ strpos($medicine->number_of_times, 'SOS') !== false ? 'checked' : '' }} onclick="handleCheckbox(this, 'SOS')"> SOS
                                </td>
                                <!-- <td>{{ $medicine->number_of_times }}</td> -->
                                <!-- <td>{{ $medicine->before_after }}</td> -->
                                <td>
                                    <input type="text" name="remarks[]" value="" class="form-control">
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
    <div class="modal fade text-left" id="previewtable" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document" style="max-width: max-content;">
            <div class="modal-content" id="printTbl">
                <div class="modal-header">
                <!-- <img id="add_pre_logo" alt="Logo" srcset="" style="height: 35px; width: 100px; object-fit: contain;"> -->
                <h6></h6>
                    <a href="#"><button id="printDiv" type="button" class="btn btn-outline-primary float-end print-button" onclick="printDiv('printTbl')">Print</button></a>
                </div>
                <div class="modal-body">

                    <div style="display:flex;">
		                <div class="modal-body modal-title" style="display:flex;justify-content:center; visibility: hidden;" id="">
                            <img id="add_pre_logo"  alt="Logo" srcset="" style="height: 150px; width: 300px; object-fit: contain; border-bottom :1px solid">
                            <h6 class="modal-title" id="pre_text_logo"  style="font-size: 1.8rem;"></h6>
		                </div>
	            	</div>
                    <br>
                    <br>
                    <br>
                    <div style="font-size:16px; display:flex;justify-content:flex-end;" ><b style="">Date :</b><span style="margin-left:30px">{{  date('d-M-Y') }}</span></div>
                    <div style="font-size:16px;margin-top:12px;" ><b style="">Name :</b><span style="margin-left:30px">{{ $patientList->name }}</span></div>
                    <div style="margin-top:12px;font-size:16px;"><b style="">Age :</b><span style="margin-left:30px">{{ $patientList->age }}</span><span style="margin-left:100px" ><b style="">Sex :</b><span style="margin-left:30px">{{ $patientList->sex == 1 ? 'Male' : 'Female ' }}</span></span> <span style="margin-left:100px"><b style="">Email Id :</b><span style="margin-left:30px">{{ $patientList->email }}</span></span></div>
                    <div style="margin-top:12px;font-size:16px;"><b style="">Address :</b><span style="margin-left:30px">{{ $patientList->address }}</span></div>
                    <div style="margin-top:12px;font-size:16px;"><b style="">Phone No :</b><span style="margin-left:30px">{{ $patientList->contact_1 }}</span></div>
                    <br>
                    <table class="table table-min-width" id="prescriptionTbl">
                        <thead>
                            <tr style="font-size: 14px;">
                                <th style="border: 0; border-bottom: 1px solid !important; padding: 16px 16px;">Medicine Name</th>
                                <th style="border: 0; border-bottom: 1px solid !important; padding: 16px 16px; width: 150px; text-align: center;">Number Of Times</th>
                                <!-- <th style="border: 0; border-bottom: 1px solid !important; padding: 16px 16px;">Before/After</th> -->
                                <th style="border: 0; border-bottom: 1px solid !important; padding: 16px 16px;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px;">
                            
                        </tbody>
                    </table>
                </div>
                    @if($signature)
                        <img src="{{ $signature }}" style="float:right;position:absolute;bottom:70px;right:5px; font-size:15px;" alt="Signature" height="80px" width="180px">
                    @else
                        <p style="float:right;position:absolute;bottom:70px;right:5px; font-size:15px;">No signature available</p>
                    @endif
                    <span style="float:right;position:absolute;bottom:70px;right:5px; font-size:15px;"><b>Doctor's Signature</b></span>
                    <div style="display: flex;justify-content: center;border-top: 1px solid #000;padding-top: 8px;position:absolute; bottom:0px;width:100vw">
                        <p style="color: #000;margin-right: 10px;text-align:center;font-family:Times New Roman">Siddhesh Optimus, Office No. 7, B Wing, First Floor, Sr.No. 211/1/7, Opposite Lunkad Queensland Society, Near Konark Epitome, Vimannagar, Pune - 14.</p> 
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
@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>

    <script>
        function handleCheckbox(checkbox, specialValue) {
            // Get all checkboxes in the same <td>
            var checkboxes = checkbox.parentNode.getElementsByTagName('input');

            // Iterate through all checkboxes
            for (var i = 0; i < checkboxes.length; i++) {
                // Disable all checkboxes except the one that was clicked
                checkboxes[i].disabled = checkboxes[i] !== checkbox && checkboxes[i].type === 'checkbox' && checkbox.checked;

                // Uncheck all checkboxes except the one that was clicked
                if (checkboxes[i] !== checkbox && checkboxes[i].type === 'checkbox') {
                    checkboxes[i].checked = false;
                }
            }
        }
    </script>
    <script>
        $(document).ready(function() {  
            // To apply datatable
            table = $("#tablelist").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    extend: 'csv',
                    title: 'List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                    'targets': [4], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            });

                 $('.drname').text('Dr. Gowthaman P. R.')
                $('.drnumber').text('9940066956')
                $('.drdeg').text('M.D.S., Oral And Maxillofacial Surgeon')
                $('.dremail').text('brammacbe@gmail.com')

            //To print table

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
            
            
            $("#previewBtn").click(function() {
                $("#prescriptionTbl > tbody").html(""); // Clear the table body before adding selected entries
                var TableRow = ``;
                
                var selectedEntries = []; // Store selected entries for saving
                
                $(".form-check-input:checked").each(function() {
                    var $row = $(this).closest("tr");
                    var medicineName = $row.find("td:eq(2)").text();
                    
                    var isMorning = $row.find("#LmorningCheckbox").is(":checked") ? 'M' : '';
                    var isAfternoon = $row.find("#LafternoonCheckbox").is(":checked") ? 'A' : '';
                    var isEvening = $row.find("#LeveningCheckbox").is(":checked") ? 'N' : '';
                    var isSOS = $row.find("#LsosCheckbox").is(":checked") ? 'SOS' : '';

                    
                    var numberOfTimes = '';

                        if (isMorning) {
                            numberOfTimes += isMorning;
                        }

                        if (isAfternoon) {
                            if (numberOfTimes !== '') {
                                numberOfTimes += '-';
                            }
                            numberOfTimes += isAfternoon;
                        }

                        if (isEvening) {
                            if ((isMorning || isAfternoon) && numberOfTimes !== '') {
                                numberOfTimes += '-';
                            }
                            numberOfTimes += isEvening;
                        }
                        if (isSOS) {
                            numberOfTimes += '-'+ isSOS;
                        }
                        
                    // var beforeAfter = $row.find("td:eq(4)").text();
                    var remarks = $row.find("input[name='remarks[]']").val(); // Get the remarks from the input field
                    
                    TableRow += `<tr>`;
                    TableRow += `<td>${medicineName}</td>`;
                    TableRow += `<td>${numberOfTimes}</td>`;
                    // TableRow += `<td>${beforeAfter}</td>`;
                    TableRow += `<td>${remarks}</td>`; // Display the remarks
                    TableRow += `</tr>`;
                    
                    // Add selected entry to array for saving
                    selectedEntries.push({
                        medicineName: medicineName,
                        numberOfTimes: numberOfTimes,
                        // beforeAfter: beforeAfter,
                        remarks: remarks
                    });
                });

                $("#prescriptionTbl > tbody").append(TableRow);
                            
                // Send an AJAX request to save prescription data
                $.ajax({
                    url: "{{ route('saveprescription') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        patient_id: "{{ $patientList->id }}",
                        selected_entries: selectedEntries
                    },
                    success: function(response) {
                        $('#billNo').text(response.billno);

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
                                window.location ();
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
            });

            // save and print
            $("#printBtn").click(function() {
                $("#prescriptionTbl > tbody").html(""); // Clear the table body before adding selected entries
                var TableRow = ``;
                
                var selectedEntries = []; // Store selected entries for saving
                
                $(".form-check-input:checked").each(function() {
                    var $row = $(this).closest("tr");
                    var medicineName = $row.find("td:eq(2)").text();
                    
                    var isMorning = $row.find("#LmorningCheckbox").is(":checked") ? 'M' : '';
                    var isAfternoon = $row.find("#LafternoonCheckbox").is(":checked") ? 'A' : '';
                    var isEvening = $row.find("#LeveningCheckbox").is(":checked") ? 'N' : '';
                    var isSOS = $row.find("#LsosCheckbox").is(":checked") ? 'SOS' : '';

                    var numberOfTimes = '';

                        if (isMorning) {
                            numberOfTimes += isMorning;
                        }

                        if (isAfternoon) {
                            if (numberOfTimes !== '') {
                                numberOfTimes += '-';
                            }
                            numberOfTimes += isAfternoon;
                        }

                        if (isEvening) {
                            if ((isMorning || isAfternoon) && numberOfTimes !== '') {
                                numberOfTimes += '-';
                            }
                            numberOfTimes += isEvening;
                        }

                        if (isSOS) {
                            numberOfTimes += '-'+ isSOS;
                        }
                        
                    // var beforeAfter = $row.find("td:eq(4)").text();
                    var remarks = $row.find("input[name='remarks[]']").val(); // Get the remarks from the input field
                    
                    TableRow += `<tr>`;
                    TableRow += `<td>${medicineName}</td>`;
                    TableRow += `<td>${numberOfTimes}</td>`;
                    // TableRow += `<td>${beforeAfter}</td>`;
                    TableRow += `<td>${remarks}</td>`; // Display the remarks
                    TableRow += `</tr>`;
                    
                    // Add selected entry to array for saving
                    selectedEntries.push({
                        medicineName: medicineName,
                        numberOfTimes: numberOfTimes,
                        // beforeAfter: beforeAfter,
                        remarks: remarks
                    });
                });

                $("#prescriptionTbl > tbody").append(TableRow);
                            
                // Send an AJAX request to save prescription data
                $.ajax({
                    url: "{{ route('saveprescription') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        patient_id: "{{ $patientList->id }}",
                        selected_entries: selectedEntries
                    },
                    success: function(response) {
                        $('#billNo').text(response.billno);

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
                                $('#printDiv').click();
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
            });



            // Get the button
            let mybutton = document.getElementById("myBtn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            scrollFunction = function () {
              if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
              } else {
                mybutton.style.display = "none";
              }
            }

            // When the user clicks on the button, scroll to the top of the document
            topFunction = function () {
              document.body.scrollTop = 0;
              document.documentElement.scrollTop = 0;
            }
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