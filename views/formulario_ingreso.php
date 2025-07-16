<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container mt-4">
    <h3>Registro de Colaboradores</h3>

    <!-- Botón para abrir el modal de registro -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistro">
        Registrar Colaborador
    </button>

    <br><br>

    <!-- Tabla de colaboradores -->
    <table class="table table-bordered" id="tabla_date">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Código</th>
                <th>Departamento</th>
                <th>Empresa</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_ingresos as $colab): ?>
            <tr>
                <td><?= $colab['Nombres'] ?></td>
                <td><?= $colab['Apellidos'] ?></td>
                <td><?= $colab['NroEmpleado'] ?></td>
                <td><?= $colab['Departamentos'] ?></td>
                <td><?php if($colab['Empresa'] == 1){ echo 'PANAMA CAR RENTAL S.A.'; }elseif($colab['Empresa'] == 7) { echo 'PANARENTING S.A.'; } ?></td>
                <td>
                    <button class="btn btn-primary btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalEditar<?php echo $colab['NroEmpleado']; ?>">
                        Editar
                    </button>

                    <!-- Modal Editar -->
                    <div class="modal fade" id="modalEditar<?= $colab['NroEmpleado'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <form action="" method="POST" class="modal-content">
                            <input type="hidden" name="NroEmpleado" value="<?= $colab['NroEmpleado'] ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Colaborador</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>

                            <div class="modal-body row g-3">

                                <!-- Datos personales -->
                                <div class="col-md-6">
                                    <label>Nombres</label>
                                    <input type="text" class="form-control" name="Nombres" value="<?= $colab['Nombres'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" name="Apellidos" value="<?= $colab['Apellidos'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label>Departamento</label>
                                    <select class="form-select" name="Departamentos" required>
                                        <?php foreach ($all_departament as $d): ?>
                                        <option value="<?= $d['Departamento'] ?>" <?= $colab['Departamentos'] == $d['Departamento'] ? 'selected' : '' ?>>
                                            <?= $d['Departamento'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Puesto</label>
                                    <select class="form-select" name="Puesto">
                                        <?php foreach ($all_puesto as $c): ?>
                                        <option value="<?= $c['Cargo'] ?>" <?= $colab['Puesto'] == $c['Cargo'] ? 'selected' : '' ?>>
                                            <?= $c['Cargo'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Acción</label>
                                    <select class="form-select" name="Accion">
                                        <?php foreach ($all_accion as $a): ?>
                                        <option value="<?= $a['Accion'] ?>" <?= $colab['Accion'] == $a['Accion'] ? 'selected' : '' ?>>
                                            <?= $a['Accion'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Empresa</label>
                                    <select class="form-select" name="Empresa">
                                        <?php foreach ($all_empresa as $e): ?>
                                        <option value="<?= $e['Empresa'] ?>" <?= $colab['Empresa'] == $e['Empresa'] ? 'selected' : '' ?>>
                                            <?= $e['Nombre'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Sucursal</label>
                                    <select class="form-select" name="Sucursal">
                                        <?php foreach ($all_sucursal as $s): ?>
                                        <option value="<?= $s['Sucursal'] ?>" <?= $colab['Sucursal'] == $s['Sucursal'] ? 'selected' : '' ?>>
                                            <?= $s['Nombre'] ?> - <?= $s['Ubicacion'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Ubicación</label>
                                    <input type="text" class="form-control" name="Ubicacion" value="<?= $colab['Ubicacion'] ?>">
                                </div>

                                <div class="col-md-6">
                                    <label>Jefe Inmediato</label>
                                    <select class="form-select" name="JefeInmediato">
                                        <?php foreach ($all_boss as $j): ?>
                                        <option value="<?= $j['correo'] ?>" <?= $colab['JefeInmediato'] == $j['correo'] ? 'selected' : '' ?>>
                                            <?= $j['correo'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Fechas -->
                                <div class="col-md-6">
                                    <label>Fecha Inicio</label>
                                    <input type="date" class="form-control" name="FechaInicio" value="<?= date('Y-m-d', strtotime($colab['FechaInicio'])) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Fecha Fin</label>
                                    <input type="date" class="form-control" name="FechaFin" value="<?= date('Y-m-d', strtotime($colab['FechaFin'])) ?>">
                                </div>

                                <!-- Checkboxes -->
                                <?php
                                $campos_bit = [
                                'Sofware' => 'Software',
                                'sofware1' => 'Software 1',
                                'Sofware2' => 'Software 2',
                                'Sofware3' => 'Software 3',
                                'Office365' => 'Office 365',
                                'PowerBI' => 'Power BI',
                                'correopublicoweb' => 'Correo Público Web',
                                'ListaCorreo' => 'Lista de Correo',
                                'GrupodeTeam' => 'Grupo de Teams',
                                'Hadware' => 'Hardware',
                                'Laptop' => 'Laptop',
                                'Cargador' => 'Cargador',
                                'Surface' => 'Surface',
                                'Tablet' => 'Tablet',
                                'Celular' => 'Celular',
                                'Pantalla' => 'Pantalla',
                                'RedesSociales' => 'Redes Sociales',
                                'RedesSocial1' => 'Red Social 1',
                                'RedesSocial2' => 'Red Social 2',
                                'RedesSocial3' => 'Red Social 3',
                                'Youtube' => 'Youtube',
                                'SharePoint' => 'SharePoint'
                                ];
                                foreach ($campos_bit as $campo => $label): ?>
                                <div class="col-md-4">
                                    <input type="hidden" name="<?= $campo ?>" value="0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="<?= $campo ?>" value="1" id="chk<?= $campo ?>_edit<?= $colab['NroEmpleado'] ?>" <?= $colab[$campo] ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="chk<?= $campo ?>_edit<?= $colab['NroEmpleado'] ?>"><?= $label ?></label>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                                <!-- Otros campos -->
                                <div class="col-md-12"><label>Otros Software</label><input type="text" name="OtrosSofware" class="form-control" value="<?= $colab['OtrosSofware'] ?>"></div>
                                <div class="col-md-6"><label>Correo</label><input type="email" name="correo" class="form-control" value="<?= $colab['correo'] ?>"></div>
                                <div class="col-md-6"><label>Dominio</label>
                                    <select class="form-select" name="Dominio">
                                        <?php foreach ($all_domain as $d): ?>
                                        <option value="<?= $d['Dominio'] ?>" <?= $colab['Dominio'] == $d['Dominio'] ? 'selected' : '' ?>><?= $d['Dominio'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6"><label>VPN</label><input type="text" name="VPN" class="form-control" value="<?= $colab['VPN'] ?>"></div>
                                <div class="col-md-6"><label>Nombre Lista</label><input type="text" name="NameListaCorreo" class="form-control" value="<?= $colab['NameListaCorreo'] ?>"></div>
                                <div class="col-md-6"><label>Nombre Grupo Teams</label><input type="text" name="NameGrupoTeam" class="form-control" value="<?= $colab['NameGrupoTeam'] ?>"></div>
                                <div class="col-md-6"><label>Otros Hardware</label><input type="text" name="Otroshadware" class="form-control" value="<?= $colab['Otroshadware'] ?>"></div>
                                <div class="col-md-6"><label>Otra Red Social</label><input type="text" name="OtraRedesSocial" class="form-control" value="<?= $colab['OtraRedesSocial'] ?>"></div>
                                <div class="col-md-6"><label>Otros Comentarios</label><textarea name="OtrosComentarios" class="form-control"><?= $colab['OtrosComentarios'] ?></textarea></div>
                                <div class="col-md-6"><label>Fecha de Sincronización</label><input type="datetime-local" name="FechaSincro" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($colab['FechaSincro'])) ?>"></div>

                                <div class="col-md-6">
                                    <label>Estatus</label>
                                    <select class="form-select" name="Estatus">
                                        <?php foreach ($all_estatus as $e): ?>
                                        <option value="<?= $e['Estatus'] ?>" <?= $colab['Estatus'] == $e['Estatus'] ? 'selected' : '' ?>>
                                            <?= $e['Estatus'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="actualizar_ingreso">Guardar Cambios</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                            </form>
                        </div>
                    </div>


                    <button class="btn btn-danger btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalEliminar<?php echo $colab['NroEmpleado']; ?>">
                        Eliminar
                    </button>

                    <!-- Modal Eliminar -->
                    <div class="modal fade" id="modalEliminar<?php echo $colab['NroEmpleado']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="" method="POST" class="modal-content">
                            <input type="hidden" name="NroEmpleado" value="<?= $colab['NroEmpleado'] ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Eliminar Colaborador</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro que deseas eliminar al colaborador <strong><?= $colab['Nombres'] . ' ' . $colab['Apellidos'] ?></strong>?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                            </form>
                        </div>
                    </div>

                    <button class="btn btn-success btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalEnviarEmail<?php echo $colab['NroEmpleado']; ?>">
                        Enviar Email
                    </button>

                    <!-- Modal enviar email -->
                    <div class="modal fade" id="modalEnviarEmail<?php echo $colab['NroEmpleado']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="" method="POST" class="modal-content">
                            <input type="hidden" name="NroEmpleado" value="<?= $colab['NroEmpleado'] ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Envia los datos del Colaborador</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro que deseas enviar los datos del colaborador <strong><?= $colab['Nombres'] . ' ' . $colab['Apellidos'] ?></strong>?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="enviar_correo_tabla">Sí, enviar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                            </form>
                        </div>
                    </div>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<!-- Registrar Colaborador -->
<div class="modal fade" id="modalRegistro" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registrar Colaborador</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body row g-3">

        <!-- Datos personales -->
        <div class="col-md-6">
            <label>Nombres</label>
            <input type="text" class="form-control" name="Nombres" required>
        </div>
        <div class="col-md-6">
            <label>Apellidos</label>
            <input type="text" class="form-control" name="Apellidos" required>
        </div>
        <div class="col-md-6">
            <label>Código Empleado</label>
            <input type="text" class="form-control" name="NroEmpleado" required>
        </div>

        <!-- Organización -->
        <div class="col-md-6">
            <label>Departamento</label>
            <select class="form-select" name="Departamentos" required>
                <option value="">Seleccionar</option>
                <?php foreach ($all_departament as $d): ?>
                <option value="<?= $d['Departamento'] ?>"><?= $d['Departamento'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label>Puesto</label>
            <select class="form-select" name="Puesto">
                <option value="">Seleccionar</option>
                <?php foreach ($all_puesto as $c): ?>
                <option value="<?= $c['Cargo'] ?>"><?= $c['Cargo'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label>Acción</label>
            <select class="form-select" name="Accion">
                <option value="">Seleccionar</option>
                <?php foreach ($all_accion as $a): ?>
                <option value="<?= $a['Accion'] ?>"><?= $a['Accion'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label>Empresa</label>
            <select class="form-select" name="Empresa">
                <option value="">Seleccionar</option>
                <?php foreach ($all_empresa as $e): ?>
                <option value="<?= $e['Empresa'] ?>"><?= $e['Nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label>Sucursal</label>
            <select class="form-select" name="Sucursal">
                <option value="">Seleccionar</option>
                <?php foreach ($all_sucursal as $s): ?>
                <option value="<?= $s['Sucursal'] ?>"><?= $s['Nombre'] ?> - <?= $s['Ubicacion'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label>Ubicación</label>
            <input type="text" class="form-control" name="Ubicacion">
        </div>
        <div class="col-md-6">
            <label>Jefe Inmediato</label>
            <select class="form-select" name="JefeInmediato">
                <option value="">Seleccionar</option>
                <?php foreach ($all_boss as $j): ?>
                <option value="<?= $j['correo'] ?>"><?= $j['correo'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Fechas -->
        <div class="col-md-6">
            <label>Fecha Inicio</label>
            <input type="date" class="form-control" name="FechaInicio">
        </div>
        <div class="col-md-6">
            <label>Fecha Fin</label>
            <input type="date" class="form-control" name="FechaFin">
        </div>

        <!-- Software (checkboxes) -->
        <?php
        $campos_bit = [
          'Sofware' => 'Software',
          'sofware1' => 'Software 1',
          'Sofware2' => 'Software 2',
          'Sofware3' => 'Software 3',
          'Office365' => 'Office 365',
          'PowerBI' => 'Power BI',
          'correopublicoweb' => 'Correo Público Web',
          'ListaCorreo' => 'Lista de Correo',
          'GrupodeTeam' => 'Grupo de Teams',
          'Hadware' => 'Hardware',
          'Laptop' => 'Laptop',
          'Cargador' => 'Cargador',
          'Surface' => 'Surface',
          'Tablet' => 'Tablet',
          'Celular' => 'Celular',
          'Pantalla' => 'Pantalla',
          'RedesSociales' => 'Redes Sociales',
          'RedesSocial1' => 'Red Social 1',
          'RedesSocial2' => 'Red Social 2',
          'RedesSocial3' => 'Red Social 3',
          'Youtube' => 'Youtube',
          'SharePoint' => 'SharePoint'
        ];
        ?>

        <?php foreach ($campos_bit as $campo => $label): ?>
        <div class="col-md-4">
            <input type="hidden" name="<?= $campo ?>" value="0">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="<?= $campo ?>" value="1" id="chk<?= $campo ?>">
                <label class="form-check-label" for="chk<?= $campo ?>"><?= $label ?></label>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Otros campos -->
        <div class="col-md-12"><label>Otros Software</label><input type="text" name="OtrosSofware" class="form-control"></div>
        <div class="col-md-6"><label>Correo</label><input type="email" name="correo" class="form-control"></div>
        <div class="col-md-6"><label>Dominio</label>
            <select class="form-select" name="Dominio">
                <option value="">Seleccionar</option>
                <?php foreach ($all_domain as $d): ?>
                <option value="<?= $d['Dominio'] ?>"><?= $d['Dominio'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6"><label>VPN</label><input type="text" name="VPN" class="form-control"></div>
        <div class="col-md-6"><label>Nombre Lista</label><input type="text" name="NameListaCorreo" class="form-control"></div>
        <div class="col-md-6"><label>Nombre Grupo Teams</label><input type="text" name="NameGrupoTeam" class="form-control"></div>
        <div class="col-md-6"><label>Otros Hardware</label><input type="text" name="Otroshadware" class="form-control"></div>
        <div class="col-md-6"><label>Otra Red Social</label><input type="text" name="OtraRedesSocial" class="form-control"></div>
        <div class="col-md-6"><label>Otros Comentarios</label><textarea name="OtrosComentarios" class="form-control"></textarea></div>
        <!--<div class="col-md-6"><label>Usuario</label><input type="text" name="Usuario" class="form-control"></div>-->
        <div class="col-md-6"><label>Fecha de Sincronización</label><input type="datetime-local" name="FechaSincro" class="form-control"></div>

        <!-- Estatus -->
        <!--<div class="col-md-6">
            <label>Estatus</label>
            <select class="form-select" name="Estatus">
                <option value="">Seleccionar</option>
                <?php foreach ($all_estatus as $e): ?>
                <option value="<?= $e['Estatus'] ?>"><?= $e['Estatus'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>-->

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="guardar_ingreso">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>



<?php include 'footer.php'; ?>