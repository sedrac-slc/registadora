<div class="row mt-1">
    <div class="col-md-12">
        @php use App\Utils\RealizacaoUtil; @endphp
        @include('components.select', [
            'label' => 'Dia semana:',
            'icon' => 'fas fa-calendar',
            'name' => 'dia_semana',
            'require' => true,
            'list' => RealizacaoUtil::diaSemana(),
            'init' => $realizacao->dia_semana ?? '',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Hora de abertura:',
            'icon' => 'fas fa-clock',
            'type' => 'time',
            'name' => 'hora_abertura',
            'placeholder' => 'Digita a hora da abertura',
            'require' => true,
            'value' => $realizacao->hora_abertura ?? old('hora_abertura'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Hora de termino:',
            'icon' => 'fas fa-clock',
            'type' => 'time',
            'name' => 'hora_termino',
            'placeholder' => 'Digita a hora da termino',
            'require' => true,
            'value' => $realizacao->hora_termino ?? old('hora_termino'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
