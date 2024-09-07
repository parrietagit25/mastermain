<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['fecha_anterior_reser'])) {

    $usuario = 'dolPanamaRW'; 
    $contrasena = 'VfsbJpYp'; 
    
    $credenciales = base64_encode("$usuario:$contrasena");
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiReservasDiaAnterior.mf?dtsdate='.$_POST['fecha_anterior_reser'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Authorization: Basic ' . $credenciales,
          'Cookie: cq_allow_progress=yes; CQCSBROWSEID=171747108654718482; CQCSID=aWrAYh_rzUQAx5TChMcdyA##'
        ),
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
      ));
    
    $response = curl_exec($curl);

    if ($response === false) {
        $error_msg = curl_error($curl);
        echo "cURL Error: $error_msg";
        exit;
    } else {
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response_arry = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Error en el json: " . json_last_error_msg();
            exit;
        }
    }
    curl_close($curl);
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headers = ["resnumber", "ranumber", "rstat", "rastat", "customerfirstname", 
            "customerlastname", "actdays", "totalestimate", "sourcecode", "referralcode", "company", 
            "locationcodeout", "reservedclass", "invclass", "dateadded", "timeadded", "addedbyemployeenumber", "dateout", "ratecode"];
$columnLetter = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($columnLetter . '1', $header);
    $columnLetter++;
}

$rowNumber = 2; 
foreach ($response_arry['data'] as $row) {
    $sheet->setCellValue('A' . $rowNumber, $row["resnumber"]);
    $sheet->setCellValue('B' . $rowNumber, $row["ranumber"]);
    $sheet->setCellValue('C' . $rowNumber, $row["rstat"]);
    $sheet->setCellValue('D' . $rowNumber, $row["rastat"]);
    $sheet->setCellValue('E' . $rowNumber, $row["customerfirstname"]);
    $sheet->setCellValue('F' . $rowNumber, $row["customerlastname"]);
    $sheet->setCellValue('G' . $rowNumber, $row["actdays"]);
    $sheet->setCellValue('H' . $rowNumber, $row["totalestimate"]);
    $sheet->setCellValue('I' . $rowNumber, $row["sourcecode"]);
    $sheet->setCellValue('J' . $rowNumber, $row["referralcode"]);
    $sheet->setCellValue('K' . $rowNumber, $row["company"]);
    $sheet->setCellValue('L' . $rowNumber, $row["locationcodeout"]);
    $sheet->setCellValue('M' . $rowNumber, $row["reservedclass"]);
    $sheet->setCellValue('N' . $rowNumber, $row["invclass"]);
    $sheet->setCellValue('O' . $rowNumber, $row["dateadded"]);
    $sheet->setCellValue('P' . $rowNumber, $row["timeadded"]);
    $sheet->setCellValue('Q' . $rowNumber, $row["addedbyemployeenumber"]);
    $sheet->setCellValue('R' . $rowNumber, $row["dateout"]);
    $sheet->setCellValue('S' . $rowNumber, $row["ratecode"]);
    $rowNumber++;
}

$writer = new Xlsx($spreadsheet);
$fileName = 'ReportedelDiaAnterior.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>
