<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];
$clave = $data["clave"];
$descripcion = $data["descripcion"];
$imagen = $data["imagen"];
$costo = $data["costo"];
$stock = $data["stock"];
$pifi_id = $data["pifi_id"];

$sql1 = "INSERT INTO `articulo`(`clave`, `descripcion`, `imagen` , `costo`, `pifi_id`, `stock`) VALUES ('".$clave."','".$descripcion."','".$imagen."',".$costo.",".$pifi_id.",".$stock.")";
try {
    $response = array();
    $result = $conn->query($sql1);
    if ($result) {
        echo json_encode($result);
        }  
    }
catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>