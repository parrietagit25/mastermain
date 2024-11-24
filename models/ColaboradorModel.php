<?php 

include_once 'Database.php';

class ColaboradorModel extends Database {

    public function update($table, $data, $conditions) {
        $conn = $this->getMySQLConnection(); // Obtiene la conexión
        if (empty($data) || !is_array($data)) {
            return false;
        }
        
        $setParts = [];
        foreach ($data as $key => $value) {
            $setParts[] = "$key = ?";
        }
        $setString = implode(', ', $setParts);
        
        $whereParts = [];
        $whereValues = [];
        foreach ($conditions as $key => $value) {
            $whereParts[] = "$key = ?";
            $whereValues[] = $value;
        }
        $whereString = implode(' AND ', $whereParts);

        $allValues = array_merge(array_values($data), $whereValues);
        $types = str_repeat('s', count($allValues));

        $query = "UPDATE $table SET $setString WHERE $whereString";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die('Error de preparación de consulta: ' . $conn->error);
        }
        $stmt->bind_param($types, ...$allValues);
        return $stmt->execute();
    }

    public function insert($table, $data) {
        $conn = $this->getMySQLConnection(); 
        if (empty($data) || !is_array($data)) {
            return false;
        }
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die('Error de preparación de consulta: ' . $conn->error);
        }
        $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data));
        return $stmt->execute();
    }

    public function all_colab() {
        $lista_col = [];
        $conn = $this->getMySQLConnection();
        $stmt = $conn->query("SELECT * FROM comisiones_colaboradores");
        while ($list = $stmt->fetch_array()) {
            $lista_col[] = $list; 
        }
        return $lista_col;
    }

    public function eliminar($table, $id_eli) {
        $conn = $this->getMySQLConnection();
        $stmt = $conn->query("DELETE FROM $table WHERE id = $id_eli");
        return true;
    }

    public function all_comisiones($desde, $hasta){

        //echo "SELECT * FROM comisiones WHERE fecha_log >= '".$desde."' AND fecha_log <= '".$hasta."'";
        $where = '';
        if ($_SESSION['tipo_usuario'] == 'admin') {
            $where = '';
        }else{
            $where = " AND departamento = '".$_SESSION['tipo_usuario']."'";
        }

        if ($desde == '' || $hasta == '') {

         return NULL;   
         
        }else{
        $lista_rep = [];
        $conn = $this->getMySQLConnection();
        $stmt = $conn->query("SELECT * FROM comisiones WHERE fecha_periodo >= '".$desde."' AND fecha_periodo <= '".$hasta."' $where");
        while ($list = $stmt->fetch_array()) {
            $lista_rep[] = $list; 
        }
        return $lista_rep;

        }

    }

    public function get_colab_id($id){

        $lista_rep = [];
        $conn = $this->getMySQLConnection();
        $stmt = $conn->query("SELECT * FROM comisiones_colaboradores WHERE id = '".$id."'");
        while ($list = $stmt->fetch_array()) {
            $lista_rep[] = $list; 
        }
        return $lista_rep;

    }

}
