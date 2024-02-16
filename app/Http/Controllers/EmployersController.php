<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
    
}
