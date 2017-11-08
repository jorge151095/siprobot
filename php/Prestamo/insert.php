<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$equipo_id = $data["equipo_id"];

$sql1 = "INSERT INTO `prestamo`(`equipo_id`) VALUES (".$equipo_id.")";
$sql2 = "SELECT id FROM prestamo ORDER BY id DESC";
try {
    $result = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
            while($row = $result2->fetch_assoc()) {
                $response[] = array('id' => $row['id']);
            }
            echo json_encode($response);
        }
}catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>