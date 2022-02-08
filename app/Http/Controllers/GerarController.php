<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
//use Codedge\Fpdf\Fpdf\Fpdf;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader; 
use Illuminate\Support\Facades\DB;


class GerarController extends Controller
{
    public function index(){

        $dados = [];

        if(isset($_GET['id'])){
            $code = addslashes($_GET['id']);  // proteção contra sql injection (old)
            $code = substr($code, 0, 4);  // pega só 4 caracteres
            $code = strtoupper($code);
            //print($code);

            $dados['evento'] = Evento::where('codigo_evento', $code)->first();

            if(empty($dados['evento'])){
                return view('gerar', $dados);
            }
            else{
                return view('emitir', $dados);
            }
        }
        else{
            return view('gerar', $dados);
        }        
    }

    
    public function pdf(Request $request){ // https://github.com/codedge/laravel-fpdf    

        function formataData($data){
            $dia = substr($data, 8, 2);
            $mes = substr($data, 5, 2);
            $ano = substr($data, 0, 4);
    
            switch($mes){
                case '01': $mes = 'janeiro'; break;
                case '02': $mes = 'fevereiro'; break;
                case '03': $mes = 'março'; break;
                case '04': $mes = 'abril'; break;
                case '05': $mes = 'maio'; break;
                case '06': $mes = 'junho'; break;
                case '07': $mes = 'julho'; break;
                case '08': $mes = 'agosto'; break;
                case '09': $mes = 'setembro'; break;
                case '10': $mes = 'outubro'; break;
                case '11': $mes = 'novembro'; break;
                case '12': $mes = 'dezembro'; break;
                default: $mes = $mes;
            }
            $data_formatada = $dia.' de '.$mes.' de '.$ano;
    
            return $data_formatada;
        }

        function generateRandomString($size){

            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";         
            $randomString = '';         
            for($i = 0; $i < $size; $i = $i+1){
                $randomString .= $chars[mt_rand(0,35)];
            }
            return $randomString;

        }
        
        if(isset($_SERVER['HTTP_REFERER'])) {
            $url_anterior = $_SERVER['HTTP_REFERER'];

            $partes_url = explode(".", $url_anterior);

            $travar = 1; 
            foreach($partes_url as $parte){
                if(($parte == 'alfahelix') or ($parte == 'https://alfahelix') or  ($parte == 'http://alfahelix') or ($parte == 'http://localhost:8000/gerar?id=1bga') or ($parte == 'http://localhost:8000/buscar/meus_certificados')){
                    $travar = 0;
                }
            }

            if($travar == 1){
                //print_r($_SERVER['HTTP_REFERER']); 
                echo 'ACESSO NEGADO. Site inválido. Acreditamos que isso foi uma tentativa de invasão. Caso discorde, entre em contato com o administrador.';
                exit();
            }
        }
        else{
            echo 'ACESSO NEGADO. Origem não detectada. Acreditamos que isso foi uma tentativa de invasão. Caso discorde, entre em contato com o administrador.';
            exit();
        }


        if(!isset($_POST['submit'])){
            print "Falha. Tentativa de fraude detectada.";
            exit();
        }

        // // Variáveis importantes ***************************************************************
        $nome = utf8_decode($request->input('nomecompleto'));
        $email = $request->input('email');
        $nascimento = $request->input('nascimento');
        $nascimento = substr($nascimento, 6, 4).'-'.substr($nascimento, 3, 2).'-'.substr($nascimento, 0, 2);
        $formacao = $request->input('formacao');

        $codigo_curso = base64_decode(strtoupper($request->input('chave_de_seguranca')));

        // busca dados do curso do banco de dados
        $info_curso = DB::table('eventos')
            ->where('codigo_evento', $codigo_curso)
            ->first();

        if(empty($info_curso)){
            print "Falha. Chave de segurança inválida. Este evento será reportado para o administrador do sistema.";
            exit();
        }

        $id_curso = $info_curso->id;
        $curso = $info_curso->nome; 
        $carga_horaria = $info_curso->carga_horaria;
        
        $hoje = formataData(date('Y-m-d')); 

        $codigo_certificado = generateRandomString(6);
        $codigo_certificado = 'AAA999';

        // verifica se o código já existe
        $unico = DB::table('certificados')
            ->where('codigo_certificado', $codigo_certificado)
            ->first();

        // enquanto o id não for único, execute novamente
        while(!empty($unico)){

            // gera um novo código
            $codigo_certificado = generateRandomString(6);

            $unico = DB::table('certificados')
            ->where('codigo_certificado', $codigo_certificado)
            ->first();

        }


        // // Gravar na base de dados *************************************************************
        // $id_usuario = gravarUsuario($nome, $email, $nascimento, $formacao);
        // gravarCertificado($id_usuario, $codigo, $nome, $email, $evento, $id_evento, $dtipo, $raw_carga);

        // gravar usuário
        $nomes = explode(' ', $nome);
        $primeiro_nome = $nomes[0];

        // verifica se o email já existe na base de daos
        $verifica_estudantes = DB::table('estudantes')
            ->where('email', $email)
            ->first();

        if(empty($verifica_estudantes)){
            $id_usuario = DB::table('estudantes')->insertGetId(
                [
                    'nome' => $nome, 
                    'primeiro_nome' => $primeiro_nome,
                    'email' => $email,
                    'formacao' => $formacao,
                    'data_nascimento' => $nascimento,
                    'inscrito' => 1,
                    'interesse' => 60,                
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]
            );
        }
        else{
            $id_usuario = $verifica_estudantes->id;
        }        

        // print_r( [
        //     'nome' => $nome, 
        //     'primeiro_nome' => $primeiro_nome,
        //     'email' => $email,
        //     'formacao' => $formacao,
        //     'data_nascimento' => $nascimento,
        //     'inscrito' => 1,
        //     'interesse' => 60
        // ]);

        // gravar certificado
        $id_certificado = DB::table('certificados')->insertGetId(
            [
                'id_usuario' => $id_usuario, 
                'id_curso' => $id_curso,
                'codigo_certificado' => $codigo_certificado,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]
        );

        // print_r([
        //     'id_usuario' => $id_usuario, 
        //     'id_curso' => $id_curso,
        //     'codigo_certificado' => $codigo_certificado
        // ]);
        // print_r($id_certificado); exit();

        //Array ( [id_usuario] => 67883 [id_curso] => 1 [codigo_certificado] => YBDLM1 ) 131647

        // // PDF *********************************************************************************
        $pdf = new Fpdi();

        // Abrindo modelo
        $pageCount = $pdf->setSourceFile('data/modelo.pdf');
        $pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

        $pdf->addPage('l');
        $pdf->useImportedPage($pageId, 0, 0);
        
        $curso = utf8_decode(mb_strtoupper($curso, 'UTF-8'));
        $nome = utf8_decode(mb_strtoupper($nome, 'UTF-8'));

        /* Nome */
        $pdf->SetFont("Arial",'','14');
        $pdf->SetTextColor(77, 77, 77);
        $pdf->SetXY(15, 70);
        $pdf->Write(0, "Atestamos que");

        $pdf->SetXY(15, 75);
        $pdf->SetFont("Arial",'B','18');       
        $pdf->MultiCell(200, 8, $nome,'','l');

        $pdf->SetXY(15, 105);        
        $pdf->SetFont("Arial",'','14');
        $pdf->Write(0, "concluiu o curso");

        $pdf->SetXY(15, 110);        
        $pdf->SetFont("Arial",'B','18');
        $pdf->MultiCell(200, 8, $curso, '','l');
        $pdf->Ln(10);

        $pdf->SetXY(15, 140);        
        $pdf->SetFont("Arial",'','14');
        $pdf->Write(0, utf8_decode("na data de $hoje (carga horária: $carga_horaria)."));
        
        $pdf->SetFont("Courier",'B','19');
        $pdf->SetTextColor(250, 250, 250);
        $pdf->SetXY(43, 187);

        $codigo_certificado = str_split($codigo_certificado);
        $codigo_certificado = implode(' ', $codigo_certificado);

        $pdf->Write(0, $codigo_certificado);


        $pdf->Image('img/protecao.png',0,0,-300);

        $pdf->Output();
        exit;

    }

