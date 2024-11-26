<?php 

class Database {
    private $mysql_host = "10.10.2.6";
    private $mysql_db_name = "mastermain";
    private $mysql_username = "root";
    private $mysql_password = "elchamo1787$$$";
    
    private $sql_server_host = "10.10.2.25";
    private $sql_server_db_name = "PCR";
    private $sql_server_username = "Pcrdwh";
    private $sql_server_password = 'dPcrdwhV646!$W';

    protected $conn;

    // Método para conectar a la base de datos MySQL
    public function getMySQLConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->mysql_host, $this->mysql_username, $this->mysql_password, $this->mysql_db_name);
            //$this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error de conexión MySQL: " . $exception->getMessage();
        }
        return $this->conn;
    }

    // Método para conectar a la base de datos SQL Server
    public function getSQLServerConnection() {
        $this->conn = null;
        try {
            $dsn = "sqlsrv:Server={$this->sql_server_host};Database={$this->sql_server_db_name}";
            $this->conn = new PDO($dsn, $this->sql_server_username, $this->sql_server_password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
