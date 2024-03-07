<?php 

require_once 'models/ColaboradorModel.php';

class ColaboradorController {
    private $model;

    public function __construct() {
        $this->model = new ColaboradorModel();
    }

    public function all_colab(){
        return $this->model->all_colab();
    }

    public function getAndShowAllColab() {

        if (isset($_POST['registrar_colaborador'])) {

            unset($_POST['registrar_colaborador']);

            $this->model->insert('comisiones_colaboradores', $_POST);
            echo 'Colaborador Registrado';
        }

        $all_colaborador = self::all_colab(); 
        include 'views/register_colab.php'; 
    }

    public function main(){
        include 'views/main.php';
    }

    public function salir(){
        include 'views/salir.php';
    }
}
