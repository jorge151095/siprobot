<?php
require 'mysqli_connect.php';

$sql ="SELECT `prestamo_articulo`.`id` AS idPrestamo, `equipo`.`id` AS idEquipo, `articulo`.`clave`, cantidad FROM `prestamo` INNER JOIN `equipo` ON `prestamo`.`equipo_id` = `equipo`.`id` INNER JOIN `prestamo_articulo` ON `prestamo_articulo`.`prestamo_id` = `prestamo`.`id` INNER JOIN `articulo` ON `articulo`.`id` = `prestamo_articulo`.`articulo_id`"; 
try {
    $response = array();
    $result = $conn->query($sql);  
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $response[] = array('id_prestamo' => $row['idPrestamo'],'articulo_clave' => $row['clave'], 'cantidad' => $row['cantidad'],'id_equipo' => $row['idEquipo']);
        }
        echo json_encode($response);
    }
    else {
        echo json_encode("Consult null");
    }
} catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}
?>