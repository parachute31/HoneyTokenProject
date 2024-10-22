
<?php
$servername = "INSERTSERVERNAMEHERE";
$username = "INSERTNAMEHERE";
$password = "INSERTPASSWORDHERE";
$dbname = "INSERTDATABASENAMEHERE";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
