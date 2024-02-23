<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth/login');
// });
Route::get('drishitadentalclinic/public/', function () {
    return view('auth/login');
});

Auth::routes();

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/homemanage', [App\Http\Controllers\HomeController::class, 'indexmanage'])->name('homemanage');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/table', [App\Http\Controllers\HomeController::class, 'table'])->name('table');
Route::get('/form', [App\Http\Controllers\HomeController::class, 'form'])->name('form');
Route::get('/forgotpassword', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgotpassword');

// Patient
Route::get('/patientlist', [App\Http\Controllers\PatientController::class, 'patientlist'])->name('patientlist');
Route::get('/patientview/{id}', [App\Http\Controllers\PatientController::class, 'patientview'])->name('patientview');
Route::get('/patientadd', [App\Http\Controllers\PatientController::class, 'patientadd'])->name('patientadd');
Route::post('/addPatient', [App\Http\Controllers\PatientController::class, 'addPatient'])->name('addPatient');
Route::get('/patientedit/{id}', [App\Http\Controllers\PatientController::class, 'patientedit'])->name('patientedit');
Route::post('/updatePatient/{id}', [App\Http\Controllers\PatientController::class, 'updatePatient'])->name('updatePatient');
Route::get('/patientvisit', [App\Http\Controllers\PatientController::class, 'patientvisit'])->name('patientvisit');
Route::get('/patientlaborder', [App\Http\Controllers\PatientController::class, 'patientlaborder'])->name('patientlaborder');
Route::delete('/deletepatientdata', [App\Http\Controllers\PatientController::class, 'deletepatientdata'])->name('deletepatientdata');
Route::post('/custommessagesend', [App\Http\Controllers\PatientController::class, 'custommessagesend'])->name('custommessagesend');
Route::get('/patientfilterlist', [App\Http\Controllers\PatientController::class, 'patientfilterlist'])->name('patientfilterlist');



// Doctor
Route::get('/doctorlist', [App\Http\Controllers\DoctorController::class, 'doctorlist'])->name('doctorlist');
Route::get('/doctorview/{id}', [App\Http\Controllers\DoctorController::class, 'doctorview'])->name('doctorview');
Route::get('/doctoradd', [App\Http\Controllers\DoctorController::class, 'doctoradd'])->name('doctoradd');
Route::post('/addDoctor', [App\Http\Controllers\DoctorController::class, 'addDoctor'])->name('addDoctor');
Route::get('/doctoredit/{id}', [App\Http\Controllers\DoctorController::class, 'doctoredit'])->name('doctoredit');
Route::post('/updateDoctor/{id}', [App\Http\Controllers\DoctorController::class, 'updateDoctor'])->name('updateDoctor');
Route::delete('/deletedoctordata', [App\Http\Controllers\DoctorController::class, 'deletedoctordata'])->name('deletedoctordata');

// Claim
Route::get('/claimedit/{id}', [App\Http\Controllers\ClaimController::class, 'claimedit'])->name('claimedit');
Route::get('/claimview/{id}', [App\Http\Controllers\ClaimController::class, 'claimview'])->name('claimview');
Route::delete('/deleteclaimdata', [App\Http\Controllers\ClaimController::class, 'deleteclaimdata'])->name('deleteclaimdata');
Route::get('/claimlist', [App\Http\Controllers\ClaimController::class, 'claimlist'])->name('claimlist');
Route::get('/claimadd', [App\Http\Controllers\ClaimController::class, 'claimadd'])->name('claimadd');
Route::post('/addClaim', [App\Http\Controllers\ClaimController::class, 'addClaim'])->name('addClaim');
Route::post('/updateClaim/{id}', [App\Http\Controllers\ClaimController::class, 'updateClaim'])->name('updateClaim');
Route::get('/claimadd', [App\Http\Controllers\ClaimController::class, 'patientlistShow'])->name('patientlistShow');


//Visit
Route::get('/visitlist', [App\Http\Controllers\VisitController::class, 'visitlist'])->name('visitlist');
Route::post('/addVisit/{id}', [App\Http\Controllers\VisitController::class, 'addVisit'])->name('addVisit');
Route::post('/updateVisit', [App\Http\Controllers\VisitController::class, 'updateVisit'])->name('updateVisit');
Route::get('/getvisitdata', [App\Http\Controllers\VisitController::class, 'getvisitdata'])->name('getvisitdata');
Route::get('/viewvisitdata', [App\Http\Controllers\VisitController::class, 'viewvisitdata'])->name('viewvisitdata');
Route::get('/viewdetailsvisitdata', [App\Http\Controllers\VisitController::class, 'viewdetailsvisitdata'])->name('viewdetailsvisitdata');
Route::delete('/deleteVisitdata', [App\Http\Controllers\VisitController::class, 'deleteVisitdata'])->name('deleteVisitdata');
Route::get('/xrays/{id}', [App\Http\Controllers\VisitController::class, 'xrays'])->name('xrays');
Route::get('/visitsummary/{id}', [App\Http\Controllers\VisitController::class, 'visitsummary'])->name('visitsummary');


//Quote
Route::get('/quotelist', [App\Http\Controllers\QuoteController::class, 'quotelist'])->name('quotelist');
Route::post('/addQuote/{id}', [App\Http\Controllers\QuoteController::class, 'addQuote'])->name('addQuote');
Route::get('/quoteadd', [App\Http\Controllers\QuoteController::class, 'quoteadd'])->name('quoteadd');
Route::post('/addQuotePlan', [App\Http\Controllers\QuoteController::class, 'addQuotePlan'])->name('addQuotePlan');
Route::get('/quoteview/{id}', [App\Http\Controllers\QuoteController::class, 'quoteview'])->name('quoteview');
Route::delete('/deleteQuotedata', [App\Http\Controllers\QuoteController::class, 'deleteQuotedata'])->name('deleteQuotedata');


// Treatment
Route::get('/patienttreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'patienttreatment'])->name('patienttreatment');
Route::get('/editpatienttreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'editpatienttreatment'])->name('editpatienttreatment');
Route::post('/addTreatment', [App\Http\Controllers\TreatmentController::class, 'addTreatment'])->name('addTreatment');
Route::post('/updateTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'updateTreatment'])->name('updateTreatment');
Route::get('/get_treatmentdata', [App\Http\Controllers\TreatmentController::class, 'get_treatmentdata'])->name('get_treatmentdata');
Route::delete('/deletetreatmentdata', [App\Http\Controllers\TreatmentController::class, 'deletetreatmentdata'])->name('deletetreatmentdata');
Route::post('/addQuotePlanTreatment/{id}', [App\Http\Controllers\TreatmentController::class, 'addQuotePlanTreatment'])->name('addQuotePlanTreatment');



// reference Treatmensts
Route::get('/ref_treatments', [App\Http\Controllers\RefTreatmentcontroller::class, 'ref_treatments'])->name('ref_treatments');
Route::post('/addreftreatment', [App\Http\Controllers\RefTreatmentcontroller::class, 'addreftreatment'])->name('addreftreatment');
Route::get('/getreftreatmentdata', [App\Http\Controllers\RefTreatmentcontroller::class, 'getreftreatmentdata'])->name('getreftreatmentdata');
Route::post('/updatereftreatment', [App\Http\Controllers\RefTreatmentcontroller::class, 'updatereftreatment'])->name('updatereftreatment');
Route::delete('/deletereftreatdata', [App\Http\Controllers\RefTreatmentcontroller::class, 'deletereftreatdata'])->name('deletereftreatdata');

//medicines
Route::get('/medicines', [App\Http\Controllers\Medicinescontroller::class, 'medicines'])->name('medicines');
Route::post('/addmedicines', [App\Http\Controllers\Medicinescontroller::class, 'addmedicines'])->name('addmedicines');
Route::post('/addmedicinescategory', [App\Http\Controllers\Medicinescontroller::class, 'addmedicinescategory'])->name('addmedicinescategory');
Route::get('/getmedicinesdata', [App\Http\Controllers\Medicinescontroller::class, 'getmedicinesdata'])->name('getmedicinesdata');
Route::post('/updatemedicines', [App\Http\Controllers\Medicinescontroller::class, 'updatemedicines'])->name('updatemedicines');
Route::delete('/deletemedicinesdata', [App\Http\Controllers\Medicinescontroller::class, 'deletemedicinesdata'])->name('deletemedicinesdata');


// medicine category home
Route::get('/medicategoryhome', [App\Http\Controllers\Medicinescontroller::class, 'medicategoryhome'])->name('medicategoryhome');
Route::get('/getmedicinesCategorydata', [App\Http\Controllers\Medicinescontroller::class, 'getmedicinesCategorydata'])->name('getmedicinesCategorydata');
Route::post('/updatemedicinesCategory', [App\Http\Controllers\Medicinescontroller::class, 'updatemedicinesCategory'])->name('updatemedicinesCategory');
Route::delete('/deleteMedicineCategorydata', [App\Http\Controllers\Medicinescontroller::class, 'deleteMedicineCategorydata'])->name('deleteMedicineCategorydata');


// Prescription
Route::get('/patientprescription/{id}', [App\Http\Controllers\PrescriptionController::class, 'patientprescription'])->name('patientprescription');
Route::post('/saveprescription', [App\Http\Controllers\PrescriptionController::class, 'savePrescription'])->name('saveprescription');
Route::get('/getinfoprescriptiondata', [App\Http\Controllers\PrescriptionController::class, 'getinfoprescriptiondata'])->name('getinfoprescriptiondata');
Route::delete('/deletePrescriptiondata', [App\Http\Controllers\PrescriptionController::class, 'deletePrescriptiondata'])->name('deletePrescriptiondata');
Route::get('/sendPrescription/{id}', [App\Http\Controllers\PrescriptionController::class, 'sendPrescription'])->name('sendPrescription');


// Appointment
Route::get('/appontmentlist', [App\Http\Controllers\Appointmentcontroller::class, 'appontmentlist'])->name('appontmentlist');
Route::post('/addappointment', [App\Http\Controllers\Appointmentcontroller::class, 'addappointment'])->name('addappointment');
Route::get('/getappointmentdata', [App\Http\Controllers\Appointmentcontroller::class, 'getappointmentdata'])->name('getappointmentdata');
Route::post('/updateappointment', [App\Http\Controllers\Appointmentcontroller::class, 'updateappointment'])->name('updateappointment');
Route::delete('/deletappointmentdata', [App\Http\Controllers\Appointmentcontroller::class, 'deletappointmentdata'])->name('deletappointmentdata');
Route::get('/addappontment', [App\Http\Controllers\Appointmentcontroller::class, 'addappontment'])->name('addappontment');
Route::post('/addAppontmentinfo', [App\Http\Controllers\Appointmentcontroller::class, 'addAppontmentinfo'])->name('addAppontmentinfo');
Route::post('/updateAppontmentinfo', [App\Http\Controllers\Appointmentcontroller::class, 'updateAppontmentinfo'])->name('updateAppontmentinfo');
Route::post('/getPatientnumber', [App\Http\Controllers\Appointmentcontroller::class, 'getPatientnumber'])->name('getPatientnumber');
Route::post('/getDoctornumber', [App\Http\Controllers\Appointmentcontroller::class, 'getDoctornumber'])->name('getDoctornumber');
Route::get('/scheduleappointment', [App\Http\Controllers\Appointmentcontroller::class, 'scheduleappointment'])->name('scheduleappointment');
Route::get('/testApi', [App\Http\Controllers\Appointmentcontroller::class, 'testApi'])->name('testApi');
Route::delete('/deleteAppoiement', [App\Http\Controllers\Appointmentcontroller::class, 'deleteAppoiement'])->name('deleteAppoiement');

//User
Route::get('/changepassword', [App\Http\Controllers\UserController::class, 'changepassword'])->name('changepassword');
Route::post('/updatePassword/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('updatePassword');

//Income Report
Route::get('/grossincomereport', [App\Http\Controllers\IncomereportController::class, 'grossincomereport'])->name('grossincomereport');

//Inventory
Route::get('/inventorylist', [App\Http\Controllers\InventoryController::class, 'inventorylist'])->name('inventorylist');
Route::post('/addInventory', [App\Http\Controllers\InventoryController::class, 'addInventory'])->name('addInventory');
Route::post('/addConsultation', [App\Http\Controllers\InventoryController::class, 'addConsultation'])->name('addConsultation');
Route::get('/getinventorydata', [App\Http\Controllers\InventoryController::class, 'getinventorydata'])->name('getinventorydata');
Route::get('/getconsultationdata', [App\Http\Controllers\InventoryController::class, 'getconsultationdata'])->name('getconsultationdata');
Route::post('/updateinventory', [App\Http\Controllers\InventoryController::class, 'updateinventory'])->name('updateinventory');
Route::post('/updateconsultation', [App\Http\Controllers\InventoryController::class, 'updateconsultation'])->name('updateconsultation');
Route::delete('/deleteinventordata', [App\Http\Controllers\InventoryController::class, 'deleteinventordata'])->name('deleteinventordata');


Route::get('/handle', [App\Console\Commands\SendMessage::class, 'handle'])->name('handle');

Route::get('/download', 'App\Http\Controllers\DatabaseController@download')->name('download');

// Consent
Route::get('/consentform', [App\Http\Controllers\ConsentController::class, 'consentform'])->name('consentform');
Route::get('/consentformview', [App\Http\Controllers\ConsentController::class, 'consentformview'])->name('consentformview');
Route::get('/consentformadd', [App\Http\Controllers\ConsentController::class, 'consentformadd'])->name('consentformadd');
Route::get('/consentformedit', [App\Http\Controllers\ConsentController::class, 'consentformedit'])->name('consentformedit');
Route::post('/addConsent', [App\Http\Controllers\ConsentController::class, 'addConsent'])->name('addConsent');
Route::delete('/deleteconsentdata', [App\Http\Controllers\ConsentController::class, 'deleteconsentdata'])->name('deleteconsentdata');
Route::get('/consentview/{id}', [App\Http\Controllers\ConsentController::class, 'consentview'])->name('consentview');
Route::get('/consentedit/{id}', [App\Http\Controllers\ConsentController::class, 'consentedit'])->name('consentedit');
Route::post('/updateConsent/{id}', [App\Http\Controllers\ConsentController::class, 'updateConsent'])->name('updateConsent');
Route::get('/consentformadd/{id}', [App\Http\Controllers\ConsentController::class, 'PatientlistConsentShow'])->name('PatientlistConsentShow');
Route::get('/fetchPatientData', [App\Http\Controllers\ConsentController::class, 'fetchPatientData'])->name('fetchPatientData');
Route::get('/sendConsent/{id}', [App\Http\Controllers\ConsentController::class, 'sendConsent'])->name('sendConsent');


// Account
Route::get('/accountlist', [App\Http\Controllers\AccountController::class, 'accountlist'])->name('accountlist');
Route::get('/accountview/{id}', [App\Http\Controllers\AccountController::class, 'accountview'])->name('accountview');
Route::delete('/deleteaccountdata', [App\Http\Controllers\AccountController::class, 'deleteaccountdata'])->name('deleteaccountdata');

//Billing
Route::get('/billing', [App\Http\Controllers\BillingController::class, 'billing'])->name('billing');
Route::get('/sendBilling/{id}', [App\Http\Controllers\BillingController::class, 'sendBilling'])->name('sendBilling');


Route::get('/gettreatdata/{Id}', [App\Http\Controllers\PatientController::class, 'gettreatdata'])->name('gettreatdata');
//Lab Note
Route::post('/addLabNote', [App\Http\Controllers\LabNoteController::class, 'addLabNote'])->name('addLabNote');
Route::post('/addprintLabNote', [App\Http\Controllers\LabNoteController::class, 'addprintLabNote'])->name('addprintLabNote');
Route::post('/downloadLabNote', [App\Http\Controllers\LabNoteController::class, 'downloadLabNote'])->name('downloadLabNote');
Route::get('/labnoteadd', [App\Http\Controllers\LabNoteController::class, 'labnoteadd'])->name('labnoteadd');
Route::get('/labnoteadding/{id}', [App\Http\Controllers\LabNoteController::class, 'labnoteadd']);
Route::get('/labnotelist', [App\Http\Controllers\LabNoteController::class, 'labnotelist'])->name('labnotelist');
Route::get('/labnoteview/{id}', [App\Http\Controllers\LabNoteController::class, 'labnoteview'])->name('labnoteview');
Route::get('/labenotedit/{id}', [App\Http\Controllers\LabNoteController::class, 'labenotedit'])->name('labenotedit');
Route::get('/receptionistedit/{id}', [App\Http\Controllers\LabNoteController::class, 'receptionistedit'])->name('receptionistedit');
Route::post('/updateLabnote/{id}', [App\Http\Controllers\LabNoteController::class, 'updateLabnote'])->name('updateLabnote');
Route::post('/updateReceptionist/{id}', [App\Http\Controllers\LabNoteController::class, 'updateReceptionist'])->name('updateReceptionist');
Route::delete('/deletelabnotedata', [App\Http\Controllers\LabNoteController::class, 'deletelabnotedata'])->name('deletelabnotedata');
Route::get('/generatePDF/{id}', [App\Http\Controllers\LabNoteController::class, 'generatePDF'])->name('generatePDF');


// add TOW
Route::get('/TOWlist', [App\Http\Controllers\TowController::class, 'TOWlist'])->name('TOWlist');
Route::get('/TOWadd', [App\Http\Controllers\TowController::class, 'TOWadd'])->name('TOWadd');
Route::delete('/deleteTOWlistdata', [App\Http\Controllers\TowController::class, 'TOWdelete'])->name('TOWdelete');
Route::post('/addTOW', [App\Http\Controllers\TowController::class, 'addTOW'])->name('addTOW');
Route::get('/TOWview/{id}', [App\Http\Controllers\TowController::class, 'TOWview'])->name('TOWview');
Route::get('/TOWedit/{id}', [App\Http\Controllers\TowController::class, 'TOWedit'])->name('TOWedit');
Route::post('/updateTOW/{id}', [App\Http\Controllers\TowController::class, 'updateTOW'])->name('updateTOW');

// note
Route::get('/notelist', [App\Http\Controllers\NoteController::class, 'notelist'])->name('notelist');
Route::get('/noteadd', [App\Http\Controllers\NoteController::class, 'noteadd'])->name('noteadd');
Route::post('/addNote', [App\Http\Controllers\NoteController::class, 'addNote'])->name('addNote');
Route::delete('/deletenotedata', [App\Http\Controllers\NoteController::class, 'deletenotedata'])->name('deletenotedata');
Route::get('/noteview/{id}', [App\Http\Controllers\NoteController::class, 'noteview'])->name('noteview');
Route::get('/noteedit/{id}', [App\Http\Controllers\NoteController::class, 'noteedit'])->name('noteedit');
Route::post('/updateNote/{id}', [App\Http\Controllers\NoteController::class, 'updateNote'])->name('updateNote');

// add lab
Route::get('/lablist', [App\Http\Controllers\LabController::class, 'list'])->name('list');
Route::get('/labadd', [App\Http\Controllers\LabController::class, 'labadd'])->name('labadd');
Route::delete('/deletelabdata', [App\Http\Controllers\LabController::class, 'delete'])->name('delete');
Route::post('/addLab', [App\Http\Controllers\LabController::class, 'addLab'])->name('addLab');
Route::get('/labview/{id}', [App\Http\Controllers\LabController::class, 'labview'])->name('labview');
Route::get('/labedit/{id}', [App\Http\Controllers\LabController::class, 'labedit'])->name('labedit');
Route::post('/updateLab/{id}', [App\Http\Controllers\LabController::class, 'updateLab'])->name('updateLab');


// report
Route::get('/report', [App\Http\Controllers\HomeController::class, 'report'])->name('report');

Route::get('/labreportfilterlist', [App\Http\Controllers\HomeController::class, 'labreportfilterlist'])->name('labreportfilterlist');

// Route::get('/billing', function () {
//     return view('billing/billing');
// });


// Shades
Route::get('/shadelist',[App\Http\Controllers\ShadeController::class,'shadelist'])->name('shadelist');
Route::get('/shadeadd',function(){
    return view('shades/shadeadd');
});
Route::post('/addShade', [App\Http\Controllers\ShadeController::class, 'addShade'])->name('addShade');
Route::get('/shadeview/{id}', [App\Http\Controllers\ShadeController::class, 'shadeview'])->name('shadeview');
Route::get('/shadeedit/{id}', [App\Http\Controllers\ShadeController::class, 'shadeedit'])->name('shadeedit');
Route::post('/updateShade/{id}', [App\Http\Controllers\ShadeController::class, 'updateShade'])->name('updateShade');
Route::delete('/deleteshadedata', [App\Http\Controllers\ShadeController::class, 'deleteshadedata'])->name('deleteshadedata');

// users list
Route::get('/userslist', [App\Http\Controllers\UserController::class, 'userslist'])->name('userslist');
Route::get('/userAdd', [App\Http\Controllers\UserController::class, 'userAdd'])->name('userAdd');
Route::post('/adduser', [App\Http\Controllers\UserController::class, 'adduser'])->name('adduser');
Route::delete('/deleteuserslist', [App\Http\Controllers\UserController::class, 'deleteuserslist'])->name('deleteuserslist');
Route::get('/userslistedit/{id}', [App\Http\Controllers\UserController::class, 'edituserslist'])->name('edituserslist');

// Plan
Route::get('/planlist', [App\Http\Controllers\PlanController::class, 'planlist'])->name('planlist');
Route::get('/planview/{id}', [App\Http\Controllers\PlanController::class, 'planview'])->name('planview');
Route::get('/planadd', [App\Http\Controllers\PlanController::class, 'planadd'])->name('planadd');
Route::post('/addPlan', [App\Http\Controllers\PlanController::class, 'addPlan'])->name('addPlan');
Route::get('/planedit/{id}', [App\Http\Controllers\PlanController::class, 'planedit'])->name('planedit');
Route::post('/updatePlan/{id}', [App\Http\Controllers\PlanController::class, 'updatePlan'])->name('updatePlan');
Route::delete('/deleteplandata', [App\Http\Controllers\PlanController::class, 'deleteplandata'])->name('deleteplandata');

// concent master
Route::get('/consentmasterlist', [App\Http\Controllers\ConsentController::class, 'consentmasterlist'])->name('consentmasterlist');
Route::get('/consentmasteradd', function () {
    return view('ConsentMaster/consentmasteradd');
});
Route::post('/addconsentmaster', [App\Http\Controllers\ConsentController::class, 'addconsentmaster'])->name('addconsentmaster');
Route::get('/consentmasterview/{id}', [App\Http\Controllers\ConsentController::class, 'consentmasterview'])->name('consentmasterview');
Route::get('/consentmasteredit/{id}', [App\Http\Controllers\ConsentController::class, 'consentmasteredit'])->name('consentmasteredit');
Route::post('/updateconsentmaster/{id}', [App\Http\Controllers\ConsentController::class, 'updateconsentmaster'])->name('updateconsentmaster');
Route::delete('/deleteconsentmaster', [App\Http\Controllers\ConsentController::class, 'deleteconsentmaster'])->name('deleteconsentmaster');
Route::get('/fetchconcentData', [App\Http\Controllers\ConsentController::class, 'fetchconcentData'])->name('fetchconcentData');

//Patient Report
Route::get('/patientreport', [App\Http\Controllers\PatientreportController::class, 'patientreport'])->name('patientreport');
Route::get('/patientviewreport/{id}', [App\Http\Controllers\PatientreportController::class, 'patientviewreport'])->name('patientviewreport');
