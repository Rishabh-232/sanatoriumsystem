@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Billing List</h3>
                </div>
                <!-- <div class="col-12 col-md-6 order-md-2 order-first">
                    <a href="#" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a>
                </div> -->
            </div>
        </div>
        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger for login form modal -->
                </div>
                <div class="card-body table-responsive asd">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th class="table-min-width-small padding-small">Sr. No.</th>
                                <th>Name</th>
                                <th class="table-min-width-small">Age</th>
                                <th class="table-min-width-small">Sex</th>
                                <th>Treatment</th>
                                <th>Contact No</th>
                                <th class="table-min-width-small">Paid-Amount</th>
                                <th class="table-min-width-small">Total-Amount</th>
                                <th class="table-min-width-small">Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>  
                        <?php $i = 1; ?>
                        @foreach($visitlist as $visit)    
                            <tr>
                                <td class="table-min-width-small">{{ $i++; }}</td>
                                <td>{{ $visit->name }}</td>
                                <td class="table-min-width-small">{{ $visit->age }}</td>
                                <td class="table-min-width-small">{{ $visit->sex == 1 ? 'Male' : 'Female ' }}</td>
                                <?php
                                        $jsonData = $visit->treatinfo;

                                        // Decode the JSON data into a PHP array
                                        $data = json_decode($jsonData, true);

                                                                                // Get the keys from the array and join them with commas
                                        $keys = implode(', ', array_keys($data));

                                    ?>
                                    <td><?php echo $keys; ?></td>
                                <!-- <td>{{ $visit->work_done }}</td> -->
                                <td>{{ $visit->contact_1 }}</td>
                                <td class="table-min-width-small">{{ $visit->total_amount }}</td>
                                <td class="table-min-width-small">{{ $visit->balance_amount }}</td>
                                <td class="table-min-width-small">{{ $visit->remaining_amount}}</td>
                                <td class="button-holder">
                                    <a href="#" class="view_visit" data-bs-toggle="modal" data-bs-target="#previewtable" data-id="{{ $visit->id }}">
                                        <button id="previewBtn" type="button" class="btn btn-outline-primary">Generate Bill</button>
                                    </a>
                                    <a href="{{ url('sendBilling'.'/'.$visit->id) }}" class="btn btn-outline-success mb-0">Send on Whatsapp</a>
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

    <!--Add billing form Modal -->
    <div class="modal fade text-left" id="previewtable" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document" style="max-width: max-content;">
            <div class="modal-content" id="printTbl">
                <div class="modal-header">
                	<!-- <img id="BillPlogo" alt="Logo" srcset="" style="height: 35px; width: 100px; object-fit: contain;"> -->
                    <h6></h6>
                	<a href="#"><button id="printDiv" type="button" class="btn btn-outline-primary float-end print-button" onclick="printDiv('printTbl')">Print</button></a>
                </div>
                <div class="modal-body">
                    <div style="display:flex;">
		                <div class="modal-body modal-title" style="display:flex;justify-content:center;" id="">
                            <img id="BillPlogo"  alt="Logo" srcset="" style="height: 150px; width: 300px; object-fit: contain; border-bottom :1px solid">
                            <h6 class="modal-title" id="billTextlogo"  style="font-size: 1.8rem;"></h6>
		                </div>
	            	</div>
	                <div style="display:flex; border-bottom :1px solid">
		                <div class="modal-body modal-title" id="">
		                	<p class="card-title" style="display:flex;justify-content:center;font-size: 12px; font-weight: 600; color:black margin-left: 100px; margin-top: 12px;line-height: 25px;text-align:center; font-family:Times New Roman">Siddhesh Optimus, Office No. 7, B Wing, First Floor, Sr.No. 211/1/7, Opposite Lunkad Queensland Society, Near Konark Epitome, Vimannagar, Pune - 14.</p>
		                	<p class="card-title" style="display:flex;justify-content:center;font-size: 12px; font-weight: 600; color:black margin-left: 100px; margin-top: 12px;line-height: 25px;"><i class="fas fa-phone" style="margin-top:5px"></i>&nbsp;<span class="drnumber"></span>&nbsp;|&nbsp;<i class="fas fa-envelope" style="margin-top:5px"></i>&nbsp;<span class="dremail"></span></p>
		                </div>
	            	</div>
                    <br>
                	<p class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px; font-family:Times New Roman"><b>Name : <span id="VisitPatientName"></span></b> <span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;"><b>Date : {{  date('d-M-Y') }}</b></span></p>
                	<p class="card-title" style=" font-size: 16px; font-weight: 600; font-family:Times New Roman"><b>Bill No : <span id="Visitbillno"></span></b> <span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;"><b>ID No : <span id="VisitIdno"></span></b> </span></p>
                	<p class="card-title" style=" font-size: 16px; font-weight: 600; font-family:Times New Roman"><b>Address : <span id="VisitPatientYears"></span></b> <span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;"><b>Ph No : <span id="VisitPatientGender"></span></b> </span></p>
                	<br>
                    <table class="table mb-0 table-lg" id="prescriptionTbl" style="border:1px solid">
                        <thead>
                            <tr style="font-size: 14px;">
                                <th style=" border: 1px solid !important; padding: 16px 16px;">Sr No</th>
                                <th style=" border: 1px solid !important; padding: 16px 16px;">Treatment</th>
                                <th style=" border: 1px solid !important; padding: 16px 16px;">Amount</th>
                                <th style=" border: 1px solid !important; padding: 16px 16px;">Balance</th>

                            </tr>
                        </thead>
            			<tbody style="font-size: 14px;">
                            <td style="border: 1px solid; color: black; padding: 10px 15px !important;" id="">1</td>
                            <td style="border: 1px solid; color: black; padding: 10px 15px !important;" id="VisitPatientTreatment">test</td>
                            <td style="border: 1px solid; color: black; padding: 10px 15px !important;" id="VisitPatientPaidAmount">650.00</td>
                            <td style="border: 1px solid; color: black; padding: 10px 15px !important;" id="VisitPatientBalanceAmount">650.00</td>

            			</tbody>
        			</table>
                    <div style="display: flex;justify-content: flex-end;padding-top: 8px;margin-top: 5%;">
                        <strong style="color: #000;margin-right: 10px;">Total :</strong> 
                        <span style="color: #000;" id="VisitPatientTotalAmount">550</span>
                    </div>
                    @if($signature)
                        <img src="{{ $signature }}" style="float:right;position:absolute;bottom:70px;right:5px; font-size:15px;" alt="Signature" height="80px" width="180px">
                    @else
                        <p style="float:right;position:absolute;bottom:70px;right:5px; font-size:15px;">No signature available</p>
                    @endif
                    <span style="float:right;margin-top: 50%; font-size:15px;"><b>Authorized Signatory</b></span>
                    <div style="display: flex;justify-content: center;border-top: 1px solid #000;padding-top: 8px;margin-top: 55%;font-family:Times New Roman">
                        <strong style="color: #000;margin-right: 10px;text-align:center;">Siddhesh Optimus, Office No. 7, B Wing, First Floor, Sr.No. 211/1/7, Opposite Lunkad Queensland Society, Near Konark Epitome, Vimannagar, Pune - 14.</strong> 
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

