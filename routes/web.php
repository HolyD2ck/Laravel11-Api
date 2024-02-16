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

Route::get('employers/export',function () {

    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $employers = Employers::all();

    $sheet->setCellValue('A1', 'Номер');
    $sheet->setCellValue('B1', 'Фамилия');
    $sheet->setCellValue('C1', 'Имя');
    $sheet->setCellValue('D1', 'Отчество');
    $sheet->setCellValue('E1', 'Организация');
    $sheet->setCellValue('F1', 'Дата Основания');
    $sheet->setCellValue('G1', 'Вакансия');
    $sheet->setCellValue('H1', 'Телефон');
    $sheet->setCellValue('I1', 'Email');

    $employers =Employers::all();
    $number=2;
    foreach ($employers as $employer) {
    $sheet->setCellValue('A'.$number, $employer->id);
    $sheet->setCellValue('B'.$number, $employer->Фамилия);
    $sheet->setCellValue('C'.$number, $employer->Имя);
    $sheet->setCellValue('D'.$number, $employer->Отчество);
    $sheet->setCellValue('E'.$number, $employer->Организация);
    $sheet->setCellValue('F'.$number, $employer->Дата_Основания);
    $sheet->setCellValue('G'.$number, $employer->Вакансия);
    $sheet->setCellValue('H'.$number, $employer->Телефон);
    $sheet->setCellValue('I'.$number, $employer->Email);
    $number++;
    }
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="myfile.xlsx"');
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet,'Xlsx');       
    $writer->save('php://output');
});
Route::get('employers/export2',function () {
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    
    $section = $phpWord->addSection();
   

    $data = Employers::all();

    foreach($data as $row) {
        $text = '';
        $attributes = $row->getAttributes();
        $attributes = collect($attributes)->except('Фото')->toArray();
        foreach($attributes as $cell) {
            $text .= $cell . ' ';
        }
        $section->addText(rtrim($text));
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="myfile.docx"');

    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('php://output');
});

