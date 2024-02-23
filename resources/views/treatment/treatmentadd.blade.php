@extends('layouts.app')

@section('content')
	<style type="text/css">
		.checkboxinputBlock {
			align-items: center;
		}

		@media screen and (max-width: 940px) {
			.checkboxinputBlock {
				flex-direction: column;
    			justify-content: flex-start;
			}
			.checkboxinputBlock .checkboxBlock,
			.checkboxinputBlock .inputBlock {
				width: 100%;
			}
		}
	</style>
	<div class="page-heading">
	    <div class="page-title mb-3">
	        <div class="row">
	            <div class="col-12 col-md-6 order-md-1 order-last">
	                <h3>Add Treatment</h3>
	            </div>
	            <div class="col-12 col-md-6 order-md-2 order-first">
	                <!-- <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
	                    <ol class="breadcrumb">
	                        <li class="breadcrumb-item"><a>Dashboard</a></li>
	                        <li class="breadcrumb-item" aria-current="page">Patient</li>
	                        <li class="breadcrumb-item active" aria-current="page">Add Treatment</li>
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
                        		 	<input type="hidden" name="patientId" id="patientId" value="{{$patientId}}">
	                                <div class="row">
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="first-name-column">Treatment Date</label>
	                                            <input type="text" id="treatment_date" class="form-control dateofbirth"
	                                                placeholder="" name="treatment_date">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                        <div class="form-group">
	                                            <label for="last-name-column">Select Teeth</label>
	                                            <div class="form-group mt-1">
											                            <a id="selectteeth" href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#selectteethModal">Select Teeth</a>
											                            <input type="hidden" name="selectedteeth" id="selectedteeth">
											                        </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-12">
	                                        <div class="form-group">
	                                            <label for="city-column">Treatment Info</label>

	                                			<div class="row">
	                                				<?php $i = 0; ?>
    	                                				@foreach($treatmentList as $index => $treatment)
                                                            <div class="col-md-6 col-12 d-flex checkboxinputBlock">
                                                                <div class="col-md-4 col-12 col-sm-12 checkboxBlock mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="form-check-input form-check-primary" name="checktreatment[]" id="{{$treatment['id']}}" value="{{$treatment['name']."-".$index}}">
                                                                        <label class="form-check-label" for="{{$treatment['id']}}">{{$treatment['name']}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-12 col-sm-12 px-2 inputBlock mb-3">
                                                                    <input type="text" class="form-control chargesinput" placeholder="Charges" name="charges[]">
                                                                </div>
                                                                <div class="col-md-4 col-12 col-sm-12 inputBlock px-2 mb-3">
                                                                    <input type="text" class="form-control" placeholder="Remark" name="remark[]">
                                                                </div>
                                                            </div>
                                                        @endforeach
			                                    </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6 col-12">
	                                    	<div class="form-group">
					                            <label for="exampleFormControlTextarea1" class="form-label">Diagnosis</label>
					                            <textarea class="form-control" id="exampleFormControlTextarea1" name="diagnosis" rows="3"></textarea>
			                                </div>
	                                    </div>
	                                    <div class="col-12 d-flex justify-content-end">
	                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
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
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Teeth Selection</h4>
                    <div class="teethbtn">
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
                        <button type="button" id="selectadultAllTeeth" class="btn btn-outline-secondary">
                            All Adult
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
                        <hr>
                        <label><b>Children Teeth</b></label>
                        <div class="teethBlock d-flex flex-column">
                            <div class="teethsection d-flex">
                                <div class="d-flex childteeth">
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/51.jpg') }}" data-id="51">
                                        <p>51</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/52.jpg') }}" data-id="52">
                                        <p>52</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/53.jpg') }}" data-id="53">
                                        <p>53</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/54.jpg') }}" data-id="54">
                                        <p>54</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/55.jpg') }}" data-id="55">
                                        <p>55</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/61.jpg') }}" data-id="61">
                                        <p>61</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/62.jpg') }}" data-id="62">
                                        <p>62</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/63.jpg') }}" data-id="63">
                                        <p>63</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/64.jpg') }}" data-id="64">
                                        <p>64</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/65.jpg') }}" data-id="65">
                                        <p>65</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/71.jpg') }}" data-id="71">
                                        <p>71</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/72.jpg') }}" data-id="72">
                                        <p>72</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/73.jpg') }}" data-id="73">
                                        <p>73</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/74.jpg') }}" data-id="74">
                                        <p>74</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/75.jpg') }}" data-id="75">
                                        <p>75</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/81.jpg') }}" data-id="81">
                                        <p>81</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/82.jpg') }}" data-id="82">
                                        <p>82</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/83.jpg') }}" data-id="83">
                                        <p>83</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/84.jpg') }}" data-id="84">
                                        <p>84</p>
                                    </div>
                                    <div class="">
                                        <img src="{{ asset('assets/images/normal/85.jpg') }}" data-id="85">
                                        <p>85</p>
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
    <script>
		$(document).ready(function() {
		    $("form").submit(function(e){
		    	var $this = $(this);
		    	var formData = $this.serializeArray();
		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ route('addTreatment') }}",
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
                                var showField = '{{ request()->query('addTreat') }}';

                                if (showField === 'true') {
                                    var redirectUrl = "{{ url('/patientview') }}/{{ $patientId }}/?addTreat=" + encodeURIComponent('yes');
                                } else {
                                    var redirectUrl = "{{ url('/patientview') }}/{{ $patientId }}";
                                }

                                window.location.href = redirectUrl;
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
                $('#selectadultAllTeeth').removeClass('active-button');
                $('#selectallTeeth').addClass('active-button');
                
            });

            // Function to deselect all teeth
            $('#deselectallTeeth').click(function () {
                $('.teethsection img').removeClass('selected');
                $('.teethsection img').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/normal') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);

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
                $('#selectadultAllTeeth').removeClass('active-button');

                
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
                $('#selectadultAllTeeth').removeClass('active-button');



                
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
                $('#selectadultAllTeeth').removeClass('active-button');


                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                    
                });
                pushselectedteethtoArray();
            });

            $('#selectadultAllTeeth').click(function () {
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
                $('#selectadultAllTeeth').addClass('active-button');
                $('#selectLowerAllTeeth').removeClass('active-button');
                $('#selectallTeeth').removeClass('active-button');
                $('#deselectallTeeth').removeClass('active-button');

                
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
                $('#selectUpperAllTeeth').removeClass('active-button');
                $('#selectadultAllTeeth').removeClass('active-button');



                
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
                $('#selectadultAllTeeth').removeClass('active-button');


                
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
                $('#selectadultAllTeeth').removeClass('active-button');


                
                // Update the images to the infected state
                $('.teethsection img.selected').each(function () {
                    var toothId = $(this).attr('data-id');
                    var tempSrc = '{{ asset('assets/images/infected') }}/' + toothId + ".jpg";
                    $(this).attr('src', tempSrc);
                    
                    

                });
                pushselectedteethtoArray();
            });


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
            $('#selectadultAllTeeth').removeClass('active-button');

            
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

			$('#selectteethModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $(function(){
                $(".dateofbirth").datepicker({ dateFormat: 'dd-M-yy', changeYear: true, changeMonth: true, yearRange: "c-150:c+150" });
                $(".dateofbirth").val($.datepicker.formatDate('dd-M-yy', new Date()));
            });

		});      
    </script>
    <script>
        $(document).ready(function() {
            // Listen for changes in the checkbox state
            $('input[type="checkbox"]').change(function() {
                var isChecked = $(this).prop('checked');
                var chargesInput = $(this).closest('.checkboxinputBlock').find('.chargesinput');

                // If the checkbox is checked, make the "Charges" field required
                if (isChecked) {
                    chargesInput.prop('required', true);
                } else {
                    chargesInput.prop('required', false);
                }
            });
        });
</script>
<script>
    $(document).ready(function () {
        // Listen for checkbox change event
        $('input[type="checkbox"]').on('change', function () {
            if ($(this).is(':checked')) {
                $('#selectteethModal').modal('show'); // Show the modal
            } else {
                $('#selectteethModal').modal('hide'); // Hide the modal
            }
        });
    });
</script>
@endsection