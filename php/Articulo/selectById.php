<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
$data = json_decode(file_get_contents('php://input'), true);
$id = $data["id"];
  
//Set the variable conexion Ej $conn
consultarMateriaById($conn,$id);

function consultarMateriaById($conn,$id){
$sql ="SELECT `articulo`.`id` AS id, `articulo`.`clave` AS clave,`articulo`.`descripcion` AS descripcion, `articulo`.`imagen` AS imagen,`articulo`.`costo` AS costo,`articulo`.`stock` AS stock, `pifi`.`id` AS clavepifi FROM `articulo` INNER JOIN `pifi`ON `articulo`.`pifi_id` = `pifi`.`id` WHERE `articulo`.`id` = ".$id; 
    try {
        $response = array();
        $result = $conn->query($sql);  
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = array('id' => $row['id'],'clave' => $row['clave'], 'descripcion' => $row['descripcion'], 'imagen' => $row['imagen'], 'costo' => $row['costo'],'stock' => $row['stock'],'clavepifi' => $row['clavepifi']);
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