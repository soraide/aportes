<?php

function guidv4()
{
    if (function_exists('com_create_guid') === true)
        return trim(com_create_guid(), '{}');

    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function formato_fechas_server($dato, $format)
{
    if (isset($dato)) {
        $valor = date_format($dato, $format);
    } else {
        $valor = '';
    }
    return $valor;
}

session_start();
$serverName = "192.168.10.26";
$connectionInfo = array("Database" => "dbEscuelaNegocios", "Uid" => "sa2", "PWD" => "123", "CharacterSet" => "UTF-8");
$con = sqlsrv_connect($serverName, $connectionInfo);
if ($con) {
} else {
    die(print_r(sqlsrv_errors(), true));
}
?>