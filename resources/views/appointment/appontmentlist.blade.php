@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Appointment List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Appointment</li>
                        </ol>
                    </nav> -->
                    <a data-bs-toggle="modal" data-bs-target="#addreftreatModal" class="new-button"> <button type="button" class="btn btn-outline-primary float-end">New Appointment</button></a>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger for login form modal -->
                    <!-- <a data-bs-toggle="modal" data-bs-target="#addreftreatModal" class="btn btn-outline-primary float-end">New Appointment</a> -->
                    <a href="{{ url('/addappontment') }}"><button type="button" class="btn btn-outline-primary float-end">New Appointment</button></a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($appointList as $applist)
                                <tr>
                                    <td>{{ $i++; }}</td>
                                    <td>{{ $applist->doctor }}</td>
                                    <td class="button-holder">
                                        <a href="#" class="btn btn-outline-warning edit_appointment"data-bs-toggle="modal" data-bs-target="#appointedit" data-id="{{ $applist->id }}">Edit</a>
                                        <a id="" class="btn btn-outline-danger deletappointment" data-id="{{ $applist->id }}">Delete</a>
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

    <!--Add Reference treatments form Modal -->
    <div class="modal fade text-left" id="addreftreatModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Appointment</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="addappointmentForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="appointId" id="appointId">
                        <label>Start Time</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control Timedatepicker" id="start_time" name="start_time">
                        </div>
                        <label>End Time</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control Timedatepicker" id="end_time" name="end_time">
                        </div>
                        <label>Patient's Name</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="patient_name" name="patient_name">
                        </div>
                        <label>Description</label>
                        <div class="form-group">
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
    <!--Edit Reference treatment form Modal -->
    <div class="modal fade text-left" id="appointedit" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Appointment</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="editappointmentForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="Eappointid" id="Eappointid">
                        <label>Start Time</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control Timedatepicker" id="Estart_time" name="Estart_time">
                        </div>
                        <label>End Time</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control Timedatepicker" id="Eend_time" name="Eend_time">
                        </div>
                        <label>Patient's Name</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Epatient_name" name="Epatient_name">
                        </div>
                        <label>Description</label>
                        <div class="form-group">
                        <textarea class="form-control" id="Edescription" name="Edescription" rows="3"></textarea>
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
    <!-- // loader when net slow -->
    <!-- <div id="overlay">
      <div class="cv-spinner">
        <button class="btn btn-secondary" type="button" disabled>
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Processing...
        </button>
      </div>
    </div> -->
@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script src="{{ url('/') }}/assets/js/jquery.datetimepicker.js"></script>
    <script>
        $(document).ready(function() {
            var dateNow = getDateTimeForDatepicker(0);
            var dateNYr = getDateTimeForDatepicker(1);
            $(".Timedatepicker").datetimepicker({
                format:'d-M-y H:i',
                value: dateNow
            });

            // To get current datetime
            function getDateTimeForDatepicker(plusyear) {
                var now     = new Date(); 
                var year    = now.getFullYear()+plusyear;
                var month   = now.getMonth()+1; 
                var day     = now.getDate();
                var hour    = now.getHours();
                var minute  = now.getMinutes();
                var second  = now.getSeconds(); 
                if(month.toString().length == 1) {
                     month = '0'+month;
                }
                if(day.toString().length == 1) {
                     day = '0'+day;
                }   
                if(hour.toString().length == 1) {
                     hour = '0'+hour;
                }
                if(minute.toString().length == 1) {
                     minute = '0'+minute;
                }
                if(second.toString().length == 1) {
                     second = '0'+second;
                }   
                var dateTime = year+'-'+month+'-'+day+' '+hour+':'+minute;   
                return dateTime;
            }

            // To apply datatable
            table = $("#tablelist").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    extend: 'csv',
                    title: 'Partition-List'
                } ],
                'order': [[0, 'asc']],
                'columnDefs': [ {
                    'targets': [2], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            }); 

             //to submit add appointment
            $("#addappointmentForm").submit(function(e){
                var $this = $(this);
                var formData = new FormData(this);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ url('addappointment') }}",
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
                                window.location.href = "{{ url('/appontmentlist') }}";
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

            // get data of edit appointment data
            $(document).on("click", ".edit_appointment", function(){    
                var appointid = $(this).data('id');
                $("#overlay").fadeIn(300);    
                console.log(appointid);
                $.ajax({
                    url: "{{ route('getappointmentdata') }}",
                    type: "GET",
                    data: {"appointid": appointid, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                        $("#overlay").fadeOut(300);
                        $("#Eappointid").val(response.data.id);
                        $("#Estart_time").val(response.data.from_time);
                        $("#Eend_time").val(response.data.to_time);
                        $("#Epatient_name").val(response.data.doctor);
                        $("#Edescription").val(response.data.remarks);
                    }
                });
            });

            // To Update reftreatment data
            $("form#editappointmentForm").submit(function(e){
                var $this = $(this);
                var formData = $this.serializeArray();

                $.ajax({
                    url: "{{ route('updateappointment') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json", 
                    success: function(response) {
                        if(response.result)
                        {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                timer: 2000,
                                button:"OK",
                                showConfirmButton:true
                            }).then(function() {
                                window.location.href = "{{ url('/appontmentlist').'/'.Request::segment(2)  }}";
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

            // to delete appointment data from list 
            $(document).on("click", ".deletappointment", function(){ 
                var appid = $(this).data('id');
                $("#overlay").fadeIn(300);    
                $.ajax({
                    url: "{{ route('deletappointmentdata') }}",
                    type: "DELETE",
                    data: {"appid": appid, "_token": $("input[name='_token']").val()},
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
                                window.location.href = "{{ url('/appontmentlist') }}";
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

            //Disable popup on click out side to page

            $('#addreftreatModal, #appointedit').modal({
                backdrop: 'static',
                keyboard: false
            });

        });
    </script>
@endsection