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
        // La implementación sería similar a la proporcionada en JobsModel
    }
}
