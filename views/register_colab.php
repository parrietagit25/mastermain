<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container mt-5">
    <h2>Usuarios</h2>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDinamica" onclick="modal_dinamica(3)">
        Registrar Colaborador
    </button>
    <br>
    <br>
    <table class="table table-hover" id="tabla_date">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Codigo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Genero</th>
            <th scope="col">Departamento</th>
            <th scope="col">Fecha de registro</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($all_colaborador) && !empty($all_colaborador)) {
                    foreach ($all_colaborador as $colab) { ?>
            <tr>
                <th scope="row"><?php echo $colab['id']; ?></th>
                <td><?php echo $colab['codigo']; ?></td>
                <td><?php echo $colab['nombre_completo']; ?></td>
                <td><?php echo $colab['genero']; ?></td>
                <td><?php echo $colab['departamento']; ?></td>
                <td><?php echo $colab['fecha_log']; ?></td>
                <td> <input type="button" value="Editar" class="btn btn-primary"><input type="button" value="Eliminar" class="btn btn-danger"> </td>
            </tr>
            <?php  }
                } else {
                    echo "No hay colaboradores registrados.";
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
<?php include 'footer.php'; ?>
