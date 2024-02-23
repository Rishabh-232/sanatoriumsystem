@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
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
                <div class="card-body">
                    <div class="buttons text-center">
                        <a href="{{ url('labenotedit'.'/'.$doctorDetails->id) }}" class="btn btn-outline-info mb-0">Edit</a>
                        <a id="deleteperson" class="btn btn-outline-danger deletedoctor mb-0">Delete</a>
                        <a href="{{ url('labnotelist') }}" class="btn btn-outline-secondary mb-0">Back</a>
                        <button id="printButton" data-bs-toggle="modal" data-bs-target="#previewtable"  type="button" class="btn btn-outline-success">Print</button>
                        <button id="downloadprint" type="button" class="btn btn-outline-primary">Download Receipt</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Lab Note Information</h4>
                </div>
                <div class="card-body">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr colspan=2>
                                    <th class="text-bold-500">Job No</th>
                                    <td>{{ $doctorDetails->id }}</td>
                                    <th class="text-bold-500">Patient Name</th>
                                    <td>{{ $doctorDetails->patient_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Lab Name</th>
                                    <td>{{ $doctorDetails->labname }}</td>
                                    <th class="text-bold-500">Teeth/Tooth</th>
                                    <td>{{ $doctorDetails->teeth_tooth }}</td>
                                </tr>
                                <tr>   
                                    <th class="text-bold-500">Type of Work</th>
                                    <td>{{ $doctorDetails->type_of_work }}</td>
                                    <th class="text-bold-500">Teeth Shades Common</th>
                                    <td>{{ $doctorDetails->multishade }}</td>

                                </tr>
                                <tr colspan=2>
                                    <th class="text-bold-500">Work Given In The Form</th>
                                    <td>{{ $doctorDetails->selectedOption }}</td>
                                    <th class="text-bold-500">Intructions</th>
                                    <td>{{$doctorDetails->additional}}</td>
                                </tr>
                                <tr colspan=2>
                                    <th class="text-bold-500">Teeth Shades Individual</th>
                                    <td>{{ $doctorDetails->shades }}</td>
                                    <th class="text-bold-500">Excepted Date of Deliver</th>
                                    <td>{{ $doctorDetails->excepted_date_of_deliver }}</td>
                                </tr>
                                <!-- <tr>
                                    <th class="text-bold-500">Instructions</th>
                                    <?php
                                        $note = $doctorDetails->note; // Your comma-separated data
                                        $values = explode(',', $note); // Split the data by commas

                                        foreach ($values as $value) {
                                            echo "<tr>";
                                            echo "<td>$value</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>

    <div class="modal fade text-left" id="previewtable" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document" style="max-width: max-content;">
            <div class="modal-content" id="printTbl">
                <div class="modal-header">
                    <!-- <img id="labnote_logo" alt="Logo" srcset="" style="height: 35px; width: 100px; object-fit: contain;"> -->
                    <!-- <h6 class="modal-title" id="labnote_text_logo"  style="font-size: 1.8rem;"></h6> -->
                    <h6></h6>
                    <a href="#"><button id="printDiv" type="button" class="btn btn-outline-primary float-end print-button" onclick="printDiv('printTbl')">Print</button></a>
                </div>
                <div class="modal-body">
                <div style="display:flex;">
		                <div class="modal-body modal-title" style="display:flex;justify-content:center;" id="">
                            <img id="labnote_logo"  alt="Logo" srcset="" style="height: 150px; width: 300px; object-fit: contain; border-bottom :1px solid">
                            <h6 class="modal-title" id="labnote_text_logo"  style="font-size: 1.8rem;"></h6>
		                </div>
	            	</div>
                    <br>
                    <div style="display:flex; border-bottom :1px solid">
                        <div class="modal-body modal-title" id="">
                        <p class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px;font-family:Times New Roman"><b><span class="drname"></span></b><span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;"><i class="fas fa-phone" style="margin-top:5px"></i>&nbsp;<span class="drnumber"></span></span></p>
                        <p class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px;font-family:Times New Roman"><span class="drdeg"></span><span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;"><i class="fas fa-envelope" style="margin-top:5px"></i>&nbsp;<span class="dremail"></span></p>
                        </div>
                    </div>
                    <br>
                    <h5 class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px;">Job No : {{ $doctorDetails->id }} <span id="VisitPatientName"></span> <span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;">Date : {{  date('d-M-Y') }}</span></h5>
                    <h5 class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px;">Patient Id : {{ $doctorDetails->patient_uniq_id }}</h5>
                    <br>
                     <table class="table printtbl dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr>
                                    <th class="text-bold-500">Lab Name</th>
                                    <td>{{ $doctorDetails->labname }}</td>
                                </tr>
                                <tr colspan=2>
                                    <th class="text-bold-500">Patient Name</th>
                                    <td>{{ $doctorDetails->patient_name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Teeth/Tooth</th>
                                    <td>{{ $doctorDetails->teeth_tooth }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Type of Work</th>
                                    <td>{{ $doctorDetails->type_of_work }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500">Work Given In The Form</th>
                                    <td>{{ $doctorDetails->selectedOption }}</td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-bold-500"></th>
                                    <td></td>
                                </tr>
                               
                                
                                <tr>   
                                    <th class="text-bold-500">Excepted Date for Work</th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table printtbl dataTable table-min-width-xl mb-0">
                            <tbody>
                                <tr>   
                                    <th class="text-bold-500">Coping/Try In:</th>
                                    <td><hr></td>
                                    <th class="text-bold-500">Final Work:</th>
                                    <td>{{ date('d-M-Y', strtotime($doctorDetails->excepted_date_of_deliver)) }}</td>
                                </tr>
                                @auth
                                <tr>   
                                    <th class="text-bold-500"><hr></th>
                                    <td><hr></td>
                                    <th class="text-bold-500">Prepared By</th>
                                    <td>{{ Auth::user()->name }}</td>
                                </tr>
                                @endauth
                            </tbody>
                        </table>
                        <div class="note">
                            <!-- <h6 class="heading">Instructions</h6> -->
                            <!-- <?php
                            $noteValues = explode(',', $doctorDetails->note); // Split the note field by commas
                            foreach ($noteValues as $noteValue) {
                                echo "<p>$noteValue</p>";
                            }
                            ?>-->
                            <h6 class="heading">Instructions</h6>
                            {{$doctorDetails->additional}}
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
    </div>
@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script>
        // Function to redirect when the button is clicked
        document.getElementById("downloadprint").addEventListener("click", function () {
            // Replace 'https://www.example.com' with the URL you want to go to
            window.location.href = "{{ url('generatePDF'.'/'.$doctorDetails->id) }}";
        });
    </script>
    <script>
        $(document).ready(function() {

                $('.drname').text('Dr. Ishita')
                $('.drnumber').text('9535751921')
                $('.drdeg').text('M.D.S. (prosthodontist & Implantologist)')
                $('.dremail').text('ishitajakhanwal90@gmail.com')

            var hiddenValue = '{{ request()->query('print') }}';
            if(hiddenValue == 'yes'){
                $("#printButton").click();
            }
            var hideValue = '{{ request()->query('Download') }}';
            if(hideValue == 'yes'){
                $("#downloadprint").click();
            }


            // To delete patient
            $(document).on("click", ".deletedoctor", function(){ 
                var doctorid = {{$doctorDetails->id}}; 
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
                                window.location.href = "{{ url('/labnotelist') }}";
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
		var labnote_text_logo = '{{ env('TEXT_LOGO') }}';
		var labnote_logo = '{{ env('IMG_LOGO') }}';
        var imgElement = document.getElementById('labnote_logo');
        imgElement.src = labnote_logo;
        $('#labnote_text_logo').text(labnote_text_logo);

        if (labnote_text_logo && labnote_text_logo.trim() !== '') {
        // If textLogo is not empty, hide the image elements
            imgElement.style.display = 'none';
        } else {
            // If textLogo is empty or null, display the image elements
            imgElement.src = imgLogo;
        }
	</script>
@endsection