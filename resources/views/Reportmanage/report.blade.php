@extends('layouts.app')

@section('content')
    <div class="page-heading">

        <div class="card">
            <div class="card-body">
                <div class="table-responsive custom-table">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr colspan=2>
                                <th class="text-bold-500">From Created Date</th>
                                <th class="text-bold-500">To Created Date</th>
                                <th class="text-bold-500">Lab Wise</th>
                                <th class="text-bold-500">Work Wise</th>
                                <th class="text-bold-500">Payment Wise</th>
                                <th class="text-bold-500">From Received Date</th>
                                <th class="text-bold-500">To Received Date</th>
                            </tr>
                            <tr>
                                <td><input type="date" placeholder="" class="form-control filters" id="fromDate" name="fromDate"></td>
                                <td><input type="date" placeholder="" class="form-control filters" id="toDate" name="toDate"></td>
                                <td>
                                <select class="form-select" id="labwise" name="labwise">
									<option value="">Select Lab</option>
									@foreach($lablist as $lab)
										<option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
									@endforeach
								</select>	
                                </td>
                                <td>
                                    <select class="form-select" id="workwise" name="workwise">
									<option value="">Select Work</option>
									@foreach($worklist as $work)
										<option value="{{ $work->type_of_work }}">{{ $work->type_of_work }}</option>
									@endforeach
								</select>
                            </td>
                            <td>
                                <select class="form-select" id="paymentwise" name="paymentwise">
									<option value="">Select Payment</option>
									<option value="4">In Process</option>
									<option value="1">Completed</option>
									<option value="2">To be Paid</option>
									<option value="3">Paid</option>
								</select>
                            </td>
                                <td><input type="date" placeholder="" class="form-control  filters" id="expecteddate" name="expecteddate"></td>
                                <td><input type="date" placeholder="" class="form-control  filters" id="receiveddate" name="receiveddate"></td>
                                <td class="filter-btn-center" style="display: flex;float: right;"><button id="applyFilter" type="button" class="btn btn-outline-primary"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>&nbsp;&nbsp;<button id="reset" type="button" class="btn btn-outline-primary"><i class="fa fa-retweet" aria-hidden="true"></i>&nbsp; Reset</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="page-title">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Report</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Patient</li>
                        </ol>
                    </nav> -->
                    <!-- <a href="{{ url('/doctorlist') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add Lab Note</button></a> -->
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
                                <th class="table-min-width-small padding-small">Sr No</th>
                                <th class="table-min-width-small padding-small">Job No</th>
                                <th>Date Created</th>
                                <th>Patient Name</th>
                                <th>Lab</th>
                                <th>Type Of Work</th>
                                <th>Expected Date Of Delivery</th>
                                <th>To be Given</th>
                                <th>Given</th>
                                <th>Given On</th>
                                <th>Received</th>
                                <th>Received Date</th>
                                <th>Given Appointment</th>
                                <th>Checked</th>
                                <th>Redo/Repeat</th>
                                <th>Deliver to the Patient</th>
                                <th>Status</th>
                                <th>Lab Bill</th>
                                <!-- <th>Payment</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($doctorlist as $doctor)
                                <tr>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td class="table-min-width-small">{{ $doctor->id }}</td>
                                    <td>{{ $doctor->created_at }}</td>
                                    <td>{{ $doctor->patient_name }}</td>
                                    <td>{{ $doctor->labname }}</td>
                                    <td>{{ $doctor->type_of_work }}</td>
                                    <?php $expDate = $doctor->excepted_date_of_deliver; ?>
                                    <?php if (empty($expDate)) { ?>
                                       <?php  $formatDate = "Not Given"; ?>
                                    <?php }else{ ?>
                                        <?php $formatDate = date("d-M-Y", strtotime($expDate)); ?> 
                                    <?php } ?>
                                    <td><?php echo $formatDate; ?></td>
                                    <td style="color: {{ ($doctor->to_be_given == '0') ? 'red' : '#00cc00' }}">
                                        {{ $doctor->to_be_given == '0' ? 'Not Given' : 'Given' }}
                                    </td>
                                    <td style="color: {{ ($doctor->given == '0') ? 'red' : '#00cc00' }}">{{ $doctor->given == '0' ? 'Not Given' : 'Given' }}</td>
                                    <?php $givenDate = $doctor->given_On; ?>
                                    <?php if (empty($givenDate)) { ?>
                                       <?php  $formattedDate = "Not Given"; ?>
                                    <?php }else{ ?>
                                        <?php $formattedDate = date("d-M-Y", strtotime($givenDate)); ?> 
                                    <?php } ?>
                                    <td style="color: {{ ($doctor->given_On == '') ? 'red' : '#00cc00' }}"><?php echo $formattedDate; ?></td>
                                    <!--<td style="color: {{ ($doctor->given_On == '') ? 'red' : '#00cc00' }}">{{ $doctor->given_On ?? 'Not Given' }}</td>-->
                                    <td style="color: {{ ($doctor->received == '0') ? 'red' : '#00cc00' }}">{{ $doctor->received == '0' ? 'Not Received' : 'Received'  }}</td>
                                    <?php $receivedDate = $doctor->receivedDate; ?>
                                    <?php if (empty($receivedDate)) { ?>
                                       <?php  $formattedreceived = "Not Given"; ?>
                                    <?php }else{ ?>
                                        <?php $formattedreceived = date("d-M-Y", strtotime($receivedDate)); ?> 
                                    <?php } ?>
                                    <td style="color: {{ ($doctor->receivedDate == '') ? 'red' : '#00cc00' }}"><?php echo $formattedreceived; ?></td>
                                    <td style="color: {{ ($doctor->given_appointment == '0') ? 'red' : '#00cc00' }}">{{ $doctor->given_appointment  == '0' ? 'No' : 'Yes' }}</td>
                                    <td style="color: {{ ($doctor->checked == '0') ? 'red' : '#00cc00' }}">{{ $doctor->checked  == '0' ? 'UnChecked' : 'Checked'}}</td>
                                    <td style="color: {{ ($doctor->redo_repeat == '0') ? 'red' : '#00cc00' }}">{{ $doctor->redo_repeat == '0' ? 'No' : 'Yes' }}</td>
                                    <td style="color: {{ ($doctor->deliver_to_person == '0') ? 'red' : '#00cc00' }}">{{ $doctor->deliver_to_person == '0' ? 'No' : 'Yes'}}</td>
                                    <td style="color: {{ ($doctor->status == '4') ? 'red' : '#00cc00' }}">@if($doctor->status == '4') In Process @elseif($doctor->status == '1')  Completed @elseif($doctor->status == '2') To be Paid @else Paid  @endif</td>       
                                    <td style="color: {{ ($doctor->lab_bill == '0') ? 'red' : '#00cc00' }}">@if ($doctor->checked == '1'){{ $doctor->lab_bill }}@else         <span style="color: red;">Not Checked</span @endif</td>
                                    <td class="button-holder">
                                    <a href="{{ url('receptionistedit'.'/'.$doctor->id.'?show_field=true&checked=' . ($doctor->checked == '1' ? '1' : '0')) }}" class="btn btn-outline-warning">Edit</a>
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
                'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                'pageLength': 50, // sets the default number of rows per page to 50
                'searching': false,
                'ordering': true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [18], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });

            // to delete doctor data from doctor list 
            $(document).on("click", ".deletedoctor", function(){ 
                var doctorid = $(this).data('id');
                $("#overlay").fadeIn(300);    
                $.ajax({
                    url: "{{ route('deletedoctordata') }}",
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
            });


            // To apply filter
            $("#applyFilter").click(function(){
                $.ajax({
                    url: "{{ route('labreportfilterlist') }}",
                    type: "GET",
                    data: {"from_Date": $("#fromDate").val(),"to_Date": $("#toDate").val(),"lab_wise": $("#labwise").val(),"payment_wise": $("#paymentwise").val(),"expected_date": $("#expecteddate").val(),"received_date": $("#receiveddate").val(),"work_wise": $("#workwise").val(), "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(data) {
                        getData(data);

                    }
                });
            });


            // To pass data to table
            getData = function(data) {
                table.destroy();
                table = $("#tablelist").DataTable({
                    dom: 'Bfrtip',
                    responsive: true,
                    buttons: [ {
                        title: 'Report-List'
                    } ],

                    'lengthChange': false,
                    'searching'   : false,
                    'order': [[0, 'asc']],
                    'pageLength': 50, // set page length to 50
                    'data': data.data,
                    'columns': [
                    {data: "id"},
                    {data: "id"},
                    {data: "created_at"},
                    {data: "patient_name"},
                    {data: "labname"},
                    {data: "type_of_work"},
                    {data: "excepted_date_of_deliver", render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                        // Assuming that data is in a standard date format that can be parsed
                        const date = new Date(data);
                        const day = date.getDate().toString().padStart(2, '0');
                        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        const month = monthNames[date.getMonth()];
                        const year = date.getFullYear();
                        return `${day}-${month}-${year}`;
                        }
                        return data;
                    }},
                    {data: "to_be_given", align: "center", render: function (rec, type, row) {
                        if (row.to_be_given == 0) {
                            return '<span class="text-red">Not Given</span>';
                        }else{
                            return '<span class="text-green">Given</span>';
                        }
                    }},
                    {data: "given", align: "center", render: function (rec, type, row) {
                        if (row.given == 0) {
                            return '<span class="text-red">Not Given</span>';
                        }else{
                            return '<span class="text-green">Given</span>';
                        }
                    }},
                    {data: "given_On", align: "center",render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                        if (!data) {
                            return '<span class="text-red">Not Given</span>';
                        } else {
                            // Assuming that data is in a standard date format that can be parsed
                            const date = new Date(data);
                            const day = date.getDate().toString().padStart(2, '0');
                            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                            const month = monthNames[date.getMonth()];
                            const year = date.getFullYear();
                            return `<span class="text-green">${day}-${month}-${year}</span>`;
                        }
                        }
                        return data;
                    }},
                    {data: "received", align: "center", render: function (rec, type, row) {
                        if (row.received == 0) {
                            return '<span class="text-red">Not Received</span>';
                        }else{
                            return '<span class="text-green">Received</span>';
                        }
                    }},
                    {data: "receivedDate", align: "center",render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                        if (!data) {
                            return '<span class="text-red">Not Given</span>';
                        } else {
                            // Assuming that data is in a standard date format that can be parsed
                            const date = new Date(data);
                            const day = date.getDate().toString().padStart(2, '0');
                            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                            const month = monthNames[date.getMonth()];
                            const year = date.getFullYear();
                            return `<span class="text-green">${day}-${month}-${year}</span>`;
                        }
                        }
                        return data;
                    }},
                    {data: "given_appointment", align: "center", render: function (rec, type, row) {
                        if (row.given_appointment == 0) {
                            return '<span class="text-red">No</span>';
                        }else{
                            return '<span class="text-green">Yes</span>';
                        }
                    }},
                    {data: "checked", align: "center", render: function (rec, type, row) {
                        if (row.checked == 0) {
                            return '<span class="text-red">UnChecked</span>';
                        }else{
                            return '<span class="text-green">Checked</span>';
                        }
                    }},
                    {data: "redo_repeat", align: "center", render: function (rec, type, row) {
                        if (row.redo_repeat == 0) {
                            return '<span class="text-red">No</span>';
                        }else{
                            return '<span class="text-green">Yes</span>';
                        }
                    }},
                    {data: "deliver_to_person", align: "center", render: function (rec, type, row) {
                        if (row.deliver_to_person == 0) {
                            return '<span class="text-red">No</span>';
                        }else{
                            return '<span class="text-green">Yes</span>';
                        }
                    }},
                    {data: "status", align: "center", render: function (rec, type, row) {
                        if (row.status == 4) {
                            return '<span class="text-red">In Process</span>';
                        }else if (row.status == 1) {
                            return '<span class="text-green">Completed</span>';
                        }else if (row.status == 2) {
                            return '<span class="text-green">To be Paid</span>';
                        }else{
                            return '<span class="text-green">Paid</span>';
                        }
                    }},
                    {
                        data: "lab_bill",
                        render: function (data, type, row) {
                            if (row.checked == 1) {
                                if (data == 0) {
                                    return '<span class="text-red">' + data + '</span>';
                                } else {
                                    return '<span class="text-green">' + data + '</span>';
                                }
                            } else {
                                return '<span class="text-red">Not Checked</span>';
                            }
                        }
                    },
                    {data: "labstatus", align: "center", render: function (rec, type, row) {
                        if (data != 0) {
                                return '<a href="{{ url('receptionistedit') }}/' + row.id + '" class="btn btn-outline-warning">Edit</a>';
                            }
                                
                        }
                    }
                    ],
                       "rowCallback": function (nRow, aData, iDisplayIndex) {
                         var oSettings = this.fnSettings ();
                         $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                         return nRow;
                    },
                    'columnDefs': [ {
                        'targets': [18], // column index (start from 0)
                        'orderable': false, // set orderable false for selected columns
                    }]
                });
            }

            // To reset filter
            
            $("#reset").click(function(){
                // $('#to_date_lab').val(currentDateDate);
                // $('#from_date_lab').val(formattedDate);
                $('.filters').prop('selectedIndex',0);
                window.location.reload();
            });

            $(function(){
                $(".dateofbirth").datepicker({ dateFormat: 'dd-M-yy', changeYear: true, changeMonth: true, yearRange: "c-150:c+150" });
            });

            // To select default one month date gap
            // var currentDate = new Date().toISOString().slice(0, 10);

            // var day = currentDate.slice(8, 10);
            // var month = currentDate.slice(5, 7);
            // var year = currentDate.slice(0, 4);

            // var monthNames = [
            // "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            // "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            // ];
            // var monthName = monthNames[parseInt(month) - 1];

            // var currentDateDate = day + '-' + monthName + '-' + year;
            // $('#to_date_lab').val(currentDateDate);


            // var prevDate = new Date();
            // prevDate.setMonth(prevDate.getMonth() - 1);

            // var day = prevDate.getDate();
            // var month = prevDate.getMonth() + 1;
            // var year = prevDate.getFullYear().toString().slice(-4);

            // // Add leading zeros if necessary
            // day = day < 10 ? '0' + day : day;
            // month = month < 10 ? '0' + month : month;

            // var monthNames = [
            // "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            // "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            // ];
            // var monthName = monthNames[month - 1];

            // var formattedDate = day + '-' + monthName + '-' + year;
            // $('#from_date_lab').val(formattedDate);
        });
    </script>
@endsection