<?php 
// controllers/UserController.php

require_once 'models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function register() {

        if (isset($_POST['registrar_usuario'])) {
            $_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $this->model->insert('usuarios', $_POST);
            echo 'Usuario Registrado';
        }
        
        include 'views/register_user.php';
    }

    public function login() {

        if (isset($_POST['session'])) {
            
            $this->model->inicio_session($_POST['email'], $_POST['password']);
            $jobsController->jobs_list();
            include 'views/main.php';
            
        }else{

            include 'views/login.php';

        }
    }

    public function all_users(){
        return $this->model->all_user();
    }

    public function getAndShowAllUsers() {

        if (isset($_POST['registrar_usuario'])) {

            unset($_POST['registrar_usuario']);

            $_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $this->model->insert('usuarios', $_POST);
            echo 'Usuario Registrado';
        }

        $all_users = self::all_users(); 
        include 'views/register_user.php'; 
    }

    public function main(){
        include 'views/main.php';
    }

    public function salir(){
        include 'views/salir.php';
    }
}
