<?php 

require_once 'models/JobsModel.php';

class MainController{

    private $model;

    public function __construct() {
        $this->model = new JobsModel();
    }

    public function ejecutarPython(){

        if (isset($_FILES['files'])) { 

            $targetDirectory = "core/sepafac/f_sinseparar/"; 

            foreach ($_FILES['files']['name'] as $i => $name) {
                if (strlen($_FILES['files']['name'][$i]) > 1) {
                    $extension = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);

                    if ($extension == "rar" || $extension == "zip") {
                        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetDirectory.$name)) {
                            echo "El archivo $name ha sido subido.";
                        } else {
                            echo "Hubo un error al subir el archivo $name.";
                        }
                    } else {
                        echo "Archivo $name no permitido. Solo se admiten archivos .rar o .zip.";
                    }

                }
            }
            
        }
        
    }

    public function separarFacturas(){

        echo 'pasando la separacion';

        if (isset($_POST['separar'])) { 

            //exec("python C:/xampp2/htdocs/masterMain/core/sepafac/separacion_facturas.py", $output, $return_var);
            
                
                // El camino al script de Python
                $pythonScript = 'C:/xampp2/htdocs/masterMain/core/sepafac/ejepy.bat';
                // Argumentos adicionales para el script de Python
                $argumentos = '';
                // Comando completo
                $comando = "$pythonScript $argumentos";

                // Ejecuta el comando
                exec($comando, $output, $return_var);

                // $output es un array con cada línea de salida del script
                foreach ($output as $line) {
                    echo $line . "\n";
                }

                // Verifica si hubo errores
                if ($return_var !== 0) {
                    echo "Error al ejecutar el script Python. Código de retorno: $return_var";
                }
        }
    }

    public function jobs_list(){

        return $this->model->inicio_session();

    }

}