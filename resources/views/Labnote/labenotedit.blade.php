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
	                <h3>Edit Lab Note</h3>
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
                                                <select  id="patient_name" class="form-select" name="patient_name">
                                                    <option value="">Select Patient Name</option>
                                                    @foreach($Patient as $patient)
                                                    <option value="{{$patient->id}}">{{$patient->name}}</option>
                                                    @endforeach
                                                </select>
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
											        <a id="selectteeth" href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#selectteethModal">Select Teeth</a>
											        <input type="hidden" name="Eselectedteeth" id="Eselectedteeth">
											</div>
	                                    </div>
	                                    <!-- <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Type of Work</label>
												<select  id="type_of_work" class="js-example-basic-multiple form-select" name="type_of_work[]" multiple="multiple">
													<option value="">Select Lab Name</option>
													@foreach($TOW as $TOWItem)
                                                        <option value="{{$TOWItem->type_of_work}}"
                                                            @if(in_array($TOWItem->id, $TOWIds))
                                                                selected
                                                            @endif
                                                        >{{$TOWItem->type_of_work}}</option>
                                                    @endforeach
												</select>
	                                        </div>
	                                    </div> -->
                                        <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Type of Work</label>
                                                <input type="text" id="type_of_work" class="form-control" placeholder=" " name="type_of_work" value="{{$doctorDetails->type_of_work}}">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Excepted Date of Deliver</label>
	                                            <input type="text" id="excepted_date_of_deliver" class="form-control dateofbirth" placeholder=" " name="excepted_date_of_deliver" value="{{$doctorDetails->excepted_date_of_deliver}}">
	                                        </div>
	                                    </div>

                                        <div class="col-md-6 col-12">
											<div class="form-group">
												<label for="city-column">Work Given In The Form</label>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="selected_option" id="option1" value="Models" {{ $doctorDetails->selectedOption == 'Models' ? 'checked' : '' }}>
													<label class="form-check-label" for="option1">Models</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="selected_option" id="option2" value="Scan File" {{ $doctorDetails->selectedOption == 'Scan File' ? 'checked' : '' }}>
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
                                                        @php
                                                            $selectedValues = explode(',', $doctorDetails->note);
                                                            $isChecked = in_array($note->note, $selectedValues);
                                                        @endphp
                                                        <input type="checkbox" class="form-check-input" id="note{{ $key + 1 }}" name="note[]" value="{{ $note->note }}"
                                                            @if($isChecked) checked @endif>
                                                        <label class="form-check-label" for="note{{ $key + 1 }}">{{ $key + 1 }}. {{ $note->note }}</label>
                                                    </div>
                                                @endforeach -->
                                            </div>
                                            <textarea class="form-control" id="additional" name="additional" placeholder="">{{$doctorDetails->additional}}</textarea>
                                        </div>
	                                    
	                                    <div class="col-12 d-flex justify-content-end">
	                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
	                                        <a href="{{ url('/labnotelist') }}"class="btn btn-light-secondary me-1 mb-1">Close</a>
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
                                            <select class="teethshade shades" data-id="18">
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
                                            <select class="teethshade shades" data-id="17">
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
                                            <select class="teethshade shades" data-id="16">
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
                                            <select class="teethshade shades" data-id="15">
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
                                            <select class="teethshade shades" data-id="14">
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
                                            <select class="teethshade shades" data-id="13">
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
                                            <select class="teethshade shades" data-id="12">
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
                                            <select class="teethshade shades" data-id="11">
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
                                            <select class="teethshade shades" data-id="21">
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
                                            <select class="teethshade shades" data-id="22">
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
                                            <select class="teethshade shades" data-id="23">
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
                                            <select class="teethshade shades" data-id="24">
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
                                            <select class="teethshade shades" data-id="25">
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
                                            <select class="teethshade shades" data-id="26">
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
                                            <select class="teethshade shades" data-id="27">
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
                                            <select class="teethshade shades" data-id="28">
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
                                            <select class="teethshade shades" data-id="48">
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
                                            <select class="teethshade shades" data-id="47">
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
                                            <select class="teethshade shades" data-id="46">
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
                                            <select class="teethshade shades" data-id="45">
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
                                            <select class="teethshade shades" data-id="44">
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
                                            <select class="teethshade shades" data-id="43">
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
                                            <select class="teethshade shades" data-id="42">
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
                                            <select class="teethshade shades" data-id="41">
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
                                            <select class="teethshade shades" data-id="31">
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
                                            <select class="teethshade shades" data-id="32">
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
                                            <select class="teethshade shades" data-id="33">
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
                                            <select class="teethshade shades" data-id="34">
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
                                            <select class="teethshade shades" data-id="35">
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
                                            <select class="teethshade shades" data-id="36">
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
                                            <select class="teethshade shades" data-id="37">
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
                                            <select class="teethshade shades" data-id="38">
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
            // Access shadesArr here
            var shadesArr = @json($doctorDetails->shades); 
            var shadesObj = JSON.parse(shadesArr);// Convert PHP array to JSON

            // Now you can use shadesArr in your jQuery code
            console.log(";;;;;;;",shadesObj);

            // Iterate over each select element with class "teethshade"
            $('.teethshade').each(function() {
                // Get the data-id attribute value
                var dataId = $(this).data('id');

                // Check if dataId is a key in shadesArr
                if (dataId in shadesObj) {
                    // Set the selected option based on the value in shadesArr
                    $(this).val(shadesObj[dataId]);

                    // Trigger a change event on the select element
                    $(this).trigger('change');
                }
            });
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

                 // Select only the checked checkboxes and get their values
                 const checkedNoteCheckboxes = $('input[name="note[]"]:checked');
                const checkedNoteValues = checkedNoteCheckboxes.map(function() {
                    return this.value;
                }).get();

		    	var formData = $this.serializeArray();
                formData.push({ name: "checked_notes", value: checkedNoteValues });

		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ url('/updateLabnote',[$doctorDetails->id]) }}",
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
	                            window.location.href = "{{ url('/labnoteview',[$doctorDetails->id]) }}";
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

			 // 	$(function(){
	   //  			$(".dateofbirth").datepicker({ 
	   //  				dateFormat: 'dd-M-yy',
	   //  				changeYear: true,
	   //  				changeMonth: true,
    // 					yearRange: "c-150:c+150"
	   //  			});
				// });


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
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectUpperAllTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
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
                $('#selectUpperLeftTeeth').removeClass('active-button');
                $('#selectUpperRightTeeth').removeClass('active-button');
                $('#selectLowerLeftTeeth').addClass('active-button');
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


				pushselectedteethtoArray = function(){
                selectedTeethArr = [];
                $('.teethsection img.selected').each(function() {
                    selectedTeethArr.push($(this).attr('data-id'));
                });
                if(selectedTeethArr.length != 0)
                {
                    $("#selectteeth").html("Selected Teeth "+selectedTeethArr);
                    $("#selectteeth").addClass("text-success").removeClass("text-danger");
                    $("#Eselectedteeth").val(JSON.stringify(selectedTeethArr, null, 2));
                }
                else
                {
                    $("#selectteeth").html("Select Teeth");
                    $("#selectteeth").addClass("text-danger").removeClass("text-success");
                    $("#Eselectedteeth").val("");
                }
            }

            // for multiple selecte dteeth have only one drop down
            // To select Image
            $('.teethsection img').click(function () {
                var dataId = $(this).data('id');
                var dataSets = [
                    [11, 12, 13, 14, 15, 16, 17, 18],
                    [21, 22, 23, 24, 25, 26, 27, 28],
                    [31, 32, 33, 34, 35, 36, 37, 38],
                    [41, 42, 43, 44, 45, 46, 47, 48],
                    [11, 12, 13, 14, 15, 16, 17, 18, 21, 22, 23, 24, 25, 26, 27, 28],
                    [31, 32, 33, 34, 35, 36, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48],
                    [11, 12, 13, 14, 15, 16, 17, 18, 21, 22, 23, 24, 25, 26, 27, 28, 31, 32, 33, 34, 35, 36, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48]
                ];

                var $teethshade = $(this).siblings('p').find('.teethshade'); // Find the related select element
                var tempSrc;

                // Toggle the 'selected' class on the clicked element
                $(this).toggleClass('selected');

                if ($(this).hasClass('selected')) {
                    tempSrc = '{{ asset('assets/images/infected') }}/' + dataId + '.jpg';
                    $teethshade.removeClass('shades'); // Remove the 'shades' class from the related select element
                } else {
                    tempSrc = '{{ asset('assets/images/normal') }}/' + dataId + '.jpg';
                    $teethshade.addClass('shades'); // Add the 'shades' class to the related select element
                }

                $(this).attr('src', tempSrc);

                for (var i = 0; i < dataSets.length; i++) {
                    var dataIdsToCheck = dataSets[i];
                    var selectedElements = $('.teethsection img').filter(function () {
                        return dataIdsToCheck.includes($(this).data('id'));
                    });

                    var allSelected = selectedElements.length === dataIdsToCheck.length &&
                        selectedElements.filter('.selected').length === dataIdsToCheck.length;

                    if (allSelected) {
                        $('#multishade').removeClass('shades');

                        selectedElements.each(function () {
                            var $relatedTeethshade = $(this).siblings('p').find('.teethshade');
                            $relatedTeethshade.addClass('shades');
                        });
                    } else {
                        $('#multishade').removeClass('shades');
                    }
                }

                pushselectedteethtoArray();
            });



            // $('.teethsection img').click(function () {
            //     $(this).toggleClass('selected');
            //     var toothId = $(this).attr('data-id');
            //     var $teethshade = $(this).siblings('p').find('.teethshade'); // Find the related select element

            //     if($(this).hasClass('selected'))
            //     {
            //         var tempSrc = '{{ asset('assets/images/infected') }}/'+toothId+".jpg";
            //         $teethshade.removeClass('shades'); // Remove the 'shades' class from the related select element

            //     }
            //     else
            //     {
            //         var tempSrc = '{{ asset('assets/images/normal') }}/'+toothId+".jpg";
            //         $teethshade.addClass('shades'); // Add the 'shades' class to the related select element
   
            //     }
            //     $(this).attr('src', tempSrc);
            //     pushselectedteethtoArray();
                
            // });

            //Disable popup on click out side to page

            $('#selectteethModal').modal({
                backdrop: 'static',
                keyboard: false
            });

			<?php foreach ($toothArr as $toothValue): ?>
            	// console.log({{$toothValue}});
            	$('.teethsection img[data-id='+{{$toothValue}}+']').trigger('click');
            <?php endforeach ?>

			<?php foreach ($TOWIds as $TOWIds): ?>
            	console.log({{$TOWIds}});
            <?php endforeach ?>

            $(function(){
                $(".dateofbirth").datepicker({ 
                    dateFormat: 'dd-M-yy',
                    changeYear: true,
                    changeMonth: true,
                    yearRange: "c-150:c+150"
                });
                $(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
            });


            $('#type_of_work option').click(function(e) {
                e.preventDefault();
                $(this).prop('selected', !$(this).prop('selected'));
            });


				$("#lab_name").val("{{ $doctorDetails->lab_name }}"); 
                $("#patient_name").val("{{ $doctorDetails->patient_name }}"); 
                $("#multishade").val("{{ $doctorDetails->multishade }}"); 
                $("#selectedShade").val("{{ $doctorDetails->multishade }}"); 
				$("#lab_name").trigger("refresh");
                $("#patient_name").trigger("refresh");
                $("#multishade").trigger("refresh");
                $("select.teethshade").trigger('change');



		});      
    </script>
@endsection