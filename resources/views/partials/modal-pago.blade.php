<div class="modal fade" id="modal-pago" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header info-color white-text text-center py-4">
                <h5 class="modal-title" id="modal-label">
                    <b>
                        Formulario de pago
                    </b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-9">
                        <div class="md-form input-with-post-icon">
                            <i class="fa-regular fa-credit-card input-prefix"></i>
                            <label for="tarjeta">Número de tarjeta</label>
                            <input type="text" id="tarjeta" name="tarjeta" class="form-control">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="md-form">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 m-0">
                        <span><b>Vencimiento de la tarjeta</b></span>
                    </div>
                    <div class="col-6">
                        <label class="mdb-main-label" for="mes">Mes</label>
                        <select class="mdb-select md-form" id="mes" name="mes">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="mi-error"></div>
                    </div>
                    <div class="col-6">
                        <label class="mdb-main-label" for="anio">Año</label>
                        <select class="mdb-select md-form" id="anio" name="anio">
                            @for ($i = date('Y'); $i <= date('Y') + 20; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="mi-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="md-form input-with-post-icon">
                            <i class="fa-solid fa-user input-prefix"></i>
                            <label for="nombres">Nombres</label>
                            <input type="text" id="nombres" class="form-control" name="nombres">
                        </div>
                        <div class="mi-error"></div>
                    </div>
                    <div class="col-6">
                        <div class="md-form input-with-post-icon">
                            <i class="fa-solid fa-user input-prefix"></i>
                            <label for="apellidos">Apellidos</label>
                            <input type="text" id="apellidos" class="form-control" name="apellidos">
                        </div>
                        <div class="mi-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="md-form input-with-post-icon">
                            <i class="fa-regular fa-envelope input-prefix"></i>
                            <label for="email">Correo electrónico:</label>
                            <input type="email" id="email" class="form-control" name="email">
                        </div>
                        <div class="mi-error"></div>
                    </div>
                    <div class="col-6">
                        <div class="md-form input-with-post-icon">
                            <i class="fa-solid fa-mobile input-prefix"></i>
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono" class="form-control" name="telefono">
                        </div>
                        <div class="mi-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="mdb-main-label" for="region">Región</label>
                        <select class="mdb-select md-form" id="region" searchable="Buscar aquí.." required
                            name="region">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="md-form input-with-post-icon">
                            <i class="fa-solid fa-location-dot input-prefix"></i>
                            <label for="ciudad">Ciudad:</label>
                            <input type="text" id="ciudad" class="form-control" name="ciudad">
                        </div>
                        <div class="mi-error"></div>
                    </div>
                    <div class="col-4">
                        <div class="md-form">
                            <label for="cp">Código postal:</label>
                            <input type="text" id="cp" class="form-control" name="cp">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="md-form">
                            <label for="direccion">Dirección</label>
                            <textarea id="direccion" class="md-textarea form-control" rows="3" name="direccion"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span class="total" id="totalCancelar"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btn-pago">Aceptar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
