@extends('template')
@section('titulo', 'Área restrita')

@section('conteudo')

<?php // barra de navegação 
?>
<section class="bg-white pt-4 pb-5">
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="eventos-tab" data-bs-toggle="tab" data-bs-target="#eventos" type="button" role="tab" aria-controls="eventos" aria-selected="true">Eventos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Estudantes</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Certificados</button>
            </li> -->
        </ul>

        <div class="tab-content p-2 my-4" id="myTabContent">
            <div class="tab-pane fade show active" id="eventos" role="tabpanel" aria-labelledby="eventos-tab">
                <table class="table table-hover table-condensed table-striped" id="tabela_eventos">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Carga horária</th>
                            <th>Data</th>
                            <th>Código</th>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>            
                


            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                
            <table class="table table-hover table-condensed table-striped w-100" id="tabela_estudantes">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Data de nascimento</th>
                            <th>Formação</th>
                            <th>Data de inscrição</th>                            
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

<script>
    $(()=>{
        ativarTabelasInterativas();
    })
</script>
@endsection