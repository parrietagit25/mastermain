<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headers = ["ID", "Departamento", "Codigo de Colaborador", "Nombre de Colaborador", "Comision", "Bonificacion", "Honorarios", "Vale", "Fecha de registro"];
$columnLetter = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($columnLetter . '1', $header);
    $columnLetter++;
}

$rowNumber = 2;

if (isset($_POST['desde']) && isset($_POST['hasta'])) {
    $mysqli = new mysqli("localhost", "root", "elchamo1787$$$", "mastermain");

    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    $desde = $mysqli->real_escape_string($_POST['desde']);
    $hasta = $mysqli->real_escape_string($_POST['hasta']);

    $comisiones = $mysqli->query("SELECT * FROM comisiones WHERE fecha_log >= '$desde' AND fecha_log <= '$hasta'");

    if ($comisiones === false) {
        die("Error en la consulta: " . $mysqli->error);
    }

    while ($comision = $comisiones->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $comision["id"]);
        $sheet->setCellValue('B' . $rowNumber, $comision["departamento"]);
        $sheet->setCellValue('C' . $rowNumber, $comision["codigo_colaborador"]);
        $sheet->setCellValue('D' . $rowNumber, $comision["nombre_colaborador"]);
        $sheet->setCellValue('E' . $rowNumber, $comision["comision"]);
        $sheet->setCellValue('F' . $rowNumber, $comision["bonificacion"]);
        $sheet->setCellValue('G' . $rowNumber, $comision["honorarios"]);
        $sheet->setCellValue('H' . $rowNumber, $comision["vale"]);
        $sheet->setCellValue('I' . $rowNumber, $comision["fecha_log"]);
        $rowNumber++;
    }

    $mysqli->close();
}

$writer = new Xlsx($spreadsheet);
$fileName = 'rep_comisiones.xlsx';
$writer->save($fileName);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>
