<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return view('welcome', compact('majors'));
    }
}
