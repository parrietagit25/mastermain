<?php 
if (isset($modal) && $modal == 1) {
    require_once '../models/FormularioIngresoModel.php';
    require '../vendor/autoload.php';
    require_once '../models/Conexion.php';

}else {
    require_once 'models/FormularioIngresoModel.php';
    require 'vendor/autoload.php';
    require_once 'models/Conexion.php';
}

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class FormularioIngesoController {
    private $model;

    public function __construct() {
        $this->model = new FormularioIngresoModel();
    }

    public function all_fingreso(){
        return $this->model->all_fingreso();
    }

    public function all_fingreso_select($tabla){
        return $this->model->all_fingreso_select($tabla);
    }

    public function reg_ingreso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_ingreso'])) {
            $db = new Conexion();
            $conn = $db->conectar();
    
            try {
                // Validar que ningún campo sea un array
                foreach ($_POST as $campo => $valor) {
                    if (is_array($valor)) {
                        echo "🚨 Error: el campo '$campo' es un array. No puede ser enviado como parte de la consulta.";
                        exit;
                    }
                }
    
                // Normalizar campos tipo BIT
                $campos_bit = [
                    'Sofware', 'sofware1', 'Sofware2', 'Sofware3', 'Office365', 'PowerBI',
                    'correopublicoweb', 'ListaCorreo', 'GrupodeTeam', 'Hadware', 'Laptop',
                    'Cargador', 'Surface', 'Tablet', 'Celular', 'Pantalla', 'RedesSociales',
                    'RedesSocial1', 'RedesSocial2', 'RedesSocial3', 'Youtube', 'SharePoint'
                ];
                foreach ($campos_bit as $campo) {
                    $_POST[$campo] = isset($_POST[$campo]) ? (int)$_POST[$campo] : 0;
                }
    
                // Validar fechas y convertir formato HTML5 a formato SQL Server
                $fechaInicio = (!empty($_POST['FechaInicio']) && strtotime($_POST['FechaInicio'])) 
                    ? date('Y-m-d H:i:s', strtotime($_POST['FechaInicio'])) 
                    : null;
    
                $fechaFin = (!empty($_POST['FechaFin']) && strtotime($_POST['FechaFin'])) 
                    ? date('Y-m-d H:i:s', strtotime($_POST['FechaFin'])) 
                    : null;
    
                $fechaSincro = (!empty($_POST['FechaSincro']) && strtotime($_POST['FechaSincro'])) 
                    ? date('Y-m-d H:i:s', strtotime(str_replace('T', ' ', $_POST['FechaSincro']))) 
                    : date('Y-m-d H:i:s');
    
                // Validar campos numéricos
                $nroEmpleado = is_numeric($_POST['NroEmpleado']) ? (int)$_POST['NroEmpleado'] : null;
    
                // Estatus es varchar(3), puedes usar 'A'
                $estatus = 'A';
    
                // Preparar y ejecutar
                $sql = "INSERT INTO tbFormInOut (
                    Nombres, Apellidos, NroEmpleado, Departamentos, JefeInmediato,
                    FechaInicio, FechaFin, Puesto, Accion, Empresa,
                    Sucursal, Ubicacion, Sofware, sofware1, Sofware2, Sofware3, OtrosSofware,
                    Office365, PowerBI, correo, Dominio, VPN, correopublicoweb, ListaCorreo,
                    NameListaCorreo, GrupodeTeam, NameGrupoTeam, Hadware, Laptop, Cargador,
                    Surface, Tablet, Celular, Pantalla, Otroshadware,
                    RedesSociales, RedesSocial1, RedesSocial2, RedesSocial3, OtraRedesSocial,
                    Youtube, SharePoint, OtrosComentarios, Usuario, FechaSincro, Estatus
                ) VALUES (
                    :Nombres, :Apellidos, :NroEmpleado, :Departamentos, :JefeInmediato,
                    :FechaInicio, :FechaFin, :Puesto, :Accion, :Empresa,
                    :Sucursal, :Ubicacion, :Sofware, :sofware1, :Sofware2, :Sofware3, :OtrosSofware,
                    :Office365, :PowerBI, :correo, :Dominio, :VPN, :correopublicoweb, :ListaCorreo,
                    :NameListaCorreo, :GrupodeTeam, :NameGrupoTeam, :Hadware, :Laptop, :Cargador,
                    :Surface, :Tablet, :Celular, :Pantalla, :Otroshadware,
                    :RedesSociales, :RedesSocial1, :RedesSocial2, :RedesSocial3, :OtraRedesSocial,
                    :Youtube, :SharePoint, :OtrosComentarios, :Usuario, :FechaSincro, :Estatus
                )";
    
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':Nombres' => $_POST['Nombres'],
                    ':Apellidos' => $_POST['Apellidos'],
                    ':NroEmpleado' => $nroEmpleado,
                    ':Departamentos' => $_POST['Departamentos'],
                    ':JefeInmediato' => $_POST['JefeInmediato'],
                    ':FechaInicio' => $fechaInicio,
                    ':FechaFin' => $fechaFin,
                    ':Puesto' => $_POST['Puesto'],
                    ':Accion' => $_POST['Accion'],
                    ':Empresa' => $_POST['Empresa'],
                    ':Sucursal' => $_POST['Sucursal'],
                    ':Ubicacion' => $_POST['Ubicacion'],
                    ':Sofware' => $_POST['Sofware'],
                    ':sofware1' => $_POST['sofware1'],
                    ':Sofware2' => $_POST['Sofware2'],
                    ':Sofware3' => $_POST['Sofware3'],
                    ':OtrosSofware' => $_POST['OtrosSofware'],
                    ':Office365' => $_POST['Office365'],
                    ':PowerBI' => $_POST['PowerBI'],
                    ':correo' => $_POST['correo'],
                    ':Dominio' => $_POST['Dominio'],
                    ':VPN' => $_POST['VPN'],
                    ':correopublicoweb' => $_POST['correopublicoweb'],
                    ':ListaCorreo' => $_POST['ListaCorreo'],
                    ':NameListaCorreo' => $_POST['NameListaCorreo'],
                    ':GrupodeTeam' => $_POST['GrupodeTeam'],
                    ':NameGrupoTeam' => $_POST['NameGrupoTeam'],
                    ':Hadware' => $_POST['Hadware'],
                    ':Laptop' => $_POST['Laptop'],
                    ':Cargador' => $_POST['Cargador'],
                    ':Surface' => $_POST['Surface'],
                    ':Tablet' => $_POST['Tablet'],
                    ':Celular' => $_POST['Celular'],
                    ':Pantalla' => $_POST['Pantalla'],
                    ':Otroshadware' => $_POST['Otroshadware'],
                    ':RedesSociales' => $_POST['RedesSociales'],
                    ':RedesSocial1' => $_POST['RedesSocial1'],
                    ':RedesSocial2' => $_POST['RedesSocial2'],
                    ':RedesSocial3' => $_POST['RedesSocial3'],
                    ':OtraRedesSocial' => $_POST['OtraRedesSocial'],
                    ':Youtube' => $_POST['Youtube'],
                    ':SharePoint' => $_POST['SharePoint'],
                    ':OtrosComentarios' => $_POST['OtrosComentarios'],
                    ':Usuario' => $_SESSION['user_id'],
                    ':FechaSincro' => $fechaSincro,
                    ':Estatus' => $estatus
                ]);
    
                $db->desconectar();
    
                $this->enviarPDFRegistro($nroEmpleado, 1);
    
                echo '✅ Registro realizado con éxito';
                // header("Location: registro_colaborador.php?registro=exito"); exit;
    
            } catch (PDOException $e) {
                echo "❌ Error al registrar: " . $e->getMessage();
            }
        }
    }
    

    public function editar_ingreso() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_ingreso'])) {
            $db = new Conexion();
            $conn = $db->conectar();
    
            try {
                $sql = "UPDATE tbFormInOut SET
                            Nombres = :Nombres,
                            Apellidos = :Apellidos,
                            Departamentos = :Departamentos,
                            Empresa = :Empresa,
                            JefeInmediato = :JefeInmediato,
                            Dominio = :Dominio,
                            Puesto = :Puesto,
                            Accion = :Accion,
                            Sucursal = :Sucursal,
                            Ubicacion = :Ubicacion,
                            correo = :correo,
                            VPN = :VPN,
                            FechaInicio = :FechaInicio,
                            FechaFin = :FechaFin,
                            Estatus = :Estatus,
                            OtrosComentarios = :OtrosComentarios,
                            Sofware = :Sofware,
                            sofware1 = :sofware1,
                            Sofware2 = :Sofware2,
                            Sofware3 = :Sofware3,
                            Office365 = :Office365,
                            PowerBI = :PowerBI,
                            correopublicoweb = :correopublicoweb,
                            ListaCorreo = :ListaCorreo,
                            GrupodeTeam = :GrupodeTeam,
                            Hadware = :Hadware,
                            Laptop = :Laptop,
                            Cargador = :Cargador,
                            Surface = :Surface,
                            Tablet = :Tablet,
                            Celular = :Celular,
                            Pantalla = :Pantalla,
                            RedesSociales = :RedesSociales,
                            RedesSocial1 = :RedesSocial1,
                            RedesSocial2 = :RedesSocial2,
                            RedesSocial3 = :RedesSocial3,
                            Youtube = :Youtube,
                            SharePoint = :SharePoint,
                            OtrosSofware = :OtrosSofware,
                            NameListaCorreo = :NameListaCorreo,
                            NameGrupoTeam = :NameGrupoTeam,
                            Otroshadware = :Otroshadware,
                            OtraRedesSocial = :OtraRedesSocial,
                            FechaSincro = :FechaSincro
                        WHERE NroEmpleado = :NroEmpleado";
    
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':Nombres' => $_POST['Nombres'],
                    ':Apellidos' => $_POST['Apellidos'],
                    ':Departamentos' => $_POST['Departamentos'],
                    ':Empresa' => $_POST['Empresa'],
                    ':JefeInmediato' => $_POST['JefeInmediato'],
                    ':Dominio' => $_POST['Dominio'],
                    ':Puesto' => $_POST['Puesto'],
                    ':Accion' => $_POST['Accion'],
                    ':Sucursal' => $_POST['Sucursal'],
                    ':Ubicacion' => $_POST['Ubicacion'],
                    ':correo' => $_POST['correo'],
                    ':VPN' => isset($_POST['VPN']) ? intval($_POST['VPN']) : 0,
                    ':FechaInicio' => !empty($_POST['FechaInicio']) ? date('Y-m-d', strtotime($_POST['FechaInicio'])) : null,
                    ':FechaFin' => !empty($_POST['FechaFin']) ? date('Y-m-d', strtotime($_POST['FechaFin'])) : null,
                    ':Estatus' => $_POST['Estatus'],
                    ':OtrosComentarios' => $_POST['OtrosComentarios'],
                    ':Sofware' => $_POST['Sofware'],
                    ':sofware1' => $_POST['sofware1'],
                    ':Sofware2' => $_POST['Sofware2'],
                    ':Sofware3' => $_POST['Sofware3'],
                    ':Office365' => $_POST['Office365'],
                    ':PowerBI' => $_POST['PowerBI'],
                    ':correopublicoweb' => $_POST['correopublicoweb'],
                    ':ListaCorreo' => $_POST['ListaCorreo'],
                    ':GrupodeTeam' => $_POST['GrupodeTeam'],
                    ':Hadware' => $_POST['Hadware'],
                    ':Laptop' => $_POST['Laptop'],
                    ':Cargador' => $_POST['Cargador'],
                    ':Surface' => $_POST['Surface'],
                    ':Tablet' => $_POST['Tablet'],
                    ':Celular' => $_POST['Celular'],
                    ':Pantalla' => $_POST['Pantalla'],
                    ':RedesSociales' => $_POST['RedesSociales'],
                    ':RedesSocial1' => $_POST['RedesSocial1'],
                    ':RedesSocial2' => $_POST['RedesSocial2'],
                    ':RedesSocial3' => $_POST['RedesSocial3'],
                    ':Youtube' => $_POST['Youtube'],
                    ':SharePoint' => $_POST['SharePoint'],
                    ':OtrosSofware' => $_POST['OtrosSofware'],
                    ':NameListaCorreo' => $_POST['NameListaCorreo'],
                    ':NameGrupoTeam' => $_POST['NameGrupoTeam'],
                    ':Otroshadware' => $_POST['Otroshadware'],
                    ':OtraRedesSocial' => $_POST['OtraRedesSocial'],
                    ':FechaSincro' => !empty($_POST['FechaSincro']) ? date('Y-m-d', strtotime($_POST['FechaSincro'])) : null,
                    ':NroEmpleado' => is_numeric($_POST['NroEmpleado']) ? intval($_POST['NroEmpleado']) : 0
                ]);

                if ($_POST['Estatus'] == 'C') {
                    $this->enviarPDFRegistro($_POST['NroEmpleado'], 3);
                }
    
                $db->desconectar();
    
                echo 'Registro Editado';
                // header("Location: registro_colaborador.php?update=ok");
                // exit;
    
            } catch (PDOException $e) {
                echo "Error al actualizar: " . $e->getMessage();
            }
        }
    }
    

    public function eliminar_ingreso(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_ingreso'])) {
            $nro = $_POST['NroEmpleado'];
        
            $db = new Conexion();
            $conn = $db->conectar();
        
            try {
                $sql = "DELETE FROM tbFormInOut WHERE NroEmpleado = :NroEmpleado";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':NroEmpleado' => $nro]);
        
                $db->desconectar();
                //header("Location: registro_colaborador.php?delete=ok");
                //exit;
        
            } catch (PDOException $e) {
                echo "Error al eliminar: " . $e->getMessage();
            }
        }
    }


    public function enviarPDFRegistro($nroEmpleado, $tipo) {
        $conexion = new Conexion();
        $conn = $conexion->conectar();

        // Obtener los datos del colaborador
        $stmt = $conn->prepare("SELECT * FROM tbFormInOut WHERE NroEmpleado = :nroEmpleado");
        $stmt->execute([':nroEmpleado' => $nroEmpleado]);
        $colab = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$colab) {
            error_log("Colaborador con NroEmpleado $nroEmpleado no encontrado.");
            return false;
        }

        // Crear el PDF
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Registro de Colaborador', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 12);

        // Campos de tipo checkbox (bit)
        $campos_checkbox = [
            'Sofware', 'sofware1', 'Sofware2', 'Sofware3', 'Office365', 'PowerBI',
            'correopublicoweb', 'ListaCorreo', 'GrupodeTeam', 'Hadware', 'Laptop',
            'Cargador', 'Surface', 'Tablet', 'Celular', 'Pantalla', 'RedesSociales',
            'RedesSocial1', 'RedesSocial2', 'RedesSocial3', 'Youtube', 'SharePoint'
        ];

        // Mostrar todos los campos con formato
        foreach ($colab as $key => $value) {
            if (!is_numeric($key)) {
                $etiqueta = utf8_decode(ucwords(str_replace('_', ' ', $key)));

                // Mostrar "Sí" o "No" para los checkboxes
                if (in_array($key, $campos_checkbox)) {
                    $valor_legible = ($value == 1) ? 'Si' : 'No';
                } else {
                    $valor_legible = utf8_decode($value);
                }

                $pdf->Cell(60, 8, $etiqueta, 0);
                $pdf->MultiCell(0, 8, $valor_legible);
            }
        }

        // Guardar PDF temporal
        $nombre_pdf = 'registro_colaborador_' . $nroEmpleado . '.pdf';
        $ruta_pdf = __DIR__ . '/../temp/' . $nombre_pdf;
        $pdf->Output('F', $ruta_pdf);

        // Enviar por correo

        if ($tipo == 1) {

            $sujeto = 'Nuevo colaborador registrado: ' . $colab['Nombres'] . ' ' . $colab['Apellidos'];
            $body = 'Se ha registrado un nuevo colaborador: <strong>' . $colab['Nombres'] . ' ' . $colab['Apellidos'] . '</strong>';
            $altbody = 'Nuevo colaborador registrado.';

        }elseif ($tipo == 2) {

            $sujeto = "Ingreso/ Salida desde edicion " . $colab['Nombres'] . ' ' . $colab['Apellidos'];
            $body = "Se envio la informacion de " . $colab['Nombres'] . " " . $colab['Apellidos'] ." desde la edicion ";
            $altbody = "Datos del usuario";
            
        }elseif ($tipo == 3) {

            $sujeto = 'Colaborador de baja: ' . $colab['Nombres'] . ' ' . $colab['Apellidos'];
            $body = 'Se ha dado de baja a un colaborador: <strong>' . $colab['Nombres'] . ' ' . $colab['Apellidos'] . '</strong>';
            $altbody = 'Colaborador de baja.';
            
        }else {

            $sujeto = "";
            $body = "";
            $altbody = "";
            
        }

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'notificaciones@grupopcr.com.pa';
            $mail->Password = 'R>xv7A=u[3WnJ{rDg;#S'; // ⚠️ RECOMENDACIÓN: usa variables de entorno o archivos seguros
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('notificaciones@grupopcr.com.pa', 'Notificaciones Grupo PCR');
            $mail->addAddress('pedro.arrieta@grupopcr.com.pa', 'Pedro Arrieta');
            $mail->addAttachment($ruta_pdf);

            $mail->isHTML(true);
            $mail->Subject = $sujeto; //'Nuevo colaborador registrado: ' . $colab['Nombres'] . ' ' . $colab['Apellidos'];
            $mail->Body    = $body;  //'Se ha registrado un nuevo colaborador: <strong>' . $colab['Nombres'] . ' ' . $colab['Apellidos'] . '</strong>';
            $mail->AltBody = $altbody;

            $mail->send();

            unlink($ruta_pdf); // Eliminar archivo temporal después de enviar

        } catch (Exception $e) {
            error_log("Error al enviar correo de registro: " . $mail->ErrorInfo);
        }
    }


    public function enviar_email_desde_tabla(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_correo_tabla'])) {

        $this->enviarPDFRegistro($_POST['NroEmpleado'], 2);
        echo '<div class="alert alert-success">Correo Enviado.</div>';
            
        }

    }


    public function main(){
        include 'views/main.php';
    }

    public function salir(){
        include 'views/salir.php';
    }
}
