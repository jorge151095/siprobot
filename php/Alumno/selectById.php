<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];
  
//Set the variable conexion Ej $conn
consultarMateriaById($conn,$id);

function consultarMateriaById($conn,$id){
$sql ="SELECT `alumno`.`id` AS alumnoId, `alumno`.`nombre` AS alumnoNombre, `alumno`.`apellido1` AS apellido1, `alumno`.`apellido2` AS apellido2, `materia`.`nombre` AS materiaNombre, `materia`.`id` AS materiaId FROM `materia_alumno` INNER JOIN `alumno` ON `alumno`.`id` = `materia_alumno`.`alumno_id` INNER JOIN `materia` ON `materia`.`id` = `materia_alumno`.`materia_id` WHERE `alumno`.`id` = ".$id; 
    try {
        $response = array();
        $result = $conn->query($sql);  
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = array('id' => $row['alumnoId'],'nombre' => $row['alumnoNombre'], 'apellido1' => $row['apellido1'], 'apellido2' => $row['apellido2'], 'materia' => $row['materiaNombre'], 'materiaId' => $row['materiaId']);
            }
            echo json_encode($response);
        }
        else {
            echo json_encode("Consult null");
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
?>