<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="user_bank"

// Skapa anslutning
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollera anslutning
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Skapa databasen
$sql = "CREATE DATABASE user_bank";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Anslut till databasen
$conn = new mysqli($servername, $username, $password, "user_bank");

// Skapa tabellen
$sql = "CREATE TABLE user_info (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_bank_name VARCHAR(50) NOT NULL,
    user_name VARCHAR(50) NOT NULL,
    user_surname VARCHAR(50) NOT NULL,
    user_bank_ DECIMAL (50,2) NOT NULL,
    user_email VARCHAR(50) NOT NULL,
    picture VARCHAR(255) NOT NULL,
)";

if ($conn->query($sql) === TRUE) {
    echo "Table user_info created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
