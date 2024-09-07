
<?php

/* 
1 = Comisiones RRHH
2 = Registro de Usuario del sistema
3 = Registro de colaborador 
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
        <input type="file" name="comisiones_file" id="" class="form-control" require>
        <br>
        <label for="fecha">Periodo de las comisiones</label>
        <input type="date" name="fecha_periodo" id="fecha" class="form-control" require>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" id="subir_comision" onclick="ocultar_boton()" name="subir_comision_colaborador" value="Subir">
    </div>
</form>
<?php }elseif (isset($_POST['jobs']) && $_POST['jobs'] == 2) { ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Usuario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
            </div>
            <div class="form-group">
                <label for="tipo_usuario">Tipo de Usuario:</label>
                <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                <option value="admin">Seleccionar</option>
                    <option value="admin">Admin</option>
                    <option value="rrhh">RRHH</option>
                    <option value="contabilidad">Contabilidad</option>
                    <option value="operaciones">Operaciones</option>
                    <option value="mercadeo">Mercadeo</option>
                    <option value="cobros">Cobros</option>
                    <option value="comercial">Comercial</option>
                    <option value="mina">Mina</option>
                    <option value="retail">Retail</option>
                    <option value="ventas_autos">Ventas de autos</option>
                    <option value="compras">Compras</option>
                    <option value="reporteria">Reporteria</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="stat" value="1">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="registrar_usuario" value="Registrar">
        </div>
    </form>

<?php }elseif (isset($_POST['jobs']) && $_POST['jobs'] == 3) { ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Colaborador</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label for="codigo">Codigo:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre completo:</label>
            <input type="text" class="form-control" id="nombre" name="nombre_completo" required>
        </div>
        <div class="form-group">
            <label for="genero">genero:</label>
            <select class="form-control" id="genero" name="genero">
                <option value="">Seleccionar</option>
                <option value="F">Femenino</option>
                <option value="M">Masculino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="departamento">Departamento:</label>
            <select class="form-control" id="departamento" name="departamento">
                <option value="">Seleccionar</option>
                    <option value="rrhh">RRHH</option>
                    <option value="contabilidad">Contabilidad</option>
                    <option value="operaciones">Operaciones</option>
                    <option value="mercadeo">Mercadeo</option>
                    <option value="cobros">Cobros</option>
                    <option value="comercial">Comercial</option>
                    <option value="mina">Mina</option>
                    <option value="retail">Retail</option>
                    <option value="ventas_autos">Ventas de autos</option>
                    <option value="compras">Compras</option>
                    <option value="reporteria">Reporteria</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="stat" value="1">
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="registrar_colaborador" value="Registrar">
    </div>
</form>

<?php }elseif (isset($_POST['jobs']) && $_POST['jobs'] == 4) {  ?>
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Descargar simulador</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <p>Descarga el ultimo archivo del simulador <a href="excel/simulador/simu.xlsx">Simulador</a></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
<?php }  ?> 