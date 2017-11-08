 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laboratorio_robotica";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
	header('HTTP/1.1 500 Bad connection to Database');
    die($conn->connect_error);
}
