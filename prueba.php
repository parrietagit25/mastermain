<?php 
$usuario = 'dolPanamaRW'; 
$contrasena = 'VfsbJpYp'; 

$credenciales = base64_encode("$usuario:$contrasena");

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://cq1e.barscloud.com:612/dolPanamaRW/queryapi/apiDuebacks.mf?dtsdate=2024-06-01&dtedate=2024-07-31',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic ' . $credenciales,
    'Cookie: CQCSBROWSEID=171747108654718482; CQCSID=c_8NOOl9ofw8Wd7VZRwVOQ##'
  ),
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => false,
));

$response = curl_exec($curl);

if ($response === false) {
    $error_msg = curl_error($curl);
    echo "cURL Error: $error_msg";
} else {
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo "HTTP Code: $http_code\n";
    echo "Response: $response\n";
}