    /* 
    *
    * EMITE UMA SEGUNDA VIA DO CERTIFICADO 
    * REQUER CÓDIGO DE SEGURANÇA
    * 
    */

    public function segunda_via(Request $request){   

        function formataData2($data){
            $dia = substr($data, 8, 2);
            $mes = substr($data, 5, 2);
            $ano = substr($data, 0, 4);
    
            switch($mes){
                case '01': $mes = 'janeiro'; break;
                case '02': $mes = 'fevereiro'; break;
                case '03': $mes = 'março'; break;
                case '04': $mes = 'abril'; break;
                case '05': $mes = 'maio'; break;
                case '06': $mes = 'junho'; break;
                case '07': $mes = 'julho'; break;
                case '08': $mes = 'agosto'; break;
                case '09': $mes = 'setembro'; break;
                case '10': $mes = 'outubro'; break;
                case '11': $mes = 'novembro'; break;
                case '12': $mes = 'dezembro'; break;
                default: $mes = $mes;
            }
            $data_formatada = $dia.' de '.$mes.' de '.$ano;
    
            return $data_formatada;
        }
        
        if(isset($_SERVER['HTTP_REFERER'])) {
            $url_anterior = $_SERVER['HTTP_REFERER'];

            $partes_url = explode(".", $url_anterior);

            $travar = 1; 
            foreach($partes_url as $parte){
                if(($parte == 'alfahelix') or ($parte == 'https://alfahelix') or  ($parte == 'http://alfahelix') or ($parte == 'http://localhost:8000/validar') or ($parte == 'http://localhost:8000/buscar/meus_certificados')){
                    $travar = 0;
                }
            }

            if($travar == 1){
                echo 'ACESSO NEGADO. Origem inválida. Acreditamos que isso foi uma tentativa de invasão. Caso discorde, entre em contato com o administrador.';
                exit();
            }
        }
        else{
            echo 'ACESSO NEGADO. Origem não detectada. Acreditamos que isso foi uma tentativa de invasão. Caso discorde, entre em contato com o administrador.';
            exit();
        }


        if(!isset($_POST['submit'])){
            print "Falha. Tentativa de fraude detectada.";
            exit();
        }

        // // Variáveis importantes ***************************************************************
        $codigo = base64_decode($request->input('codigo_de_seguranca'));

        // verifica se o código já existe
        $certificado = DB::table('certificados')
            ->join('estudantes','estudantes.id','=','certificados.id_usuario')
            ->join('eventos','eventos.id','=','certificados.id_curso')            
            ->select(
                'estudantes.nome as nome_estudante', 
                'eventos.nome as nome_evento', 'eventos.carga_horaria', 
                'certificados.created_at as data_emissao'
                )
            ->where('certificados.codigo_certificado', $codigo)
            ->first();
        
        $nome = $certificado->nome_estudante;
        $curso = $certificado->nome_evento;
        $carga_horaria = $certificado->carga_horaria;
        $hoje = formataData2($certificado->data_emissao);

        // // PDF *********************************************************************************
        $pdf = new Fpdi();

        // Abrindo modelo
        $pageCount = $pdf->setSourceFile('data/modelo.pdf');
        $pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

        $pdf->addPage('l');
        $pdf->useImportedPage($pageId, 0, 0);
        
        $curso = utf8_decode(mb_strtoupper($curso, 'UTF-8'));
        $nome = utf8_decode(mb_strtoupper($nome, 'UTF-8'));

        /* Nome */
        $pdf->SetFont("Arial",'','14');
        $pdf->SetTextColor(77, 77, 77);
        $pdf->SetXY(15, 70);
        $pdf->Write(0, "Atestamos que");

        $pdf->SetXY(15, 75);
        $pdf->SetFont("Arial",'B','18');       
        $pdf->MultiCell(200, 8, $nome,'','l');

        $pdf->SetXY(15, 105);        
        $pdf->SetFont("Arial",'','14');
        $pdf->Write(0, "concluiu o curso");

        $pdf->SetXY(15, 110);        
        $pdf->SetFont("Arial",'B','18');
        $pdf->MultiCell(200, 8, $curso, '','l');
        $pdf->Ln(10);

        $pdf->SetXY(15, 140);        
        $pdf->SetFont("Arial",'','14');
        $pdf->Write(0, utf8_decode("na data de $hoje (carga horária: $carga_horaria)."));
        
        $pdf->SetFont("Courier",'B','19');
        $pdf->SetTextColor(250, 250, 250);
        $pdf->SetXY(43, 187);

        $codigo_certificado = str_split($codigo);
        $codigo_certificado = implode(' ', $codigo_certificado);

        $pdf->Write(0, $codigo_certificado);


        $pdf->Image('img/protecao.png',0,0,-300);

        $pdf->Output();
        exit;

    }

}
