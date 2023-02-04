<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('/signup', [RegisterController::class, 'create2']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth.basic'])->group(function () {
    // Your protected routes here
Route::post('/login', [LoginController::class, 'signin']);

});
Route::middleware(['auth.basic', 'PatientApi'])->group(function () {
    // Your protected routes here
Route::get('/specialite','SpecialiteController@getSpec');
Route::get('/available/doctors', 'FrontendController@availableDoctors');
Route::post('/find/doctors', 'FrontendController@findDoctors');
Route::get('/doctor/{id}', 'FrontendController@DoctorDates');
Route::post('/booking', 'FrontendController@Booking');
Route::get('/mybookings/{id}', 'FrontendController@UserBooking');
Route::get('/doctors', 'DoctorController@GetAllDoctors');
Route::get('/get/patient/{id}', 'PatientController@findPatient');
Route::put('/update/patient/{id}', 'ProfileController@storeapi');
Route::put('/update/avatar', 'ProfileController@updateAvatarapi');
Route::get('/prescription/{id_appointment}/{doctor_id}', 'PrescriptionController@showapi');
Route::get('/review/{id}/{review}', 'ProfileController@review');
Route::get('/messages', 'ChatController@index');
Route::post('/send-message', 'ChatController@triggerEvent');
Route::get('messages/doctor/{doctor_id}/patient/{patient_id}', 'ChatsController_Web@GetMessageByDoctor_Patient');
});
//Route::get('/specialite','SpecialiteController@getSpec');

