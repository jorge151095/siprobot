<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
//$JSON       = file_get_contents("php://input");
//$request    = json_decode($JSON);
//$usuario    = $request->usuario;
//$contrasena = $request->contrasena;

//Set the variable conexion Ej $conn
consultarProfesor($conn);

function consultarProfesor($conn){
    $sql ="SELECT `profesor`.`id` AS profesorId, `profesor`.`nombre` AS profesorNombre, `materia`.`id` AS materiaId FROM `materia_profesor` INNER JOIN `profesor` ON `alumno`.`id` = `materia_alumno`.`alumno_id` INNER JOIN `materia` ON `profesor`.`id` = `materia_profesor`.`profesor_id`";
    try {
        $response = array();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = array('id' => $row['profesorId'],'nombre' => $row['profesorNombre']);
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
