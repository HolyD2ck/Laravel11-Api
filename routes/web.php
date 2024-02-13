<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\EmployersController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('applicants', ApplicantsController::class);
Route::resource('employers', EmployersController::class);