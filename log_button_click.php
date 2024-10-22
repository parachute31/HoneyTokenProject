
<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $button_color = $_POST['button_color'];
    $username = 'admin'; // Assuming username is admin for honeypot purposes

    // Get Geolocation Information
    $ip = $_SERVER['REMOTE_ADDR'];
    $locationData = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
    $city = $locationData->city;
    $country = $locationData->country;

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO user_activity (username, button_clicked, city, country) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $button_color, $city, $country);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
