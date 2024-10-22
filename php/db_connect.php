<?php
$servername = "db5016526420.hosting-data.io";
$username = "dbu1197814";
$password = "Neilpogi!";
$dbname = "dbs13413406";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
