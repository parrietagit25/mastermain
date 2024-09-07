<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<?php 
require_once('controllers/UserController.php');
$jobsController = new JobsController();
?>
<div class="container">
    <h1>Bienvenido al Master Main</h1>

    <br>
    
    <?php foreach ($jobsController->jobs_list() as $key => $value) { ?>

        <?php /* if($_SESSION['tipo_usuario'] == 'rrhh'){ 
                if ($value['id'] != 1) {
                    continue;
                }
              }
              
            echo $_SESSION['user_id'].'<br>';
            echo $_SESSION['username'].'<br>';
            echo $_SESSION['tipo_usuario'].'<br>'; */ 
              
              ?>

        <?php if($_SESSION['tipo_usuario'] == 'reporteria'){ }else{ ?>

        <div class="card text-center" style="width:300px; float:left; margin:5px;">
            <div class="card-header">
                <?php echo $value['departamento']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><?php echo $value['descripcion']; ?></p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDinamica" onclick="modal_dinamica(<?php echo $value['id']; ?>)">
                    Ver
                </button>
            </div>
            <div class="card-footer text-body-secondary">
                Cantidad: 
            </div>
        </div>

        <?php } ?>

    <?php } ?>

    <?php if (!empty($listado_no_list_comi) && is_array($listado_no_list_comi)) { ?>

    <div class="container">
        <div class="card text-center" style="width:300px; float:left; margin:5px;">
            <div class="card-header" style="color:red;">
                Codigo de colaborador no registrado
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><?php print_r($listado_no_list_comi['no_listado']); ?></p>
                
            </div>
            <div class="card-footer text-body-secondary">
                Cantidad: <?php //count($listado_no_list_comi['no_listado']); ?>
            </div>
        </div>

        <div class="card text-center" style="width:300px; float:left; margin:5px;">
            <div class="card-header" style="color:red;">
                Codigos ya registrados para este mes
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><?php print_r($listado_no_list_comi['comision_existente']); ?></p>
                
            </div>
            <div class="card-footer text-body-secondary">
                Cantidad: <?php //count($listado_no_list_comi['comision_existente']); ?>
            </div>
        </div>
    </div>

    <?php } ?>

    <!-- Modal Dinamica -->
    <div class="modal fade" id="modalDinamica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_dinamico">
                
            </div>
        </div>
    </div>


</div>
<?php include 'footer.php'; ?>