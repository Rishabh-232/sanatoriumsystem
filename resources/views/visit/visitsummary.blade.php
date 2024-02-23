<div style="">
    <div style="display:flex;">
        <div class="modal-body modal-title" style="margin-left:30%" id="">
            <img src="https://identx.in/drishitadentalclinic/public/assets/images/logo/ayudentallogo.png" id="logoImage"  alt="Logo" srcset="" style="height: 150px; width: 250px; object-fit: contain;">
        </div>
    </div>
    <br>
</div>
<div>
    <p><b>Dr. Ishita</b></p>
    <p><b>M.D.S. (prosthodontist & Implantologist)</b></p>
</div>
<div style="float:right;margin-top:-85px">
    <p><b>7276075503</b></p>
    <p><b>ayucareultrasoundh@gmail.com</b></p>
</div>
<hr>
    <table class="table printtbl dataTable table-min-width-xl mb-0">
        <tbody>
            <tr>
                <th class="text-bold-500"style="text-align: left; font-size:">Patient Name:</th>
                <td>{{$details->pname}}</td>
            </tr>
            <tr>
                <th class="text-bold-500"style="text-align: left; font-size:">Patient Id:</th>
                <td>{{$details->patient_uniq_id}}</td>
            </tr>
            <br>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">Visit Date</th>
                <td style="padding-left:60px">{{$details->date_of_visit}}</td>
            </tr>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">Chief Complaint</th>
                <td style="padding-left:60px">{{$details->chief_complain}}</td>
            </tr>
            <br>
            <tr colspan=2>
                <th class="text-bold-500" style="text-align: left;">History of Presenting Illness:</th>
                <td style="padding-left:60px">{{$details->history_presenting_Illness}}</td>
            </tr>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">Medical/Dental History</th>
                <td style="padding-left:60px">{{$details->medicalhistory}}</td>
            </tr>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">Findings</th>
                <td style="padding-left:60px">{{$details->findings}}</td>
            </tr>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">Investigations</th>
                <td style="padding-left:60px">{{$details->investigations}}</td>
            </tr>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">Diagnosis</th>
                <td>{{$details->diagnosis}}</td>
            </tr>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">Treatment Plan</th>
                <td>{{$details->treatmentplan}}</td>
            </tr>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">Treatment Done</th>
                <td>{{$details->treatmentdone}}</td>
            </tr>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">Work Done</th>
                <td>{{$details->work_done}}</td>
            </tr>
            <br>
            <tr>
                <th class="text-bold-500" style="text-align: left;">xrays</th>
                <td></td>
            </tr>
            <br>
        </tbody>
    </table>
    <div style="float:right;margin-top:80px">
        <p><b>Doctor's Signature</b></p>
    </div> 
    <div style="margin-top:120px">
        <hr>
        <p>Siddhesh Optimus, Office No. 7, B Wing, First Floor, Sr.No. 211/1/7, Opposite Lunkad Queensland Society, Near Konark Epitome, Vimannagar, Pune - 14.</p>
    </div>
    @if($file)
    <div>
        <p><b>X-Rays</b></p>
        @foreach ($file as $report)
            <img src="{{ asset('Xrays/' . $report) }}" style="height:450px !important; width:700px !important;border:1px solid" alt="Image"  />
        @endforeach
    </div>
    @endif     
