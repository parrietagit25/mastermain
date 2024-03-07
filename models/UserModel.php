<?php 

include_once 'Database.php';

class UserModel extends Database {

    /*
    public function __construct() {
        parent::__construct();
    } */

    public function inicio_session($email, $password) {
        $conn = $this->getMySQLConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['pass'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nombre'];
            return true; // Devuelve true para indicar éxito
        } else {
            return false; // Devuelve false si la autenticación falla
        }
    }

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

    public function all_user() {
        $conn = $this->getMySQLConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
