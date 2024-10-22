<?php
include 'db_connect.php'; // Connect to the database

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug file to log actions
$debug_file = 'log_debug.txt';

// Prepare SQL query to get all logs
$sql = "SELECT id, time, username, ip, type FROM login_attempts ORDER BY time DESC";
$result = $conn->query($sql);

$logs = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $logs[] = $row;
    }
    file_put_contents($debug_file, "Successfully retrieved logs from database." . PHP_EOL, FILE_APPEND);
} else {
    // Log if no records were found or there was an error
    if ($result) {
        file_put_contents($debug_file, "No logs found in the database." . PHP_EOL, FILE_APPEND);
    } else {
        file_put_contents($debug_file, "Error retrieving logs from database: " . $conn->error . PHP_EOL, FILE_APPEND);
    }
}

// Set the header to ensure JSON output
header('Content-Type: application/json');
echo json_encode($logs);

// Close the connection
$conn->close();
?>
