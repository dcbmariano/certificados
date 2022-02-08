<!-- MODAL LISTAR CERTIFICADOS --> 
<div class="modal fade" id="modal_listar_certificados" tabindex="-1" aria-labelledby="modal_listar_certificados" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_editar"><b>Certificados por autor</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          
        <table id="certificados_estudante" class="small table table-hover table-condensed table-striped mb-5">

        <?php // ATENÇÃO, ESTA TABELA É PREENCHIDA EM /js/script.js -> função listarCertificados ?>
            <thead>
                <th>#</th>
                <th>Nome</th>
                <th>id_usuario</th>
                <th>Curso</th>
                <th>Código [curso]</th>
                <th>Data de emissão</th>
                <th class="text-center">Gerar PDF</th>
            </thead>
            <tbody>
                
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL LISTAR CERTIFICADOS --> 