<?php 
session_start();
// index.php
require_once('controllers/UserController.php');
require_once('controllers/MainController.php');
require_once('controllers/JobsController.php');

$controller = new UserController();
$archivos = new MainController();
$jobs = new JobsController();

if (isset($_POST['casio'])) {
    $archivos->ejecutarPython();
}

if (isset($_POST['separar'])) {
    $archivos->separarFacturas();
}

if (!isset($_SESSION['user_id'])) {
    $controller->login();
}elseif(isset($_GET['pag']) && $_GET['pag'] == 'main'){
    $controller->main();
    $jobs->obtener_datos_faltantes();
}elseif(isset($_GET['pag']) && $_GET['pag'] == 'reg_user'){
    $controller->register();
}elseif(isset($_GET['pag']) && $_GET['pag'] == 'salir'){
    $controller->salir();
}else{
    $controller->main();
    $jobs->obtener_datos_faltantes();
}
