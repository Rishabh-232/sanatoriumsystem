@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/choices.css') }}">

    <div class="page-heading">
        <div class="card">
            <div class="card-body">
                <!-- table bordered -->
                <div class="table-responsive custom-table-100">
                    <form class="form" id="addVisitForm">
                    @csrf
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr colspan=2>
                                    <th class="text-bold-500">From Date</th>
                                    <th class="text-bold-500">To Date</th>
                                </tr>
                                <tr>
                                    <td><input type="text" placeholder="" class="form-control startDate" id="from_date_lab" name="from_date_lab"></td>
                                    <td><input type="text" placeholder="" class="form-control endDate" id="to_date_lab" name="to_date_lab"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Patient Report</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                   

                </div>
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
                                <th class="table-min-width-small"></th>
                                <th class="table-min-width-small">Sr. No.</th>
                                <th class="table-min-width-small">Name</th>
                                <th>Date of Birth</th>
                                <th class="table-min-width-small">Age</th>
                                <th class="table-min-width-small">Attended By</th>
                                <th>Primary Number</th>
                                <th class="table-min-width-small">Insurance</th>
                                <th class="table-min-width-small">Consent Form</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($patientList as $patient)
                                <tr>
                                    <td class="table-min-width-small">
                                        <input type="checkbox" class="checkbox-class" data-id="{{ $patient->contact_1 }}">
                                    </td>
                                    <td class="table-min-width-small">{{ $i++; }}</td>
                                    <td class="table-min-width-small">{{ $patient->name }}</td>
                                    <td>@if($patient->date_of_birth == '')
                                        @else
                                        {{ date('d-M-Y', strtotime($patient->date_of_birth)) }}
                                        @endif
                                    </td>
                                    <td class="table-min-width-small">{{ $patient->age }}</td>
                                    <td class="table-min-width-small">{{ $patient->attended_by }}</td>
                                    <td>{{ $patient->contact_1 }}</td>
                                    <td class="table-min-width-small">{{ $patient->patient_insurance }}</td>
                                    <td class="table-min-width-small">{{ $patient->consent_form }}</td>
                                    <td class="button-holder">
                                    <a href="#" class="btn btn-outline-info view-btn" data-patient-id="{{ $patient->id }}">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>

 

@endsection
@section('jsscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Assuming you have jQuery available
        $(document).ready(function() {
            
            // To apply datatable
            table = $("#tablelist").DataTable({
                dom: 'Bfrtip',
                buttons: [ {
                    title: 'Patient-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'paging': false,  // Disable pagination
                'order': [[0, 'desc']],
                'columnDefs': [ {
                'targets': [9], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });
            
            $('.view-btn').click(function(e) {
                e.preventDefault();
                var patientId = $(this).data('patient-id');
                var startDate = $('#from_date_lab').val();
                var endDate = $('#to_date_lab').val();
                var url = "{{ url('patientviewreport') }}" + '/' + patientId + '?startdate=' + startDate + '&enddate=' + endDate;
                window.location.href = url;
            });
        });
    </script>
    <script>
            $(function(){
                $(".startDate").datepicker({ dateFormat: 'dd-M-yy', changeYear: true, changeMonth: true, yearRange: "c-150:c+150" }); //dd-M-yy
                $(".endDate").datepicker({ dateFormat: 'dd-M-yy', changeYear: true, changeMonth: true, yearRange: "c-150:c+150" });
            });
            
             $("#reset").click(function(){
                $('.filters').prop('selectedIndex',0);
                window.location.href = "{{URL::to('/grossincomereport')}}"            
            });

            // To select default one month date gap
            @if(isset($startDate) && $startDate != "")
                var startDate = '<?= $startDate; ?>';
            @else
            var prevDate = new Date();
            prevDate.setMonth(prevDate.getMonth() - 1);

            var day = prevDate.getDate();
            var month = prevDate.getMonth() + 1;
            var year = prevDate.getFullYear().toString().slice(-4);

            // Add leading zeros if necessary
            day = day < 10 ? '0' + day : day;
            month = month < 10 ? '0' + month : month;
            var monthNames = [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
            var monthName = monthNames[month - 1];

            var startDate = day + '-' + monthName + '-' + year;
            @endif
            $('#from_date_lab').val(startDate);

            // endDate
            @if(isset($endDate) && $endDate != "")
                var endDate = '<?= $endDate; ?>';
            @else
            var currentDate = new Date().toISOString().slice(0, 10);

            var day = currentDate.slice(8, 10);
            var month = currentDate.slice(5, 7);
            var year = currentDate.slice(0, 4);
            var monthNames = [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
            var monthName = monthNames[parseInt(month) - 1];

            var endDate = day + '-' + monthName + '-' + year;
            @endif
            $('#to_date_lab').val(endDate);
    </script>

@endsection