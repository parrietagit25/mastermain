<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container mt-5">
    <h2>Formulario de Registro</h2>
    <form action="" method="post">
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
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
<?php include 'footer.php'; ?>
