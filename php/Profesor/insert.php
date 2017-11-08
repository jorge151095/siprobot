<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$nombre = $data["name"];
$id = $data["id"];
//$profesor_id = $data["profesor_id"]; //Color verde es variable JSON

$sql1 = "INSERT INTO `profesor`(`id`, `nombre`) VALUES (".$id.",'".$nombre."')";
//$sql2 = "INSERT INTO `materia_profesor`(`profesor_id`,`materia_id`) VALUES (".$profesor_id.",".$materia_id.")";
try {
    $response = array();
    $result = $conn->query($sql1);
    //$result2 = $conn->query($sql2);
    if ($result) { //if ($result && $result2)
        echo json_encode("OK");
        echo "Sí sirvio we";
        }
    }
catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
    echo "No sirvio we";
}

?>
