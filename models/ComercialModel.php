<?php 

//include 'Database.php';

class ComercialModel extends Database{

    private $db;

    public function __construct() {
        $this->db = (new Database())->getSQLServerConnection();
    }

    public function getCentroCostro_tenn(){
        $costo_centro = [];
        $conn = $this->getSQLServerConnection();
        $stmt = $conn->query("SELECT * FROM tbCostCenterFee");
        while ($centro_costo = $stmt -> fetch_array()) {
            $costo_centro[] = $centro_costo;
        }
        return $costo_centro;
    }

    public function getCentroCostro() {
        try {
            $query = "SELECT * FROM tbCostCenterFee"; 
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }

    public function getCateCliente() {
        try {
            $query = "SELECT * FROM tbCatCteFee"; 
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }

    public function getTarifaVehiculo() {
        try {
            $query = "SELECT * FROM tbVehicleRate"; 
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }

    public function editar_general($datos, $tabla, $id){
        $setPart = [];
        foreach ($datos as $campo => $valor) {
            $setPart[] = "$campo = :$campo";
        }
        $setQuery = implode(", ", $setPart);
        $sql = "UPDATE $tabla SET $setQuery WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        foreach ($datos as $campo => $valor) {
            $stmt->bindValue(":$campo", $valor);
        }
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }

    public function eliminar_general($tabla, $id) {
        try {
            $query = "DELETE FROM $tabla WHERE id = $id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }

    public function insertar_general($tabla, $datos) {
        
        $columnas = array_keys($datos); 
        $placeholders = array_map(function($campo) {
            return ":$campo";
        }, $columnas); 
    
        $columnasStr = implode(", ", $columnas); 
        $placeholdersStr = implode(", ", $placeholders); 
    
        $sql = "INSERT INTO $tabla ($columnasStr) VALUES ($placeholdersStr)";
        $stmt = $this->db->prepare($sql);
    
        foreach ($datos as $campo => $valor) {
            $stmt->bindValue(":$campo", $valor);
        }
        $stmt->execute();
    }
    
}