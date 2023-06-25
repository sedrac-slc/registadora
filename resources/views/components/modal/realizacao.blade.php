<div class="modal fade m-2 p-1" id="modalRealizacao" tabindex="-1" aria-labelledby="modalRealizacaoTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <form id="form-realizacao" class="modal-content bg-white rounded" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="modalRealizacaoTitle"></h5>
        </div>
        <div class="modal-body">
            <input type="hidden" name="key" id="key"/>
            <section id="form-component">
                @include('components.import.realizacao')
            </section>
            <section id="table-component">

            </section>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary rounded" id="btn-action">
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
