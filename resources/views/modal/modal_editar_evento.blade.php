<!-- MODAL editar evento --> 
<div class="modal fade" id="modal_editar_evento" tabindex="-1" aria-labelledby="modal_editar_evento" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_editar_evento_titulo"><b>Editar evento #<span id="evento_atual_editar"></span>?</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" id="editar_evento_form" action="/restrito/atualizar_evento">
          @csrf
          @method("PUT")
            <div class="mb-3">
                <label for="tipo" class="badge bg-secondary form-label">Tipo</label>
                <select class="form-control" name="tipo" id="editar_tipo_evento">
                    <option id="editar_tipo_evento_padrao" selected></option>
                    <option value="curso">Curso</option>
                    <option value="palestra">Palestra</option>
                    <option value="conferencia">Conferência</option>
                    <option value="seminario">Seminário</option>           
                    <option value="workshop">Workshop</option>
                </select>
                <small id="" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="editar_nome_evento" class="form-label badge bg-secondary">Nome do evento</label>
                <input type="text" class="form-control" name="nome" id="editar_nome_evento" aria-describedby="nome_evento" placeholder="Digite o nome do evento">
                <small id="" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="editar_carga_horaria" class="form-label badge bg-secondary">Carga horária</label>
                <input type="text" class="form-control" name="carga_horaria" id="editar_carga_horaria" aria-describedby="editar_carga_horaria" placeholder="Exemplo: 20h, 1h30 ou 30 min">
                <small id="" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="editar_data_evento" class="form-label badge bg-secondary">Data</label>
                <input type="date" class="form-control" name="data" id="editar_data_evento" aria-describedby="editar_data_evento">
                <small id="" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="editar_codigo_evento" class="form-label badge bg-secondary">Código do evento</label>
                <input type="text" class="form-control" name="codigo_evento" id="editar_codigo_evento" aria-describedby="editar_codigo_evento" maxlength="4" minlength="4" placeholder="Exemplos: 1BGA, 4MDP, WEB1" onkeypress="this.value = this.value.toUpperCase()">
                <small id="" class="form-text text-muted">* Obrigatório</small>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" value="Salvar"></form>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL editar evento --> 

<script>
    const editarEvento = (id_evento_atual_editar)=>{
        $("#evento_atual_editar").text(id_evento_atual_editar);
        
        // preencher valores do formulário
        $.ajax({
            url: "/restrito/editar_eventoAjax/"+id_evento_atual_editar
        }).done((d)=>{

            function letraMaiuscula(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
            // atualiza os valores nos campos
            $("#editar_evento_form").attr("action", "/restrito/atualizar_evento/"+d.id);
            $("#editar_tipo_evento_padrao").text(letraMaiuscula(d.tipo));
            $("#editar_tipo_evento_padrao").attr("value",d.tipo);
            $("#editar_nome_evento").val(d.nome);
            $("#editar_carga_horaria").val(d.carga_horaria);
            $("#editar_data_evento").val(d.data);
            $("#editar_codigo_evento").val(d.codigo_evento);

        });
    }
</script>