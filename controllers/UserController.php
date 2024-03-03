<?php 
// controllers/UserController.php

require_once 'models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new JobsModel();
    }

    public function register() {

        if (isset($_POST['pass'])) {
            $_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $this->model->insert('usuarios', $_POST);
            // Redirigir al usuario a la página de inicio de sesión o a donde prefieras
            echo 'Usuario Registrado';
        }

        include 'views/register_user.php';
    }

    public function login() {

        if (isset($_POST['session'])) {
            
            $this->model->inicio_session($_POST['email'], $_POST['password']);
            include 'views/main.php';
            
        }else{

            include 'views/login.php';

        }
    }

    public function main(){
        include 'views/main.php';
    }

    public function salir(){
        include 'views/salir.php';
    }
}
