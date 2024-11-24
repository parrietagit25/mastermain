<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<?php //echo $resul_api_due; ?>
<div class="container mt-5">
    <h2>Reporte de comisiones Corp</h2>
    <br>
    <br>
    <form action="" method="post">
        <label for="desde">Desde
        <input type="date" name="fecha_inicio_corp" id="desde" class="form-control"></label>
        <label for="hasta">Hasta
        <input type="date" name="fecha_fin_corp" id="hasta" class="form-control"></label>
        <input type="submit" value="Filtrar" class="btn btn-primary">
    </form>
    <br>
    <?php if (isset($_POST['fecha_inicio_corp']) && !empty($_POST['fecha_fin_corp'])) { ?>
    <form action="views/excelreporcorp.php" method="post" target="_blank">
        <input type="hidden" name="fecha_inicio_corp" value="<?php echo $_POST['fecha_inicio_corp']; ?>">
        <input type="hidden" name="fecha_fin_corp" value="<?php echo $_POST['fecha_fin_corp']; ?>">
        <input type="submit" value="Exportar a Excel" class="btn btn-success" name="dueBacks">
    </form>
    <?php } ?>
    <div class="table-responsive">
        <table class="table table-hover" id="tabla_date">
            <thead>
                <tr>
                    <th scope="col">Commonid</th>
                    <th scope="col">resnumber</th>
                    <th scope="col">ranumber</th>
                    <th scope="col">Company</th>
                    <th scope="col">name</th>
                    <th scope="col">customerfirstname</th>
                    <th scope="col">customerlastname</th>
                    <th scope="col">invclass</th>
                    <th scope="col">DateOut</th>
                    <th scope="col">DateDue</th>
                    <th scope="col">totalestimate</th>
                    <th scope="col">totalcharges</th>
                    <th scope="col">insuredname</th>
                    <th scope="col">verifiedby</th>
                    <th scope="col">rctotal</th>
                    <th scope="col">totcharge</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($resul_api_corp) && !empty($resul_api_corp)) {
                        foreach ($resul_api_corp as $corp_rep) { ?>
                <tr>
                    <th scope="row"><?php echo $corp_rep['commonid']; ?></th>
                    <td><?php echo $corp_rep['resnumber']; ?></td>
                    <td><?php echo $corp_rep['ranumber']; ?></td>
                    <td><?php echo $corp_rep['company']; ?></td>
                    <td><?php echo $corp_rep['name']; ?></td>
                    <td><?php echo $corp_rep['customerfirstname']; ?></td>
                    <td><?php echo $corp_rep['customerlastname']; ?></td>
                    <td><?php echo $corp_rep['invclass']; ?></td>
                    <td><?php echo $corp_rep['dateout']; ?></td>
                    <td><?php echo $corp_rep['datedue']; ?></td>
                    <td><?php echo $corp_rep['totalestimate']; ?></td>
                    <td><?php echo $corp_rep['totalcharges']; ?></td>
                    <td><?php echo $corp_rep['insuredname']; ?></td>
                    <td><?php echo $corp_rep['verifiedby']; ?></td>
                    <td><?php echo $corp_rep['rctotal']; ?></td>
                    <td><?php echo $corp_rep['totcharge']; ?></td>
                </tr>
                <?php  }
                    } else {
                        echo "Ingrese el rango de fechas";
                    }
                        ?>
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
