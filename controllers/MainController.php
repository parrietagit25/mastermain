<?php 
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'models/ColaboradorModel.php';

class MainController {
    // Si no usas $model, considera removerlo.
    // private $model;

    public function __construct() {
        $this->model = new ColaboradorModel(); // Asegúrate de que esto se refiere a tu modelo real
    }

    public function ejecutarPython() {
        
    }

    public function separarFacturas() {
        
    }

    public function all_comisiones(){
        $desde = "";
        $hasta = "";
        if (isset($_POST['desde'])) {
            $desde = $_POST['desde'];
        }
        if (isset($_POST['hasta'])) {
            $hasta = $_POST['hasta'];
        }
        $comisiones = $this->model->all_comisiones($desde, $hasta);
        include_once 'views/reporte_comisiones.php';
    }

    public function reporte_comisiones(){



    }

    public function main() {
       if (isset($_POST['subir_comision_colaborador']) && isset($_FILES['comisiones_file'])) {

            $extension = pathinfo($_FILES["comisiones_file"]["name"], PATHINFO_EXTENSION);
            $nombreAleatorio = uniqid('archivo-', true) . rand(0, 9999) . '.' . $extension;
            $target_dir = "excel/comisiones/";
            $target_file = $target_dir . $nombreAleatorio;
            if (move_uploaded_file($_FILES["comisiones_file"]["tmp_name"], $target_file)) {
                //echo "El archivo ". htmlspecialchars( basename( $_FILES["comisiones_file"]["name"])). " ha sido subido.";
            } else {
                exit;
            }
        
            $reader = new Xlsx();
            $spreadsheet = $reader->load($target_file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
        
            $mysqli = new mysqli("localhost", "root", "", "mastermain");

            $stat = 1;
            $id_user = $_SESSION['user_id'];

            $n = 0;
            $no_listados = "";
            $ya_listada = "";
        
            foreach ($sheetData as $row) {

                if ($n == 0) {
                    $n++;
                    continue;
                }
                
                $buscar_colaborador = $mysqli->query("SELECT count(*) as contar FROM comisiones_colaboradores WHERE codigo = '".$row[1]."'");

                while ($comprobar = $buscar_colaborador->fetch_array()) {
                    
                    if ($comprobar['contar'] > 0) {

                        $buscar_colaborador_comision = $mysqli->query("SELECT count(*) as contar FROM comisiones WHERE codigo_colaborador = '".$row[1]."' and MONTH(fecha_log) = MONTH(NOW()) and YEAR(fecha_log) = YEAR(NOW())");

                        while ($comprobar_comision = $buscar_colaborador_comision ->fetch_array()) {

                            if ($comprobar_comision['contar'] == 0) {
                        
                                $query = "INSERT INTO comisiones (departamento, codigo_colaborador, nombre_colaborador, comision, bonificacion, honorarios, vale, stat, id_user_register) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                $stmt = $mysqli->prepare($query);
                                $stmt->bind_param("sssssssii", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $stat, $id_user); 
                                $stmt->execute();
                                $n++;
    
                            }else{

                                $ya_listada .= $row[1].'<br>';
    
                            }
                        }
                    
                    }else {
                        $no_listados .= $row[1].'<br>';
                    }
                }
            }

            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor de correo y envío de email
                $mail->isSMTP();
                $mail->Host = 'smtp.example.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'user@example.com';
                $mail->Password = 'secret';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Destinatarios
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress('to@example.com', 'Joe User'); // Agregar un destinatario

                // Contenido
                $mail->isHTML(true); // Establecer formato de email a HTML
                $mail->Subject = 'Nombre Subio las comisiones';
                $mail->Body    = 'Este es el cuerpo del mensaje en HTML <b>en negrita!</b>';
                $mail->AltBody = 'Este es el cuerpo en texto plano para clientes de correo no HTML';

                $mail->send();
                //echo 'Mensaje enviado';
            } catch (Exception $e) {
                //echo "El mensaje no pudo ser enviado. Error de Mailer: {$mail->ErrorInfo}";
            }

        }

        $no_list = 'Listado de codigo de colaborador no registrado: '.$no_listados;
        $comision_list = 'Comision ya existente en el sistema '.$ya_listada;

        return $listados = array("no_listado"=> $no_list , "comision_existente"=> $comision_list);

    }
}
