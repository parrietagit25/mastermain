<?php 

//include 'Database.php';

class ComercialModel extends Database{


    public function getCentroCostro(){
        $costo_centro = [];
        $conn = $this->getSQLServerConnection();
        $stmt = $conn->query("SELECT * FROM tbCostCenterFee");
        while ($centro_costo = $stmt -> fetch_array()) {
            $costo_centro[] = $centro_costo;
        }
        return $costo_centro;
    }


}