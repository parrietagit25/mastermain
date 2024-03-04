
<?php

/* 
1 = Comisiones RRHH
*/

if (isset($_POST['jobs']) && $_POST['jobs'] == 1) {  ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Subir Comisiones</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <p>El archivo .xlsx debe tener el siguiente formato <a href="excel/muestras/MUESTRA_COMISIONES.xlsx">Formato Correccto</a></p>
        Carga las comisiones
        <input type="file" name="comisiones_file" id="" class="form-control">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="subir_comision_colaborador" value="Subir">
    </div>
</form>
<?php } ?>