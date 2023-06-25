<div class="modal fade" id="modalServicoJoin" tabindex="-1" aria-labelledby="modalServicoJoinTitle" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="modal-content" id="form-servico-cliente" action="#" method="POST">
            @csrf
            @method('POST')
            <div class="modal-header">
                <h5 class="modal-title" id="modalServicoJoinTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="pb-3">
                    @include('components.input', [
                        'label' => 'Cliente:',
                        'icon' => 'fas fa-signature',
                        'type' => 'text',
                        'name' => 'name_user',
                        'placeholder' => 'Digita o servico',
                        'inline' => $inline ?? false,
                        'readonly' => true,
                    ])
                </div>
                <div id="panelInput">
                    @include('components.input', [
                        'label' => 'Servico:',
                        'icon' => 'fas fa-tools',
                        'type' => 'text',
                        'name' => 'name_service',
                        'placeholder' => 'Digita o servico',
                        'inline' => $inline ?? false,
                        'disabled' => $disabled ?? false,
                    ])
                </div>
                <div id="panelTable" class="table-responsive"></div>
                <input type="hidden" name="operation" id="operation-service" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn-action-service">Confirma</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>
