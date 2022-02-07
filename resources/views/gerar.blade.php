@extends('template')
@section('titulo', 'Certificados')

@section('conteudo')
<div class="bg-white py-5">
    <div class="container">
        <h1 class="text-muted text-center p-4">Você não tem permissão para acessar esta página.</h1>
        <p class="text-center text-muted p-4">Olá! Tudo bem com você? Apenas alunos que concluiram cursos podem requisitar a emissão de certificados. Toda vez que você conclui um curso você recebe por e-mail o link de acesso com a chave de segurança. A Alfahelix fornece serviços de emissão de certificados. <strong>Quer conhecer alguns dos cursos gratuitos que oferecemos certificados? </strong>Acesse o site do <a href="https://diegomariano.com/cursos-gratuitos/">Prof. Diego Mariano</a>.</p>


        <p class="text-muted text-center">Gostaria de <mark class="text-success highlight"><strong>emitir a segunda via</strong></mark> de um certificado gerado anteriormente? Clique abaixo e digite o código de segurança.</p>
        <p class="text-center"><a href="/" class="text-center btn btn-outline-success">Emitir segunda via de um certificado</a></p>    
    </div>
</div>

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
