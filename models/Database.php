<?php 

class Database {
    private $mysql_host = "localhost";
    private $mysql_db_name = "mastermain";
    private $mysql_username = "root";
    private $mysql_password = "elchamo1787$$$";
    
    private $sql_server_connection_string = 'DRIVER={ODBC Driver 17 for SQL Server};SERVER=10.10.2.25;DATABASE=PCR;UID=Pcrdwh;PWD=dPcrdwhV646!$W';

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

