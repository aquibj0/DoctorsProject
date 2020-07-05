<?php

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


Auth::routes();

Route::get('/', 'AppController@index');


Route::post('/register-user', 'Auth\RegisterController@create_user')->name('register_user');
Route::post('/login-user', "Auth\LoginController@login_user")->name('login_user');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
// Route
Route::get('/doctor/ask-a-doctor', 'AskDoctorController@doctor_index');
Route::get('/doctor/ask-a-doctor/{id}', 'AskDoctorController@doctor_show');
Route::post('/doctor/ask-a-doctor/{id}/response', 'AskDoctorController@doctor_respones')->name('ask_a_doctor.response');
Route::get('/ask-a-doctor/{id}', 'AskDoctorController@index');
Route::post('/ask-a-doctor/store', 'AskDoctorController@store')->name('ask_a_doctor.store');

Route::get('/video-consultation', 'VideoConsultationController@index');
Route::get('/clinic-appointment', 'ClinicAppointmentController@index');

// Route::post('/register-user', 'Auth\RegisterController@create_user')->name('register_user');
// Route::post('/login-user', "Auth\LoginController@login_user")->name('login_user');


Route::get('/home', 'HomeController@index')->name('home');
//patients route
Route::get('/user-patients/create', 'PatientController@create');
Route::get('/user-patients/{service}', 'PatientController@index');
// Route::get('/user-patients/create', 'PatientController@create');


 
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/service-request/{id}', 'UserController@userServiceRequest');
Route::get('/service-request/{id}/{srId}', 'UserController@serviceRequestDetail');


Route::get('/service-booking/{srvdID}', 'AskDoctorController@serviceBooking')->name('confirm-service-request');
// Route::get('product', 'RazorpayController@index'); 

Route::post('/payment-inititate-request', 'PaymentController@Initiate');


Route::post('razor-thank-you', 'PaymentController@thankYou');
// Route::post('/change-user-to-internal', 'AppController@internal_user');



// Clinic Apoointment
Route::get('/clinic-appointment', 'ClinicAppointmentController@index');
Route::get('/admin', 'AdminAppController@index');


    //
});


// Route::get('product', 'RazorpayController@index');
// Route::post('paysuccess', 'RazorpayController@paysuccess');
// Route::post('razor-thank-you', 'RazorpayController@thankYou');


Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::get('dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::get('register', 'Admin\AdminController@create')->name('admin.register');
    Route::post('register', 'Admin\AdminController@store')->name('admin.register.store');
    Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
    Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
    Route::get('/create/internal-user', 'Admin\AdminController@create_user');
    Route::post('/create/internal-user/store', 'Admin\AdminController@store_user')->name('admin.register.user.store');
    Route::get('/service-request/{id}', 'Admin\ServiceRequestController@show');
    Route::post('/ask-a-doctor/{id}/response', 'Admin\ServiceRequestController@response');
  });