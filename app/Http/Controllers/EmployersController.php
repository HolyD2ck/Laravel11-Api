<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employers;
class EmployersController extends Controller
{
    public function index()
    {
        $employer = Employers::all();
        return response()->json($employer);
    }
    
}
