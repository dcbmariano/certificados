<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Evento;
use App\Models\Estudante;

use Illuminate\Http\Request;
use DataTables;

class RestritoController extends Controller
{
    public function index(){

        $dados = [];

        $dados['cursos'] = Evento::all();
        
        return view('restrito', $dados);

        // $estudantes = Estudante::select();
        // print_r($estudantes);
        // exit();
    }

    public function estudantesAjax(){
        $estudantes = Estudante::select();
        
        return DataTables::of($estudantes)->make(true);
    }

}
