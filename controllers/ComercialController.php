<?php 

include 'models/ComercialModel.php';

class Comercial{


    public function __construct() {
        $this->model = new ComercialModel();
    }

    public function getCentroCosto(){
        return $this->model->getCentroCostro();
    }

    public function getCateCliente(){
        return $this->model->getCateCliente();
    }

    public function getTarifaVehiculo(){
        return $this->model->getTarifaVehiculo();
    }

}