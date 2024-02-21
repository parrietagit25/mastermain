<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container">
    <h1>Bienvenido al Master Main</h1>

    <br>
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

    <?php 
    
    echo '<pre>';
    echo var_dump($jobs);
    echo '</pre>';
    
    ?>

    <!-- Modal Dinamica -->
    <div class="modal fade" id="modalDinamica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_dinamico">
                
            </div>
        </div>
    </div>


</div>
<?php include 'footer.php'; ?>