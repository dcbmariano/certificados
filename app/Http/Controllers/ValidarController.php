<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificado;
use Illuminate\Support\Facades\DB;

class ValidarController extends Controller
{

    

    public function index(Request $request){
        function formatar($data){

            $ano = substr($data, 0, 4);
            $mes = substr($data, 5, 2);
            $dia = substr($data, 8, 2);
    
            $data = $dia."/".$mes."/".$ano;

            return $data;
            
        }
        $dados = [];

        $c1 = substr($request->input('code1'), 0, 1);
        $c2 = substr($request->input('code2'), 0, 1);
        $c3 = substr($request->input('code3'), 0, 1);
        $c4 = substr($request->input('code4'), 0, 1);
        $c5 = substr($request->input('code5'), 0, 1);
        $c6 = substr($request->input('code6'), 0, 1);

        $code = strtoupper($c1.$c2.$c3.$c4.$c5.$c6);

        $dados['codigo_seguranca'] = $code;

        $dados['certificado'] = DB::table('certificados')
            ->join('estudantes','estudantes.id','=','certificados.id_usuario')
            ->join('eventos','eventos.id','=','certificados.id_curso')            
            ->select(
                'estudantes.nome as nome_estudante', 
                'eventos.nome as nome_evento', 'eventos.carga_horaria', 
                'certificados.created_at as data_emissao'
                )
            ->where('certificados.codigo_certificado', $code)
            ->first();

        // buscando dados
        //$dados['certificado'] = Certificado::where('codigo_certificado', $code)->first();
         //$dados['certificado'] = Certificado::table('certificados')->join('estudantes', 'certificados.id_usuario', '=', 'estudantes.id')->where('certificados.codigo_certificado', $code)->first();
        // $array = $dados['certificado'];
        // while ($fruit_name = current($array)) {
        //      echo key($array).'<br />';
        //     next($array);
        //  }
        if(empty($dados['certificado'])){
            $dados['valido'] = false;
        }
        else{
            $dados['valido'] = true;
        }

        return view('validar', $dados);
    }

}
