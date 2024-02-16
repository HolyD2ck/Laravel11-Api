<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\EmployersController;
use App\Models\Employers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpWord\IOFactory;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/employers/export', function () {
    return view('employers/export');
});
Route::get('/employers/export2', function () {
    return view('employers/export2');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('applicants', ApplicantsController::class);
Route::resource('employers', EmployersController::class);

Route::get('employers/export', [EmployersController::class, 'export']);
Route::get('employers/export2', [EmployersController::class, 'export2']);


