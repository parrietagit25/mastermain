<?php 

class ReservaDelDiaAnteriorController {

    public function reservadiaanterior() {
        if (isset($_POST['fecha_anterior']) && !empty($_POST['fecha_anterior'])) {
            
            $usuario = 'dolPanamaRW'; 
            $contrasena = 'VfsbJpYp'; 
            
            // Codifica las credenciales en Base64
            $credenciales = base64_encode("$usuario:$contrasena");
            
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiReservasDiaAnterior.mf?dtsdate=' . $_POST['fecha_anterior'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30, // Ajusta el tiempo de espera si es necesario
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . $credenciales, // Incluye la autenticación en la cabecera
                    'Cookie: cq_allow_progress=yes; CQCSBROWSEID=171747108654718482; CQCSID=KgH19pCAiVMA2A4yMq3oiw##'
                ),
                CURLOPT_SSL_VERIFYPEER => false, // Deshabilita la verificación del certificado SSL
                CURLOPT_SSL_VERIFYHOST => false, // Deshabilita la verificación del host SSL
            ));
            
            $response = curl_exec($curl);
            
            if ($response === false) {
                // Muestra el error de cURL si falla
                $error_msg = curl_error($curl);
                echo "Error de cURL: $error_msg";
            } else {
                $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                
                if ($http_code === 200) {
                    // Decodifica la respuesta JSON
                    $response_array = json_decode($response, true);

                    if (json_last_error() === JSON_ERROR_NONE) {
                        return $response_array; // Retorna el array decodificado
                    } else {
                        echo "Error en el JSON: " . json_last_error_msg();
                    }
                } else {
                    echo "Error HTTP: $http_code\n";
                    echo "Respuesta del servidor: $response";
                }
            }
            
            curl_close($curl);
        } else {
            echo "La fecha no fue proporcionada.";
        }
    }
}
