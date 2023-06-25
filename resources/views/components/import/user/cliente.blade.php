<hr/>
<div class="row">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Quantidade de serviço:',
            'icon' => 'fas fa-tools',
            'type' => 'number',
            'name' => 'quantidade_servico',
            'placeholder' => 'Digita a quantidade de serviço',
            'value' => $user->cliente->quantidade_servico ?? '',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