@endsection

@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.drnumber').text('9535751921')
                $('.dremail').text('ishitajakhanwal90@gmail.com')
            // To apply datatable
            table = $("#tablelist").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    title: 'Patient-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [8], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
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


           //
            $(document).on("click", ".view_visit", function(){    
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "{{ route('getvisitdata') }}",
                    type: "GET",
                    data: {"visitid": id, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                        $("#VisitPatientName").text(response.data.name);
                        $("#VisitPatientYears").text(response.data.address);
                        $("#Visitbillno").text(response.data.id);
                        $("#VisitIdno").text(response.data.patient_uniq_id);
                        // var gender = response.data.sex === 1 ? "Male" : "Female";
                        $("#VisitPatientGender").text(response.data.mobno);
                        $("#VisitPatientPaidAmount").text(response.data.total_amount);
                        $("#VisitPatientTotalAmount").text(response.data.total_amount);
                         $("#VisitPatientBalanceAmount").text(response.data.remaining_amount);

                        // Assuming response.data.work_done is a JSON string
                        var workDone = JSON.parse(response.data.treatinfo);
                        
                        // Extract the keys from the JavaScript object
                        var keys = Object.keys(workDone).join(', ');
                        
                        $("#VisitPatientTreatment").text(keys);
                    }
                });
            });

        });
    </script>
    <script>
		var billTextlogo = '{{ env('TEXT_LOGO') }}';
		var BillPlogo = '{{ env('IMG_LOGO') }}';
        var imgElement = document.getElementById('BillPlogo');
        imgElement.src = BillPlogo;
        $('#billTextlogo').text(billTextlogo);

        if (billTextlogo && billTextlogo.trim() !== '') {
        // If textLogo is not empty, hide the image elements
            imgElement.style.display = 'none';
        } else {
            // If textLogo is empty or null, display the image elements
            imgElement.src = imgLogo;
        }
	</script>
@endsection