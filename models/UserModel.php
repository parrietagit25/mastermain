<?php 

include_once 'Database.php';

class UserModel extends Database {

    /*
    public function __construct() {
        parent::__construct();
    } */

    public function actualizar_pass($id_user, $pass, $table){

        $conn = $this->getMySQLConnection();

        $stmt = $conn->query("UPDATE $table SET pass = '".$pass."' WHERE id = '".$id_user."'");

        return true;

    }

    public function inicio_session($email, $password) {
        $conn = $this->getMySQLConnection();
        /* $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
         $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC); */

        $stmt = $conn->query("SELECT * FROM usuarios WHERE email = '".$email."'");

        while ($user_list = $stmt -> fetch_array()) {

            $id_user = $user_list['id'];
            $username = $user_list['nombre'];
            $pass = $user_list['pass'];
            $tipo_use = $user_list['tipo_usuario'];
            
        }
        
        if ($username && password_verify($password, $pass)) {
            $_SESSION['user_id'] = $id_user;
            $_SESSION['username'] = $username;
            $_SESSION['tipo_usuario'] = $tipo_use;
            return true; // Devuelve true para indicar éxito
        } else {
            return false; // Devuelve false si la autenticación falla
        }
    }

    
    public function insert($table, $data) {
        // Verifica que los datos no estén vacíos y sean un arreglo
        if (empty($data) || !is_array($data)) {
            return false;
        }
    
        // Obtiene una conexión a la base de datos MySQL
        try {
            $conn = $this->getMySQLConnection();
        } catch (Exception $e) {
            // Manejo del error en caso de fallar la conexión
            error_log("Error de conexión: " . $e->getMessage());
            return false;
        }
    
        // Prepara los nombres de las columnas
        $columns = implode(", ", array_keys($data));
    
        // Prepara los valores como strings para la consulta SQL
        $values = array_map(function ($value) use ($conn) {
            // Escapa los valores para seguridad y los encierra en comillas
            if (is_string($value)) {
                return "'" . $conn->real_escape_string($value) . "'";
            }
            return $value;
        }, array_values($data));
        $values = implode(", ", $values);
    
        // Construye la consulta SQL
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
    
        try {
            // Ejecuta la consulta
            $conn->query($query);
            return true;
        } catch (Exception $e) {
            // Manejo del error en caso de fallar la ejecución de la sentencia
            error_log("Error en la ejecución: " . $e->getMessage());
            return false;
        }
    }
    

    public function all_user() {
        $lisat_user = [];
        $conn = $this->getMySQLConnection();
        $stmt = $conn->query("SELECT * FROM usuarios");
        while ($user_list = $stmt -> fetch_array()) {
            $lisat_user[] = $user_list;
        }
        return $lisat_user;
    }
}
