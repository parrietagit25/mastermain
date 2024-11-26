<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<div class="container mt-4">
    <h2 class="text-center">COMERCIAL</h2>
    <h2 class="text-center">Configuración Comisiones Corp.</h2>

    <ul class="nav nav-tabs mt-4" id="tabConfig" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="centro-costo-tab" data-bs-toggle="tab" data-bs-target="#centro-costo" type="button" role="tab">Por Centro Costo</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="categoria-cliente-tab" data-bs-toggle="tab" data-bs-target="#categoria-cliente" type="button" role="tab">Por Categoría Cliente</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tarifa-vehiculo-tab" data-bs-toggle="tab" data-bs-target="#tarifa-vehiculo" type="button" role="tab">Por Tarifa Vehículo</button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="tabContentConfig">
        <!-- Por Centro Costo -->
        <div class="tab-pane fade show active" id="centro-costo" role="tabpanel">
            <form>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="centroCosto" class="form-label">Centro Costo:</label>
                        <select id="centroCosto" class="form-select">
                            <option>Seleccione...</option>
                            <?php foreach ($gerCentroCosto as $key => $value) { ?>
                            <option value="<?php echo $value['Id']; ?>"><?php echo $value['centroCosto']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="mantenimiento" class="form-label">Mantenimiento %:</label>
                        <input type="text" id="mantenimiento" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="crecimiento" class="form-label">Crecimiento %:</label>
                        <input type="text" id="crecimiento" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="nuevo" class="form-label">Nuevo %:</label>
                        <input type="text" id="nuevo" class="form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100">Continuar</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Centro Costo</th>
                        <th>Mantenimiento</th>
                        <th>Crecimiento</th>
                        <th>Nuevo</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos dinámicos -->
                </tbody>
            </table>
        </div>

        <!-- Por Categoría Cliente -->
        <div class="tab-pane fade" id="categoria-cliente" role="tabpanel">
            <form>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="cuenta" class="form-label">Cuenta:</label>
                        <select id="cuenta" class="form-select">
                            <option>Seleccione...</option>
                            <!-- Opciones dinámicas -->
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="mantenimientoCliente" class="form-label">Mantenimiento %:</label>
                        <input type="text" id="mantenimientoCliente" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="crecimientoCliente" class="form-label">Crecimiento %:</label>
                        <input type="text" id="crecimientoCliente" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="nuevoCliente" class="form-label">Nuevo %:</label>
                        <input type="text" id="nuevoCliente" class="form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100">Continuar</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Mantenimiento</th>
                        <th>Crecimiento</th>
                        <th>Nuevo</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos dinámicos -->
                </tbody>
            </table>
        </div>

        <!-- Por Tarifa Vehículo -->
        <div class="tab-pane fade" id="tarifa-vehiculo" role="tabpanel">
            <form>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="categoria" class="form-label">Categoría:</label>
                        <select id="categoria" class="form-select">
                            <option>Seleccione...</option>
                            <!-- Opciones dinámicas -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="centroCostoVehiculo" class="form-label">Centro Costo:</label>
                        <select id="centroCostoVehiculo" class="form-select">
                            <option>Seleccione...</option>
                            <!-- Opciones dinámicas -->
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100">Buscar</button>
                        <button type="button" class="btn btn-secondary w-100 ms-2">Crear Tarifa</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Tarifa</th>
                        <th>Super Óptima</th>
                        <th>Centro Costo</th>
                        <th>Comisión 1</th>
                        <th>Comisión 2</th>
                        <th>Comisión 3</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos dinámicos -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
