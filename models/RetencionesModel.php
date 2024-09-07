<?php 

include_once 'Database.php';

class RetencionesModel extends Database { 

    public function all_proveedores(){
        $conn = $this->getMySQLConnection();
        $prov = $conn->query("SELECT * FROM proveedores");

        $arr_prov = [];

        while ($list_prov = $prov -> fetch_array()) {
            $arr_prov[] =$list_prov;
        }

        return $arr_prov;
    }

}