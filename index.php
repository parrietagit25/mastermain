<?php

session_start();

require_once('models/Database.php');

require_once('controllers/UserController.php');
require_once('controllers/MainController.php');
require_once('controllers/JobsController.php');
require_once('controllers/ColaboradorController.php');

$userController = new UserController();
$mainController = new MainController();
$jobsController = new JobsController();
$colaboradorController = new ColaboradorController();

$listado_no_list_comi = "";

if (isset($_POST['subir_comision_colaborador'])) {
    $listado_no_list_comi = $mainController->main();
}

if (!isset($_SESSION['user_id'])) {
    $userController->login();
} else {
    if (isset($_GET['pag'])) {
        switch ($_GET['pag']) {
            case 'main':
                //$mainController->main();
                $jobsController->jobs_list();
                include_once 'views/main.php';
                break;
            case 'reg_user':
                $userController->all_users();
                $userController->getAndShowAllUsers(); // Modificado aquí
                break;
            case 'salir':
                $userController->salir();
                break;
            case 'reg_colab':
                $colaboradorController->all_colab();
                $colaboradorController->getAndShowAllColab(); 
                break;
            default:
                //$mainController->main();
                $jobsController->jobs_list();
                include_once 'views/main.php'; 
        }
    } else {

        $jobsController->jobs_list();
        //$mainController->main();
        include_once 'views/main.php';
    }
}
