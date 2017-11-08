<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$name = $data["name"];

//Set the variable conexion Ej $conn
consultarProfesorByName($conn,$name);

function consultarProfesorBy($conn,$name){
    $sql ="SELECT * FROM profesor WHERE nombre = '".$name."'";
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
