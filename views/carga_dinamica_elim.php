
<?php

/* 
1 = eliminar colaborador
*/

$modal = 1;
require_once('../controllers/ColaboradorController.php');
$colaboradorController = new ColaboradorController();

if (isset($_POST['elimnar']) && $_POST['elimnar'] == 1) { 
    
    $mostra_colab_id = $colaboradorController->get_colab_id($_POST['eli_id']);
    
    if (isset($mostra_colab_id) && !empty($mostra_colab_id)) {
        foreach ($mostra_colab_id as $colab) { ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:red;">Eliminar colaborador</h1>
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
                <label for="tipo_usuario" style="color:red;">Esta seguro que desea eliminar este colaborador?</label>
                
            </div>
        </div>
        <input type="hidden" name="stat" value="1">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-danger" name="eliminar_usuario" value="Eliminar">
            <input type="hidden" name="id_eliminar_colaborador" value="<?php echo $_POST['eli_id']; ?>">
        </div>
    </form>

    <?php 
        } 

    } ?>

<?php } ?> 