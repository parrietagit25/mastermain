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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Centro Costo</th>
                        <th>Mantenimiento</th>
                        <th>Crecimiento</th>
                        <th>Nuevo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($gerCentroCosto as $key => $value) { ?>
                    <tr>
                        <th><?php echo $value['centroCosto']; ?></th>
                        <th><?php echo number_format($value['mantenimiento'], 4); ?></th>
                        <th><?php echo number_format($value['crecimiento'], 4); ?></th>
                        <th><?php echo number_format($value['nuevo'], 4); ?></th>
                        <th>
                            <input type="button" value="Editar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editComercial<?php echo $value['Id']; ?>"> 
                            <input type="button" value="Eliminar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#elimComercial<?php echo $value['Id']; ?>">
                        </th>
                    </tr>

                    <!-- Modal editar-->
                    <div class="modal fade" id="editComercial<?php echo $value['Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="post">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar por centro de costo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="">Centro de costo</label>
                                        <input type="text" value="<?php echo $value['centroCosto']; ?>" class="form-control" name="centroCosto">
                                        <label for="">Mantenimiento</label>
                                        <input type="text" value="<?php echo number_format($value['mantenimiento'], 4); ?>" name="mantenimiento" class="form-control">
                                        <label for="">Crecimiento</label>
                                        <input type="text" value="<?php echo number_format($value['crecimiento'], 4); ?>" name="crecimiento" class="form-control">
                                        <label for="">Nuevo</label>
                                        <input type="text" value="<?php echo number_format($value['nuevo'], 4); ?>" name="nuevo" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        <input type="hidden" name="editar_por_centro_costo" value="<?php echo $value['Id']; ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Eliminar -->
                    <div class="modal fade" id="elimComercial<?php echo $value['Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="post">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:red;">Eliminar por centro de costo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color:red;">Esta seguro que desea eliminar el registro</p>
                                        <label for="">Centro de costo</label>
                                        <input type="text" readonly value="<?php echo $value['centroCosto']; ?>" class="form-control">
                                        <label for="">Mantenimiento</label>
                                        <input type="text" readonly value="<?php echo number_format($value['mantenimiento'], 4); ?>" name="mantenimiento_cc" class="form-control">
                                        <label for="">Crecimiento</label>
                                        <input type="text" readonly value="<?php echo number_format($value['crecimiento'], 4); ?>" name="crecimiento_cc" class="form-control">
                                        <label for="">Nuevo</label>
                                        <input type="text" readonly value="<?php echo number_format($value['nuevo'], 4); ?>" name="nuevo_cc" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                        <input type="hidden" name="eliminar_por_centro_costo" value="<?php echo $value['Id']; ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Por Categoría Cliente -->
        <div class="tab-pane fade" id="categoria-cliente" role="tabpanel">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Mantenimiento</th>
                        <th>Crecimiento</th>
                        <th>Nuevo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($gerCateCliente as $key => $value) { ?>
                    <tr>
                        <th><?php echo $value['catCte']; ?></th>
                        <th><?php echo number_format($value['mantenimientocatCte'], 4); ?></th>
                        <th><?php echo number_format($value['crecimientocatCte'], 4); ?></th>
                        <th><?php echo number_format($value['NuevocatCte'], 4); ?></th>
                        <th>
                            <input type="button" value="Editar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCateClien<?php echo $value['id']; ?>"> 
                            <input type="button" value="Eliminar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#elimCateClien<?php echo $value['id']; ?>">
                        </th>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="editCateClien<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="post">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar por Categoria Cliente</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="">Cuenta</label>
                                        <input type="text" value="<?php echo $value['catCte']; ?>" class="form-control" name="catCte">
                                        <label for="">Mantenimiento</label>
                                        <input type="text" value="<?php echo number_format($value['mantenimientocatCte'], 4); ?>" name="mantenimientocatCte" class="form-control">
                                        <label for="">Crecimiento</label>
                                        <input type="text" value="<?php echo number_format($value['crecimientocatCte'], 4); ?>" name="crecimientocatCte" class="form-control">
                                        <label for="">Nuevo</label>
                                        <input type="text" value="<?php echo number_format($value['NuevocatCte'], 4); ?>" name="NuevocatCte" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        <input type="hidden" name="editar_por_cliente" value="<?php echo $value['id']; ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                     <!-- Modal Eliminar -->
                     <div class="modal fade" id="elimCateClien<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="post">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:red;">Eliminar por Categoria Cliente</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color:red;">Esta seguro que desea eliminar el registro</p>
                                        <label for="">Cuenta</label>
                                        <input type="text" readonly value="<?php echo $value['catCte']; ?>" class="form-control" name="catCte">
                                        <label for="">Mantenimiento</label>
                                        <input type="text" readonly value="<?php echo number_format($value['mantenimientocatCte'], 4); ?>" name="mantenimientocatCte" class="form-control">
                                        <label for="">Crecimiento</label>
                                        <input type="text" readonly value="<?php echo number_format($value['crecimientocatCte'], 4); ?>" name="crecimientocatCte" class="form-control">
                                        <label for="">Nuevo</label>
                                        <input type="text" readonly value="<?php echo number_format($value['NuevocatCte'], 4); ?>" name="NuevocatCte" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                        <input type="hidden" name="eliminar_por_cliente" value="<?php echo $value['id']; ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Por Tarifa Vehículo -->
        <div class="tab-pane fade" id="tarifa-vehiculo" role="tabpanel">
            <input type="button" value="Registrar Tarifa" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrar_tarifa">

            <!-- Modal -->
            <div class="modal fade" id="registrar_tarifa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar por Tarifa de Vehiculo</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Categoria</label>
                                <input type="text" value="" class="form-control" name="invclass">
                                <label for="">Tarifa</label>
                                <input type="text" value="" name="rate" class="form-control">
                                <label for="">Super Optima</label>
                                <input type="text" value="" name="superOptimal" class="form-control">
                                <label for="">Centro Costo</label>
                                <input type="text" value="" name="CentroCostos" class="form-control">
                                <label for="">Comision 1</label>
                                <input type="text" value="" class="form-control" name="payment1">
                                <label for="">Comision 2</label>
                                <input type="text" value="" name="payment2" class="form-control">
                                <label for="">Comision 3</label>
                                <input type="text" value="" name="payment3" class="form-control">
                                <label for="">Comision 4</label>
                                <input type="text" value="" name="payment4" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" name="guardar_tarifa">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-hover" id="tabla_date">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Tarifa</th>
                        <th>Super Óptima</th>
                        <th>Centro Costo</th>
                        <th>Comisión 1</th>
                        <th>Comisión 2</th>
                        <th>Comisión 3</th>
                        <th>Comisión 4</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($gerVehiculeRate as $key => $value) { ?>
                    <tr>
                        <th><?php echo $value['invclass']; ?></th>
                        <th><?php echo $value['rate']; ?></th>
                        <th><?php echo $value['superOptimal']; ?></th>
                        <th><?php echo $value['CentroCostos']; ?></th>
                        <th><?php echo $value['payment1']; ?></th>
                        <th><?php echo $value['payment2']; ?></th>
                        <th><?php echo $value['payment3']; ?></th>
                        <th><?php echo $value['payment4']; ?></th>
                        <th>
                            <input type="button" value="Editar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTariVeh<?php echo $value['id']; ?>"> 
                            <input type="button" value="Eliminar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#elimTariVeh<?php echo $value['id']; ?>">
                        </th>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="editTariVeh<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="post">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar por Tarifa de Vehiculo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="">Categoria</label>
                                        <input type="text" value="<?php echo $value['invclass']; ?>" class="form-control" name="invclass">
                                        <label for="">Tarifa</label>
                                        <input type="text" value="<?php echo $value['rate']; ?>" name="rate" class="form-control">
                                        <label for="">Super Optima</label>
                                        <input type="text" value="<?php echo $value['superOptimal']; ?>" name="superOptimal" class="form-control">
                                        <label for="">Centro Costo</label>
                                        <input type="text" value="<?php echo $value['CentroCostos']; ?>" name="CentroCostos" class="form-control">
                                        <label for="">Comision 1</label>
                                        <input type="text" value="<?php echo $value['payment1']; ?>" class="form-control" name="payment1">
                                        <label for="">Comision 2</label>
                                        <input type="text" value="<?php echo $value['payment2']; ?>" name="payment2" class="form-control">
                                        <label for="">Comision 3</label>
                                        <input type="text" value="<?php echo $value['payment3']; ?>" name="payment3" class="form-control">
                                        <label for="">Comision 4</label>
                                        <input type="text" value="<?php echo $value['payment4']; ?>" name="payment4" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        <input type="hidden" name="editar_por_tarifa" value="<?php echo $value['id']; ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                     <!-- Modal Eliminar -->
                     <div class="modal fade" id="elimTariVeh<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="post">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:red;">Eliminar por Tarifa de Vehiculo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color:red;">Esta seguro que desea eliminar el registro</p>
                                        <label for="">Categoria</label>
                                        <input type="text" readonly value="<?php echo $value['invclass']; ?>" class="form-control">
                                        <label for="">Tarifa</label>
                                        <input type="text" readonly value="<?php echo $value['rate']; ?>" name="mantenimiento_cc" class="form-control">
                                        <label for="">Super Optima</label>
                                        <input type="text" readonly value="<?php echo $value['superOptimal']; ?>" name="crecimiento_cc" class="form-control">
                                        <label for="">Centro Costo</label>
                                        <input type="text" readonly value="<?php echo $value['CentroCostos']; ?>" name="nuevo_cc" class="form-control">
                                        <label for="">Comision 1</label>
                                        <input type="text" readonly value="<?php echo $value['payment1']; ?>" class="form-control">
                                        <label for="">Comision 2</label>
                                        <input type="text" readonly value="<?php echo $value['payment2']; ?>" name="mantenimiento_cc" class="form-control">
                                        <label for="">Comision 3</label>
                                        <input type="text" readonly value="<?php echo $value['payment3']; ?>" name="crecimiento_cc" class="form-control">
                                        <label for="">Comision 4</label>
                                        <input type="text" readonly value="<?php echo $value['payment4']; ?>" name="nuevo_cc" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                        <input type="hidden" name="eliminar_por_tarifa" value="<?php echo $value['id']; ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
