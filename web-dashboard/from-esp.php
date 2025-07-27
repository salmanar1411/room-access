<?php

// include "connect.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = "192.168.100.13";
$user = "mavis";
$pass = "!23Mavis";
$db = "esp32"; // Database name

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if UID is sent with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["num1"]) && isset($_POST["num2"])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $api_key = $_POST["api_key"];

    // Validate API key
    $apiKeyValue = "tPmAT5Ab3j7F9"; // Ensure this matches with the value in your ESP32/ESP8266 code
    if ($api_key == $apiKeyValue) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO num (num1, num2) VALUES (?, ?)");
        $stmt->bind_param("ii", $num1, $num2);

        // Execute the statement and check if successful
        if ($stmt->execute()) {
            echo "Data successfully inserted";
        } else {
            echo "Error: " . $stmt->error;
        }

    // Close statement
    $stmt->close();
    } else {
        echo "Invalid request method";
    }
}

// Close connection
$conn->close();
?>
