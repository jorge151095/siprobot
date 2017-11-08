<?php
require 'mysqli_connect.php';

$sql ="SELECT * FROM equipo "; 
try {
    $response = array();
    $result = $conn->query($sql);  
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $response[] = array('id' => $row['id']);
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