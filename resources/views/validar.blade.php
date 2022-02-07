@extends('template')
@section('titulo', 'Verificando a autenticidade do certificado')

@section('conteudo')

@if($valido)
<section class="bg-white py-5 p-2">
    <div class="container">
        <h1 class="text-success text-center pt-3 pb-0 display-4"><strong>✔ Este certificado é válido</strong></h1>
        
        <p class="text-center text-muted pb-3">Código de segurança: <label class="badge bg-success">{{ $codigo_seguranca }}</label></p>

        <p class="text-muted pt-3 pb-5 px-5 text-center">Este certificado foi concedido a <strong>{{$certificado->nome_estudante}}</strong> <br>pela participação no curso <strong>{{$certificado->nome_evento}}</strong> <br>com carga horária de <strong>{{$certificado->carga_horaria}}</strong> <br>concluído no dia <strong class="formatarData">{{$certificado->data_emissao}}</strong>.</p>

        <div class="text-center pb-4">
            <form action="/gerar/segunda_via" method="POST">
                @csrf
                <input type="hidden" name="codigo_de_seguranca" value="<?php echo base64_encode(strtoupper($codigo_seguranca)); ?>">
                <input type="submit" name="submit" value="Emitir uma cópia deste certificado" class="btn btn-xl btn-outline-success">
            </form>
        </div>

    </div>
</section>
@else
<style>
    .navbar{ background: linear-gradient(90deg, #ff0000 0%,#dc3545 100%); }
</style>
<section class="bg-white py-5 p-2">
    <div class="container">
        <h1 class="text-danger text-center pt-3 pb-0 display-4"><strong>✖ Este certificado não é válido</strong></h1>
        <p class="text-center text-muted pb-3">Código de segurança inválido: <label class="badge bg-danger">{{ $codigo_seguranca }}</label></p>

        <p class="text-muted pt-3 pb-5 px-5 text-center">O <strong>código de segurança</strong> verificado não foi encontrado em nossa base de dados. O certificado pesquisado pode ter sido vítima de uma falsificação ou, por algum problema técnico, pode ainda não ter sido inserido em nossa base de dados. Para mais informações, entre em <a href="/contato">contato</a> com o administrador do sistema.</p>
        <p class="small text-muted text-center"><strong>Digitou incorretamente?</strong></p>
        <div class="text-center pb-4"><a href="/" class="btn btn-xl btn-outline-danger">Tentar novamente</a></div>

    </div>
</section>
@endif

    
<div class="bg-light py-5">

    <div class="container">
        <div class="col-md-6 col-12 offset-md-3">
            <div class="formacao">
                <span class="destaque">SOBRE</span>
                <h2><b>Quem valida este certificado?</b></h2>
                <span class="destaque">_____</span>
            </div>

            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <a href="#">
                    <img src="/img/alfa.jpg" width="160px" class="img-thumbnail">
                    </a>
                </div>

                <div class="flex-grow-1 ms-3">
                    <h4 class="pt-3 destaque"><b>Alfahelix</b></h4>

                    <p class="small text-muted">Somos uma <b>escola de computação</b> com profissionais altamente qualificados. Promovemos cursos rápidos, práticos e de alta qualidade. Nossos profissionais possuem graduação, mestrado ou doutorado. CNPJ: 37.524.984/0001-10</p>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
