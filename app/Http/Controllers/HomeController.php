<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $dados = [];
        
        return view('home', $dados);
    }
}
