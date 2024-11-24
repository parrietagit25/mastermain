<?php 

class CorpController {

    public function corp() {
        if (isset($_POST['fecha_inicio_corp'])) {
            $usuario = 'dolPanamaRW'; 
            $contrasena = 'VfsbJpYp'; 
            $credenciales = base64_encode("$usuario:$contrasena");

            // Definir URLs de los tres endpoints
            $urls = [
                'api1' => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiReporteComisionesCorp1.mf?dtsdate=' . $_POST['fecha_inicio_corp'] . '&dtedate=' . $_POST['fecha_fin_corp'],
                'api2' => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiReporteComisionesCorp2.mf?dtsdate=' . $_POST['fecha_inicio_corp'] . '&dtedate=' . $_POST['fecha_fin_corp'],
                'api3' => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiReporteComisionesCorp3.mf?dtsdate=' . $_POST['fecha_inicio_corp'] . '&dtedate=' . $_POST['fecha_fin_corp']
            ];

            // Configuración común para las solicitudes cURL
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

            // Ejecutar solicitudes y decodificar respuestas
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

            // Verificar que las respuestas estén decodificadas correctamente
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo "Error en el JSON: " . json_last_error_msg();
                return;
            }

            // Procesar los datos y combinarlos
            $data1 = $responses['api1']['data'];
            $data2 = array_column($responses['api2']['data'], 'rctotal', 'commonid');
            $data3 = array_column($responses['api3']['data'], 'totcharge', 'commonid');

            // Combinar datos en `data1`
            foreach ($data1 as &$record) {
                $commonid = $record['commonid'];
                $record['rctotal'] = $data2[$commonid] ?? null;
                $record['totcharge'] = $data3[$commonid] ?? null;
            }

            //echo '<pre>';
            //echo var_dump($data1);
            //echo '</pre>';

            return $data1;
        }
    }
}
