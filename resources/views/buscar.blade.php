@extends('template')
@section('titulo', 'Verificando a autenticidade do certificado')

@section('conteudo')


<div class="text-center bg-light">

@if(!$encontrado)
    <div class="alert alert-danger"><b>Nenhum certificado foi encontrado </b>para essa combinação de e-mail e data de nascimento. Tente novamente. <button type="button" class="btn btn-link text-danger p-0 btn-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="Infelizmente, caso tenha cadastrado e-mail ou data de nascimento incorretamente não será possível recuperar seus certificados. Neste caso, tente acessar o curso original, clicar novamente no link de emissão de certificado e emitir um novo."><i class="bi bi-question-circle-fill"></i></button>
</div>
@endif 

    <main class="form-signin offset-md-4 col-12 col-md-4 py-5">
    <form method="POST" action="/buscar/meus_certificados">
        @csrf
        <h1 class="h3 mb-3 fw-normal mt-4"><strong>Buscar meus certificados</strong></h1>
            <p class="text-muted small">Para listar todos os seus certificados, informe seu endereço de e-mail e data de nascimento usados na inscrição. Você pode ainda reemitir certificados usando o <a href="/">código de segurança</a>.</p>

        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="email" placeholder="nome@exemplo.com">
            <label for="email">Endereço de e-mail</label>
        </div>
        <div class="form-floating">
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data de nascimento">
            <label for="data_nascimento">Data de nascimento</label>
        </div>

        <div class="row mt-1">
            <div class="col-6 text-muted small text-right pt-1">Prove que não é um robô:</div>
            <div class="col-6">{!!getCaptchaBox()!!}</div>
        </div>
        <button class="w-100 btn btn-lg btn-primary my-4" type="submit">Buscar</button>

        </form>
    </main>

</div>

    
<div class="bg-white py-5">

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
