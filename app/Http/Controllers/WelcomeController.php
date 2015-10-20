<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tip;

class WelcomeController extends Controller
{

    public function index()
    {
        $tips = Tip::orderBy('created_at', 'desc')->paginate(20);
        return view('welcome.index')->with('tips', $tips);
    }

}
