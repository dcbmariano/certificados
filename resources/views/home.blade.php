@extends('template')
@section('titulo', 'Certificados')

@section('conteudo')

<div class="col-12 col-md-4 offset-md-4">
    <div class="container py-5 mb-4 mt-2" id="content">
    
		<div class="formacao">
            <span class="destaque">CERTIFICADOS <button type="button" class="btn btn-link text-dark p-0 btn-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="CÓDIGO DE SEGURANÇA DE 6 DIGITOS [ABC123]: você pode encontrá-lo no canto inferior do seu certificado. Caso tenha perdido o certificado, clique em 'emitir certificado' e faça uma busca usando seu endereço de e-mail e data de nascimento."><i class="bi bi-question-circle-fill"></i></button>
        </span>
            <h2><b>Validação de certificados</b></h2>
            <span class="destaque">_____</span>
		</div>

		<form method="POST" action="/validar">
            @csrf
            <div class="row g-3">
                <div class="col-2">
                    <input type="text" name="code1" class="form-control form-control-lg validacao" size="1" maxlength="1" > 
                </div> 
                <div class="col-2">
                    <input type="text" name="code2" class="form-control form-control-lg validacao" size="1" maxlength="1" > 
                </div> 
                <div class="col-2">
                    <input type="text" name="code3" class="form-control form-control-lg validacao" size="1" maxlength="1" > 
                </div> 
                <div class="col-2">
                    <input type="text" name="code4" class="form-control form-control-lg validacao" size="1" maxlength="1" > 
                </div> 
                <div class="col-2">
                    <input type="text" name="code5" class="form-control form-control-lg validacao" size="1" maxlength="1" > 
                </div> 
                <div class="col-2">
                    <input type="text" name="code6" class="form-control form-control-lg validacao" size="1" maxlength="1" > 
                </div> 
            </div>

            
            <div class="row mt-4">
                <div class="col-6 text-muted small text-right pt-1">Prove que não é um robô:</div>
                <div class="col-6 text-muted">{!!getCaptchaBox()!!}</div>
            </div>

            <div class="row mt-4 mx-0">
			    <input type="submit" value="Verificar autenticidade" class="btn btn-success btn-lg col-md-12">
            </div>

            <!--
                <input type="text" name="code1" class="form-control col-1">
			<input type="text" name="id" class="form-control input-lg" placeholder="Insira o código de 6 digitos aqui [ABC123]">
			<br>
			<center><div class="g-recaptcha" data-sitekey="6LeWlqUUAAAAAOQJFx-p0Tl54GGL6VvtAhdbEEv-"></div></center>
			<br>
-->
		</form>
	</div>
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

<script>
    $(()=>{
        atalhoCertificado();
    })
</script>
@endsection
