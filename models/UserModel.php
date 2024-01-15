<?php 
include 'coneccion.php';
// models/UserModel.php
class UserModel extends Database{

    public function __construct() {
        $this->getConnection(); 
    }

    public function getUserByUsername($username) {
        
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

    public function inicio_session($email, $password) {

        session_start();

        $email = $email;
        $password = $password;

        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['pass'])) {
            // Si la verificación es exitosa, el usuario inicia sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nombre'];
            // Redirige a la página principal o a donde necesites
            //header("Location: main.php");
        } else {
            // Si las credenciales no son correctas, muestra un error
            echo "Nombre de usuario o contraseña incorrectos.". $password.' *--* '.$user['pass'];
        }
        
    }
}
