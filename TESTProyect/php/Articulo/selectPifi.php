<?php
require 'mysqli_connect.php';
consultarPifis($conn);

function consultarPifis($conn){
    $sql ="SELECT * FROM `pifi`"; 
    try {
        $response = array();
        $result = $conn->query($sql);  
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = array('id' => $row['id'],'clave' => $row['clave'], 'descripcion' => $row['descripcion'], 'nombre' => $row['nombre'], 'fecha' => $row['fecha']);
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