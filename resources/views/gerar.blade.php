@extends('template')
@section('titulo', 'Certificados')

@section('conteudo')
<div class="bg-white py-5">
    <div class="container">
        <h1 class="text-muted text-center p-4">Emissão de segunda via de certificado <button type="button" class="btn btn-link text-secondary p-0 btn-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="GERE UMA CÓPIA EM PDF DO SEU CERTIFICADO: certificados só podem ser gerados com um link único geralmente enviado pelo sistema na conclusão do curso. Caso você não tenha gerado seu certificado, você não conseguirá fazer isto por esta página. Entretanto, caso você já tenha gerado seu certificado, você pode emitir uma cópia em formato PDF por esta página. Há duas formas de fazer isso: informando o código de segurança de 6 digitos ou informando seu e-mail e data de nascimento. Infelizmente, caso tenha cadastrado e-mail e data de nascimento incorretamente não será possível recuperar os certificados. Neste caso, tente acessar o curso original e clicar no link de emissão de certificado."><i class="bi bi-question-circle-fill"></i></button></h1>
        <p class="text-center text-muted pt-2 pb-4">Olá! Tudo bem com você? Apenas alunos que concluiram cursos podem requisitar a emissão de certificados. Toda vez que você conclui um curso você recebe por e-mail o link de acesso com a chave de segurança. A Alfahelix fornece serviços de emissão de certificados. <strong>Quer conhecer alguns dos cursos gratuitos que oferecemos certificados? </strong>Acesse o site do <a href="https://diegomariano.com/cursos-gratuitos/">Prof. Diego Mariano</a>.</p>


        <p class="text-muted text-center">Gostaria de <mark class="text-success highlight"><strong>emitir a segunda via</strong></mark> de um certificado gerado anteriormente? Há duas formas de fazer isso:</p>
        <p class="text-center pb-4">
            <a href="{{ url('/') }}" class="text-center btn btn-primary btn-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="Busca pelo código de segurança de 6 digitos presente em todos os certificados: [ A B C 1 2 3 ]">Busca por código de segurança</a>
            <a href="{{ url('/') }}/buscar" class="text-center btn btn-success btn-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="Lista todos os certificados registrados para seu e-mail (requer que o usuário informe a data de nascimento registrada durante o cadastro)">Busca por e-mail e data de nascimento</a>
        </p>    
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
                    <img src="{{ url('/') }}/img/alfa.jpg" width="160px" class="img-thumbnail">
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
