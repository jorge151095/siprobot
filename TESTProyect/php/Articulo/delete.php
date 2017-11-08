<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];
  
//Set the variable conexion Ej $conn
deleteArt($conn,$id);
 
function deleteArt($conn,$id){
    $sql2 ="DELETE FROM `articulo` WHERE id = ".$id; 
    try {
        $result2 = $conn->query($sql2);
        if ($result2) {
            echo json_encode("OK");
            }  
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
?>