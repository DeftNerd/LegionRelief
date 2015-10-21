<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Legionnaire;

class WelcomeController extends Controller
{

    public function index()
    {
        $legionnaires = Legionnaire::orderBy('created_at', 'desc')->paginate(20);
        return view('welcome.index')->with('legionnaires', $legionnaires);
    }

}
