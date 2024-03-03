<?php 

//include 'coneccion.php';


class JobsModel extends Database{

    private $connec;

    public function __construct() {
        $this->connec = new getConnection();
    }

    public function jobs_list() {

        $stmt = $this->connec->prepare("SELECT * FROM jos");
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
        $stmt = $this->connec->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}
