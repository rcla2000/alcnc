<div class="info-solicitud">
    <span>
        <i class="fa-solid fa-id-card mr-2"></i>
        <b>DUI solicitante:</b> {{ $solicitud->usuario }}
    </span>
    <span>
        <i class="fa-solid fa-location-dot mr-2"></i>
        <b>Lugar solicitado:</b> {{ $solicitud->lugar->nombre ?? 'No especificado' }}
    </span>
    <span>
        <i class="fa-regular fa-calendar-days mr-2"></i>
        <b>Fecha de evento:</b>
        {{ date_format(date_create($solicitud->fecha_evento), 'd-m-Y') }}
    </span>
    @if ($solicitud->sillas !== null)
        <span>
            <i class="fa-regular fa-circle-dot mr-2"></i>
            <b>Sillas solicitadas:</b> {{ $solicitud->sillas }}
        </span>
    @endif
    @if ($solicitud->mesas !== null)
        <span>
            <i class="fa-regular fa-circle-dot mr-2"></i>
            <b>Mesas solicitadas:</b> {{ $solicitud->mesas }}
        </span>
    @endif
    @if ($solicitud->canopis !== null)
        <span>
            <i class="fa-regular fa-circle-dot mr-2"></i>
            <b>Canopis solicitados:</b> {{ $solicitud->canopis }}
        </span>
    @endif
    <span>
        <i class="fa-regular fa-calendar-days mr-2"></i>
        <b>Fecha en que se realizó la solicitud:</b>
        {{ date_format(date_create($solicitud->fecha_solicitud), 'd-m-Y') }}
    </span>
    <span>
        <i class="fa-solid fa-circle-info mr-2"></i>
        <b>Estado:</b>
        <span class="estado-solicitud estado-solicitud-{{ $solicitud->estado_solicitud->id_estado }}">
            {{ $solicitud->estado_solicitud->desc_estado }}
        </span>
    </span>
    <span>
        <i class="fa-regular fa-calendar-days mr-2"></i>
        <b>Fecha de actualización:</b>
        {{ date_format(date_create($solicitud->fecha_actualización), 'd-m-Y') }}
    </span>
    <span>
        <i class="fa-regular fa-file-lines mr-2"></i>
        <b>Comentarios:</b>
        {{ $solicitud->comentarios }}
    </span>
</div>
