<?php 

require_once 'models/JobsModel.php';


class JobsController {
    private $model;

    public function __construct() {
        $this->model = new JobsModel();
    }

    public function obtener_datos_faltantes() {

        $this->model->getDatosFaltantes();
        include 'views/main.php';
    }

}