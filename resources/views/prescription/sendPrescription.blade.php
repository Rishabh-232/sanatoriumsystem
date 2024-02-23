<div class="modal-body">

    <img id="" src="https://identx.in/drishitadentalclinic/public/assets/images/logo/ayudentallogo.png" margin-top: 30px; alt="Logo" srcset="" style="margin-left:26%;height: 150px; width: 300px; object-fit: contain; border-bottom :1px solid">
    
        
      <br>
          <div style="display:flex; border-bottom :1px solid">
            <div class="modal-body modal-title" id="">
              <p class="card-title" style="display:flex;justify-content:center;font-size: 12px; font-weight: 600; color:black margin-left: 100px; margin-top: 12px;line-height: 25px;text-align:center; font-family:Times New Roman">Siddhesh Optimus, Office No. 7, B Wing, First Floor, Sr.No. 211/1/7, Opposite Lunkad Queensland Society, Near Konark Epitome, Vimannagar, Pune - 14.</p>
              <p class="card-title" style="display:flex;justify-content:center;font-size: 12px; font-weight: 600; color:black margin-left: 100px; margin-top: 12px;line-height: 25px;text-align:center; font-family:Times New Roman"></i>Contact: 9535751921 | </i>ishitajakhanwal90@gmail.com </p>
            </div>
          </div>
    
      <br>
    
          
        
      <br>
                <table class="table mb-0 table-lg" id="prescriptionTbl" style="border:1px solid; width: 100%;">
                      <thead>
                          <tr style="font-size: 14px;">
                              <th style=" border: 1px solid !important; padding: 20px 30px;">Sr No</th>
                              <th style=" border: 1px solid !important; padding: 20px 30px;">Medicine Name</th>
                              <th style=" border: 1px solid !important; padding: 20px 30px;">Number Of Times</th>
                              <th style=" border: 1px solid !important; padding: 20px 30px;">Remark</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        @foreach($Prescription as $Prescription)
                            <tr>
                                <td class="table-min-width-small">{{ $i++; }}</td>
                                <td class="table-min-width-small">{{ $Prescription->medicine_name }}</td>
                                <td class="table-min-width-small">{{ $Prescription->number_of_times }}</td>
                                <td class="table-min-width-small">{{ $Prescription->remarks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    
    <br>
    <br>
    

    
    
    
                <p class="card-title" style="display:flex;justify-content:center;font-size: 12px; font-weight: 600; color:black margin-left: 100px; margin-top: 12px;line-height: 25px;text-align:center; font-family:Times New Roman">
    </div>
    
    <br>
    <br>
    <br>
    
    <div class="modal-body">
         
         <div style=" text-align:right; display: flex;justify-content: center;padding-top: 8px;margin-top: 20%;font-family:Times New Roman">
            <strong style="color: #000;margin-left: 50px; margin-top: 50px;text-align:center;"><img id="" src="https://identx.in/drishitadentalclinic/public/assets/images/logo/signature.png" style="height:80px;width:150px;"></strong> 
          </div>
          <span style="float:right;margin-top: 0%; font-size:15px;"><b>Doctor's Signature</b></span>
    
          <div style=" text-align:center; display: flex;justify-content: center;border-top: 1px solid #000;padding-top: 8px;margin-top: 5%;font-family:Times New Roman">
            <strong style="color: #000;margin-left: 50px; margin-top: 50px;text-align:center;">Siddhesh Optimus, Office No. 7, B Wing, First Floor, Sr.No. 211/1/7, Opposite Lunkad Queensland Society, Near Konark Epitome, Vimannagar, Pune - 14.</strong> 
          </div>
    </div>