<div class="row mt-4 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Gestionar solicitud</h5>
                <hr>
                <form method="POST" id="frm-solicitud" action="{{ route($ruta, $solicitud->id_solicitud) }}">
                    @csrf
                    <div class="form-group">
                        <select class="mdb-select md-form" name="estado">
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id_estado }}" @if($estado->id_estado == $solicitud->estado) selected @endif>{{ $estado->desc_estado }}</option>
                            @endforeach
                        </select>
                        <label class="mdb-main-label">Establecer estado de solicitud</label>
                    </div>
                    <div class="md-form mt-3">
                        <label for="comentarios">Escribir algún comentario u observación:</label>
                        <textarea 
                            id="comentarios" 
                            name="comentarios" 
                            class="md-textarea form-control @error('comentarios') is-invalid @enderror" rows="3">{{ old('comentarios') }}</textarea>
                        <div class="invalid-feedback">
                            @error('comentarios') {{ $message }} @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                        Guardar cambios
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>