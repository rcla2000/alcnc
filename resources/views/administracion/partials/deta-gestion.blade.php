<div class="row">
    <div class="col-md-12">
        <h4>Fecha de ingreso de solicitud: <strong>{{ date('d/m/Y', strtotime($solicitud->fecha_solicitud)) }}
            </strong></h4>
        <hr>
    </div>
    <div class="col-md-12">
        <h5><u> <strong> Información de solicitante </strong></u></h5>
    </div>
    <div class="col-md-7">
        Nombre del solicitante: <strong>{{ $solicitud->nombre }} </strong>
    </div>
    <div class="col-md-5">
        DUI del solicitante: <strong>{{ $solicitud->dui }} </strong>
    </div>
    <div class="col-md-12 mt-3">
        <h5><u> <strong>Información de solicitud </strong></u></h5>
    </div>
    <div class="col-md-7">
        Solicitud: <strong>{{ $solicitud->solicitud }} </strong>
    </div>
    <div class="col-md-3">
        Cantidad solicitada: <strong>{{ $solicitud->cantidad }} </strong>
    </div>
    <div class="col-md-7">
        Nombre en el documento: <strong>{{ $solicitud->nombre_documento }} </strong>
    </div>
    <div class="col-md-7">
        Fecha de partida o documento: <strong>{{ date('d/m/Y', strtotime($solicitud->fecha_documento)) }} </strong>
    </div>

    <div class="col-md-3">
        Autentica:
        @if($solicitud->autentica == 0)
            <strong>No</strong>
        @else
            <strong>Si</strong>
        @endif
    </div>
    <div class="col-md-7">
        Comentario:
        @if ($solicitud->comentario == null)
            <strong>Ninguno</strong>
        @else
            <strong> {{ $solicitud->comentario }}</strong>
        @endif
    </div>
    <div class="col-md-5">
        Fecha de resolución: <strong>
            @if ($solicitud->fecha_resolucion == null)
                <strong>Sin resolución</strong>
            @else
                <strong> {{ $solicitud->fecha_resolucion }}</strong>
            @endif
        </strong>
    </div>

    <div class="col-md-12">
        <hr>
        Última actualizacion: <strong>
            @if ($solicitud->fecha_actualizacion == null)
                Sin actualizaciones
            @else
                {{ date('d/m/Y', strtotime($solicitud->fecha_actualizacion)) }}
            @endif
        </strong>
    </div>
    <div class="col-md-12">
        Usuario que actualizo: <strong>
            @if ($solicitud->usuario_actualizacion == null)
                Sin actualizaciones
            @else
                {{ $solicitud->usuario_actualizacion }}
            @endif
        </strong>
    </div>
    <div class="col-md-12">
        Área responsable: <strong>{{ $solicitud->area }}</strong>
    </div>
    <div class="col-md-6">
        Dirección responsable: <strong>{{ $solicitud->direccion }}</strong>
    </div>
</div>
