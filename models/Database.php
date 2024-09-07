<?php 
/*
class Database {
    private $host = "localhost";
    private $db_name = "mastermain";
    private $username = "root";
    private $password = "";
    protected $conn;

    // Método para conectar a la base de datos
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function conectarSQL() {
        $conn = null;
  
        try {
            //$conn = new PDO("mysql:host={$this->server};dbname=dbglmd0nhlfimi", 'u7tutx9cpc5lf', 'Chicho1787$$$');
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connectionString = "odbc:Driver={SQL Server};Server=PEDRO\SQLEXPRESS;Database=PCR;Trusted_Connection=yes;";
            $conn = new PDO($connectionString);
            //echo "Conexión exitosa a la base de datos MySQL.";
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
  
        return $conn;
    }
  
    public function desconectarSQL($conn) {
        $conn = null;
    }

} */
class Database {
    private $mysql_host = "localhost";
    private $mysql_db_name = "mastermain";
    private $mysql_username = "root";
    private $mysql_password = "elchamo1787$$$";
    
    private $sql_server_connection_string = "odbc:Driver={SQL Server};Server=PEDRO\SQLEXPRESS;Database=PCR;Trusted_Connection=yes;";

    protected $conn;

    // Método para conectar a la base de datos MySQL
    public function getMySQLConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli('localhost', 'root', 'elchamo1787$$$', 'mastermain');
            //$this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión MySQL: " . $exception->getMessage();
        }
        return $this->conn;
    }

    // Método para conectar a la base de datos SQL Server
    public function getSQLServerConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO($this->sql_server_connection_string);
            // Configuraciones adicionales para SQL Server pueden ir aquí
        } catch (PDOException $exception) {
            echo "Error de conexión SQL Server: " . $exception->getMessage();
        }
        return $this->conn;
    }

    // Método para desconectar la base de datos (opcional, PHP maneja esto automáticamente)
    public function disconnect() {
        $this->conn = null;
    }
}

