<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container mt-5">
    <h2>Usuarios</h2>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDinamica" onclick="modal_dinamica(2)">
        Registrar Usuario
    </button>
    <br>
    <br>
    <table class="table table-hover" id="tabla_date">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">tipo de ususario</th>
            <th scope="col">Fecha de registro</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($all_users) && !empty($all_users)) {
                    foreach ($all_users as $user) { ?>
            <tr>
                <th scope="row"><?php echo $user['id']; ?></th>
                <td><?php echo $user['nombre']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['tipo_usuario']; ?></td>
                <td><?php echo $user['fecha_log']; ?></td>
                <td> 
                    <input type="button" value="Editar" class="btn btn-primary">
                    <input type="button" value="Pass" class="btn btn-danger" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalDinamicaPass" 
                    onclick="cambiar_pass_dinamica(<?php echo $user['id']; ?>);">
                </td>
            </tr>
            <?php  }
                } else {
                    echo "No hay usuarios registrados.";
                }
                    ?>
        </tbody>
    </table>
</div>

    <!-- Modal Dinamica -->
    <div class="modal fade" id="modalDinamica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_dinamico">
                
            </div>
        </div>
    </div>

    <!-- Modal para cambiar contraseña -->
    <div class="modal fade" id="modalDinamicaPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_dinamico_pass">
                <!-- Aquí se cargará el contenido dinámico -->
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
