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
                        <a href="{{ url('consentmasteredit'.'/'.$consentmasterDetails->id) }}" class="btn btn-outline-info mb-0">Edit</a>
                        <a id="deleteperson" class="btn btn-outline-danger deleteconsent mb-0">Delete</a>
                        <button id="print" data-bs-toggle="modal" data-bs-target="#previewtable"  type="button" class="btn btn-outline-primary">Print</button>
                        <a href="{{ url('consentmasterlist') }}" class="btn btn-outline-secondary mb-0">Back</a>
                    </div>
                </div>
            </div>
            <div class="card" id="printConsentdiv">
                <div class="card-header header-center">
                    <h2>MODEL FORM OF INFORMED CONSENT</h2>
                </div>

                <div class="card-body">
                    
                    <div class="consent-form-top">
                        <ul>
                            <li>
                                <h5>{{$consentmasterDetails->heading}}</h5>
                                <p>{{$consentmasterDetails->consent}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
    <div class="modal fade text-left" id="previewtable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document" style="max-width: max-content;">
                <div class="modal-content concentpop" id="printTbl">
                    <div class="modal-header">
                        <!-- <img src="https://demoadmsoft.in/admsoft-dental/public/assets/images/logo/iDentX-logo-new3.png" alt="Logo" srcset="" style="height: 35px; width: 140px; object-fit: contain;"> -->
                        <h6 class="modal-title" id="myModalLabel33" style="font-size: 1.5rem;"></h6>
                        <a href="#"><button id="printDiv" type="button" class="btn btn-outline-primary float-end" onclick="printConsentDiv('printConsent')">Print</button></a>
                    </div>
                    <div class="modal-body">
                        <div class="card" id="printConsent">
                            <div class="card-header header-center">
                                <h2>MODEL FORM OF INFORMED CONSENT</h2>
                            </div>
                            <div class="card-body">
                                <div class="consent-form-top">
                                    <ul>
                                        <li>
                                            <h5>{{$consentmasterDetails->heading}}</h5>
                                            <p>{{$consentmasterDetails->consent}}</p>
                                        </li>
                                    </ul>
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

            // To delete patient
            $(document).on("click", ".deleteconsent", function(){ 
                var consentid = {{$consentmasterDetails->id}}; 
                $("#overlay").fadeIn(300);   
                $.ajax({
                    url: "{{ url('/deleteconsentmaster') }}",
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
                                window.location.href = "{{ url('/consentmasterlist') }}";
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
@endsection