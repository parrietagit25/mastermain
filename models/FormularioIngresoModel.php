<?php 

require_once 'Conexion.php';

class FormularioIngresoModel extends Database {

    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function all_fingreso() {
        $conn = $this->conexion->conectar();
    
        $lista_col = [];
        $stmt = $this->conexion->ejecutarConsulta("SELECT * FROM tbforminout");
    
        return $stmt;
    }

    public function all_fingreso_select($tabla){
        $conn = $this->conexion->conectar();
    
        $lista_col = [];
        $stmt = $this->conexion->ejecutarConsulta("SELECT * FROM $tabla");

        return $stmt;
    }



}