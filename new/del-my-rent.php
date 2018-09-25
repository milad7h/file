<?php
$database_file = file_get_contents("database.json");
$database_info = json_decode($database_file);

$username = $database_info->username;
$servername = $database_info->servername;
$password = $database_info->password;
$database_name = $database_info->database_name;
// Create connection
$conn = new mysqli($servername, $username, $password, $database_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$rid = $_REQUEST['rid'];
$sql="DELETE FROM rental WHERE id=$rid";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>