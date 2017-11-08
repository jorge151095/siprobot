 <?php
$servername = "85.10.205.173";
$username = "laborobo";
$port = "3307";
$password = "335878531";
$dbname = "laboratorio_robo";

$conn = new mysqli($servername, $username, $password, $dbname, $port);
$conn->set_charset("utf8");

if ($conn->connect_error) {
	header('HTTP/1.1 500 Bad connection to Database');
    die($conn->connect_error);
}
