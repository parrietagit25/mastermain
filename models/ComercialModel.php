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
            $query = "SELECT * FROM tbCostCenterFee"; // Cambia esta consulta según tu tabla
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }

    public function getCateCliente() {
        try {
            $query = "SELECT * FROM tbCatCteFee"; // Cambia esta consulta según tu tabla
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }

    public function getTarifaVehiculo() {
        try {
            $query = "SELECT * FROM tbVehicleRate"; // Cambia esta consulta según tu tabla
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }


}