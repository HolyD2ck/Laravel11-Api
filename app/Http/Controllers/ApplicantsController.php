<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicants;
class ApplicantsController extends Controller
{
    public function index()
    {
        $applicant = Applicants::all();
        return response()->json($applicant);
    }
}
