<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class Home extends Controller
{
    //


    public function home () :View {

        return View('Home');
    } 
}
