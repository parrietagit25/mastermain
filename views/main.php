<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container">
    <h1>Bienvenido al Master Main</h1>

    <br>
    <?php /* while ($listado_jobs = $jobs -> FETCH_ASSOC()) { ?>
        <div class="container" style="border: solid 1px black">
            <h2><?php echo $listado_jobs['titulo']; ?></h2>
            <form action="" method="post" enctype="multipart/form-data" >
                <div>
                    <label for="fileUpload"><?php echo $listado_jobs['descripcion']; ?></label>
                </div>
            </form>
            <br>
            <form action="" method="post">
                <button type="submit" class="btn btn-primary" name="separar">Acciones</button>
            </form>
        </div>
    <?php } */ /* ?>
    <!--<div class="container" style="border: solid 1px black">
        <h2>Separacion de Facturas</h2>
        <form action="" method="post" enctype="multipart/form-data" >
            <div>
                <label for="fileUpload">Seleccionar archivos (.rar, .zip):</label>
                <input type="file" name="files[]" id="fileUpload" multiple="multiple" accept=".rar,.zip">
                <input type="hidden" name="casio" value="aaaaa">
            </div>
            <button type="submit">Subir Archivos</button>
        </form>
        <br>
        <form action="" method="post">
            <button type="submit" class="btn btn-primary" name="separar">Separar</button>
        </form>
    </div> -->

    <div class="card text-center" style="width:300px; float:left; margin:5px;">
        <div class="card-header">
            Separacion de Facturas
        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">Seleccionar archivos (.rar, .zip):</p>
            <a href="#" class="btn btn-primary">Subir</a>
        </div>
        <div class="card-footer text-body-secondary">
            Separar: 
        </div>
    </div>

    <div class="card text-center" style="width:300px; float:left; margin:5px;">
        <div class="card-header">
            Operaciones
        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">Listado de placas con datos faltantes.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDinamica" onclick="modal_dinamica()">
                Ver
            </button>
        </div>
        <div class="card-footer text-body-secondary">
            Cantidad: 
        </div>
    </div>

    <?php */ /* $jobsController
    
    echo '<pre>';
    echo var_dump($jobs);
    echo '</pre>'; */
    ?>

    <?php foreach ($jobsController->jobs_list() as $key => $value) { ?>

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