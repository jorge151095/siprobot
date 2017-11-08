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
    $sql ="SELECT * FROM materia"; 
    try {
        $response = array();
        $result = $conn->query($sql);  
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = array('id' => $row['id'], 'nombre' => $row['nombre']);
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