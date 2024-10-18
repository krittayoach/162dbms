<?php
// Database configuration
$host = 'localhost';  // Your database host
$dbname = 'dbms';  // Your database name
$username = 'root';  // Your database username
$password = '';  // Your database password (leave blank if no password)

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: set the default fetch mode to fetch as an associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // If there is an error in the connection, catch it and display a message
    die("Error connecting to the database: " . $e->getMessage());
}
?>
