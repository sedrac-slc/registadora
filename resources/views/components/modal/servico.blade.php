<div class="modal fade m-2 p-1" id="modalServico" tabindex="-1" aria-labelledby="modalServicoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <form id="form-user" class="modal-content bg-white rounded" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-header">
          <h5 class="modal-title" id="modalServicoTitle"></h5>
        </div>
        <div class="modal-body">
            <input type="hidden" name="key" id="key"/>
            @include('components.import.servico',[
                'rounded' => true
            ])
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary rounded">
            <i class="fas fa-check"></i>
            <span id="span-operaction">Cadastra</span>
          </button>
          <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">
            <i class="fas fa-times"></i>
            <span>Cancelar</span>
          </button>
        </div>
      </form>
    </div>
  </div>
