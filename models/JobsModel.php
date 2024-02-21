<?php 

//include 'coneccion.php';


class JobsModel extends Database{

    public function __construct() {
        $this->conectarSQL(); 
    }

    public function getDatosFaltantes() {

        $stmt = $this->conn->prepare("SELECT * FROM InterWeb_Automarket_datosFaltantes");
        $stmt->execute();
        $datos_faltantes = $stmt->fetch(PDO::FETCH_ASSOC);
        return $datos_faltantes;
        
    }

    // Método para insertar datos
    public function insert($table, $data) {
        if (empty($data) || !is_array($data)) {
            return false;
        }
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->conn->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}
