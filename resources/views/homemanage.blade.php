@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-md-6 page-title-right">
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
                                <th>Deliver to the Patient </th>
                                <th>Status</th>
                                <!-- <th>Lab Bill</th>
                                <th>Payment</th> -->
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
                                    <!-- <td style="color: {{ ($doctor->payment == 'Not Received') ? 'red' : '#00cc00' }}">{{ $doctor->lab_bill }}</td>
                                    <td style="color: {{ ($doctor->payment == 'Not Received') ? 'red' : '#00cc00' }}">{{ $doctor->payment }}</td> -->
                                    <td class="button-holder">
                                        <a href="{{ url('receptionistedit'."/".$doctor->id) }}" class="btn btn-outline-warning">Edit</a>
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
                'targets': [17], // column index (start from 0)
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

        });
    </script>
@endsection