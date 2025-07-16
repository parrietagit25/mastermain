<?php
require_once 'Conexion.php';

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

class JornadaModel {

    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerJornadas() {
        $conn = $this->conexion->conectar();

        if ($conn) {
            $query = "
            SELECT 
                CONVERT(VARCHAR(10), Fecha, 120) AS Fecha,
                CondicionLaboral,
                CONVERT(VARCHAR(8), InicioJornada, 108) AS InicioJornada,
                CONVERT(VARCHAR(8), FinalJornada, 108) AS FinalJornada,
                Condicion2,
                CONVERT(VARCHAR(8), InicioFueraS1, 108) AS InicioFueraS1,
                CONVERT(VARCHAR(8), FinalFueraS1, 108) AS FinalFueraS1,
                CONVERT(VARCHAR(8), InicioFueraS2, 108) AS InicioFueraS2,
                CONVERT(VARCHAR(8), FinalFueraS2, 108) AS FinalFueraS2,
                Condicion1
            FROM HorarioReporteReservas
            ORDER BY Fecha ASC
            ";

            return $this->conexion->ejecutarConsulta($query);
        }

        return [];
    }

    public function cargarDesdeExcel($archivo) {
        try {
            $spreadsheet = IOFactory::load($archivo);
            $hoja = $spreadsheet->getActiveSheet();
            $datos = $hoja->toArray(null, true, true, true);

            $conn = $this->conexion->conectar();
    
            if ($conn) {
                $conn->exec("DELETE FROM HorarioReporteReservas");
    
                $stmt = $conn->prepare("
                    INSERT INTO HorarioReporteReservas 
                    (Fecha, CondicionLaboral, InicioJornada, FinalJornada, Condicion2,
                     InicioFueraS1, FinalFueraS1, InicioFueraS2, FinalFueraS2, Condicion1)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
    
                foreach (array_slice($datos, 1) as $index => $fila) {
                    // Validar y formatear fecha
                    $fechaExcel = $fila['A'];
                
                    if (!empty($fechaExcel)) {
                        $fecha = date('Y-m-d', strtotime($fechaExcel)); // ← Normalización aquí
                    } else {
                        echo "Fila $index: Fecha vacía<br>";
                        continue;
                    }
                
                    $condLab       = $fila['B'];
                    $inicioJornada = $fila['C'];
                    $finalJornada  = $fila['D'];
                    $cond2         = $fila['E'];
                    $inicioS1      = $fila['F'];
                    $finalS1       = $fila['G'];
                    $inicioS2      = $fila['H'];
                    $finalS2       = $fila['I'];
                    $cond1         = $fila['J'];
                
                    // Validar horas
                    foreach ([$inicioJornada, $finalJornada, $inicioS1, $finalS1, $inicioS2, $finalS2] as $hora) {
                        if (!preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', $hora)) {
                            echo "Fila $index: Hora inválida ($hora)<br>";
                            continue 2;
                        }
                    }
                
                    // Pad horas a HH:MM:SS si vienen como H:MM
                    $inicioJornada = date('H:i:s', strtotime($inicioJornada));
                    $finalJornada  = date('H:i:s', strtotime($finalJornada));
                    $inicioS1      = date('H:i:s', strtotime($inicioS1));
                    $finalS1       = date('H:i:s', strtotime($finalS1));
                    $inicioS2      = date('H:i:s', strtotime($inicioS2));
                    $finalS2       = date('H:i:s', strtotime($finalS2));
                
                    // Ejecutar inserción
                    $stmt->execute([
                        $fecha, $condLab, $inicioJornada, $finalJornada, $cond2,
                        $inicioS1, $finalS1, $inicioS2, $finalS2, $cond1
                    ]);
                }
    
                return true;
            } else {
                echo "No hay conexión a la base de datos.";
            }
        } catch (Exception $e) {
            echo "Error en modelo: " . $e->getMessage();
        }
    
        return false;
    }
    

}

?>
