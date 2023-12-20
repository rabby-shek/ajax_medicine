<?php
function dd($var)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    die();
}

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prescription";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get input from AJAX request
$input = $_GET['input'];

// Perform a database query to get medicine names based on the input
$sql = "SELECT id, medicine_name FROM medicine WHERE medicine_name LIKE '$input%'";
$result = $conn->query($sql);

$options = [];
while ($row = $result->fetch_assoc()) {
    $options[] = [
        'id' => $row['id'],
        'text' => $row['medicine_name'],
    ];
}

// Send the options back to the JavaScript as JSON
header('Content-Type: application/json');
echo json_encode(['results' => $options]);

$conn->close();
?>
