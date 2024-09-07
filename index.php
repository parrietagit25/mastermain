<?php

session_start();

require_once('models/Database.php');

require_once('controllers/UserController.php');
require_once('controllers/MainController.php');
require_once('controllers/JobsController.php');
require_once('controllers/ColaboradorController.php');
require_once('controllers/BuebacksController.php');
require_once('controllers/RetencionesController.php');
require_once('controllers/ReservaDiaAnteriorController.php');

$userController = new UserController();
$mainController = new MainController();
$jobsController = new JobsController();
$colaboradorController = new ColaboradorController();
$duebacks = new BuebacksController();
$retenciones = new RetencionesController();
$reservasdiaanterior = new ReservaDelDiaAnteriorController();

$listado_no_list_comi = "";



if (isset($_POST['registrar_colaborador'])) {
    $var_post = $_POST;
    $reg_colb = $colaboradorController->add_colab($var_post);
}

if (isset($_POST['subir_comision_colaborador'])) {
    $listado_no_list_comi = $mainController->main();
}

if (isset($_POST['editar_colaborador'])) {

    $var_post = $_POST;

    $colaboradorController->actualizar_colab($var_post);
}

if (isset($_POST['id_eliminar_colaborador'])) {

    $var_post = $_POST['id_eliminar_colaborador'];

    $colaboradorController->eliminar_colab($var_post);
}

if (!isset($_SESSION['user_id'])) {
    $userController->login();
} else {
    if (isset($_GET['pag'])) {
        switch ($_GET['pag']) {
            case 'main':
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
                
                $mostar_colab = $colaboradorController->all_colab();
                $colaboradorController->getAndShowAllColab(); 
                break;
            case 'rep_comisiones':
                $mainController->all_comisiones();
                break;
            case 'rep_comisiones_anio':
                $mainController->reporte_comisiones();
                break;
            case 'duebacks':
                $resul_api_due = $duebacks->duebacks();
                include 'views/duebacks.php';
                break;
            case 'reservadiaanterior':
                $resul_api_diaanterior = $reservasdiaanterior->reservadiaanterior();
                include 'views/reservadiaanterior.php';
                break;
            case 'retenciones':
                $resul_retenciones = $retenciones->proveedores();
                $retenciones_print = $retenciones->enviar_retenciones();
                $retenciones_enviadas = $retenciones->send_reten();
                include 'views/retenciones.php';
                break;
            default:
                $jobsController->jobs_list();
                include_once 'views/main.php'; 
        }
    } else {

        $jobsController->jobs_list();
        include_once 'views/main.php';
    }
}
