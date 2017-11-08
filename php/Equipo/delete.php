<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$equipo_id = $data["equipo"];
$alumno_id = $data["alumno"];

//$sql2 ="DELETE FROM `alumno` WHERE id = ".$id; 
$sql1 ="DELETE FROM `equipo_alumno` WHERE alumno_id = ".$alumno_id." AND equipo_id = ".$equipo_id;  
try {
    $result = $conn->query($sql1);
    if ($result) {
        echo json_encode("OK");
        }  
}catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>