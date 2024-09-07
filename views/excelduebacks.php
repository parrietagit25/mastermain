<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['fecha_inicio_due'])) {

    $usuario = 'dolPanamaRW'; 
    $contrasena = 'VfsbJpYp'; 
    
    $credenciales = base64_encode("$usuario:$contrasena");
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiDuebacks.mf?dtsdate='.$_POST['fecha_inicio_due'].'&dtedate='.$_POST['fecha_fin_due'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . $credenciales,
        'Cookie: CQCSBROWSEID=171747108654718482; CQCSID=c_8NOOl9ofw8Wd7VZRwVOQ##'
      ),
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false,
    ));
    
    $response = curl_exec($curl);
    
    if ($response === false) {
        $error_msg = curl_error($curl);
        echo "cURL Error: $error_msg";
    } else {
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //echo "HTTP Code: $http_code\n";
        //echo "Response: $response\n";

        $response_arry = json_decode($response, true);

        if (json_last_error() === JSON_ERROR_NONE) {

            //include 'views/duebacks.php';
            //return $response_arry;
            
        }else{
            echo "Error en el json".json_last_error_msg();
        }

        
    }
}

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$headers = ["RANumber", "Company", "Location Code Out", "Location Code Due", "Customer First Name", "Customer Last Name", "Date Out", "Date Due", "Inv Class", "Total Charges", "Days"];
$columnLetter = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($columnLetter . '1', $header);
    $columnLetter++;
}

$rowNumber = 2; 
foreach ($response_arry['data'] as $row) {
    $sheet->setCellValue('A' . $rowNumber, $row["ranumber"]);
    $sheet->setCellValue('B' . $rowNumber, $row["company"]);
    $sheet->setCellValue('C' . $rowNumber, $row["locationcodeout"]);
    $sheet->setCellValue('D' . $rowNumber, $row["locationcodedue"]);
    $sheet->setCellValue('E' . $rowNumber, $row["customerfirstname"]);
    $sheet->setCellValue('F' . $rowNumber, $row["customerlastname"]);
    $sheet->setCellValue('G' . $rowNumber, $row["dateout"]);
    $sheet->setCellValue('H' . $rowNumber, $row["datedue"]);
    $sheet->setCellValue('I' . $rowNumber, $row["invclass"]);
    $sheet->setCellValue('J' . $rowNumber, $row["totalcharges"]);
    $sheet->setCellValue('K' . $rowNumber, $row["days"]);
    $rowNumber++;
}

$writer = new Xlsx($spreadsheet);
$fileName = 'duebacks.xlsx';
$writer->save($fileName);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
