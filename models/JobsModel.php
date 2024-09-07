<?php

include_once 'Database.php'; // Asegura la inclusión correcta del archivo

class JobsModel extends Database {
    
    public function jobs_list() {
        // Asumiendo que usas MySQL
        $conn = $this->getMySQLConnection(); // Obtiene la conexión a la base de datos MySQL
        /* $stmt = $conn->prepare("SELECT * FROM jos"); // Asegúrate de que la tabla se llame 'jobs'
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); */ // Obtiene todos los registros
        $jobs = $conn->query("SELECT * FROM jos where stat = 1");

        $arr_job = [];

        while ($list_jobs = $jobs -> fetch_array()) {
            $arr_job[] =$list_jobs;
        }

        return $arr_job;

    }

    public function insert($table, $data) {
        // Asumiendo que usas MySQL
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
}
