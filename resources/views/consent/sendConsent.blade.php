<div class="modal-body">
    <img id="add_pre_logo" src="https://identx.in/drishitadentalclinic/public/assets/images/logo/ayudentallogo.png"  alt="Logo" srcset="" style="height: 100px; width: 200px; object-fit: contain;">
    <div style="float:right">
        <h3>Dr. Ishita Jakhanwal</h3>
        <h5>MDS, prosthodontist & Implantologist</h5>
        <h5>(Reg : A-26110)</h5>
    </div>
</div>
<br>
<hr>
<div>
    <h3 style="margin-left:35%">CONSULTATION FORM</h3>
</div>
<hr>
<ul class="patient-details-list d-flex justify-content-around" style="list-style:none">
    <li><b>Full Name:</b> {{$consentDetails->name}}</li>
    <li><b>Date:</b> {{ date('d-M-Y', strtotime($consentDetails->date)) }}</li>
    <li><b>Address:</b> {{$consentDetails->address}}</li>
    <li><b>Contact Phone:</b> {{$consentDetails->contact}}</li>
    <li><b>Email Address:</b> {{$consentDetails->email}}</li>
</ul>
<br>
<hr>
<ul class="patient-details-list d-flex justify-content-around" style="list-style:none">
    <li><b>Chief Complaint:</b> {{$consentDetails->chiefcomplain}}</li>
    <li><b>Medical History:</b>{{$consentDetails->medicalhistory}}</li>
    <li><b>Dental History:</b> {{$consentDetails->dentalhistory}}</li>
    <li><b>Under Medication (If Any):</b> {{$consentDetails->undermedication}}</li>
