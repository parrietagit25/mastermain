<?php

session_start();

require_once('models/Database.php');

require_once('controllers/UserController.php');
require_once('controllers/MainController.php');
require_once('controllers/JobsController.php');
require_once('controllers/ColaboradorController.php');
require_once('controllers/BuebacksController.php');
require_once('controllers/rep_comisiones_corp.php');
require_once('controllers/RetencionesController.php');
require_once('controllers/ReservaDiaAnteriorController.php');
require_once('controllers/ComercialController.php');
require_once('controllers/OverdueController.php');
require_once('controllers/FormularioIngreso.php');

require_once('controllers/ReservasController.php');

$userController = new UserController();
$mainController = new MainController();
$jobsController = new JobsController();
$colaboradorController = new ColaboradorController();
$duebacks = new BuebacksController();
$corp = new CorpController();
$retenciones = new RetencionesController();
$reservasdiaanterior = new ReservaDelDiaAnteriorController();
$comerciaController = new Comercial();
$reservasController = new JornadaController();

$formulario_ingreso = new FormularioIngesoController();
//$formularioIngresoController = new FormularioController();

$listado_no_list_comi = "";

if (isset($_POST['cambiar_pass_user'])) {
    $var_post = $_POST;
    $reg_colb = $userController->cambiar_pass($var_post);
}

if (isset($_POST['editar_por_centro_costo'])) {
    $id = $_POST['editar_por_centro_costo']; 
    unset($_POST['editar_por_centro_costo']);
    $edit_comercial = $comerciaController->editar_centro_costo($_POST, $id);
}

if (isset($_POST['eliminar_por_centro_costo'])) {
    $eliminar_comercial = $comerciaController->eliminar_centro_costo($_POST['eliminar_por_centro_costo']);
}

if (isset($_POST['editar_por_cliente'])) {
    $id = $_POST['editar_por_cliente']; 
    unset($_POST['editar_por_cliente']);
    $edit_comercial = $comerciaController->editar_categoria_cliente($_POST, $id);
}

if (isset($_POST['eliminar_por_cliente'])) {
    $eliminar_comercial = $comerciaController->eliminar_categoria_cliente($_POST['eliminar_por_cliente']);
}

if (isset($_POST['editar_por_tarifa'])) {
    $id = $_POST['editar_por_tarifa']; 
    unset($_POST['editar_por_tarifa']);
    $edit_comercial = $comerciaController->editar_tarifa_vehiculo($_POST, $id);
}

if (isset($_POST['guardar_tarifa'])) {
    unset($_POST['guardar_tarifa']);
    $insert = $comerciaController->insertar_tarifa($_POST);
}

if (isset($_POST['eliminar_por_tarifa'])) {
    $eliminar_comercial = $comerciaController->eliminar_tarifa_vehiculo($_POST['eliminar_por_tarifa']);
}

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

if (isset($_FILES['archivo_excel']) && $_FILES['archivo_excel']['error'] === 0) {
    $rutaTemporal = $_FILES['archivo_excel']['tmp_name'];
    $subidaExitosa = $reservasController->subirArchivoExcel($rutaTemporal);

    if ($subidaExitosa) {
        header("Location: index.php?pag=reservas&msg=success");
        exit;
    } else {
        header("Location: index.php?pag=reservas&msg=error");
        exit;
    }
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
            case 'rep_comisiones_corp':
                $resul_api_corp = $corp->corp();
                include 'views/rep_comisiones_corp.php';
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
            case 'comercial':
                $gerCentroCosto = $comerciaController->getCentroCosto();
                $gerCateCliente = $comerciaController->getCateCliente();
                $gerVehiculeRate = $comerciaController->getTarifaVehiculo();
                include 'views/comercial.php';
                break;
            case 'finanzas':
                include 'views/finanzas.php';
                break;
            case 'cumplimiento':
                include 'views/cumplimiento.php';
                break;
            case 'overdue':
                include 'views/overdue.php';
                break;
            case 'reservas':
                $jornadas = $reservasController->mostrarJornadas();
                include 'views/reservas_horarios.php';
                break;
            case 'form_int':
                $formulario_ingreso->enviar_email_desde_tabla();
                $all_departament = $formulario_ingreso->all_fingreso_select('tbDepto');
                $all_company = $formulario_ingreso->all_fingreso_select('tbEmpresa');
                $all_boss = $formulario_ingreso->all_fingreso_select('tbJefeInmediato');
                $all_domain = $formulario_ingreso->all_fingreso_select('tbDominio');
                $all_estatus = $formulario_ingreso->all_fingreso_select('tbEstatus');
                $all_puesto = $formulario_ingreso->all_fingreso_select('tbCargo');
                $all_accion = $formulario_ingreso->all_fingreso_select('tbAccion');
                $all_empresa = $formulario_ingreso->all_fingreso_select('tbEmpresa');
                $all_sucursal = $formulario_ingreso->all_fingreso_select('tbSucursal');
                $reg_ing = $formulario_ingreso->reg_ingreso();
                $edit_ing = $formulario_ingreso->editar_ingreso();
                $eli_ing = $formulario_ingreso->eliminar_ingreso();
                $all_ingresos = $formulario_ingreso->all_fingreso();
                include 'views/formulario_ingreso.php';
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
