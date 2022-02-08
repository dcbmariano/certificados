<!-- MODAL ADICIONAR EVENTO --> 
<div class="modal fade" id="modal_adicionar_evento" tabindex="-1" aria-labelledby="modal_adicionar_evento" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_adicionar_evento_titulo"><b>Adicionar evento</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/restrito/gravar_evento">
          @csrf
            <div class="mb-3">
                <label for="tipo" class="badge bg-secondary form-label">Tipo</label>
                <select class="form-control" name="tipo_evento" id="tipo_evento">
                <option value="curso">Curso</option>
                <option value="palestra">Palestra</option>
                <option value="conferencia">Conferência</option>
                <option value="seminario">Seminário</option>           
                <option value="workshop">Workshop</option>
                </select>
                <small id="helpId" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="nome_evento" class="form-label badge bg-secondary">Nome do evento</label>
                <input type="text" class="form-control" name="nome_evento" id="nome_evento" aria-describedby="nome_evento" placeholder="Digite o nome do evento">
                <small id="nome_evento" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="carga_horaria" class="form-label badge bg-secondary">Carga horária</label>
                <input type="text" class="form-control" name="carga_horaria" id="carga_horaria" aria-describedby="carga_horaria" placeholder="Exemplo: 20h, 1h30 ou 30 min">
                <small id="" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="data_evento" class="form-label badge bg-secondary">Data</label>
                <input type="date" class="form-control" name="data_evento" id="data_evento" aria-describedby="data_evento">
                <small id="" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="" class="form-label badge bg-secondary">Código do evento</label>
                <input type="text" class="form-control" name="codigo_evento" id="codigo_evento" aria-describedby="codigo_evento" maxlength="4" minlength="4" placeholder="Exemplos: 1BGA, 4MDP, WEB1" onkeypress="this.value = this.value.toUpperCase()">
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
<!-- FIM MODAL LISTAR CERTIFICADOS --> 