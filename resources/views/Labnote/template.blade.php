
        <div class="modal-body">
            <div style="display:flex;">
                <div class="modal-body modal-title" style="display:flex;justify-content:center; margin-left:25%" id="">
                    <img id="" src="https://identx.in/drishitadentalclinic/public/assets/images/logo/ayudentallogo.png"  alt="Logo" srcset="" style="height: 150px; width: 300px; object-fit: contain;">
                </div>
            </div>
            <div style="display:flex; border-bottom :1px solid">
                <div class="modal-body modal-title" id="">
                <p class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px;font-family:Times New Roman"><b><span class="drname">Dr. Ishita</span></b><span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;"><i class="fas fa-phone" style="margin-top:5px"></i>&nbsp;<span class="drnumber">9535751921</span></span></p>
                <p class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px;font-family:Times New Roman"><span class="drdeg">M.D.S. (prosthodontist & Implantologist)</span><span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;"><i class="fas fa-envelope" style="margin-top:5px"></i>&nbsp;<span class="dremail">ishitajakhanwal90@gmail.com</span></p>
                </div>
            </div>
            <h5 class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px;color:#29166f;">Job No : {{ $details->id }}  <span id="VisitPatientName"></span> <span style="float: right; font-size: 16px; font-weight: 600; margin-right: 15px;color:#29166f;">Date : {{  date('d-M-Y') }}</span></h5>
            </h5>
            <h5 class="card-title" style=" font-size: 16px; font-weight: 600;  margin-bottom: 8px; color:#29166f;">Patient Id : {{ $details->patient_uniq_id }}</h5>
            <br>
            <br>
                <table class="table printtbl dataTable table-min-width-xl mb-0">
                    <tbody>
                        <tr>
                            <th class="text-bold-500" style="text-align: left;">Lab Name</th>
                            <td style="padding-left:60px">{{$details->labname}}</td>
                        </tr>
                        <br>
                        <tr colspan=2>
                            <th class="text-bold-500" style="text-align: left;">Patient Name</th>
                            <td style="padding-left:60px">{{$details->patient_name}}</td>
                        </tr>
                        <br>
                        <tr>
                            <th class="text-bold-500" style="text-align: left;">Teeth/Tooth</th>
                            <td style="padding-left:60px">{{$details->teeth_tooth}}</td>
                        </tr>
                        <br>
                        <tr>
                            <th class="text-bold-500" style="text-align: left;">Type of Work</th>
                            <td style="padding-left:60px">{{$details->type_of_work}}</td>
                        </tr>
                        <br>
                        <tr>
                            <th class="text-bold-500" style="text-align: left;">Work Given In The Form</th>
                            <td style="padding-left:60px">{{$details->selectedOption}}</td>
                        </tr>
                        <tr>
                        <div class="note">
                            <!-- <h4 class="text-bold-500">Instructions</h4>
                            <?php
                            $noteValues = explode(',', $details->note); // Split the note field by commas
                            foreach ($noteValues as $noteValue) {
                                echo "<p>$noteValue</p>";
                            }
                            ?> -->
                            <h4 class="heading">Instructions</h4>
                            <p>{{$details->additional}}</p>
                        </div>
                        </tr>
                        <br>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text-bold-500"></th>
                            <td></td>
                        </tr>
                        
                    </tbody>
                </table>
                <table class="table printtbl dataTable table-min-width-xl mb-0">
                    <tbody>
                        <tr>   
                            <th class="text-bold-500" style="text-align: left;">Coping/Try In:</th>
                            <td><hr></td>
                            <th class="text-bold-500" style="padding-left:350px">Final Work:</th>
                            <td>{{ date('d-M-Y', strtotime($details->excepted_date_of_deliver)) }}</td>
                        </tr>
                        @auth
                        <tr>   
                            <th class="text-bold-500"><hr></th>
                            <td><hr></td>
                            <th class="text-bold-500" style="padding-left:350px;">Prepared By:</th>
                            <td style="padding-left:10px;">{{ Auth::user()->name }}</td>
                        </tr>
                        @endauth
                    </tbody>
                </table>
            </div>
        </div>
        
        
