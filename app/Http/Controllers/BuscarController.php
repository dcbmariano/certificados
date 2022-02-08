<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudante;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FuncoesController as f;

class BuscarController extends Controller
{
    public function index(){

        $dados = [];
        $dados['encontrado'] = true; // no primeiro acesso deve estar true

        return view('buscar', $dados);
    }        

    public function listar_certificados(Request $request){
       
        $request->validate([ '_answer' => 'required | simple_captcha' ]);

        $email = $request->input('email');
        $data_nascimento = $request->input('data_nascimento');

        // busca primeiro o id do usuario
        $usuario = Estudante::get()->where('email', $email)->where('data_nascimento', $data_nascimento)->first();
        $dados['usuario'] = $usuario;

        if(empty($usuario)){
            $dados['encontrado'] = false;

            return view('buscar', $dados); 
        }
        else{
            $dados['encontrado'] = true;
        }

        $id_usuario = $usuario->id;

        $certificado = DB::table('certificados')
        ->join('eventos','eventos.id','=','certificados.id_curso')            
         ->select(
             'certificados.codigo_certificado',
             'eventos.nome as nome_evento', 'eventos.carga_horaria', 
             'certificados.created_at as data_emissao'
             )
        ->where('id_usuario', $id_usuario)->get();

        foreach($certificado as $i){
            $i->data_emissao = f::formataData($i->data_emissao);
        }

        $dados['certificado'] = $certificado;

        return view('resultado_busca', $dados); 
    }
}
