<?php 
if (isset($modal) && $modal == 1) {
    require_once '../models/ColaboradorModel.php';
}else {
    require_once 'models/ColaboradorModel.php';
}


class ColaboradorController {
    private $model;

    public function __construct() {
        $this->model = new ColaboradorModel();
    }

    public function actualizar_colab($var_post){
        
        if (isset($var_post['editar_colaborador'])) {

            unset($var_post['editar_colaborador']);

            $conditions = [
                'id' => $var_post['id_editar_colaborador']
            ];

            unset($var_post['id_editar_colaborador']);

            $this->model->update('comisiones_colaboradores', $var_post, $conditions);
            echo 'Colaborador Actualizado';
        }
    }

    public function eliminar_colab($id_eli){

        $this->model->eliminar('comisiones_colaboradores', $id_eli);
        echo 'Colaborador Eliminado';

    }

    public function all_colab(){
        return $this->model->all_colab();
    }

    public function getAndShowAllColab() {

        /*if (isset($_POST['registrar_colaborador'])) {

            unset($_POST['registrar_colaborador']);

            $this->model->insert('comisiones_colaboradores', $_POST);
            echo 'Colaborador Registrado';
        } */

        $all_colaborador = self::all_colab(); 
        include 'views/register_colab.php'; 
    }

    public function add_colab($post){
        unset($post['registrar_colaborador']);
        $this->model->insert('comisiones_colaboradores', $post);
        echo 'Colaborador Registrado';

    }

    public function get_colab_id($id){
        return $this->model->get_colab_id($id);
    }

    public function main(){
        include 'views/main.php';
    }

    public function salir(){
        include 'views/salir.php';
    }
}
