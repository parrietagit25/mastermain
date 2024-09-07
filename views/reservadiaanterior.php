<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<?php //echo $resul_api_due; ?>
<div class="container mt-5">
    <h2>Reserva del dia anterior </h2>
    <br>
    <br>
    <form action="" method="post">
        <label for="desde">Fecha
        <input type="date" name="fecha_anterior" id="desde" class="form-control"></label>
        <input type="submit" value="Filtrar" class="btn btn-primary">
    </form>
    <br>
    <?php if (isset($_POST['fecha_anterior'])) { ?>
    <form action="views/excelreservasdiaanterior.php" method="post" target="_blank">
        <input type="hidden" name="fecha_anterior_reser" value="<?php echo $_POST['fecha_anterior']; ?>">
        <input type="submit" value="Reserva del dia anterior" class="btn btn-success" name="reservadiaanterior">
    </form>
    <?php } ?>
    <div style="overflow-x: auto;">
    <table class="table table-hover" id="tabla_date">
        <thead>
            <tr>
                <th scope="col">resnumber</th>
                <th scope="col">ranumber</th>
                <th scope="col">rstat</th>
                <th scope="col">rastat</th>
                <th scope="col">customerfirstname</th>
                <th scope="col">customerlastname</th>
                <th scope="col">actdays</th>
                <th scope="col">totalestimate</th>
                <th scope="col">sourcecode</th>
                <th scope="col">referralcode</th>
                <th scope="col">company</th>
                <th scope="col">locationcodeout</th>
                <th scope="col">reservedclass</th>
                <th scope="col">invclass</th>
                <th scope="col">dateadded</th>
                <th scope="col">timeadded</th>
                <th scope="col">addedbyemployeenumber</th>
                <th scope="col">dateout</th>
                <th scope="col">ratecode</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($resul_api_diaanterior) && !empty($resul_api_diaanterior)) {
                foreach ($resul_api_diaanterior['data'] as $diaanterior) { ?>
            <tr>
                <th scope="row"><?php echo $diaanterior['resnumber']; ?></th>
                <td><?php echo $diaanterior['ranumber']; ?></td>
                <td><?php echo $diaanterior['rstat']; ?></td>
                <td><?php echo $diaanterior['rastat']; ?></td>
                <td><?php echo $diaanterior['customerfirstname']; ?></td>
                <td><?php echo $diaanterior['customerlastname']; ?></td>
                <td><?php echo $diaanterior['actdays']; ?></td>
                <td><?php echo $diaanterior['totalestimate']; ?></td>
                <td><?php echo $diaanterior['sourcecode']; ?></td>
                <td><?php echo $diaanterior['referralcode']; ?></td>
                <td><?php echo $diaanterior['company']; ?></td>
                <td><?php echo $diaanterior['locationcodeout']; ?></td>
                <td><?php echo $diaanterior['reservedclass']; ?></td>
                <td><?php echo $diaanterior['invclass']; ?></td>
                <td><?php echo $diaanterior['dateadded']; ?></td>
                <td><?php echo $diaanterior['timeadded']; ?></td>
                <td><?php echo $diaanterior['addedbyemployeenumber']; ?></td>
                <td><?php echo $diaanterior['dateout']; ?></td>
                <td><?php echo $diaanterior['ratecode']; ?></td>
            </tr>
            <?php }
            } else {
                echo "Ingrese las fechas";
            } ?>
        </tbody>
    </table>
</div>

</div>

    <!-- Modal Dinamica -->
    <div class="modal fade" id="modalDinamica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_dinamico">
                
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
