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

    public function editar_centro_costo($datos, $id){
        $tabla = 'tbCostCenterFee';
        return $this->model->editar_general($datos, $tabla, $id);
    }

    public function eliminar_centro_costo($id){
        $tabla = 'tbCostCenterFee';
        return $this->model->eliminar_general($tabla, $id);
    }

    public function editar_categoria_cliente($datos, $id){
        $tabla = 'tbCatCteFee';
        return $this->model->editar_general($datos, $tabla, $id);
    }

    public function eliminar_categoria_cliente($id){
        $tabla = 'tbCatCteFee';
        return $this->model->eliminar_general($tabla, $id);
    }

    public function editar_tarifa_vehiculo($datos, $id){
        $tabla = 'tbVehicleRate';
        return $this->model->editar_general($datos, $tabla, $id);
    }

    public function eliminar_tarifa_vehiculo($id){
        $tabla = 'tbVehicleRate';
        return $this->model->eliminar_general($tabla, $id);
    }

    public function insertar_tarifa($datos){
        $tabla = 'tbVehicleRate';
        return $this->model->insertar_general($tabla, $datos);
    }

}