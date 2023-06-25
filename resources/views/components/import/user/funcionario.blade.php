<hr/>
<div class="row">
    <div class="col-md-6">
        @php use App\Utils\FuncionarioUtil; @endphp
        @include('components.select', [
            'label' => 'Tipo:',
            'icon' => 'fas fa-list-ol',
            'name' => 'tipo',
            'placeholder' => 'Digita a tipo de funcionario:',
            'init' => $user->funcionario->tipo ?? '',
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
            'list' => FuncionarioUtil::tipos(),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
        ])
    </div>
</div>
