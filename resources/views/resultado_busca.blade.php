@extends('template')
@section('titulo', 'Verificando a autenticidade do certificado')

@section('conteudo')

@if($encontrado)
<div class="bg-white py-5">
    <div class="container">
        <h2 class="mt-3"><strong>Meus certificados</strong></h2>
        <p class="pb-3 text-muted">Lista de certificados emitidos para <strong>{{ $usuario->nome }}</strong></p>
        <table id="meus_certificados" class="table table-hover table-condensed table-striped mb-5">
            <thead>
                <th>#</th>
                <th>Curso</th>
                <th>Carga horária</th>
                <th>Data de emissão</th>
                <th>Código</th>
                <th class="text-center">Gerar PDF</th>
            </thead>
            <tbody>
                <?php $cont = 0; ?>
                @foreach($certificado as $i)
                    <?php $cont++; ?>
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ $i->nome_evento }}</td>
                        <td>{{ $i->carga_horaria }}</td>
                        <td>{{ $i->data_emissao }}</td>
                        <td><code>{{ $i->codigo_certificado }}</code></td>
                        <td class="text-center">
                        
                            <form action="{{ url('/') }}/gerar/segunda_via" method="POST">
                                @csrf
                                <input type="hidden" name="codigo_de_seguranca" value="<?php echo base64_encode(strtoupper($i->codigo_certificado)); ?>">
                                <!--<i class="bi bi-file-earmark-arrow-down-fill"></i>-->
                                <input type="submit" name="submit" value="Download" class="btn btn-outline-success">
                                
                                
                            </form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else

<div class="text-center bg-light py-5">

    <h1>Nenhum resultado encontrado.</h1>

</div>


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


<script>$(()=>{ ativarTabelasInterativas(); });</script>
@endsection
