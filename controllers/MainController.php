<?php 

class MainController{

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

            //exec("python core/sepafac/separacion_facturas.py", $output, $return_var);
            //$output2 = shell_exec('python /core/sepafac/separacion_facturas.py');
            shell_exec('python /core/sepafac/separacion_facturas.py');
            system('python core/sepafac/separacion_facturas.py');
            passthru('python core/sepafac/separacion_facturas.py');
            pclose(popen("start /B python core/sepafac/separacion_facturas.py", "r"));
            /*echo $output;
            echo '<pre>';
            var_dump($output);
            echo '</pre>';
            echo '2-'.$output2; */
/*
                foreach ($output as $line) {
                    echo $line . "<br>";
                }
                if ($return_var == 0) {
                    echo "Ejecución exitosa";
                } else {
                    echo "Error en la ejecución";
                } */
        }
    }

}