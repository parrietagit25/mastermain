
<?php

/* 
1 = eliminar colaborador
*/
/*
$modal = 1;
require_once('../controllers/ColaboradorController.php');
$colaboradorController = new ColaboradorController();

if (isset($_POST['pass']) && $_POST['pass'] == 1) { 
    
    $mostra_colab_id = $colaboradorController->get_colab_id($_POST['edit_pass_id']);
    
    if (isset($mostra_colab_id) && !empty($mostra_colab_id)) {
        foreach ($mostra_colab_id as $colab) {  */ ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:red;">Cambiar Pass</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="nombre">Nueva Password:</label>
                <input type="text" class="form-control" id="nombre" name="cambiar_pass" required value="">
            </div>
        </div>
        <input type="hidden" name="stat" value="1">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-danger" name="cambiar_pass_user" value="cambiar_pass">
            <input type="hidden" name="id_user_cambiar_pass" value="<?php echo $_POST['edit_pass_id']; ?>">
        </div>
    </form>

    <?php 
    /*    } 

    }*/ ?>

<?php //} ?> 