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

$sql = " UPDATE `articulo` SET `clave`= '".$clave."', descripcion = '".$descripcion."', imagen = '".$imagen."', costo = ".$costo.", stock = ".$stock.", pifi_id =".$pifi_id." WHERE id = ".$id;
try {
    $response = array();
    $result = $conn->query($sql); 
    if ($result) {
        echo json_encode("OK");
        }  
    }catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}
?>