<!-- MODAL deletar evento --> 
<div class="modal fade" id="modal_deletar_evento" tabindex="-1" aria-labelledby="modal_deletar_evento" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_deletar_evento_titulo"><b>Deseja realmente deletar o evento #<span id="evento_atual"></span>?</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <form action="{{ url('/') }}/restrito/deletar" id="deletar_evento" method="POST">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-lg">Sim</button>
        </form>
        <button type="button" class="btn btn-primary btn-lg" data-bs-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL deletar evento --> 

<script>
    const confirmarDelecao = (id_evento_atual)=>{
        $("#evento_atual").text(id_evento_atual);
        $("#deletar_evento").attr("action", "{{ url('/') }}/restrito/deletar/"+id_evento_atual);
    }
</script>