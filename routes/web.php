<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


//front end rute start
Route::get('/', function () {
    return view('frontend.index');
})->name('website');

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

    //Supplier route start
    Route::resource('supplier', 'Admin\Supplier\SupplierController');
    Route::get('/supplier/soft-delete/{id}', 'Admin\Supplier\SupplierController@softDelete')->name('supplier_soft_delete');
    Route::get('/supplier/restore/{id}', 'Admin\Supplier\SupplierController@restore')->name('restore');
    Route::get('/supplier/force-delete/{id}', 'Admin\Supplier\SupplierController@forceDelete')->name('forceDelete');
    Route::get('/supplier/inactive/suppliers', 'Admin\Supplier\SupplierController@inactive')->name('inactive');
});
