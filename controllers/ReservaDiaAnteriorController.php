<?php 

class ReservaDelDiaAnteriorController{


    public function reservadiaanterior(){

        if (isset($_POST['fecha_anterior'])) {

            $usuario = 'dolPanamaRW'; 
            $contrasena = 'VfsbJpYp'; 
            
            $credenciales = base64_encode("$usuario:$contrasena");
            
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiReservasDiaAnterior.mf?dtsdate='.$_POST['fecha_anterior'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Authorization: ••••••',
                'Cookie: cq_allow_progress=yes; CQCSBROWSEID=171747108654718482; CQCSID=aWrAYh_rzUQAx5TChMcdyA##'
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
                    
                    return $response_arry;
                    
                }else{
                    echo "Error en el json".json_last_error_msg();
                }

                
            }
        }
        
        

    }


}