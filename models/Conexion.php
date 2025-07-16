<?php
class Conexion {

    private $conn;

    // Método para establecer la conexión a la base de datos
    public function conectar() {
        $this->conn = null;

        // Definir los detalles de la conexiónS
        $serverName = "10.10.2.25";  // IP del servidor
        $dbName = "DWHPCR";  // Nombre de la base de datos
        $username = "Pcrdwh";  // Usuario de SQL Server
        $password = "dPcrdwhV646!\$W";  // Contraseña (escapar el símbolo $ con una barra invertida)

        try {
            // Configurar el DSN para PDO utilizando ODBC
            $dsn = "odbc:Driver={ODBC Driver 17 for SQL Server};Server=$serverName;Database=$dbName;";
            $this->conn = new PDO($dsn, $username, $password);
            // Establecer atributos de error para PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexión exitosa";
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }

        return $this->conn;
    }

    // Método para ejecutar consultas SQL
    public function ejecutarConsulta($query) {
        if ($this->conn) {
            try {
                // Ejecutar la consulta y obtener los resultados
                $stmt = $this->conn->query($query);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error en la consulta: " . $e->getMessage();
                return false;
            }
        } else {
            echo "No hay conexión establecida.";
            return false;
        }
    }

    // Método para cerrar la conexión
    public function desconectar() {
        $this->conn = null;
    }

}
?>