</ul>
<hr>
<div class="col-md-12 col-12 d-flex">
    <div class="col-md-6 col-6">
        <div class="">
            <h3>Advice(please Tick)</h3>
        </div>
        <div class="">
            <div class="form-group">
                <div style="font-size:14px">
                    @php
                    $checkboxNames = [
                        'Single Dental Implant',
                            'All on 6 Implants',
                            'Multiple Dental Implants',
                            'Sinus/ bone grafting',
                            'All on 4 Implants',
                            'Full Mouth Rehabilitation',
                        ];
                        $selectedValues = [];
                    @endphp

                    @foreach ($checkboxNames as $name)
                        @php
                            $isChecked = in_array($name, explode(',', $consentDetails->advice));
                        @endphp

                        @if ($isChecked)
                            <div class="form-check">
                                {{ $name }}
                            </div>
                            @php
                                $selectedValues[] = $name;
                            @endphp
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-6">
        <div class="">
            <h3>Blood investigations For Implant</h3>
        </div>
        <div class="">
            <div class="form-group">
                <div style="font-size:14px">
                    @php
                        $bloodInvestigations = [
                            'CBC',
                            'CB / CT',
                            'BT / CT',
                            'RBS',
                            'Rapid HIV',
                            'PT / INR',
                        ];
                        $selectedBloodValues = [];
                    @endphp

                    @foreach ($bloodInvestigations as $investigation)
                        @php
                            $selectedValues = explode(',', $consentDetails->bloodinvestigate);
                            $isChecked = in_array($investigation, $selectedValues);
                        @endphp

                        @if ($isChecked)
                            <div class="form-check">
                                {{ $investigation }}
                            </div>
                            @php
                                $selectedBloodValues[] = $investigation;
                            @endphp
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="">
    <h3>Dental Consultation:</h3>
    <div class="table-responsive">
        <ul class="dconsult" style="display:flex;flex-wrap:wrap;list-style:none;justify-content:space-around">
            <!-- Row 1 -->
            @if(!empty($consentDetails->maxrightcaries) || !empty($consentDetails->maxleftcaries) || !empty($consentDetails->manrightcaries) || !empty($consentDetails->manleftcaries))
                <li><strong>1. Caries:</strong>
                    <ul>
                        @if(!empty($consentDetails->maxrightcaries))
                            <li>Maxillary Right: {{ $consentDetails->maxrightcaries }}</li>
                        @endif
                        @if(!empty($consentDetails->maxleftcaries))
                            <li>Maxillary Left: {{ $consentDetails->maxleftcaries }}</li>
                        @endif
                        @if(!empty($consentDetails->manrightcaries))
                            <li>Mandibular Right: {{ $consentDetails->manrightcaries }}</li>
                        @endif
                        @if(!empty($consentDetails->manleftcaries))
                            <li>Mandibular Left: {{ $consentDetails->manleftcaries }}</li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Row 2 -->
            @if(!empty($consentDetails->maxrightcervical) || !empty($consentDetails->maxleftcervical) || !empty($consentDetails->manrightcervical) || !empty($consentDetails->manleftcervical))
                <li><strong>2. Cervical Abrasion:</strong>
                    <ul>
                        @if(!empty($consentDetails->maxrightcervical))
                            <li>Maxillary Right: {{ $consentDetails->maxrightcervical }}</li>
                        @endif
                        @if(!empty($consentDetails->maxleftcervical))
                            <li>Maxillary Left: {{ $consentDetails->maxleftcervical }}</li>
                        @endif
                        @if(!empty($consentDetails->manrightcervical))
                            <li>Mandibular Right: {{ $consentDetails->manrightcervical }}</li>
                        @endif
                        @if(!empty($consentDetails->manleftcervical))
                            <li>Mandibular Left: {{ $consentDetails->manleftcervical }}</li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Row 3 -->
            @if(!empty($consentDetails->maxrightroot) || !empty($consentDetails->maxleftroot) || !empty($consentDetails->manrightroot) || !empty($consentDetails->manleftroot))
                <li><strong>3. Root Pieces:</strong>
                    <ul>
                        @if(!empty($consentDetails->maxrightroot))
                            <li>Maxillary Right: {{ $consentDetails->maxrightroot }}</li>
                        @endif
                        @IF(!empty($consentDetails->maxleftroot))
                            <li>Maxillary Left: {{ $consentDetails->maxleftroot }}</li>
                        @endif
                        @if(!empty($consentDetails->manrightroot))
                            <li>Mandibular Right: {{ $consentDetails->manrightroot }}</li>
                        @endif
                        @if(!empty($consentDetails->manleftroot))
                            <li>Mandibular Left: {{ $consentDetails->manleftroot }}</li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Row 4 -->
            @if(!empty($consentDetails->maxrightcervical) || !empty($consentDetails->maxleftcervical) || !empty($consentDetails->manrightcervical) || !empty($consentDetails->manleftcervical))
                <li><strong>4. Cervical Abrasion:</strong>
                    <ul>
                        @if(!empty($consentDetails->maxrightcervical))
                            <li>Maxillary Right: {{ $consentDetails->maxrightcervical }}</li>
                        @endif
                        @if(!empty($consentDetails->maxleftcervical))
                            <li>Maxillary Left: {{ $consentDetails->maxleftcervical }}</li>
                        @endif
                        @if(!empty($consentDetails->manrightcervical))
                            <li>Mandibular Right: {{ $consentDetails->manrightcervical }}</li>
                        @endif
                        @if(!empty($consentDetails->manleftcervical))
                            <li>Mandibular Left: {{ $consentDetails->manleftcervical }}</li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Row 5 -->
            @if(!empty($consentDetails->maxrightroot) || !empty($consentDetails->maxleftroot) || !empty($consentDetails->manrightroot) || !empty($consentDetails->manleftroot))
                <li><strong>5. Root Pieces:</strong>
                    <ul>
                        @if(!empty($consentDetails->maxrightroot))
                            <li>Maxillary Right: {{ $consentDetails->maxrightroot }}</li>
                        @endif
                        @if(!empty($consentDetails->maxleftroot))
                            <li>Maxillary Left: {{ $consentDetails->maxleftroot }}</li>
                        @endif
                        @if(!empty($consentDetails->manrightroot))
                            <li>Mandibular Right: {{ $consentDetails->manrightroot }}</li>
                        @endif
                        @if(!empty($consentDetails->manleftroot))
                            <li>Mandibular Left: {{ $consentDetails->manleftroot }}</li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Row 6 -->
            @if(!empty($consentDetails->maxrightmissing) || !empty($consentDetails->maxleftmissing) || !empty($consentDetails->manrightmissing) || !empty($consentDetails->manleftmissing))
                <li><strong>6. Missing Teeth:</strong>
                    <ul>
                        @if(!empty($consentDetails->maxrightmissing))
                            <li>Maxillary Right: {{ $consentDetails->maxrightmissing }}</li>
                        @endif
                        @if(!empty($consentDetails->maxleftmissing))
                            <li>Maxillary Left: {{ $consentDetails->maxleftmissing }}</li>
                        @endif
                        @if(!empty($consentDetails->manrightmissing))
                            <li>Mandibular Right: {{ $consentDetails->manrightmissing }}</li>
                        @endif
                        @if(!empty($consentDetails->manleftmissing))
                            <li>Mandibular Left: {{ $consentDetails->manleftmissing }}</li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Row 7 -->
            @if(!empty($consentDetails->maxrightrestored) || !empty($consentDetails->maxleftrestored) || !empty($consentDetails->manrightrestored) || !empty($consentDetails->manleftrestored))
                <li><strong>7. Restored Teeth:</strong>
                    <ul>
                        @if(!empty($consentDetails->maxrightrestored))
                            <li>Maxillary Right: {{ $consentDetails->maxrightrestored }}</li>
                        @endif
                        @if(!empty($consentDetails->maxleftrestored))
                            <li>Maxillary Left: {{ $consentDetails->maxleftrestored }}</li>
                        @endif
                        @if(!empty($consentDetails->manrightrestored))
                            <li>Mandibular Right: {{ $consentDetails->manrightrestored }}</li>
                        @endif
                        @if(!empty($consentDetails->manleftrestored))
                            <li>Mandibular Left: {{ $consentDetails->manleftrestored }}</li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Row 8 -->
            @if(!empty($consentDetails->maxrightcrowned) || !empty($consentDetails->maxleftcrowned) || !empty($consentDetails->manrightcrowned) || !empty($consentDetails->manleftcrowned))
                <li><strong>8. Crowned Teeth:</strong>
                    <ul>
                        @if(!empty($consentDetails->maxrightcrowned))
                            <li>Maxillary Right: {{ $consentDetails->maxrightcrowned }}</li>
                        @endif
                        @IF(!empty($consentDetails->maxleftcrowned))
                            <li>Maxillary Left: {{ $consentDetails->maxleftcrowned }}</li>
                        @endif
                        @if(!empty($consentDetails->manrightcrowned))
                            <li>Mandibular Right: {{ $consentDetails->manrightcrowned }}</li>
                        @endif
                        @if(!empty($consentDetails->manleftcrowned))
                            <li>Mandibular Left: {{ $consentDetails->manleftcrowned }}</li>
                        @endif
                    </ul>
                </li>
            @endif

            <!-- Row 9 -->
            @if(!empty($consentDetails->maxrightbridge) || !empty($consentDetails->maxleftbridge) || !empty($consentDetails->manrightbridge) || !empty($consentDetails->manleftbridge))
                <li><strong>9. Bridge:</strong>
                    <ul>
                        @if(!empty($consentDetails->maxrightbridge))
                            <li>Maxillary Right: {{ $consentDetails->maxrightbridge }}</li>
                        @endif
                        @if(!empty($consentDetails->maxleftbridge))
                            <li>Maxillary Left: {{ $consentDetails->maxleftbridge }}</li>
                        @endif
                        @if(!empty($consentDetails->manrightbridge))
                            <li>Mandibular Right: {{ $consentDetails->manrightbridge }}</li>
                        @endif
                        @if(!empty($consentDetails->manleftbridge))
                            <li>Mandibular Left: {{ $consentDetails->manleftbridge }}</li>
                        @endif
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
<div class="">
    <h3>Special Instructions:</h3>
    <p>{{$consentDetails->specialinstruction}}</p>
</div>
<br>
<p style="color:black;text-align:center;" >**I declare that I have read this consultation form thoroughly and I understand every question asked. I
believe I have no medical condition that may affect the treatment. All of the given answer is correct and
true to the best of my knowledge.
</p>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="modal-body">
    <p>Patient's Signature</p>
    <div style="float:right;margin-top:-150px">
        <img src="https://identx.in/drishitadentalclinic/public/assets/images/logo/signature.png" alt="Signature" style="border-bottom:1px solid;" width="180px">
        <h3>Dr Ishita Jakhanwal</h3>
        <p>MDS, prosthodontist & Implantologist</p>
    </div>
</div>
<hr>
    <div class="" style="text-align:center;background:aliceblue;" id="">
        <p style="text-align:center"><i class="fas fa-phone"></i>&nbsp;Appointment No.: 9535751921 / 9960375503</p>
        <p style="text-align:center"><i class="fas fa-map-marker-alt"></i>&nbsp;Office 7, B wing, 1st floor, Siddhesh optimus, opp Lunkad Queensland, Viman Nagar, Pune - 411014</p>
    </div>
<hr>
