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



Route::get('/', 'AppController@index');

Route::get('/ask-a-doctor', 'AskDoctorController@index');
Route::post('/ask-a-doctor/store', 'AskDoctorController@store')->name('ask_a_doctor.store');
Route::get('/video-consultation', 'VideoConsultationController@index');
Route::get('/clinic-appointment', 'ClinicAppointmentController@index');

Route::post('/register-user', 'Auth\RegisterController@create_user')->name('register_user');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
