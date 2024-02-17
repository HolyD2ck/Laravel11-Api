<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpWord\IOFactory;
class EmployersController extends Controller
{
  
    public function index()
    {
        $employer = Employers::all();
        return response()->json($employer)->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET');
        
    }
    public function show($id)
    {
        $employer = Employers::find($id);
        return response()->json($employer)->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET');
        
    }
    public function store(Request $request){

        $employer = new Employers;
        $employer->Фамилия =$request->Фамилия;
        $employer->Имя =$request->Имя;
        $employer->Отчество =$request->Отчество;
        $employer->Организация =$request->Организация;
        $employer->Дата_Основания =$request->Дата_Основания;
        $employer->Вакансия =$request->Вакансия;
        $employer->Телефон =$request->Телефон;
        $employer->Email =$request->Email;
        $employer->Фото =$request->Фото;
        $employer->save();
        return response()->json([
            "message"=>"Работодатель добавлен."
        ],201); 

    }
    public function export(){
         
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
    }
    public function export2(){
        
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
      
       

    }
}
