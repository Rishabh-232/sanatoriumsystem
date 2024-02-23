@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Visits</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Visits</li>
                        </ol>
                    </nav> -->
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">   
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Patient</th>
                                <th>Date of Visit</th>
                                <th>Next Visit Date</th>
                                <th>Work Done</th>
                                <th>Total Amount</th>
                                <th>Advance Amount</th>
                                <th>Discount Amount</th>
                                <th>Balance Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($visitlist as $visit)
                                <tr>
                                    <td>{{ $i++; }}</td>
                                    <td>{{ $visit->name }}</td>
                                    <td>@if($visit->date_of_visit == '')
                                        @else
                                        {{ date('d-M-Y', strtotime($visit->date_of_visit)) }}
                                        @endif
                                    </td>
                                    <td>{{ $visit->next_visit_date }}</td>
                                    <td>{{ $visit->work_done }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $visit->discount_amount }}</td>
                                    <td></td>
                                    <td class="button-holder">
                                        <a data-bs-toggle="modal" data-bs-target="#viewvisit" class="btn btn-outline-info view_visit" data-id="{{ $visit->id }}">View</a>
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

    <!--View Visit form Modal -->
    <div class="modal fade text-left" id="viewvisit" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Visit</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="editLaborderForm">
                    @csrf
                    <div class="modal-body">
                        <label>Id</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="view_id" name="view_id" disabled>
                        </div>
                        <label>Patient</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="Vpatient" id="Vpatient" disabled>
                        </div>
                        <label>Date of Visit</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Vdate_of_visit" name="Vdate_of_visit" disabled>
                        </div>
                        <label>Work Done</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Vwork_done" name="Vwork_done" disabled>
                        </div>
                        <label>Paid Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="Vpaid_amount" name="Vpaid_amount" disabled>
                        </div>
                        <label>Discount Amount</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control onlynumbers" id="Vdiscount_amount" name="Vdiscount_amount" disabled>
                        </div>
                        <label>Remark</label>
                        <div class="form-group">
                            <input type="text" placeholder=""
                                class="form-control" id="Vremarks" name="Vremarks" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Select Teeth Modal -->
    <div class="modal fade text-left" id="selectteethModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Teeth Selection</h4>
                    <button type="button" class="close" data-bs-toggle="modal" data-bs-target="#newLabOrder">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="selectTeethform">
                    @csrf
                    <div class="modal-body">
                        <div class="teethBlock d-flex flex-column">
                            <div class="teethsection d-flex">
                                <div class="d-flex border-bottom border-end border-dark">
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/18.jpg') }}" data-id="18">
                                        <p>18</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/17.jpg') }}" data-id="17">
                                        <p>17</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/16.jpg') }}" data-id="16">
                                        <p>16</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/15.jpg') }}" data-id="15">
                                        <p>15</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/14.jpg') }}" data-id="14">
                                        <p>14</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/13.jpg') }}" data-id="13">
                                        <p>13</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/12.jpg') }}" data-id="12">
                                        <p>12</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/11.jpg') }}" data-id="11">
                                        <p>11</p>
                                    </div>
                                </div>
                                <div class="d-flex border-bottom border-dark">
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/21.jpg') }}" data-id="21">
                                        <p>21</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/22.jpg') }}" data-id="22">
                                        <p>22</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/23.jpg') }}" data-id="23">
                                        <p>23</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/24.jpg') }}" data-id="24">
                                        <p>24</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/25.jpg') }}" data-id="25">
                                        <p>25</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/26.jpg') }}" data-id="26">
                                        <p>26</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/27.jpg') }}" data-id="27">
                                        <p>27</p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/28.jpg') }}" data-id="28">
                                        <p>28</p>
                                    </div>
                                </div>
                            </div>
                            <div class="teethsection d-flex">
                                <div class="d-flex border-end border-dark">
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/48.jpg') }}" data-id="48">
                                        <p>48</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/47.jpg') }}" data-id="47">
                                        <p>47</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/46.jpg') }}" data-id="46">
                                        <p>46</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/45.jpg') }}" data-id="45">
                                        <p>45</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/44.jpg') }}" data-id="44">
                                        <p>44</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/43.jpg') }}" data-id="43">
                                        <p>43</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/42.jpg') }}" data-id="42">
                                        <p>42</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/41.jpg') }}" data-id="41">
                                        <p>41</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/31.jpg') }}" data-id="31">
                                        <p>31</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/32.jpg') }}" data-id="32">
                                        <p>32</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/33.jpg') }}" data-id="33">
                                        <p>33</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/34.jpg') }}" data-id="34">
                                        <p>34</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/35.jpg') }}" data-id="35">
                                        <p>35</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/36.jpg') }}" data-id="36">
                                        <p>36</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/37.jpg') }}" data-id="37">
                                        <p>37</p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/38.jpg') }}" data-id="38">
                                        <p>38</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="saveselectedTeeth" class="btn btn-primary ml-1" data-bs-toggle="modal" data-bs-target="#newLabOrder">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save & Close</span>
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
                    extend: 'csv',
                    title: 'Partition-List'
                } ],
                'order': false,
                'bInfo': false, //Left side Info entries Hide
                'bPaginate': false, // Pagination Hide
                'columnDefs': [ {
                    'targets': [7], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }]
            });

            // get data of edit lab order
            $(document).on("click", ".edit_laborder", function(){    
                var id = $(this).data('id');
                console.log(id);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ route('geteditlabdata') }}",
                    type: "GET",
                    data: {"labid": id, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {
                        $("#overlay").fadeOut(300);
                        $("#LabOrder_id").val(response.data.id);
                        $("#Elab_order_date").val(response.data.order_date);
                        $("#Eselectedteeth").val(response.data.teeth_numbers);
                        $("#Etype_of_work").val(response.data.type_of_work);
                        $("#Eamount").val(response.data.amount);
                        $("#Elab_name").val(response.data.lab_name);
                    }
                });
            });

            // To Update visit
            $("form#editLaborderForm").submit(function(e){
                var $this = $(this);
                var formData = $this.serializeArray();
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ route('updateLabOrder') }}",
                    type: "POST",
                    data: formData,
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
                                window.location.href = "{{ url('/patientview').'/'.Request::segment(2) }}";
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

            //to delete visit
            $(document).on("click", ".delete_lab_order", function(){    
                var id = $(this).data('id');
                console.log(id);
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: "{{ route('deleteLabdata') }}",
                    type: "DELETE",
                    data: {"deleteid": id, "_token": $("input[name='_token']").val()},
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
                                window.location.href = "{{ url('/laborderlist') }}";
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

            // get data of view visit
            $(document).on("click", ".view_visit", function(){    
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "{{ route('getvisitdata') }}",
                    type: "GET",
                    data: {"visitid": id, "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(response) {

                        $("#view_id").val(response.data.id);
                        $("#Vpatient").val(response.data.name);
                        $("#Vdate_of_visit").val(response.data.date_of_visit);
                        $("#Vwork_done").val(response.data.work_done);
                        $("#Vpaid_amount").val(response.data.paid_amount);
                        $("#Vdiscount_amount").val(response.data.discount_amount);
                        $("#Vmiddle_name").val(response.data.MiddleName);
                        $("#Vremarks").val(response.data.remark);
                    }
                });
            });

            // to delete patient data from patient list 
            // $(document).on("click", ".deletepatient", function(){ 
            //     var patientid = $(this).data('id');    
            //     $.ajax({
            //         url: "{{ route('deletepatientdata') }}",
            //         type: "DELETE",
            //         data: {"patientid": patientid, "_token": $("input[name='_token']").val()},
            //         dataType: "json", 
            //         success: function(response) {
            //             alert("Success");
            //             window.location.href = "{{ url('/patientlist') }}";
            //         }
            //     });
            // });

            // To push selected teeth no to array
            pushselectedteethtoArray = function(){
                selectedTeethArr = [];
                $('.teethsection img.selected').each(function() {
                    selectedTeethArr.push($(this).attr('data-id'));
                });
                if(selectedTeethArr.length != 0)
                {
                    $("#selectteeth").html("Selected Teeth "+selectedTeethArr);
                    $("#selectteeth").addClass("text-success").removeClass("text-danger");
                    $("#selectedteeth").val(JSON.stringify(selectedTeethArr, null, 2));
                }
                else
                {
                    $("#selectteeth").html("Select Teeth");
                    $("#selectteeth").addClass("text-danger").removeClass("text-success");
                    $("#selectedteeth").val("");
                }
            }

            // To select Image
            $('.teethsection img').click(function () {
                $(this).toggleClass('selected');
                var toothId = $(this).attr('data-id');
                if($(this).hasClass('selected'))
                {
                    var tempSrc = '{{ asset('assets/images/infected') }}/'+toothId+".jpg";
                }
                else
                {
                    var tempSrc = '{{ asset('assets/images/normal') }}/'+toothId+".jpg";   
                }
                $(this).attr('src', tempSrc);
                pushselectedteethtoArray();
            });

            //Disable popup on click out side to page

            $('#viewvisit').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
    </script>
@endsection