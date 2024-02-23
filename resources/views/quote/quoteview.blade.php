@extends('layouts.app')

@section('content')
<style>
   
</style>
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    {{-- <h3>Quote List</h3> --}}
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
                        <a id="deletequote" class="btn btn-outline-danger deletequote mb-0">Delete</a>
                        <a href="{{ url('quotelist') }}" class="btn btn-outline-secondary mb-0">Back</a>
                        <button id="printButton" data-bs-toggle="modal" data-bs-target="#previewtable"  type="button" class="btn btn-outline-success">Print</button>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Treatment Plan Information</h4>
                </div>
                <div class="card-body">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr colspan=2>
                                    <th class="text-bold-500">Id</th>
                                    <td>{{ $quoteDetails->id }}</td>
                                    <th class="text-bold-500">Date</th>
                                    <td>{{ $quoteDetails->quote_date }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Patient</th>
                                    <td>{{ $quoteDetails->patient_name }}</td>
                                    <th class="text-bold-500">Treatment</th>
                                    <td>{{ $quoteDetails->treatment }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Teeth Numbers</th>
                                    <td>{{ $quoteDetails->teeth }}</td>
                                    <th class="text-bold-500">Doctor</th>
                                    <td>{{ $quoteDetails->doctor_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Charges Option 1</th>
                                    <td>{{ $quoteDetails->charge_opt_one }}</td>
                                    <th class="text-bold-500">Charges Option 2</th>
                                    <td>{{ $quoteDetails->charge_opt_two }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Charges Option 3</th>
                                    <td>{{ $quoteDetails->charge_opt_three }}</td>
                                    <th class="text-bold-500">Discount</th>
                                    <td>{{ $quoteDetails->discount }}</td>
                                </tr>
                                <tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <hr>
                    <div id="prinQuoteTable" class="card-body table-responsive">
                        <table class="table table-min-width" id="tablelist">
                            <thead>
                                <tr>
                                    <th class="table-min-width-small">Sr. No.</th>
                                    <th class="table-min-width-small">Treatment</th>
                                    <th class="table-min-width-small">ChargesOption1</th>
                                    <th class="table-min-width-small">ChargesOption2</th>
                                    <th class="table-min-width-small">ChargesOption3</th>
                                    <th class="table-min-width-small">Discount</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($QuoteRowList as $quote)
                                    <tr>
                                        <td class="table-min-width-small">{{ $i++; }}</td>
                                        <td class="table-min-width-small">{{ $quote->treatment }}</td>
                                        <td class="table-min-width-small">{{ $quote->chargesOption1 }}</td>
                                        <td class="table-min-width-small">{{ $quote->chargesOption2 }}</td>
                                        <td class="table-min-width-small">{{ $quote->chargesOption3 }}</td>
                                        <td class="table-min-width-small">{{ $quote->discount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                	<img src="https://demoadmsoft.in/admsoft-dental/public/assets/images/logo/iDentX-logo-new3.png" alt="Logo" srcset="" style="height: 35px; width: 100px; object-fit: contain;">
                    <h6 class="modal-title" id="myModalLabel33" style="font-size: 1.8rem;"></h6>
                	<a href="#"><button id="printDiv" type="button" class="btn btn-outline-primary float-end" onclick="printDiv('printTbl')">Print</button></a>
                </div>
                <div class="modal-body">

	                <div style="display:flex;">
		                <div class="modal-body modal-title" id="">
		                	<h5 class="card-title" style=" font-size: 16px; font-weight: 600;  margin-top: 12px;line-height: 25px;">DR.GIRISH SHAH <br>M.B.B.S.M.D.(Medicine)<br>Reg.No.30143</h5>
		                </div>

		                <div class="modal-body modal-title" id="">
		                	<h5 class="card-title" style=" font-size: 16px; font-weight: 600; margin-left: 100px; margin-top: 12px;line-height: 25px;">Phone No:451560/9307594757<br>Clinic Address:Office No-309,<br> Chandrarang Sliver,Shrusti Chowk, <br>Pimple Gurav, Pune, MH, IN - 411061</h5>
		                </div>
	            	</div>
	            	<hr>

                	<h5 class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px;">Name : <span id="VisitPatientName">{{ $quoteDetails->patient_name }}</span> <span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;">Date : {{  date('d-M-Y') }}</span></h5>
                	<h5 class="card-title" style=" font-size: 16px; font-weight: 600; ">Age : <span id="VisitPatientYears"></span> {{ $quoteDetails->p_age }} <span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;">Gender : <span id="VisitPatientGender">{{$quoteDetails->pSex == 1 ? 'Male' : 'Female'}}</span> </span></h5>
                	<br>
                    <hr>
                    <table class="table table-bordered dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr>
                                    <th class="text-bold-500">Treatment</th>
                                    <td>{{ $quoteDetails->treatment }}</td>
                                    <th class="text-bold-500">Doctor</th>
                                    <td>{{ $quoteDetails->doctor_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Teeth Numbers</th>
                                    <td>{{ $quoteDetails->teeth }}</td>
                                    <th class="text-bold-500">Charges Option 1</th>
                                    <td>{{ $quoteDetails->charge_opt_one }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Charges Option 2</th>
                                    <td>{{ $quoteDetails->charge_opt_two }}</td>
                                    <th class="text-bold-500">Charges Option 3</th>
                                    <td>{{ $quoteDetails->charge_opt_three }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Discount</th>
                                    <td>{{ $quoteDetails->discount }}</td>
                                </tr>
                                <tr>
                            </tbody>
                        </table>
                    <br>
                    <hr>
                        <div id="prinQuoteTable" class="card-body table-responsive">
                        <table class="table table-min-width" id="tablelist">
                            <thead>
                                <tr>
                                    <th class="table-min-width-small">Sr. No.</th>
                                    <th class="table-min-width-small">Treatment</th>
                                    <th class="table-min-width-small">ChargesOption1</th>
                                    <th class="table-min-width-small">ChargesOption2</th>
                                    <th class="table-min-width-small">ChargesOption3</th>
                                    <th class="table-min-width-small">Discount</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($QuoteRowList as $quote)
                                    <tr>
                                        <td class="table-min-width-small">{{ $i++; }}</td>
                                        <td class="table-min-width-small">{{ $quote->treatment }}</td>
                                        <td class="table-min-width-small">{{ $quote->chargesOption1 }}</td>
                                        <td class="table-min-width-small">{{ $quote->chargesOption2 }}</td>
                                        <td class="table-min-width-small">{{ $quote->chargesOption3 }}</td>
                                        <td class="table-min-width-small">{{ $quote->discount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- <div style="display: flex;justify-content: flex-end;border-top: 1px solid #000;padding-top: 8px;margin-top: 10px;">
                        <strong style="color: #000;margin-right: 10px;">Total :</strong> 
                        <span style="color: #000;" id="VisitPatientTotalAmount">550</span>
                    </div> -->
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
    </div>
@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script>
        $(document).ready(function() {
            
                // // Function to handle the print button click
                // $("#printButton").on("click", function() {
                //     window.print(); // Trigger the print action
                // });

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

            $(function(){
                $(".dateofbirth").datepicker({ 
                    dateFormat: 'dd-M-yy',
                    changeYear: true,
                    changeMonth: true,
                    yearRange: "c-150:c+150"
                });
                $(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
            }); 

            // To delete patient
            $(document).on("click", ".deletequote", function(){ 
                var quoteplanid = {{$quoteDetails->id}};
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
    });
        
    </script>
@endsection