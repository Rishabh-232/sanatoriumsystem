@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/choices.css') }}">
    <style type="text/css">

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            width: 450px;
        }

        .select2-container--default .select2-selection--single {
            height: 50px;
            padding: 8px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            padding: 22px;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da !important;
        }

    </style>
	<div class="page-heading">
	    <div class="page-title">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Add Lab Note</h3>
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

	    <!-- // Basic multiple Column Form section start -->
	    <section id="multiple-column-form">
	        <div class="row match-height">
	            <div class="col-12">
	                <div class="card">
	                    <div class="card-header">
	                        <h4 class="card-title"></h4>
	                    </div>
	                    <div class="card-content">
	                        <div class="card-body">
	                            <form class="form">
                        		 @csrf
	                                <div class="row">
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
                                                <label for="first-name-column">Patient Name</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="patient_name" name="patient_name">
                                                        @foreach($PatientList as $patient)  
                                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>

                                                        @endforeach
                                                    </select>
                                                </fieldset>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Lab Name</label>
												<select  id="lab_name" class="form-select" name="lab_name">
													<option value="">Select Lab Name</option>
													@foreach($Lab as $lab)
													<option value="{{$lab->id}}">{{$lab->lab_name}}</option>
													@endforeach
												</select>
	                                        </div>
	                                    </div>
										
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Teeth/Tooth</label>
												<div class="form-group mt-1">
													<a id="selectteeth" href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#selectteethModal">Select Teeth</a>
													<input type="hidden" name="selectedteeth" id="selectedteeth">
											    </div>
	                                        </div>
	                                    </div>
	                                    <!-- <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Type of Work</label>
												<select  id="type_of_work" class="js-example-basic-multiple form-select" name="type_of_work[]" multiple="multiple">
													<option value="">Select Type of Work</option>
													@foreach($TOW as $TOW)
													<option value="{{$TOW->type_of_work}}">{{$TOW->type_of_work}}</option>
													@endforeach
												</select>
	                                        </div>
	                                    </div> -->
                                        <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Type of Work</label>
                                                <input type="text" id="type_of_work" class="form-control" placeholder=" " name="type_of_work">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Excepted Date of Deliver</label>
	                                            <input type="text" id="excepted_date_of_deliver" class="form-control dateofbirth" placeholder=" " name="excepted_date_of_deliver">
	                                        </div>
	                                    </div>

                                        <div class="col-md-6 col-12">
											<div class="form-group">
												<label for="city-column">Work Given In The Form</label>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="selected_option" id="option1" value="Models" checked>
													<label class="form-check-label" for="option1">Models</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="selected_option" id="option2" value="Scan File">
													<label class="form-check-label" for="option2">Scan File</label>
												</div>
											</div>
										</div>
                                        <input type="hidden" id="shades" name="shades[]">
                                        <input type="hidden" id="selectedShade" name="selectedShade">

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city-column">Lab Instructions</label>
                                                <!-- @foreach($note as $key => $note)
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="note{{ $key + 1 }}" name="note[]" value="{{ $note->note }}">
                                                        <label class="form-check-label" for="note{{ $key + 1 }}">{{ $key + 1 }}. {{ $note->note }}</label>
                                                    </div>
                                                @endforeach -->
                                            </div>
                                            <textarea class="form-control" id="additional" name="additional" placeholder=""></textarea>
                                        </div>

	                                    <div class="col-12 d-flex button-wrap">
	                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                            <button type="button" class="btn btn-info me-1 mb-1" id="printButton">Save & Print</button>
                                            <button type="button" class="btn btn-success me-1 mb-1" id="printDownload">Save & Download</button>
	                                        <a href="{{ url()->previous() }}"class="btn btn-light-secondary me-1 mb-1">Close</a>
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	    <!-- // Basic multiple Column Form section end -->
	</div>

	<!--Select Teeth Modal -->
    <div class="modal fade text-left" id="selectteethModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg labteethpopup"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Teeth Selection</h4>
                    <div>
                        <button type="button" id="selectUpperLeftTeeth" class="btn btn-outline-secondary">
                            UL
                        </button>
                        <button type="button" id="selectUpperRightTeeth" class="btn btn-outline-secondary">
                            UR
                        </button>
                        <button type="button" id="selectLowerLeftTeeth" class="btn btn-outline-secondary">
                            LL
                        </button>
                        <button type="button" id="selectLowerRightTeeth" class="btn btn-outline-secondary">
                            LR
                        </button>
                        <button type="button" id="selectUpperAllTeeth" class="btn btn-outline-secondary">
                            UR All
                        </button>
                        <button type="button" id="selectLowerAllTeeth" class="btn btn-outline-secondary">
                            LR All
                        </button>
                        <button type="button" id="selectallTeeth" class="btn btn-outline-secondary">
                            All
                        </button>
                        <button type="button" id="deselectallTeeth" class="btn btn-outline-secondary">
                            Uncheck All
                        </button>
                    </div>
                    <button type="button" class="close" data-bs-toggle="modal" data-bs-target="#newLabOrder">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form class="form" id="selectTeethform">
                    @csrf
                    <div class="modal-body">
                        <div class="teethBlock d-flex flex-column labteethBlock">
                            <div class="teethsection d-flex">
                                <div class="d-flex border-bottom border-end border-dark">
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/18.jpg') }}" data-id="18">
                                        <p>18
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="18">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/17.jpg') }}" data-id="17">
                                        <p>17
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="17">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/16.jpg') }}" data-id="16">
                                        <p>16
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="16">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/15.jpg') }}" data-id="15">
                                        <p>15
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="15">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/14.jpg') }}" data-id="14">
                                        <p>14
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="14">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/13.jpg') }}" data-id="13">
                                        <p>13
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="13">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/12.jpg') }}" data-id="12">
                                        <p>12
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="12">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/11.jpg') }}" data-id="11">
                                        <p>11
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="11">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex border-bottom border-dark">
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/21.jpg') }}" data-id="21">
                                        <p>21
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="21">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/22.jpg') }}" data-id="22">
                                        <p>22
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="22">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/23.jpg') }}" data-id="23">
                                        <p>23
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="23">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/24.jpg') }}" data-id="24">
                                        <p>24
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="24">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/25.jpg') }}" data-id="25">
                                        <p>25
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="25">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/26.jpg') }}" data-id="26">
                                        <p>26
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="26">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/27.jpg') }}" data-id="27">
                                        <p>27
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="27">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1">
                                        <img src="{{ asset('assets/images/normal/28.jpg') }}" data-id="28">
                                        <p>28
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="28">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="teethsection d-flex">
                                <div class="d-flex border-end border-dark">
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/48.jpg') }}" data-id="48">
                                        <p>48
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="48">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/47.jpg') }}" data-id="47">
                                        <p>47
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="47">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/46.jpg') }}" data-id="46">
                                        <p>46
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="46">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/45.jpg') }}" data-id="45">
                                        <p>45
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="45">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/44.jpg') }}" data-id="44">
                                        <p>44
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="44">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/43.jpg') }}" data-id="43">
                                        <p>43
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="43">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/42.jpg') }}" data-id="42">
                                        <p>42
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="42">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/41.jpg') }}" data-id="41">
                                        <p>41
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="41">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/31.jpg') }}" data-id="31">
                                        <p>31
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="31">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/32.jpg') }}" data-id="32">
                                        <p>32
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="32">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/33.jpg') }}" data-id="33">
                                        <p>33
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="33">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/34.jpg') }}" data-id="34">
                                        <p>34
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="34">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/35.jpg') }}" data-id="35">
                                        <p>35
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="35">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/36.jpg') }}" data-id="36">
                                        <p>36
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="36">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/37.jpg') }}" data-id="37">
                                        <p>37
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="37">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                    <div class="mx-1 mt-2">
                                        <img src="{{ asset('assets/images/normal/38.jpg') }}" data-id="38">
                                        <p>38
                                            <select class="teethshade shades" id="">
                                                <option value=""></option>
                                                @foreach($Shades as $Shade)
                                                <option value="{{$Shade->shade_name}}" data-id="38">{{$Shade->shade_name}}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <select class="multishade shades" id="multishade" name="multishade">
                                <option value=""></option>
                                @foreach($Shades as $Shade)
                                <option value="{{$Shade->shade_name}}" data-id="38">{{$Shade->shade_name}}</option>
                                @endforeach
                            </select>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script>
        const selectElement = document.getElementById('multishade');
        const hiddenInput = document.getElementById('selectedShade');

        selectElement.addEventListener('change', function() {
            const selectedValue = selectElement.value;
            hiddenInput.value = selectedValue;
        });
    </script>

    <script>
        $(document).ready(function () {
            // Define an empty array to store selected option values and data-ids
            var selectedshades = [];

            // Attach an event listener to all select elements with class "shades"
            $("select.teethshade").on("change", function () {
                // Clear the selectedshades array
                selectedshades = [];

                // Iterate through all the select elements with class "shades"
                $("select.teethshade").each(function () {
                    var selectedShade = $(this).val();
                    var dataId = $(this).find("option:selected").data("id");
                    
                    // Check if the selected option is not empty
                    if (selectedShade !== "") {
                        // Push an object containing the selected value and data-id into the array
                        selectedshades.push({ value: selectedShade, dataId: dataId });
                    }
                });

                 // Create an object to store the selected values
                var selectedValuesObject = {};

                // Iterate through selectedshades and add key-value pairs to the object
                selectedshades.forEach(function (option) {
                    selectedValuesObject[option.dataId] = option.value;
                });

                // Convert the object to a JSON string
                var selectedValuesJSON = JSON.stringify(selectedValuesObject);

                // Set the JSON string as the value of an element with the id "shades"
                $("#shades").val(selectedValuesJSON);


                // Now, selectedshades contains objects with both value and dataId
                console.log(selectedValuesJSON);

            });
        });
    </script>
 
    <script>
		$(document).ready(function() {
            $('.js-example-basic-multiple').select2();

		    $("form").submit(function(e){
		    	var $this = $(this);
                const selectedOption = document.querySelector('input[name="selected_option"]:checked');
				const selectedOptionValue = selectedOption.value;

                // Select only the checked checkboxes and get their values
                const checkedNoteCheckboxes = $('input[name="note[]"]:checked');
                const checkedNoteValues = checkedNoteCheckboxes.map(function() {
                    return this.value;
                }).get();

		    	var formData = $this.serializeArray();
                formData.push({ name: "selected_option", value: selectedOptionValue });
                formData.push({ name: "checked_notes", value: checkedNoteValues });


		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ url('/addLabNote') }}",
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
                                showConfirmButton: false, // This will hide the "OK" button
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
		    	
		    	e.preventDefault();
		    });

            $("#printButton").click(function () {
                var $form = $("form");
                const selectedOption = document.querySelector('input[name="selected_option"]:checked');
				const selectedOptionValue = selectedOption.value;

                // Select only the checked checkboxes and get their values
                const checkedNoteCheckboxes = $('input[name="note[]"]:checked');
                const checkedNoteValues = checkedNoteCheckboxes.map(function() {
                    return this.value;
                }).get();

                var formData = $form.serializeArray();
                formData.push({ name: "selected_option", value: selectedOptionValue });
                formData.push({ name: "checked_notes", value: checkedNoteValues });

		    	$.ajax({
		    		url: "{{ url('/addprintLabNote') }}",
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
                                showConfirmButton: false, // This will hide the "OK" button
                            }).then(function() {
                                window.location.href = "{{ url('/labnoteview') }}/" + response.id + "?print=" + encodeURIComponent('yes');
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


            $("#printDownload").click(function () {
                var $form = $("form");
                const selectedOption = document.querySelector('input[name="selected_option"]:checked');
				const selectedOptionValue = selectedOption.value;

                // Select only the checked checkboxes and get their values
                const checkedNoteCheckboxes = $('input[name="note[]"]:checked');
                const checkedNoteValues = checkedNoteCheckboxes.map(function() {
                    return this.value;
                }).get();

                var formData = $form.serializeArray();
                formData.push({ name: "selected_option", value: selectedOptionValue });
                formData.push({ name: "checked_notes", value: checkedNoteValues });

		    	$.ajax({
		    		url: "{{ url('/downloadLabNote') }}",
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
                                showConfirmButton: false, // This will hide the "OK" button
                            }).then(function() {
                                window.location.href = "{{ url('/labnoteview') }}/" + response.id + "?Download=" + encodeURIComponent('yes');
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

            // Add this code below your existing JavaScript code

            // Function to select all teeth
            $('#selectallTeeth').click(function () {
                $('.teethsection img').addClass('selected');
                $('.teethsection img').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    

                });
                pushselectedteethtoArray();
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');
                $('#selectallTeeth').addClass('active-button');
                $('#multishade').removeClass('shades');

            });

            // Function to deselect all teeth
            $('#deselectallTeeth').click(function () {
                $('.teethsection img').removeClass('selected');
                $('.teethsection img').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/normal') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    $(this).siblings('p').find('.teethshade').addClass('shades');

                });
                pushselectedteethtoArray();
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');
                $('#deselectallTeeth').addClass('active-button');
                $('#multishade').addClass('shades');
                $("select.teethshade").val("");
                $('#shades').val('');
            });

            // Add this code below your existing JavaScript code

            // Function to select upper all teeth
            $('#selectUpperAllTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="11"]').addClass('selected');
                $('.teethsection img[data-id="12"]').addClass('selected');
                $('.teethsection img[data-id="13"]').addClass('selected');
                $('.teethsection img[data-id="14"]').addClass('selected');
                $('.teethsection img[data-id="15"]').addClass('selected');
                $('.teethsection img[data-id="16"]').addClass('selected');
                $('.teethsection img[data-id="17"]').addClass('selected');
                $('.teethsection img[data-id="18"]').addClass('selected');
                $('.teethsection img[data-id="21"]').addClass('selected');
                $('.teethsection img[data-id="22"]').addClass('selected');
                $('.teethsection img[data-id="23"]').addClass('selected');
                $('.teethsection img[data-id="24"]').addClass('selected');
                $('.teethsection img[data-id="25"]').addClass('selected');
                $('.teethsection img[data-id="26"]').addClass('selected');
                $('.teethsection img[data-id="27"]').addClass('selected');
                $('.teethsection img[data-id="28"]').addClass('selected');
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').addClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#multishade').removeClass('shades');



                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                });
                pushselectedteethtoArray();
            });

            // Function to select lower All  teeth
            $('#selectLowerAllTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="31"]').addClass('selected');
                $('.teethsection img[data-id="32"]').addClass('selected');
                $('.teethsection img[data-id="33"]').addClass('selected');
                $('.teethsection img[data-id="34"]').addClass('selected');
                $('.teethsection img[data-id="35"]').addClass('selected');
                $('.teethsection img[data-id="36"]').addClass('selected');
                $('.teethsection img[data-id="37"]').addClass('selected');
                $('.teethsection img[data-id="38"]').addClass('selected');
                $('.teethsection img[data-id="41"]').addClass('selected');
                $('.teethsection img[data-id="42"]').addClass('selected');
                $('.teethsection img[data-id="43"]').addClass('selected');
                $('.teethsection img[data-id="44"]').addClass('selected');
                $('.teethsection img[data-id="45"]').addClass('selected');
                $('.teethsection img[data-id="46"]').addClass('selected');
                $('.teethsection img[data-id="47"]').addClass('selected');
                $('.teethsection img[data-id="48"]').addClass('selected');
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').addClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#multishade').removeClass('shades');


                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                });
                pushselectedteethtoArray();
            });

            // Function to select upper left teeth
            $('#selectUpperLeftTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="11"]').addClass('selected');
                $('.teethsection img[data-id="12"]').addClass('selected');
                $('.teethsection img[data-id="13"]').addClass('selected');
                $('.teethsection img[data-id="14"]').addClass('selected');
                $('.teethsection img[data-id="15"]').addClass('selected');
                $('.teethsection img[data-id="16"]').addClass('selected');
                $('.teethsection img[data-id="17"]').addClass('selected');
                $('.teethsection img[data-id="18"]').addClass('selected');
                $('#selectUpperLeftTeeth').addClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#multishade').removeClass('shades');
                $('#selectUpperAllTeeth').removeClass('active-button');
                $('#multishade').removeClass('shades');



                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    

                });
                pushselectedteethtoArray();
            });

            // Add this code below your existing JavaScript code

            // Function to select upper right teeth
            $('#selectUpperRightTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="21"]').addClass('selected');
                $('.teethsection img[data-id="22"]').addClass('selected');
                $('.teethsection img[data-id="23"]').addClass('selected');
                $('.teethsection img[data-id="24"]').addClass('selected');
                $('.teethsection img[data-id="25"]').addClass('selected');
                $('.teethsection img[data-id="26"]').addClass('selected');
                $('.teethsection img[data-id="27"]').addClass('selected');
                $('.teethsection img[data-id="28"]').addClass('selected');
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').addClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');
                $('#multishade').removeClass('shades');


                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    

                });
                pushselectedteethtoArray();
            });
            // Function to select upper right teeth
            $('#selectLowerRightTeeth').click(function () {
                $('#deselectallTeeth').click();
                $('.teethsection img').removeClass('selected');
                $('.teethsection img[data-id="31"]').addClass('selected');
                $('.teethsection img[data-id="32"]').addClass('selected');
                $('.teethsection img[data-id="33"]').addClass('selected');
                $('.teethsection img[data-id="34"]').addClass('selected');
                $('.teethsection img[data-id="35"]').addClass('selected');
                $('.teethsection img[data-id="36"]').addClass('selected');
                $('.teethsection img[data-id="37"]').addClass('selected');
                $('.teethsection img[data-id="38"]').addClass('selected');
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').removeClass('active-button');
                $('#selectLowerRightTeeth').addClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');
                $('#multishade').removeClass('shades');


                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    

                });
                pushselectedteethtoArray();
            });

            // Function to select upper right teeth
            // $('#selectLowerLeftTeeth').click(function () {
            //     $('#deselectallTeeth').click();
            //     $('.teethsection img').removeClass('selected');
            //     $('.teethsection img[data-id="41"]').addClass('selected');
            //     $('.teethsection img[data-id="42"]').addClass('selected');
            //     $('.teethsection img[data-id="43"]').addClass('selected');
            //     $('.teethsection img[data-id="44"]').addClass('selected');
            //     $('.teethsection img[data-id="45"]').addClass('selected');
            //     $('.teethsection img[data-id="46"]').addClass('selected');
            //     $('.teethsection img[data-id="47"]').addClass('selected');
            //     $('.teethsection img[data-id="48"]').addClass('selected');
            //     $('#selectUpperLeftTeeth').removeClass('active-button');
            //     $('#selectUpperRightTeeth').removeClass('active-button');
            //     $('#selectLowerLeftTeeth').addClass('active-button');
            //     $('#selectLowerRightTeeth').removeClass('active-button');
            //     $('#selectallTeeth').removeClass('active-button');
            //     $('#deselectallTeeth').removeClass('active-button');

                
            //     // Update the images to the infected state
            //     $('.teethsection img.selected').each(function () {
            //         var toothId = $(this).attr('data-id');
            //         var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
            //         $(this).attr('src', tempSrc);
            //     });
            //     pushselectedteethtoArray();
            // });

            $('#selectLowerLeftTeeth').click(function () {
            $('#deselectallTeeth').click();
            $('.teethsection img').removeClass('selected');
            $('.teethsection img[data-id="41"]').addClass('selected');
            $('.teethsection img[data-id="42"]').addClass('selected');
            $('.teethsection img[data-id="43"]').addClass('selected');
            $('.teethsection img[data-id="44"]').addClass('selected');
            $('.teethsection img[data-id="45"]').addClass('selected');
            $('.teethsection img[data-id="46"]').addClass('selected');
            $('.teethsection img[data-id="47"]').addClass('selected');
            $('.teethsection img[data-id="48"]').addClass('selected');
            
            // Update the images and select elements to the infected state
            $('.teethsection img.selected').each(function () {
                var toothId = $(this).attr('data-id');
                var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                $(this).attr('src', tempSrc);
                
            });
            
            // Update the UI for button states
            $('#selectUpperLeftTeeth').removeClass('active-button');
            $('#selectUpperRightTeeth').removeClass('active-button');
            $('#selectLowerLeftTeeth').addClass('active-button');
            $('#selectLowerRightTeeth').removeClass('active-button');
            $('#selectallTeeth').removeClass('active-button');
            $('#deselectallTeeth').removeClass('active-button');
            $('#selectLowerAllTeeth').removeClass('active-button');
            $('#selectUpperAllTeeth').removeClass('active-button');
            $('#multishade').removeClass('shades');

            
            pushselectedteethtoArray();
        });



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
                var $teethshade = $(this).siblings('p').find('.teethshade'); // Find the related select element

                if($(this).hasClass('selected'))
                {
                    var tempSrc = '{{ asset('assets/images/infected') }}/'+toothId+".jpg";
                    $teethshade.removeClass('shades'); // Remove the 'shades' class from the related select element
                }
                else
                {
                    var tempSrc = '{{ asset('assets/images/normal') }}/'+toothId+".jpg";
                    $teethshade.addClass('shades'); // Add the 'shades' class to the related select element   
                }
                $(this).attr('src', tempSrc);
                pushselectedteethtoArray();
            });

			$('#selectteethModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $(function(){
                $(".dateofbirth").datepicker({ 
                    dateFormat: 'dd-M-yy',
                    changeYear: true,
                    changeMonth: true,
                    yearRange: "c-150:c+150"
                });
                $(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
            });

            var url = window.location.href;

             // Function to extract the ID from the URL
            function getIDFromURL(url) {
                var match = /\/labnoteadding\/(\d+)/.exec(url);
                if (match && match[1]) {
                    return match[1];
                }
                return null;
            }

            var id = getIDFromURL(url);

            if(id){
                $('#patient_name').val(id);
                $('#patient_name').css('pointer-events', 'none');
                $('#patient_name').css('background-color', '#e6eaee');
            }

            console.log('qqqqq',id);

 

		});      
    </script>
@endsection
