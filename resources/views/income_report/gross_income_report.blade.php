@extends('layouts.app')

@section('content')
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
                                    <th class="text-bold-500">Options</th>
                                </tr>
                                <tr>
                                    <td><input type="text" placeholder="" class="form-control startDate" id="from_date_lab" name="from_date_lab"></td>
                                    <td><input type="text" placeholder="" class="form-control endDate" id="to_date_lab" name="to_date_lab"></td>
                                    <td class="filter-btn-center"><a href="#" id="reset" class="btn btn-outline-primary float-end"><i class="fa fa-retweet" aria-hidden="true"></i>&nbsp;&nbsp;Reset</a>
                                    <button style="margin-right:12px" class="btn btn-outline-primary float-end"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp; Submit</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div> 
           

        
        <div class="page-title">
            <div class="row page-title-row">
                <div class="col-md-6 page-title-left">
                    <h3>Gross Income Report</h3>
                </div>
                <div class="col-md-6 page-title-right">
                    <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Income Report</li>
                        </ol>
                    </nav> -->
                </div>
            </div>
        </div>            

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-min-width" id="tablelist">
                        <thead>
                            <tr>
                                <th>Income</th>
                                <th>Lab Charges</th>
                                <th>Inventory Charges</th>
                                <th>Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$grosspaidamount}}</td>
                                <td>{{$grossamount}}</td>
                                <td>{{$inventoryamount}}</td>
                                <td>{{$profit}}</td>
                            </tr>
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
            // table = $("#tablelist").DataTable({
            //     dom: 'Bfrtip',
            //     responsive: true,
            //     buttons: [ {
            //         extend: 'csv',
            //         title: 'Partition-List'
            //     } ],
            //     'order': [[0, 'desc']],
            //     'columnDefs': [ {
            //         'targets': [6], // column index (start from 0)
            //         'orderable': false, // set orderable false for selected columns
            //     }]
            // });

            // // To pass data to table
            // getData = function(data) {
            //     table.destroy();
            //     table = $("#tablelist").DataTable({
            //         dom: 'Bfrtip',
            //         responsive: true,
            //         buttons: [ {
            //             extend: 'csv',
            //             title: 'Partition-List'
            //         } ],

            //         'lengthChange': false,
            //         'searching'   : false,
            //         'order': [[0, 'desc']],
            //         'data': data.data,
            //         'columns': [
            //         {data: "order_date"},
            //         {data: "name"},
            //         {data: "teeth_numbers"},
            //         {data: "type_of_work"},
            //         {data: "amount"},
            //         {data: "labstatus", align: "center", render: function (rec, type, row) {                            
            //                 if(rec == 0) {
            //                     return '<span class="badge bg-success">Open</span>';
            //                 } else  {
            //                     return '<span class="badge bg-danger">Close</span>';
            //                 }
            //             }
            //         },
            //         {data: "labstatus", align: "center", render: function (rec, type, row) {
            //                 if(rec != 0) {
            //                     return '<a class="btn btn-outline-info view_laborder statusbtn" data-id="'+row.labid+'" data-value="0"><i class="fa fa-eye" aria-hidden="true"></i> Open</a>';
            //                 } else  {
            //                     return '<a class="btn btn-outline-info view_laborder statusbtn" data-id="'+row.labid+'" data-value="1"><i class="fa fa-eye-slash" aria-hidden="true"></i> close</a>';
            //                 }
                                
            //             }
            //         }
            //         ],
            //         'columnDefs': [ {
            //             'targets': [6], // column index (start from 0)
            //             'orderable': false, // set orderable false for selected columns
            //         }]
            //     });
            // }

            //to open close functionality

            $(document).on("click", ".statusbtn", function(e){
                var labid = $(this).data('id');
                var statusval = $(this).data('value');

                $.ajax({
                    url: "{{ url('/updatelabstatus') }}",
                    type: "POST",
                    data: {"labid": labid, "statusval": statusval, "_token": $("[name='_token']").val()},
                    success: function(response) {
                        if(response.response) { 
                            $("#applyFilter").trigger('click');
                        }
                    }
                });

                e.preventDefault();
            });

            // To apply filter
            $("#applyFilter").click(function(){
                $.ajax({
                    url: "{{ URL('/reportfilterlist') }}",
                    type: "GET",
                    data: {"lab_list": $("#lablist").val(), "from_datelab": $("#from_date_lab").val(), "to_datelab": $("#to_date_lab").val(), "_token": $("input[name='_token']").val()},
                    dataType: "json", 
                    success: function(data) {
                        getData(data);

                    }
                });
            });

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
        });
    </script>
@endsection