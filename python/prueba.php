<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $ruc_prov = $_POST['ruc_prov'];
    
    // Datos a enviar en la solicitud POST
    $data = array(
        'fecha_inicio' => $fecha_inicio,
        'fecha_fin' => $fecha_fin,
        'ruc_prov' => $ruc_prov
    );
    
    // Convertir los datos a JSON
    $data_json = json_encode($data);
    
    // URL del script de Python
    $url = 'http://localhost:5000/generate_report'; // Asegúrate de que esta URL es correcta
    
    // Inicializar cURL
    $ch = curl_init($url);
    
    // Configurar cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
    // Ejecutar la solicitud
    $response = curl_exec($ch);
    
    // Cerrar cURL
    curl_close($ch);
    
    echo $response;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generar Reporte de Retenciones</title>
</head>
<body>
    <form method="post" action="">
        Fecha Inicio: <input type="date" name="fecha_inicio"><br>
        Fecha Fin: <input type="date" name="fecha_fin"><br>
        RUC Proveedor: <input type="text" name="ruc_prov"><br>
        <input type="submit" value="Generar Reporte">
    </form>
</body>
</html>
