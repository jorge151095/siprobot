<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];
$nombre = $data["nombre"];
$apellido1 = $data["apellido1"];
$apellido2 = $data["apellido2"];
$materia = $data["materia"];

$sql1 = "INSERT INTO `alumno`(`id`, `nombre`, `apellido1`, `apellido2`) VALUES (".$id.",'".$nombre."','".$apellido1."','".$apellido2."')";
$sql2 = "INSERT INTO `materia_alumno`(`materia_id`, `alumno_id`) VALUES (".$materia.",".$id.")"; 
try {
    $response = array();
    $result = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    if ($result && $result2) {
        echo json_encode("OK");
        }  
    }
catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>