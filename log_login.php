<?php
include 'db_connect.php'; // Connect to the database

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug file to log actions
$debug_file = 'log_debug.txt';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the POST request
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $ip = isset($_POST['ip']) ? $_POST['ip'] : '';
    $time = date('Y-m-d H:i:s');  // Use current date in correct MySQL format
    $type = isset($_POST['type']) ? $_POST['type'] : '';

    // Log received POST data for debugging
    file_put_contents($debug_file, "Received POST data: Username: $username, IP: $ip, Time: $time, Type: $type" . PHP_EOL, FILE_APPEND);

    if ($username && $ip && $time && $type) {
        // Prepare and bind parameters to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO login_attempts (username, ip, time, type) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $username, $ip, $time, $type);

            // Execute the query
            if ($stmt->execute()) {
                echo "Log saved successfully";
                file_put_contents($debug_file, "Log saved successfully" . PHP_EOL, FILE_APPEND);
            } else {
                echo "Error during execution: " . $stmt->error;
                file_put_contents($debug_file, "Error during execution: " . $stmt->error . PHP_EOL, FILE_APPEND);
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Statement preparation failed: " . $conn->error;
            file_put_contents($debug_file, "Statement preparation failed: " . $conn->error . PHP_EOL, FILE_APPEND);
        }
    } else {
        echo "Incomplete data received. Username: $username, IP: $ip, Time: $time, Type: $type";
        file_put_contents($debug_file, "Incomplete data received" . PHP_EOL, FILE_APPEND);
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request method. Expected POST.";
    file_put_contents($debug_file, "Invalid request method. Expected POST." . PHP_EOL, FILE_APPEND);
}
?>
