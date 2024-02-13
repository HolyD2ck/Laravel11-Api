<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employers extends Model
{
    use HasFactory;
    protected $table ='employers';
    protected $fillable = ['Фамилия','Имя','Отчество','Организация','Дата_Основания','Вакансия','Телефон','Email','Фото'];
}
