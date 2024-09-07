<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<?php //echo $resul_api_due; ?>
<div class="container mt-5">
    <h2>Reporte DueBacks</h2>
    <br>
    <br>
    <form action="" method="post">
        <label for="desde">Desde
        <input type="date" name="fecha_inicio_due" id="desde" class="form-control"></label>
        <label for="hasta">Hasta
        <input type="date" name="fecha_fin_due" id="hasta" class="form-control"></label>
        <input type="submit" value="Filtrar" class="btn btn-primary">
    </form>
    <br>
    <?php if (isset($_POST['fecha_inicio_due']) && !empty($_POST['fecha_fin_due'])) { ?>
    <form action="views/excelduebacks.php" method="post" target="_blank">
        <input type="hidden" name="fecha_inicio_due" value="<?php echo $_POST['fecha_inicio_due']; ?>">
        <input type="hidden" name="fecha_fin_due" value="<?php echo $_POST['fecha_fin_due']; ?>">
        <input type="submit" value="Reporte DueBacks" class="btn btn-success" name="dueBacks">
    </form>
    <?php } ?>
    <table class="table table-hover" id="tabla_date">
        <thead>
            <tr>
            <th scope="col">Ranumber</th>
            <th scope="col">Company</th>
            <th scope="col">LocationCodeOut</th>
            <th scope="col">LocationCodeDue</th>
            <th scope="col">CustomerFirsName</th>
            <th scope="col">CustomerLastName</th>
            <th scope="col">DateOut</th>
            <th scope="col">DateDue</th>
            <th scope="col">InvClass</th>
            <th scope="col">TotalCharges</th>
            <th scope="col">Days</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($resul_api_due) && !empty($resul_api_due)) {
                    foreach ($resul_api_due['data'] as $duebacks) { ?>
            <tr>
                <th scope="row"><?php echo $duebacks['ranumber']; ?></th>
                <td><?php echo $duebacks['company']; ?></td>
                <td><?php echo $duebacks['locationcodeout']; ?></td>
                <td><?php echo $duebacks['locationcodedue']; ?></td>
                <td><?php echo $duebacks['customerfirstname']; ?></td>
                <td><?php echo $duebacks['customerlastname']; ?></td>
                <td><?php echo $duebacks['dateout']; ?></td>
                <td><?php echo $duebacks['datedue']; ?></td>
                <td><?php echo $duebacks['invclass']; ?></td>
                <td><?php echo $duebacks['totalcharges']; ?></td>
                <td><?php echo $duebacks['days']; ?></td>
            </tr>
            <?php  }
                } else {
                    echo "Ingrese el rango de fechas";
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
