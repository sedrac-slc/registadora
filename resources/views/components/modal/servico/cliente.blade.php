<div class="modal fade" id="modalRegistar" tabindex="-1" aria-labelledby="modalRegistarTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" id="form-servico-cliente" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalRegistarTitle">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <section id="msgADD" class="d-none msg">
                <p>Tens a certeza que queres fazer a solicitação deste servico.</p>
            </section>
            <section id="msgDEL" class="d-none msg">
                <p>Tens a certeza que dsejas anular a solicitação deste servico.</p>
            </section>
            <input type="hidden" name="operation" id="operation">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Confirma</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </form>
    </div>
  </div>
