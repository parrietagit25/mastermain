<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<?php //echo $resul_api_due; ?>
<div class="container mt-5">
    <h2>Retenciones</h2>
    <br>
    <p>Seleccione un proovedor y el rango de fecha, se le enviara las retenciones al correo del proovedor.</p>
    <form action="" method="post">
        <label for="">Seleccionar Proovedor</label>
        <select name="ruc_prov" id="miSelect">
            <option value="">Seleccionar</option>
            <?php foreach ($resul_retenciones as $key => $value) { ?>
                <option value="<?php echo $value['RUC']; ?>"><?php echo $value['Proveedor'].' || '.$value['Nombre']; ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="desde">Desde
        <input type="date" name="fecha_inicio_ret" id="desde" class="form-control"></label>
        <label for="hasta">Hasta
        <input type="date" name="fecha_fin_ret" id="hasta" class="form-control"></label>
        <input type="submit" value="Filtrar" class="btn btn-primary">
    </form>
    <br>
    <?php if (isset($_POST['fecha_inicio_ret']) && !empty($_POST['fecha_fin_ret'])) { ?>
    <form action="" method="post">
        <input type="hidden" name="fecha_inicio_ret_send" value="<?php echo $_POST['fecha_inicio_ret']; ?>">
        <input type="hidden" name="fecha_fin_ret_send" value="<?php echo $_POST['fecha_fin_ret']; ?>">
        <input type="hidden" name="ruc_prov_send" value="<?php echo $_POST['ruc_prov']; ?>">
        <input type="submit" value="Enviar las Retenciones por email" class="btn btn-success" name="retenciones_enviar_mail">
    </form>
    <?php } ?>
    <?php echo $retenciones_print; ?>
    <?php echo $retenciones_enviadas; ?>
</div>

<?php include 'footer.php'; ?>
