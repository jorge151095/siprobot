<?php
require 'mysqli_connect.php';

$sql ="SELECT `equipo`.`materia_id`, `equipo_alumno`.`equipo_id`,`alumno`.`id`,`alumno`.`nombre`,`alumno`.`apellido1`,`alumno`.`apellido2`,`materia`.`nombre`AS materia_nombre FROM `equipo` INNER JOIN equipo_alumno ON `equipo`.`id` = `equipo_alumno`.`equipo_id` INNER JOIN alumno ON `equipo_alumno`.`alumno_id` = `alumno`.`id` INNER JOIN materia ON `equipo`.`materia_id` = `materia`.`id` "; 
try {
    $response = array();
    $result = $conn->query($sql);  
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $response[] = array('materia_id' => $row['materia_id'],'equipo_id' => $row['equipo_id'], 'id' => $row['id'], 'nombre' => $row['nombre'], 'apellido1' => $row['apellido1'], 'apellido2' => $row['apellido2'], 'materia_nombre' => $row['materia_nombre']);
        }
        echo json_encode($response);
    }
    else {
        echo json_encode("Consult null");
    }
} catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}
?>