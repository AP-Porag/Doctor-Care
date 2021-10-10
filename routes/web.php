<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


//front end rute start
Route::get('/', 'IndexPageController@index')->name('website');
Route::post('/taking-appointment', 'IndexPageController@takingAppointment')->name('taking-appointment');

Auth::routes();
// Auth::routes(['verify' => true]);

//backend route start
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    //User maneging start
    Route::resource('user', 'Admin\User\UsersController');
    Route::get('/user/soft-delete/{id}', 'Admin\User\UsersController@softDelete')->name('user_soft_delete');
    Route::get('/user/restore/{id}', 'Admin\User\UsersController@restore')->name('restore_user');
    Route::get('/user/force-delete/{id}', 'Admin\User\UsersController@forceDelete')->name('forceDelete_user');
    Route::get('/user/inactive/user', 'Admin\User\UsersController@inactive')->name('inactive_users');

    //assign role to user
    Route::get('/user/assignRolePageView/{id}', 'Admin\User\UsersController@assignRolePageView')->name('assignRolePageView');
    Route::post('/user/assignRole/{id}', 'Admin\User\UsersController@assignRole')->name('assignRole');

    //assign permission to user
    Route::get('/user/assignPermissionPageView/{id}', 'Admin\User\UsersController@assignPermissionPageView')->name('assignPermissionPageView');
    Route::post('/user/assignPermission/{id}', 'Admin\User\UsersController@assignPermission')->name('assignPermission');

    //Role Route start
    Route::resource('role', 'Admin\Role\RolesController');
    Route::get('/role/soft-delete/{id}', 'Admin\Role\RolesController@softDelete')->name('role_soft_delete');
    Route::get('/role/restore/{id}', 'Admin\Role\RolesController@restore')->name('restore_role');
    Route::get('/role/force-delete/{id}', 'Admin\Role\RolesController@forceDelete')->name('forceDelete_role');
    Route::get('/role/inactive/role', 'Admin\Role\RolesController@inactive')->name('inactive_roles');

    //Permission Route start
    Route::resource('permission', 'Admin\Permission\PermissionController');
    Route::get('/permission/soft-delete/{id}', 'Admin\Permission\PermissionController@softDelete')->name('permission_soft_delete');
    Route::get('/permission/restore/{id}', 'Admin\Permission\PermissionController@restore')->name('restore_permission');
    Route::get('/permission/force-delete/{id}', 'Admin\Permission\PermissionController@forceDelete')->name('forceDelete_permission');
    Route::get('/permission/inactive/permission', 'Admin\Permission\PermissionController@inactive')->name('inactive_permission');
    Route::post('/permission/group/store', 'Admin\Permission\PermissionController@store_group')->name('store_group');

    //Doctor route start
    Route::resource('doctor', 'Admin\Doctor\DoctorController');
    Route::get('/doctor/soft-delete/{id}', 'Admin\Doctor\DoctorController@softDelete')->name('doctor_soft_delete');
    Route::get('/doctor/restore/{id}', 'Admin\Doctor\DoctorController@restore')->name('restore_doctor');
    Route::get('/doctor/force-delete/{id}', 'Admin\Doctor\DoctorController@forceDelete')->name('forceDelete_doctor');
    Route::get('/doctor/inactive/doctors', 'Admin\Doctor\DoctorController@inactive')->name('inactive_doctors');

    //Schedule route start
    Route::resource('schedule', 'Admin\Schedule\ScheduleController');
    Route::get('/schedule/soft-delete/{id}', 'Admin\Schedule\ScheduleController@softDelete')->name('schedule_soft_delete');
    Route::get('/schedule/restore/{id}', 'Admin\Schedule\ScheduleController@restore')->name('restore_schedule');
    Route::get('/doctor/force-delete/{id}', 'Admin\Schedule\ScheduleController@forceDelete')->name('forceDelete_schedule');
    Route::get('/schedule/inactive/schedules', 'Admin\Schedule\ScheduleController@inactive')->name('inactive_schedules');


    //Patient route start
    Route::resource('patient', 'Admin\Patient\PatientController');
    Route::get('/patient/soft-delete/{id}', 'Admin\Patient\PatientController@softDelete')->name('patient_soft_delete');
    Route::get('/patient/restore/{id}', 'Admin\Patient\PatientController@restore')->name('restore_patient');
    Route::get('/patient/force-delete/{id}', 'Admin\Patient\PatientController@forceDelete')->name('forceDelete_patient');
    Route::get('/patient/inactive/patients', 'Admin\Patient\PatientController@inactive')->name('inactive_patients');
    Route::get('/patient/inactive/findPrice', 'Admin\Patient\PatientController@findPrice')->name('findPrice');

    //Appointment route start
    Route::resource('appointment', 'Admin\Appointment\AppointmentsController');
    Route::get('/appointment/soft-delete/{id}', 'Admin\Appointment\AppointmentsController@softDelete')->name('appointment_soft_delete');
    Route::get('/appointment/restore/{id}', 'Admin\Appointment\AppointmentsController@restore')->name('restore_appointment');
    Route::get('/appointment/force-delete/{id}', 'Admin\Appointment\AppointmentsController@forceDelete')->name('forceDelete_appointment');
    Route::get('/appointment/inactive/appointment', 'Admin\Appointment\AppointmentsController@inactive')->name('inactive_appointments');
    Route::get('/appointment/paymentView/{id}', 'Admin\Appointment\AppointmentsController@paymentView')->name('appointment_paymentView');
    Route::get('/appointment/confirmation/{id}', 'Admin\Appointment\AppointmentsController@confirmation')->name('confirmation_appointment');
    Route::get('/appointment/add/add-patient', 'Admin\Appointment\AppointmentsController@addPatientView')->name('addPatientView');
    Route::post('/appointment/add/store-patient', 'Admin\Appointment\AppointmentsController@storePatient')->name('storePatient');
    Route::get('/appointment/appointments/{id}', 'Admin\Appointment\AppointmentsController@appointments')->name('appointments');

    //Prescription Route start
    Route::resource('prescription', 'Admin\Prescription\PrescriptionController');
    Route::get('/prescription/soft-delete/{id}', 'Admin\Prescription\PrescriptionController@softDelete')->name('prescription_soft_delete');
    Route::get('/prescription/restore/{id}', 'Admin\Prescription\PrescriptionController@restore')->name('restore_prescription');
    Route::get('/prescription/force-delete/{id}', 'Admin\Prescription\PrescriptionController@forceDelete')->name('forceDelete_prescription');
    Route::get('/prescription/inactive/prescription', 'Admin\Prescription\PrescriptionController@inactive')->name('inactive_prescription');

    //Lab test route start
    Route::resource('lab', 'Admin\Lab\LabController');
    Route::get('/lab/soft-delete/{id}', 'Admin\Lab\LabController@softDelete')->name('lab_soft_delete');
    Route::get('/lab/restore/{id}', 'Admin\Lab\LabController@restore')->name('lab_patient');
    Route::get('/lab/force-delete/{id}', 'Admin\Lab\LabController@forceDelete')->name('forceDelete_lab');
    Route::get('/lab/inactive/patients', 'Admin\Lab\LabController@inactive')->name('inactive_labs');
    Route::get('/lab/make-report/view', 'Admin\Lab\LabController@makeLabReport')->name('makeLabReport');
    Route::get('/lab/make-report/findTemplate', 'Admin\Lab\LabController@findTemplate')->name('findTemplate');
    Route::post('/lab/make-report/saveLabReport', 'Admin\Lab\LabController@saveLabReport')->name('saveLabReport');
    Route::get('/lab/all-report/view', 'Admin\Lab\LabController@allLabReports')->name('allLabReports');

    //Medicine Route start
    Route::resource('medicine', 'Admin\Medicine\MedicineController');
    Route::get('/medicine/soft-delete/{id}', 'Admin\Medicine\MedicineController@softDelete')->name('medicine_soft_delete');
    Route::get('/medicine/restore/{id}', 'Admin\Medicine\MedicineController@restore')->name('restore_medicine');
    Route::get('/medicine/force-delete/{id}', 'Admin\Medicine\MedicineController@forceDelete')->name('forceDelete_medicine');
    Route::get('/medicine/inactive/permission', 'Admin\Medicine\MedicineController@inactive')->name('inactive_medicine');
    Route::post('/medicine/generic/store', 'Admin\Medicine\MedicineController@store_generic')->name('store_generic');

    //Pharmacy Route start
    Route::resource('sale', 'Admin\Sale\SaleController');
    Route::get('/sale/soft-delete/{id}', 'Admin\Sale\SaleController@softDelete')->name('sale_soft_delete');
    Route::get('/sale/restore/{id}', 'Admin\Sale\SaleController@restore')->name('restore_sale');
    Route::get('/sale/force-delete/{id}', 'Admin\Sale\SaleController@forceDelete')->name('forceDelete_sale');
    Route::get('/sale/inactive/permission', 'Admin\Sale\SaleController@inactive')->name('inactive_sale');
    Route::get('/sale/medicine/search', 'Admin\Sale\SaleController@search')->name('search_medicine');
    Route::get('/sale/medicine/stock', 'Admin\Sale\SaleController@stock')->name('stock');

    //Purchase Route start
    Route::resource('purchase', 'Admin\Purchase\PurchaseController');
    Route::get('/purchase/request/{id}', 'Admin\Purchase\PurchaseController@purchaseRequest')->name('purchaseRequest');
    Route::get('/purchase/purchaseRequest/view', 'Admin\Purchase\PurchaseController@purchaseRequestView')->name('purchaseRequestView');
    Route::post('/purchase/medicine/createView', 'Admin\Purchase\PurchaseController@createView')->name('pr_createView');
    Route::get('/purchase/force-delete/{id}', 'Admin\Purchase\PurchaseController@purchaseRequestForceDelete')->name('purchaseRequestForceDelete');

    //Purchase Route start
    Route::resource('stock', 'Admin\Stock\StockController');
    Route::post('/stock/add/stock', 'Admin\Stock\StockController@addStock')->name('addStock');

    //Company route start
    Route::resource('company', 'Admin\Company\CompanyController');
    Route::get('/company/soft-delete/{id}', 'Admin\Company\CompanyController@softDelete')->name('company_soft_delete');
    Route::get('/company/restore/{id}', 'Admin\Company\CompanyController@restore')->name('restore');
    Route::get('/company/force-delete/{id}', 'Admin\Company\CompanyController@forceDelete')->name('forceDelete');
    Route::get('/company/inactive/companies', 'Admin\Company\CompanyController@inactive')->name('inactive');
});
