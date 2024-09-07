<?php

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="reportCommissions.csv"');

function decimal_0($monto){
    $arr_nu = explode('.', (string)$monto);

    if ($arr_nu[1] == '00') {
        return (int)$monto;
    }else {
        return $monto;
    }
}

if (isset($_POST['desde']) && isset($_POST['hasta'])) {
    $mysqli = new mysqli("localhost", "root", "elchamo1787$$$", "mastermain");
    $desde = $mysqli->real_escape_string($_POST['desde']);
    $hasta = $mysqli->real_escape_string($_POST['hasta']);

    $comisiones = $mysqli->query("SELECT * FROM comisiones WHERE fecha_log >= '".$desde."' AND fecha_log <= '".$hasta."'");

    $output = fopen('php://output', 'w');

    // fputs($output, "codigo_colaborador,comision,vale\n");

    $comision_val;

    while ($comision = $comisiones->fetch_assoc()) {
        $comision_val = $comision['comision'];
        
        if($comision_val == 0 || $comision_val == 0.00){
            $comision_val = '';
        }
        
        if ($comision_val == '') {
            $comision_val = '';
        }else{
            $comision_val = decimal_0($comision_val);
        }

        $linea = $comision['codigo_colaborador'].','.$comision_val.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.','.',';

        fputs($output, $linea . "\n");
    }

    fclose($output);

}
?>
