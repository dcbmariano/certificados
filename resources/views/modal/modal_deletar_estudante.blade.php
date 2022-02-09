<!-- MODAL deletar estudante --> 
<div class="modal fade" id="modal_deletar_estudante" tabindex="-1" aria-labelledby="modal_deletar_estudante" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_deletar_estudante_titulo"><b>Deseja realmente deletar o estudante #<span id="estudante_atual"></span>?</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <form action="{{ url('/') }}/restrito/deletar" id="deletar_estudante" method="POST">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-lg">Sim</button>
        </form>
        <button type="button" class="btn btn-primary btn-lg" data-bs-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL deletar estudante --> 

<script>
    const confirmarDelecaoEstudante = (id_estudante_atual)=>{
      console.log('a');
        $("#estudante_atual").text(id_estudante_atual);
        $("#deletar_estudante").attr("action", "{{ url('/') }}/restrito/deletar_estudante/"+id_estudante_atual);
    }
</script>