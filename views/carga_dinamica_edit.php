<?php
/* 
1 = Editar Colaborador
*/
$modal = 1;
require_once('../controllers/ColaboradorController.php');
$colaboradorController = new ColaboradorController();

if (isset($_POST['edit']) && $_POST['edit'] == 1) { 
    
    $mostra_colab_id = $colaboradorController->get_colab_id($_POST['id_edit']);
    
    if (isset($mostra_colab_id) && !empty($mostra_colab_id)) {
        foreach ($mostra_colab_id as $colab) {  ?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Colaborador</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label for="codigo">Codigo:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required value="<?php echo $colab['codigo']; ?>">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre completo:</label>
            <input type="text" class="form-control" id="nombre" name="nombre_completo" required value="<?php echo utf8_encode($colab['nombre_completo']); ?>">
        </div>
        <div class="form-group">
            <label for="genero">genero:</label>
            <select class="form-control" id="genero" name="genero">
                <option value="">Seleccionar</option>
                <option value="F" <?php if($colab['genero'] == 'F'){ echo 'selected'; } ?>>Femenino</option>
                <option value="M" <?php if($colab['genero'] == 'M'){ echo 'selected'; } ?>>Masculino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="departamento">Departamento:</label>
            <select class="form-control" id="departamento" name="departamento">
                <option value="">Seleccionar</option>
                    <option value="rrhh" <?php if($colab['departamento'] == 'rrhh'){ echo 'selected'; } ?>>RRHH</option>
                    <option value="contabilidad" <?php if($colab['departamento'] == 'contabilidad'){ echo 'selected'; } ?>>Contabilidad</option>
                    <option value="operaciones" <?php if($colab['departamento'] == 'operaciones'){ echo 'selected'; } ?>>Operaciones</option>
                    <option value="mercadeo" <?php if($colab['departamento'] == 'mercadeo'){ echo 'selected'; } ?>>Mercadeo</option>
                    <option value="cobros" <?php if($colab['departamento'] == 'cobros'){ echo 'selected'; } ?>>Cobros</option>
                    <option value="comercial" <?php if($colab['departamento'] == 'comercial'){ echo 'selected'; } ?>>Comercial</option>
                    <option value="mina" <?php if($colab['departamento'] == 'mina'){ echo 'selected'; } ?>>Mina</option>
                    <option value="retail" <?php if($colab['departamento'] == 'retail'){ echo 'selected'; } ?>>Retail</option>
                    <option value="ventas_autos" <?php if($colab['departamento'] == 'ventas_autos'){ echo 'selected'; } ?>>Ventas de autos</option>
                    <option value="compras" <?php if($colab['departamento'] == 'compras'){ echo 'selected'; } ?>>Compras</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="stat" value="1">
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-warning" name="editar_colaborador" value="Actualizar">
        <input type="hidden" name="id_editar_colaborador" value="<?php echo $_POST['id_edit']; ?>">
    </div>
</form>

<?php 
        } 

    } ?>

<?php } ?> 