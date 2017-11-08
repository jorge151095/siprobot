<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];

$sql1 ="DELETE FROM `prestamo_articulo` WHERE id = ".$id;  
try {
    $result = $conn->query($sql1);
    if ($result) {
        echo json_encode("OK");
        }  
}catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>