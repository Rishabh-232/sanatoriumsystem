@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Doctor List</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Patient</li>
                        </ol>
                    </nav> -->
                    <a href="{{ url('/doctoradd') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a>
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
                                <th class="table-min-width-small padding-small">Sr. No.</th>
                                <th>Name of the Doctor</th>
                                <th class="table-min-width-small">Age</th>
                                <th class="table-min-width-small">Sex</th>
                                <th class="table-min-width-small">Degree</th>
                                <th class="table-min-width-small">Experience (Years)</th>
                                <th>Clinic Name</th>
                                <th class="table-min-width-small">Location</th>
                                <th>Book Video Consultations</th>
                                <th>Book Hospital Appointment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($doctorlist as $doctor)
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td>{{ $doctor->doctor_name }}</td>
                                    <td class="table-min-width-small">{{ $doctor->age }}</td>
                                    <td class="table-min-width-small">{{ $doctor->sex == 1 ? 'Male' : 'Female ' }}</td>
                                    <td class="table-min-width-small">{{ $doctor->degree }}</td>
                                    <td class="table-min-width-small">{{ $doctor->experience }}</td>
                                    <td>{{ $doctor->clinic_name }}</td>
                                    <td class="table-min-width-small">{{ $doctor->location }}</td>
                                    <td>{{ $doctor->book_video_consult }}</td>
                                    <td>{{ $doctor->book_hospital_app }}</td>
                                    <td class="button-holder">
                                        <a href="{{ url('doctorview'."/".$doctor->id) }}" class="btn btn-outline-info">View</a>
                                        <a href="{{ url('doctoredit'."/".$doctor->id) }}" class="btn btn-outline-warning">Edit</a>
                                        <a id="deleteperson" class="btn btn-outline-danger deletedoctor" data-id="{{$doctor->id}}">Delete</a>
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
                    title: 'Doctor-List'
                } ],
                'lengthMenu': [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                'lengthChange': true,  // Set to true to enable length change dropdown
                'searching': true,
                'order': [[0, 'asc']],
                'columnDefs': [{
                    'targets': [8], // column index (start from 0)
                    'orderable': false // set orderable false for selected columns
                }]
            });

            // get data of view visit
            // $(document).on("click", ".add_visit", function(){
            //     var id = $(this).data('id');
            //     $("#patientId").val(id);
            // });

            //to submit visit
            // $("form#addVisitForm").submit(function(e){
            //     var id = $("#patientId").val();
            //     var $this = $(this);
            //     var formData = $this.serializeArray();
            //     $("#overlay").fadeIn(300);
            //     $.ajax({
            //         url: "{{ url('addVisit') }}/"+id,
            //         type: "POST",
            //         data: formData,
            //         dataType: "json", 
            //         success: function(response) {
            //              $("#overlay").fadeOut(300);
            //             if(response.result)
            //             {
            //                 Swal.fire({
            //                     icon: "success",
            //                     title: "Success",
            //                     timer: 2000,
            //                     button:"OK",
            //                     showConfirmButton:true
            //                 }).then(function() {
            //                     window.location.reload();
            //                 });
            //             }
            //             else
            //             {
            //                 Swal.fire({
            //                     icon: "error",
            //                     title: "Error"
            //                 });
            //             }
            //         }
            //     });
                
            //     e.preventDefault();
            // });

            // to pass id to visit modal
            // $(document).on("click", ".add_visit", function(){
            //     var id = $(this).data('id');
            //     $("#patientId").val(id);
            // });

            // // to pass id to lab order modal
            // $(document).on("click", ".add_laborder", function(){
            //     var id = $(this).data('id');
            //     $("#patientIdLabOrder").val(id);
            // });

            //to submit Lab order
            // $("form#LaborderForm").submit(function(e){
            //     var id = $("#patientIdLabOrder").val();
            //     var $this = $(this);
            //     var formData = $this.serializeArray();
            //     $("#overlay").fadeIn(300);
            //     $.ajax({
            //         url: "{{ url('addLabOrder') }}/"+id,
            //         type: "POST",
            //         data: formData,
            //         dataType: "json",
            //         success: function(response) {
            //              $("#overlay").fadeOut(300);
            //             if(response.result)
            //             {
            //                 Swal.fire({
            //                     icon: "success",
            //                     title: "Success",
            //                     timer: 2000,
            //                     button:"OK",
            //                     showConfirmButton:true
            //                 }).then(function() {
            //                     window.location.reload();
            //                 });
            //             }
            //             else
            //             {
            //                 Swal.fire({
            //                     icon: "error",
            //                     title: "Error"
            //                 });
            //             }
            //         }
            //     });
            //     e.preventDefault();
            // });

            // to delete patient data from patient list 
            $(document).on("click", ".deletedoctor", function(){ 
                var patientid = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmation',
                    text: 'Are you sure you want to delete this Doctor\'s data?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $("#overlay").fadeIn(300);    
                        $.ajax({
                            url: "{{ route('deletedoctordata') }}",
                            type: "DELETE",
                            data: {"doctorid": patientid, "_token": $("input[name='_token']").val()},
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
                                        window.location.href = "{{ url('/doctorlist') }}";
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
            // pushselectedteethtoArray = function(){
            //     selectedTeethArr = [];
            //     $('.teethsection img.selected').each(function() {
            //         selectedTeethArr.push($(this).attr('data-id'));
            //     });
            //     if(selectedTeethArr.length != 0)
            //     {
            //         $("#selectteeth").html("Selected Teeth "+selectedTeethArr);
            //         $("#selectteeth").addClass("text-success").removeClass("text-danger");
            //         $("#selectedteeth").val(JSON.stringify(selectedTeethArr, null, 2));
            //     }
            //     else
            //     {
            //         $("#selectteeth").html("Select Teeth");
            //         $("#selectteeth").addClass("text-danger").removeClass("text-success");
            //         $("#selectedteeth").val("");
            //     }
            // }

            // To select Image
            // $('.teethsection img').click(function () {
            //     $(this).toggleClass('selected');
            //     var toothId = $(this).attr('data-id');
            //     if($(this).hasClass('selected'))
            //     {
            //         var tempSrc = '{{ asset('assets/images/infected') }}/'+toothId+".jpg";
            //     }
            //     else
            //     {
            //         var tempSrc = '{{ asset('assets/images/normal') }}/'+toothId+".jpg";   
            //     }
            //     $(this).attr('src', tempSrc);
            //     pushselectedteethtoArray();
            // });

            // $('#addVisitModal, #newLabOrder, #selectteethModal').modal({
            //     backdrop: 'static',
            //     keyboard: false
            // });

            // $(function(){
            //     $(".dateofbirth").datepicker({ 
            //         dateFormat: 'dd-M-yy',
            //         changeYear: true,
            //         changeMonth: true,
            //         yearRange: "c-150:c+150"
            //     });
            //     $(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
            // });
        });
    </script>
@endsection