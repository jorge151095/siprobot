<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
//$JSON       = file_get_contents("php://input");
//$request    = json_decode($JSON);
//$usuario    = $request->usuario; 
//$contrasena = $request->contrasena;
  
//Set the variable conexion Ej $conn
consultarMaterias($conn);

function consultarMaterias($conn){
    $sql ="SELECT `alumno`.`id` AS alumnoId, `alumno`.`nombre` AS alumnoNombre, `alumno`.`apellido1` AS apellido1, `alumno`.`apellido2` AS apellido2, `materia`.`nombre` AS materiaNombre FROM `materia_alumno` INNER JOIN `alumno` ON `alumno`.`id` = `materia_alumno`.`alumno_id` INNER JOIN `materia` ON `materia`.`id` = `materia_alumno`.`materia_id` "; 
    try {
        $response = array();
        $result = $conn->query($sql);  
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = array('id' => $row['alumnoId'],'nombre' => $row['alumnoNombre'], 'apellido1' => $row['apellido1'], 'apellido2' => $row['apellido2'], 'materia' => $row['materiaNombre']);
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