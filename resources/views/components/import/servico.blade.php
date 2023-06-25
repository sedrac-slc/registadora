<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Nome:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'nome',
            'placeholder' => 'Digita o nome do servico',
            'require' => true,
            'value' => $servico->nome ?? old('nome'),
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Preço:',
            'icon' => 'fas fa-money-bill',
            'type' => 'number',
            'name' => 'preco',
            'placeholder' => 'Digita o preço do servico',
            'require' => true,
            'value' => $servico->preco ?? old('preco'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-12">
        @include('components.textaria', [
            'label' => 'Faça uma descrição:',
            'icon' => 'fas fa-comment',
            'type' => 'text',
            'name' => 'descricao',
            'placeholder' => 'Escreva uma descrição curta',
            'require' => true,
            'value' => $servico->descricao ?? old('descricao'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
            'rows' => 3,
        ])
    </div>
</div>
