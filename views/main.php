<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<div class="container">
    <h1>Bienvenido al Master Main</h1>
</div>
<br>
<div class="container" style="border: solid 1px black">
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
</div>
<?php include 'footer.php'; ?>