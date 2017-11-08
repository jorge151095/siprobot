<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];
$nombre = $data["nombre"];
$apellido1 = $data["apellido1"];
$apellido2 = $data["apellido2"];
$materia = $data["materia"];

$sql2 = " UPDATE `alumno` SET `nombre`= '".$nombre."', id = ".$id.", apellido1 = '".$apellido1."', apellido2 = '".$apellido2."' WHERE id = ".$id;
$sql1 = "UPDATE `materia_alumno` SET `materia_id`= ".$materia." WHERE `alumno_id` = ".$id;
try {
    $response = array();
    $result = $conn->query($sql1); 
    $result2 = $conn->query($sql2);
    if ($result && $result2) {
        echo json_encode("OK");
        }  
    }catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}
?>