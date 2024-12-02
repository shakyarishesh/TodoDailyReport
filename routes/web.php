<?php

use App\Http\Controllers\Auth\SocialAuthentication;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');


//register
Route::view('/register','register')->name('register');
//register post
Route::post('/registerPost',[RegistrationController::class,'register']);


//login
// Route::view('/login','login');
//login post
Route::post('/loginPost',[RegistrationController::class,'login']);
Route::post('/logout', [RegistrationController::class, 'logout'])->name('logout');

/*
* Google
*/
Route::get('/google', [SocialAuthentication::class, 'google'])->name('google');
Route::get('/google-callback', [SocialAuthentication::class, 'googleResponse'])->name('google.callback');


//for lists
Route::view('/list','lists')->name('list')->middleware('auth');

//for reports
Route::view('/report','dailyreport');
//report post
Route::post('/reportPost',[ReportController::class,'reportPost']);

//profile
// Route::view('/profile', 'profile');
Route::get('/profile',[ReportController::class,'reportGet']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
