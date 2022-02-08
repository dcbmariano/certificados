@extends('template')
@section('titulo', 'Área restrita')

@section('conteudo')

<?php // barra de navegação 
?>
<section class="bg-white pt-4 pb-5">
    <div class="container-fluid">

        <!-- ABAS DE NAVEGAÇÃO -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="eventos-tab" data-bs-toggle="tab" data-bs-target="#eventos" type="button" role="tab" aria-controls="eventos" aria-selected="true">Eventos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Estudantes</button>
            </li>
        </ul>

        <!-- CONTEÚDO DAS ABAS DE NAVEGAÇÃO -->
        <div class="tab-content p-2 my-4" id="myTabContent">
            <div class="tab-pane fade show active" id="eventos" role="tabpanel" aria-labelledby="eventos-tab">

                <p class="text-start">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_evento">Adicionar evento</a>
                </p>
                <table class="small table table-hover table-condensed table-striped" id="tabela_eventos">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Carga horária</th>
                            <th>Data</th>
                            <th>Código</th>
                            <th>Editar</th>
                            <th>Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cursos as $e)
                        <tr>
                            <td>{{ $e->id }}</td>
                            <td>{{ $e->nome }}</td>
                            <td>{{ $e->tipo }}</td>
                            <td>{{ $e->carga_horaria }}</td>
                            <td>{{ $e->data }}</td>
                            <td>{{ $e->codigo_evento }}</td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#modal_editar_evento" onclick="editarEvento( {{ $e->id }} )"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#modal_deletar_evento" class="text-danger" onclick="confirmarDelecao( {{ $e->id }} )"><i class="bi bi-x-circle-fill"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>          

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <p class="text-start">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_estudante">Adicionar Estudante</a>
                </p>
                <table class="small table table-hover table-condensed table-striped w-100" id="tabela_estudantes">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Idade</th>
                            <th>Data de nascimento</th>
                            <th>Formação</th>
                            <th>Data de inscrição</th>  
                            <th>Inscrito?</th> 
                            <th>Editar</th>      
                            <th>Listar certificados</th>
                            <th>Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
            <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Certificados</div> -->
        </div>
    </div>
</section>



<!-- ***********************  MODAIS ************************ -->
<?php // disponíveis em /resources/views/modal ?>

@include('modal.modal_listar_certificados')
@include('modal.modal_adicionar_evento')
@include('modal.modal_deletar_evento')
@include('modal.modal_editar_evento')
@include('modal.modal_editar_estudante')
@include('modal.modal_adicionar_estudante')
@include('modal.modal_deletar_estudante')

<!-- FIM MODAIS -->

<script>
    $(()=>{
        ativarModais();
        ativarTabelasInterativas();
    })
</script>
@endsection