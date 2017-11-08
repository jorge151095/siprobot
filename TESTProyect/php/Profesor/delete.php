<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];

//Set the variable conexion Ej $conn
deleteProfesor($conn,$id);

function deleteProfesor($conn,$id){
    $sql2 ="DELETE FROM `profesor` WHERE id = ".$id;
    $sql1 ="DELETE FROM `materia_profesor` WHERE profesor_id = ".$id;
    try {
        $result = $conn->query($sql1);
        $result2 = $conn->query($sql2);
        if ($result && $result2) {
            echo json_encode("OK");
            }
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
?>
