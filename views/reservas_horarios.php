<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container mt-5">
    <h2>Horarios reporte de reservas </h2>
    <br>

    <?php if (isset($_GET['msg'])): ?>
        <?php if ($_GET['msg'] === 'success'): ?>
            <div class="alert alert-success">Archivo subido y cargado exitosamente.</div>
        <?php elseif ($_GET['msg'] === 'error'): ?>
            <div class="alert alert-danger">Hubo un error al procesar el archivo Excel.</div>
        <?php endif; ?>
    <?php endif; ?>

    <br>
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalSubirExcel">
        Subir archivo Excel
    </button>
    <table class="table table-hover" id="tabla_jornada">
    <thead>
        <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Condición Laboral</th>
            <th scope="col">Inicio Jornada</th>
            <th scope="col">Final Jornada</th>
            <th scope="col">Condición 2</th>
            <th scope="col">Inicio Fuera S1</th>
            <th scope="col">Final Fuera S1</th>
            <th scope="col">Inicio Fuera S2</th>
            <th scope="col">Final Fuera S2</th>
            <th scope="col">Condición 1</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($jornadas) && !empty($jornadas)) {
            foreach ($jornadas as $jornada) { ?>
                <tr>
                    <td><?php echo $jornada['Fecha']; ?></td>
                    <td><?php echo $jornada['CondicionLaboral']; ?></td>
                    <td><?php echo $jornada['InicioJornada']; ?></td>
                    <td><?php echo $jornada['FinalJornada']; ?></td>
                    <td><?php echo $jornada['Condicion2']; ?></td>
                    <td><?php echo $jornada['InicioFueraS1']; ?></td>
                    <td><?php echo $jornada['FinalFueraS1']; ?></td>
                    <td><?php echo $jornada['InicioFueraS2']; ?></td>
                    <td><?php echo $jornada['FinalFueraS2']; ?></td>
                    <td><?php echo $jornada['Condicion1']; ?></td>
                </tr>
        <?php }
        } else {
            echo "<tr><td colspan='10'>No hay jornadas registradas.</td></tr>";
        } ?>
    </tbody>
</table>

</div>

<!-- Modal para subir Excel -->
<div class="modal fade" id="modalSubirExcel" tabindex="-1" aria-labelledby="modalSubirExcelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSubirExcelLabel">Subir archivo Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="archivo_excel" class="form-label">Seleccione el archivo Excel</label>
            <input type="file" class="form-control" name="archivo_excel" accept=".xlsx" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Subir y cargar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
