<!-- views/register.php -->
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<?php //echo $resul_api_due; ?>
<div class="container mt-5">
    <h2>Reporte OverDue</h2>
    <br>
    <br>

    <form action="views/exceloverdue.php" method="post" target="_blank">
        <input type="submit" value="Reporte OverDue" class="btn btn-success" name="overdue">
    </form>
</div>

    <!-- Modal Dinamica -->
    <div class="modal fade" id="modalDinamica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal_dinamico">
                
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
