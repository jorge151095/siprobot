<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$equipo_id = $data["equipo_id"];
$alumno_id = $data["alumno_id"];

$sql1 = "INSERT INTO `equipo_alumno`(`equipo_id`, `alumno_id`) VALUES (".$equipo_id.",".$alumno_id.")";
try {
    $result = $conn->query($sql1);
    if ($result) {
        echo json_encode("OK");
        }  
    }
catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>