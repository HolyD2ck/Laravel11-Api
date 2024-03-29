<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicants extends Model
{
    use HasFactory;
    protected $table ='applicants';
    protected $fillable = ['Фамилия','Имя','Отчество','Образование','Специальность','Дата_Рождения','Телефон','Email','Фото'];
}
