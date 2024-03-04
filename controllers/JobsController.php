<?php 

require_once 'models/JobsModel.php';

class JobsController {
    private $model;

    public function __construct() {
        $this->model = new JobsModel();
    }

    public function obtener_datos_faltantes() {
        // Asegúrate de que getDatosFaltantes haga lo que se espera y considera qué hacer con los datos
        $datos = $this->model->getDatosFaltantes();
        // Posiblemente procesar $datos o pasarlos a la vista
        include 'views/main.php';
    }

    public function jobs_list(){

        $datos = $this->model->jobs_list();
        return $datos;

    }
}
