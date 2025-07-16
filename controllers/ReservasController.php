<?php
require_once 'models/ReservasModel.php';

class JornadaController {

    private $modelo;

    public function __construct() {
        $this->modelo = new JornadaModel();
    }

    public function mostrarJornadas() {
        return $this->modelo->obtenerJornadas();
    }

    public function subirArchivoExcel($archivoExcel) {
        return $this->modelo->cargarDesdeExcel($archivoExcel);
    }
}


?>
