<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container mt-5">
    <h2>Reporte de Comisiones</h2>
    <br>
    <br>
    <form action="" method="post">
        <label for="desde">Desde
        <input type="date" name="desde" id="desde" class="form-control"></label>
        <label for="hasta">Hasta
        <input type="date" name="hasta" id="hasta" class="form-control"></label>
        <input type="submit" value="Filtrar" class="btn btn-primary">
    </form>
    <br>
    <?php if (isset($comisiones) && !empty($comisiones)) { ?>
    <form action="views/csv_comisiones.php" method="post">
        <input type="hidden" name="desde" value="<?php echo $_POST['desde']; ?>">
        <input type="hidden" name="hasta" value="<?php echo $_POST['hasta']; ?>">
        <input type="submit" value="Exportar a Excel" class="btn btn-success">
    </form>
    <?php } ?>
    <table class="table table-hover" id="tabla_date">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Departamento</th>
            <th scope="col">Codigo de Colaborador</th>
            <th scope="col">Nombre de Colaborador</th>
            <th scope="col">Comision</th>
            <th scope="col">Fecha de registro</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($comisiones) && !empty($comisiones)) {
                    foreach ($comisiones as $comision) { ?>
            <tr>
                <th scope="row"><?php echo $comision['id']; ?></th>
                <td><?php echo $comision['departamento']; ?></td>
                <td><?php echo $comision['codigo_colaborador']; ?></td>
                <td><?php echo $comision['nombre_colaborador']; ?></td>
                <td><?php echo $comision['comision']; ?></td>
                <td><?php echo $comision['fecha_log']; ?></td>
                <td><input type="button" value="Pass" class="btn btn-danger"> </td>
            </tr>
            <?php  }
                } else {
                    echo "No hay comisiones registradas.";
                }
                    ?>
        </tbody>
    </table>
</div>

    <!-- Modal Dinamica -->
    <div class="modal fade" id="modalDinamica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_dinamico">
                
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
