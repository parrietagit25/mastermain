<?php 

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

}
