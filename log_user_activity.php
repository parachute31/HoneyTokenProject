
<?php
include 'db_connect.php';

$query = "SELECT * FROM user_activity";
$result = $conn->query($query);

echo "<h2>User Activity Log</h2>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Button Clicked</th>
            <th>Bot Name</th>
            <th>Downloaded File</th>
            <th>City</th>
            <th>Country</th>
            <th>Timestamp</th>
        </tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['button_clicked']}</td>
                <td>{$row['bot_name']}</td>
                <td>{$row['downloaded_file']}</td>
                <td>{$row['city']}</td>
                <td>{$row['country']}</td>
                <td>{$row['timestamp']}</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No user activity found</td></tr>";
}

echo "</table>";
$conn->close();
?>
