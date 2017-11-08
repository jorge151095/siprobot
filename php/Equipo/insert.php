<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id_materia = $data["id_materia"];

$sql1 = "INSERT INTO `equipo`(`materia_id`) VALUES (".$id_materia.")";
$sql2 = "SELECT id FROM equipo ORDER BY id DESC";
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