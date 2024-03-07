<?php 

include_once 'Database.php';

class ColaboradorModel extends Database {

    public function insert($table, $data) {
        $conn = $this->getMySQLConnection(); // Obtiene la conexión
        if (empty($data) || !is_array($data)) {
            return false;
        }
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $conn->prepare($query);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    public function all_colab() {
        $conn = $this->getMySQLConnection();
        $stmt = $conn->prepare("SELECT * FROM comisiones_colaboradores");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
