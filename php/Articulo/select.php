<?php
require 'mysqli_connect.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
//$JSON       = file_get_contents("php://input");
//$request    = json_decode($JSON);
//$usuario    = $request->usuario; 
//$contrasena = $request->contrasena;
  
//Set the variable conexion Ej $conn
consultarArticulos($conn);

function consultarArticulos($conn){
    $sql ="SELECT `articulo`.`id` AS id, `articulo`.`clave` AS clave,`articulo`.`descripcion` AS descripcion, `articulo`.`imagen` AS imagen,`articulo`.`costo` AS costo,`articulo`.`stock` AS stock, `pifi`.`nombre` AS clavepifi FROM `articulo` INNER JOIN `pifi`ON `articulo`.`pifi_id` = `pifi`.`id`"; 
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