<?php 
require_once 'models/RetencionesModel.php';

class RetencionesController {


    public function __construct() {
        $this->model = new RetencionesModel(); 
    }

    public function proveedores(){
        return $proveedores = $this->model->all_proveedores();
    }

    public function enviar_retenciones(){

        if (isset($_POST["fecha_inicio_ret"])) {
        
            $fecha_inicio = $_POST["fecha_inicio_ret"]; 
            $fecha_fin = $_POST["fecha_fin_ret"];
            $ruc_prov = $_POST["ruc_prov"];
            $pythonPath = 'C:\\Program Files\\Python311\\python.exe';
            $scriptPath = 'C:\\inetpub\\wwwroot\\mastermain\\python\\retenciones.py';
            $command = "\"$pythonPath\" \"$scriptPath\" " . escapeshellarg($fecha_inicio) . ' ' . escapeshellarg($fecha_fin) . ' ' . escapeshellarg($ruc_prov);
            $output = shell_exec($command);
            //echo "<pre>$output</pre>";
            return $output;

        }

    }

    public function send_reten(){
        echo 'Entro a la funcion send_reten()';
        if(isset($_POST['retenciones_enviar_mail'])){

            echo '<br>Entro a la funcion send_reten() en el post';

           // echo 'Pasando';
            
            $fecha_inicio = $_POST["fecha_inicio_ret_send"]; 
            $fecha_fin = $_POST["fecha_fin_ret_send"];
            $ruc_prov = $_POST["ruc_prov_send"];

            echo $fecha_inicio.'<br>';
            echo $fecha_fin.'<br>';
            echo $ruc_prov.'<br>';

            //echo $fecha_inicio.' '.$fecha_fin.' '.$ruc_prov;
            $pythonPath = 'C:\\Program Files\\Python311\\python.exe';
            $scriptPath = 'C:\\inetpub\\wwwroot\\mastermain\\python\\generate_pdf\\prueba2.py';
            $command = "\"$pythonPath\" \"$scriptPath\" " . escapeshellarg($fecha_inicio) . ' ' . escapeshellarg($fecha_fin) . ' ' . escapeshellarg($ruc_prov);
            $output = shell_exec($command);
            //echo "<pre>$output</pre>";
            return $output; /* */

            /*
            $fecha_inicio = $_POST['fecha_inicio_ret_send'];
            $fecha_fin = $_POST['fecha_fin_ret_send'];
            $ruc_prov = explode(" ", $_POST['ruc_prov_send']);
            $ruc_prov = $ruc_prov[0];
 
            // Datos a enviar en la solicitud POST
            $data = array(
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'ruc_prov' => $ruc_prov
            );
            
            // Convertir los datos a JSON
            $data_json = json_encode($data);
            
            // URL del script de Python
            $url = 'http://localhost:5000/generate_report'; // Asegúrate de que esta URL es correcta
            
            // Inicializar cURL
            $ch = curl_init($url);
            
            // Configurar cURL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            
            // Ejecutar la solicitud
            $response = curl_exec($ch);
            
            // Cerrar cURL
            curl_close($ch);
            
            return $response; */

        }
    }

}