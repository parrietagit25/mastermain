<!-- views/login.php -->
<?php include 'header.php'; ?>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <form class="col-md-4" action="" method="post">
            <img src="assets/img/logo.png" alt="" width="420">
            <h2 class="text-center">Master Main</h2>
            <div class="form-group">
                <label for="username">Email de Usuario:</label>
                <input type="text" class="form-control" id="username" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-block" name="session">Iniciar Sesión</button>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>