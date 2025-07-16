<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function getSQLServerConnection() {
    $sql_server_host = "10.10.2.25";
    $sql_server_db_name = "NetRent";
    $sql_server_username = "kuruma";
    $sql_server_password = "KURUMAADMIN2022*";
    $conn = null;
    try {
        $dsn = "sqlsrv:Server=$sql_server_host;Database=$sql_server_db_name";
        $conn = new PDO($dsn, $sql_server_username, $sql_server_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        die("Error de conexión SQL Server: " . $exception->getMessage());
    }
    return $conn;
}

if (isset($_POST['overdue'])) {
    // Conectar a la base de datos
    $conn = getSQLServerConnection();

    // Crear archivo Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Configurar encabezados
    $headers = [
        'datedue', 'timedue', 'ranumber', 'unitnumber', 'year', 
        'make', 'model', 'renter', 'dateout', 'company', 
        'locationcodedue', 'locationcodeout', 'agent', 'DateAdded', 'Days'
    ];
    $columnLetter = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($columnLetter . '1', $header);
        $columnLetter++;
    }

    // Procesar datos en lotes
    $batchSize = 500; // Tamaño del lote
    $offset = 0;
    $rowNumber = 2; // Inicia después de los encabezados

    do {
        // Query con paginación
        $query = "
            SELECT 
                datedue, 
                timedue, 
                REPLACE(CAST(ranumber AS NVARCHAR(MAX)), CHAR(26), '') AS ranumber,
                unitnumber, 
                year, 
                make, 
                model, 
                renter, 
                dateout, 
                company, 
                locationcodedue, 
                locationcodeout, 
                agent, 
                DateAdded, 
                Days
            FROM OverDue
            ORDER BY DateAdded
            OFFSET $offset ROWS
            FETCH NEXT $batchSize ROWS ONLY;
        ";

        // Ejecutar el query
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Salir del bucle si no hay más datos
        if (empty($results)) {
            break;
        }

        // Agregar datos al Excel
        foreach ($results as $row) {
            $columnLetter = 'A';
            foreach ($row as $cell) {
                $sheet->setCellValue($columnLetter . $rowNumber, $cell);
                $columnLetter++;
            }
            $rowNumber++;
        }

        // Incrementar el offset
        $offset += $batchSize;

    } while (true);

    // Guardar el archivo Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'duebacks.xlsx';
    $writer->save($fileName);

    // Enviar el archivo como descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}
