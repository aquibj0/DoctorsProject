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

// Route
Route::get('/doctor/ask-a-doctor', 'AskDoctorController@doctor_index');
Route::get('/doctor/ask-a-doctor/{id}', 'AskDoctorController@doctor_show');
Route::post('/doctor/ask-a-doctor/{id}/response', 'AskDoctorController@doctor_respones')->name('ask_a_doctor.response');
Route::get('/ask-a-doctor', 'AskDoctorController@index');
Route::post('/ask-a-doctor/store', 'AskDoctorController@store')->name('ask_a_doctor.store');

Route::get('/video-consultation', 'VideoConsultationController@index');
Route::get('/clinic-appointment', 'ClinicAppointmentController@index');

Route::post('/register-user', 'Auth\RegisterController@create_user')->name('register_user');
Route::post('/login-user', "Auth\LoginController@login_user")->name('login_user');
<<<<<<< HEAD
=======
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
>>>>>>> 3122faee19de4bf26df658b4ce884b1446a8cbf3



 
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/service-request/{id}', 'UserController@userServiceRequest');
Route::get('/service-request/{id}/{srId}', 'UserController@serviceRequestDetail');

<<<<<<< HEAD

Route::get('/service-booking/{srvdID}', 'AskDoctorController@serviceBooking')->name('confirm-service-request');
// Route::get('product', 'RazorpayController@index'); 

Route::post('/payment-inititate-request', 'PaymentController@Initiate');


Route::post('razor-thank-you', 'PaymentController@thankYou');
// Route::post('/change-user-to-internal', 'AppController@internal_user');



// Clinic Apoointment
Route::get('/clinic-appointment', 'ClinicAppointmentController@index');
=======
Route::post('/change-user-to-internal', 'AppController@internal_user');
>>>>>>> 3122faee19de4bf26df658b4ce884b1446a8cbf3
