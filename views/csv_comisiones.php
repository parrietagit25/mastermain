<?php

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="reportCommissions.csv"');

if (isset($_POST['desde']) && isset($_POST['hasta'])) {
    $mysqli = new mysqli("localhost", "root", "", "mastermain");
    $desde = $mysqli->real_escape_string($_POST['desde']);
    $hasta = $mysqli->real_escape_string($_POST['hasta']);

    $comisiones = $mysqli->query("SELECT * FROM comisiones WHERE fecha_log >= '".$desde."' AND fecha_log <= '".$hasta."'");

    $datos = [
    ];

    // Rellena el array con los datos de la consulta, insertando columnas vacías según sea necesario
    while ($comision = $comisiones->fetch_assoc()) {
        $datos[] = [
            $comision['codigo_colaborador'].','.$comision['comision'].','.','.','.','.','.','.','.','.','.','.$comision['vale'].','.','.','.','.','.','.','.','
        ];
    }

    $output = fopen('php://output', 'w');

    // Escribe los encabezados y luego cada fila de datos
    foreach ($datos as $fila) {
        fputcsv($output, $fila);
    }

    fclose($output);
}
?>
