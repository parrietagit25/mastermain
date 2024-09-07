<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container mt-5">
    <h2>Registrod de Colaborador</h2>

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
                <td><?php echo utf8_encode($colab['nombre_completo']); ?></td>
                <td><?php if($colab['genero'] == 'M'){ echo 'Masculino'; }else{ echo 'Femenino';} ?></td>
                <td><?php echo $colab['departamento']; ?></td>
                <td><?php echo $colab['fecha_log']; ?></td>
                <td> 
                    <input type="button" value="Editar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDinamicaEdit<?php echo $colab['id']; ?>" onclick="modal_dinamica_edit(<?php echo $colab['id']; ?>, 1)">
                    <input type="button" value="Eliminar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDinamicaElim<?php echo $colab['id']; ?>" onclick="modal_dinamica_elim(<?php echo $colab['id']; ?>, 1)"> 
                </td>
            </tr>
            <!-- Modal Dinamica Editar -->
            <div class="modal fade" id="modalDinamicaEdit<?php echo $colab['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modal_dinamico_edit<?php echo $colab['id']; ?>">
                        
                    </div>
                </div>
            </div>
            <!-- Modal Dinamica Eliminar -->
            <div class="modal fade" id="modalDinamicaElim<?php echo $colab['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modal_dinamico_elim<?php echo $colab['id']; ?>">
                        
                    </div>
                </div>
            </div>
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
