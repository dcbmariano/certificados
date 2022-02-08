<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Evento;
use App\Models\Estudante;
use App\Models\Certificado;
use App\Http\Controllers\FuncoesController as f;

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

    // EVENTO

    public function gravar_evento(Request $request){

        $eventos = new Evento; // instancia o modelo q conecta ao banco
        $eventos->nome = $request->nome_evento; // vincula input ao campo no banco
        $eventos->tipo = $request->tipo_evento;
        $eventos->carga_horaria = $request->carga_horaria;        
        $eventos->data = $request->data_evento;
        $eventos->codigo_evento = $request->codigo_evento;

        // grava no banco de dados
        $eventos->save();

        return redirect('/restrito')->with('mensagem', 'Dados gravados com sucesso');

    }

    public function deletar_evento($id){

        Evento::findOrFail($id)->delete();

        return redirect('/restrito')->with('mensagem', 'Evento deletado com sucesso.');

    }

    public function atualizar_evento(Request $request){

        // // renomeando os campos (para condizer com os nomes na tabela)
        // $request->nome = $request->editar_tipo_evento;
        // $request->carga_horaria = $request->editar_carga_horaria;
        // $request->data = $request->editar_data_evento;
        // $request->tipo = $request->editar_tipo_evento;
        // $request->codigo_evento = $request->editar_codigo_evento;
        // unset($request->editar_tipo_evento);
        
        $evento = Evento::findOrFail($request->id)->update($request->all());

       return redirect('/restrito')->with('mensagem', 'Evento atualizado com sucesso.');

    }

    public function editar_eventoAjax($id){

        $evento = Evento::findOrFail($id);

        return response()->json($evento);
    }


    // ESTUDANTE ---------------------------------------------------------------------
    
    public function gravar_estudante(Request $request){

        $estudante = new Estudante; // instancia o modelo q conecta ao banco
        
        $primeiro_nome = explode(" ", $request->nome);
        $estudante->primeiro_nome = $primeiro_nome[0];
        
        $estudante->nome = $request->nome;
        $estudante->email = $request->email;
        $estudante->data_nascimento = $request->data_nascimento;
        $estudante->formacao = $request->formacao;
        $estudante->telefone = $request->telefone;
        $estudante->inscrito = $request->inscrito;
        $estudante->estado = $request->estado;
        $estudante->cidade = $request->cidade;
        $estudante->curso = $request->curso;
        $estudante->outras_informacoes = $request->outras_informacoes;
        $estudante->interesse = 60; // valor default


        // grava no banco de dados
        $estudante->save();

        return redirect('/restrito')->with('mensagem', 'Dados gravados com sucesso');

    }

    public function deletar_estudante($id){

        //Estudante::findOrFail($id)->delete();
        $x = Certificado::select('id')->where('id_usuario',$id)->get();

        // pega o id de cada certificado do estudante
        foreach($x as $y){
            $id_certificado = ($y->id);
            Certificado::findOrFail($id_certificado)->delete();
        } 

        Estudante::findOrFail($id)->delete();

        return redirect('/restrito')->with('mensagem', 'Estudante deletado com sucesso.');

    }

    public function atualizar_estudante(Request $request){

        $evento = Estudante::findOrFail($request->id)->update($request->all());

       return redirect('/restrito')->with('mensagem', 'Estudante atualizado com sucesso.');

    }

    public function editar_estudanteAjax($id){

        $evento = Estudante::findOrFail($id);

        return response()->json($evento);
    }


    public function estudantesAjax(Request $request){

        // bloqueando acesso direto
        if(!$request->ajax()){
            echo "Acesso negado";
            exit();
        }

        $estudantes = Estudante::select();

        return DataTables::of($estudantes)->make(true);
    }

    public function listarCertificadosAjax($id){
        // bloqueando acesso direto
        // if($request->ajax()){
        //     echo "Acesso negado";
        //     exit();
        // }

        $id_usuario = $id;

        $certificado = DB::table('certificados')
        ->join('eventos','eventos.id','=','certificados.id_curso') 
        ->join('estudantes','estudantes.id','=','certificados.id_usuario')         
         ->select(
             'certificados.codigo_certificado as id_certificado',
             'estudantes.nome as nome_estudante',
             'estudantes.id as id_usuario',
             'estudantes.email as email',
             'eventos.nome as nome_curso', 'eventos.codigo_evento as codigo_curso', 
             'certificados.created_at as data_emissao',
             'certificados.codigo_certificado as codigo_de_seguranca'
             )
        ->where('certificados.id_usuario', $id_usuario)->get();

        foreach($certificado as $i){
            $i->data_emissao = f::formataData($i->data_emissao);
        }
        
        return DataTables::of($certificado)->make(true);
    }

}
