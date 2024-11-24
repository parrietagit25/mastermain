<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['fecha_inicio_corp'])) {
    $usuario = 'dolPanamaRW'; 
    $contrasena = 'VfsbJpYp'; 
    $credenciales = base64_encode("$usuario:$contrasena");

    $urls = [
        'api1' => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiReporteComisionesCorp1.mf?dtsdate=' . $_POST['fecha_inicio_corp'] . '&dtedate=' . $_POST['fecha_fin_corp'],
        'api2' => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiReporteComisionesCorp2.mf?dtsdate=' . $_POST['fecha_inicio_corp'] . '&dtedate=' . $_POST['fecha_fin_corp'],
        'api3' => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiReporteComisionesCorp3.mf?dtsdate=' . $_POST['fecha_inicio_corp'] . '&dtedate=' . $_POST['fecha_fin_corp']
    ];

    $curlOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => [
            'Authorization: Basic ' . $credenciales,
            'Cookie: CQCSBROWSEID=171747108654718482; CQCSID=c_8NOOl9ofw8Wd7VZRwVOQ##'
        ],
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ];

    $responses = [];
    foreach ($urls as $key => $url) {
        $curl = curl_init($url);
        curl_setopt_array($curl, $curlOptions);
        $response = curl_exec($curl);
        if ($response === false) {
            echo "cURL Error: " . curl_error($curl);
            curl_close($curl);
            return;
        }
        $responses[$key] = json_decode($response, true);
        curl_close($curl);
    }

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error en el JSON: " . json_last_error_msg();
        return;
    }

    $data1 = $responses['api1']['data'];
    $data2 = array_column($responses['api2']['data'], 'rctotal', 'commonid');
    $data3 = array_column($responses['api3']['data'], 'totcharge', 'commonid');

    foreach ($data1 as &$record) {
        $commonid = $record['commonid'];
        $record['rctotal'] = $data2[$commonid] ?? null;
        $record['totcharge'] = $data3[$commonid] ?? null;
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $headers = ["commonid", "resnumber", "ranumber", "company", "name", "customerfirstname", "customerlastname", "invclass", "dateout", "datedue", "totalestimate", "totalcharges", "insuredname", "verifiedby", "rctotal", "totcharge"];
    $columnLetter = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($columnLetter . '1', $header);
        $columnLetter++;
    }

    $rowNumber = 2;
    foreach ($data1 as $row) {
        $sheet->setCellValue('A' . $rowNumber, $row["commonid"]);
        $sheet->setCellValue('B' . $rowNumber, $row["resnumber"]);
        $sheet->setCellValue('C' . $rowNumber, $row["ranumber"]);
        $sheet->setCellValue('D' . $rowNumber, $row["company"]);
        $sheet->setCellValue('E' . $rowNumber, $row["name"]);
        $sheet->setCellValue('F' . $rowNumber, $row["customerfirstname"]);
        $sheet->setCellValue('G' . $rowNumber, $row["customerlastname"]);
        $sheet->setCellValue('H' . $rowNumber, $row["invclass"]);
        $sheet->setCellValue('I' . $rowNumber, $row["dateout"]);
        $sheet->setCellValue('J' . $rowNumber, $row["datedue"]);
        $sheet->setCellValue('K' . $rowNumber, $row["totalestimate"]);
        $sheet->setCellValue('L' . $rowNumber, $row["totalcharges"]);
        $sheet->setCellValue('M' . $rowNumber, $row["insuredname"]);
        $sheet->setCellValue('N' . $rowNumber, $row["verifiedby"]);
        $sheet->setCellValue('O' . $rowNumber, $row["rctotal"]);
        $sheet->setCellValue('P' . $rowNumber, $row["totcharge"]);
        $rowNumber++;
    }

    $writer = new Xlsx($spreadsheet);
    $fileName = 'reportComisionesCorp.xlsx';
    $writer->save($fileName);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}
