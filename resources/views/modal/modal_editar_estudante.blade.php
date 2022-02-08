<!-- MODAL editar estudante --> 
<div class="modal fade" id="modal_editar_estudante" tabindex="-1" aria-labelledby="modal_editar_estudante" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_editar_estudante_titulo"><b>Editar estudante #<span id="estudante_atual_editar"></span>?</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" id="editar_estudante_form" action="/restrito/atualizar_estudante">
          @csrf
          @method("PUT")
          <div class="mb-3">
                <label for="nome_estudante" class="form-label badge bg-secondary">Nome do estudante</label>
                <input type="text" class="form-control" name="nome" id="nome_estudante" aria-describedby="nome_estudante" placeholder="Digite o nome do estudante">
                <small id="nome_estudante" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label badge bg-secondary">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="carga_horaria" placeholder="examplo@email.com">
                <small id="" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="data_estudante" class="form-label badge bg-secondary">Data de nascimento</label>
                <input type="date" class="form-control" name="data_nascimento" id="data_estudante" aria-describedby="data_estudante">
                <small id="" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="formacao" class="badge bg-secondary form-label">Formação acadêmica</label>
                <select class="form-control" name="formacao" id="formacao_estudante">
                  <option id="formacao_estudante_padrao" selected></option>
                  <option value="Ensino fundamental">Ensino fundamental</option>
                  <option value="Ensino medio">Ensino médio</option>
                  <option value="Ensino superior">Ensino superior</option>
                  <option value="Mestrado">Mestrado</option>           
                  <option value="Doutorado">Doutorado</option>        
                  <option value="Pos-doutorado">Pós-doutorado</option>
                </select>
                <small id="helpId" class="form-text text-muted">* Obrigatório</small>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label badge bg-secondary">Telefone</label>
                <input type="text" class="form-control" name="telefone" id="telefone" aria-describedby="telefone">
                <small id="" class="form-text text-muted">* opcional</small>
            </div>

            <div class="mb-3">
                <label for="inscrito" class="form-label badge bg-secondary">Inscrito na newsletter?</label>
                <select class="form-control" name="inscrito" id="formacao_estudante">
                    <option id="inscrito_padrao"></option> 
                  <option value="1">Sim</option>
                  <option value="0">Não</option>
                </select>
                <small id="" class="form-text text-muted">* opcional</small>
            </div>

            <div class="mb-3">
                <label for="cidade" class="form-label badge bg-secondary">Cidade</label>
                <input type="text" class="form-control" name="cidade" id="cidade" aria-describedby="cidade">
                <small id="" class="form-text text-muted">* opcional</small>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label badge bg-secondary">Estado</label>
                <select id="estado" class="form-control" name="estado">
                  <option id="estado_padrao" selected></option>
                  <option value="AC">Acre</option>
                  <option value="AL">Alagoas</option>
                  <option value="AP">Amapá</option>
                  <option value="AM">Amazonas</option>
                  <option value="BA">Bahia</option>
                  <option value="CE">Ceará</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="ES">Espírito Santo</option>
                  <option value="GO">Goiás</option>
                  <option value="MA">Maranhão</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="PA">Pará</option>
                  <option value="PB">Paraíba</option>
                  <option value="PR">Paraná</option>
                  <option value="PE">Pernambuco</option>
                  <option value="PI">Piauí</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="RO">Rondônia</option>
                  <option value="RR">Roraima</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="SP">São Paulo</option>
                  <option value="SE">Sergipe</option>
                  <option value="TO">Tocantins</option>
                  <option value="EX">Estrangeiro</option>
                </select>
                <small id="" class="form-text text-muted">* opcional</small>
            </div>

            <div class="mb-3">
                <label for="curso" class="form-label badge bg-secondary">Curso de graduação</label>
                <input type="text" class="form-control" name="curso" id="curso" aria-describedby="curso">
                <small id="" class="form-text text-muted">* opcional</small>
            </div>

            <div class="mb-3">
                <label for="curso" class="form-label badge bg-secondary">Outras informações</label>
                <textarea class="form-control" name="outras_informacoes" id="outras_informacoes"></textarea>
                <small id="" class="form-text text-muted">* opcional</small>
            </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" value="Salvar"></form>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL editar estudante --> 

<script>
    const editarestudante = (id_estudante_atual_editar)=>{
        $("#estudante_atual_editar").text(id_estudante_atual_editar);
        
        // preencher valores do formulário
        $.ajax({
            url: "/restrito/editar_estudanteAjax/"+id_estudante_atual_editar
        }).done((d)=>{

            // atualiza os valores nos campos
            $("#editar_estudante_form").attr("action", "/restrito/atualizar_estudante/"+d.id);
            $("#editar_tipo_estudante_padrao").attr("value",d.tipo);
            $("#nome_estudante").val(d.nome);
            $("#email").val(d.email);
            $("#data_estudante").val(d.data_nascimento);
            $("#formacao_estudante_padrao").val(d.formacao);
            $("#formacao_estudante_padrao").text(d.formacao);
            $("#telefone").val(d.telefone);
            
            $("#inscrito_padrao").val(d.inscrito);

            // if(d.inscrito == "1"){ d.inscrito = "Sim"; }
            // else if(d.inscrito == "0"){ d.inscrito = "Não"; }
            d.inscrito = d.inscrito == 1 ? 'Sim' : 'Não';

            $("#inscrito_padrao").text(d.inscrito);

            $("#cidade").val(d.cidade);

            $("#estado_padrao").val(d.estado);
            $("#estado_padrao").text(d.estado);

            $("#curso").val(d.curso);
            $("#outras_informacoes").val(d.outras_informacoes);


        });
    }
</script>