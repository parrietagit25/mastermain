<?php 

// index.php
require_once('controllers/UserController.php');

$controller = new UserController();

// Aquí deberías tener alguna lógica de enrutamiento
// Por ejemplo, si estás en la página de inicio de sesión:
$controller->register();
//$controller->login();
