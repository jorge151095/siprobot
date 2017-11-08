<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$name = $data["name"];
$id = $data["id"];
  
//Set the variable conexion Ej $conn
insertMaterias($conn,$name,$id);
 
function insertMaterias($conn,$name,$id){
    $sql ="UPDATE `materia` SET `nombre`= '".$name."' WHERE id = ".$id; 
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