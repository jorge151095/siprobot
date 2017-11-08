<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];

//Set the variable conexion Ej $conn
consultarProfesorById($conn,$id);

function consultarProfesorById($conn,$id){
$sql ="SELECT `profesor`.`id` AS profesorId, `profesor`.`nombre` AS profesorNombre, `materia`.`id` AS materiaId FROM `materia_profesor` INNER JOIN `profesor` ON `alumno`.`id` = `materia_alumno`.`alumno_id` INNER JOIN `materia` ON `profesor`.`id` = `materia_profesor`.`profesor_id` WHERE `profesor`.`id` = ".$id;
    try {
        $response = array();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = array('id' => $row['profesorId'],'nombre' => $row['profesorNombre'], 'materiaId' => $row['materiaId']);
            }
            echo json_encode($response);
        }
        else {
            echo json_encode("Consulta nula");
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
?>
