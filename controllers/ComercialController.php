<?php 

include 'models/ComercialModel.php';

class Comercial{


    public function __construct() {
        $this->model = new ComercialModel();
    }

    public function getCentroCosto(){
        return $this->model->getCentroCostro();
    }


}