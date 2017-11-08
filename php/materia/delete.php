<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];
  
//Set the variable conexion Ej $conn
insertMaterias($conn,$id);
 
function insertMaterias($conn,$id){
    $sql ="DELETE FROM `materia` WHERE id = ".$id; 
    try {
        $response = array();
        $result = $conn->query($sql);  
        if ($result) {
            echo json_encode("OK");
            }  
        }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
?>