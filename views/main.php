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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#miModalDinamico">
                Ver
            </button>
        </div>
        <div class="card-footer text-body-secondary">
            Cantidad: 
        </div>
    </div>

    <!-- Modal Dinamica -->
    <div class="modal fade" id="miModalDinamico" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Título Dinámico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- El contenido dinámico se cargará aquí -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


</div>
<?php include 'footer.php'; ?>