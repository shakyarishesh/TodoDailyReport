<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});


//register
Route::view('/register','register');
//register post
Route::post('/registerPost',[RegistrationController::class,'register']);


//login
// Route::view('/login','login');
//login post
Route::post('/loginPost',[RegistrationController::class,'login']);

//for lists
Route::view('/list','lists');

//for reports
Route::view('/report','dailyreport');
//report post
Route::post('/reportPost',[ReportController::class,'reportPost']);
