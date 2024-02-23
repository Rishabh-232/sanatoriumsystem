@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Account List</h3>
                </div>
                <!-- <div class="col-12 col-md-6 order-md-2 order-first">
                    <a href="{{ url('/patientadd') }}" class="new-button"><button type="button" class="btn btn-outline-primary float-end">Add New</button></a>
                </div> -->
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
                                <th>Patient Name</th>
                                <th class="table-min-width-small">Date</th>
                                <th>Type Of Work</th>
                                <th class="table-min-width-small">Paid-Amount</th>
                                <th class="table-min-width-small">Total-Amount</th>
                                <th class="table-min-width-small">Balance</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>  
                        <?php $i = 1; ?>
                        @foreach($visitlist as $visit)    
                            <tr>
                                <td class="table-min-width-small">{{ $i++; }}</td>
                                <td>{{ $visit->name }}</td>
                                <td class="table-min-width-small">{{ $visit->date_of_visit }}</td>
                                <?php
                                        $jsonData = $visit->treatinfo;

                                        // Decode the JSON data into a PHP array
                                        $data = json_decode($jsonData, true);

                                                                                // Get the keys from the array and join them with commas
                                        $keys = implode(', ', array_keys($data));

                                    ?>
                                    <td><?php echo $keys; ?></td>
                                <td class="table-min-width-small">{{ $visit->total_amount }}</td>
                                <td class="table-min-width-small">{{ $visit->balance_amount }}</td>
                                <td class="table-min-width-small">{{ $visit->remaining_amount}}</td>
                                <!-- <td class="button-holder">
                                    <a href="" class="btn btn-outline-info">View</a>
                                    <a id="deleteperson" class="btn btn-outline-danger deletepatient" data-id="">Delete</a>
                                </td> -->
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
    <div class="modal fade text-left" id="addVisitModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Visit</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="addVisitForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="patientId" id="patientId">
                        <label>Date Of Visit</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control dateofbirth" id="date_of_visit" name="date_of_visit">
                        </div>
                        <label>Work Done</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="work_done" name="work_done">
                        </div>
                        <label>Paid Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="paid_amount" name="paid_amount">
                        </div>
                        <label>Discount Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="discount_amount" name="discount_amount">
                        </div>
                        <label>Remarks</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="remarks" name="remarks">
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
                    title: 'Account-List'
                } ],
                'lengthChange': false,
                'searching'   : true,
                'order': [[0, 'asc']],
                'columnDefs': [ {
                'targets': [7], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                }]
            });

        });
    </script>
@endsection