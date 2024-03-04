<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    $target_dir = "excel/colaboradoes/";
    $filePath = __DIR__ . '/excel/colaboradores/2024.xlsx';

    $reader = new Xlsx();
    $spreadsheet = $reader->load($filePath);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    // Establece aquí tu conexión a la base de datos
    $mysqli = new mysqli("localhost", "root", "", "mastermain");

    $stat = 1;

    foreach ($sheetData as $row) {
        // Asume que tienes columnas `columna1`, `columna2`, etc., en tu base de datos
        // y que la primera fila del archivo Excel contiene encabezados
        $query = "INSERT INTO comisiones_colaboradores (codigo, nombre_completo, genero, departamento, stat) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssi", $row[0], $row[1], $row[2], $row[3], $stat); // Ajusta esto según tus necesidades
        $stmt->execute();
    }

    echo "Datos importados a MySQL.";
?>
