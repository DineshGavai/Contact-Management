<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact_management"; // Added the database name

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
} else {
    // Create the database
    $create_db_query = "CREATE DATABASE IF NOT EXISTS $database"; // Added IF NOT EXISTS to avoid creating if it already exists

    if (mysqli_query($conn, $create_db_query)) {
        // Select the database
        mysqli_select_db($conn, $database);

        // Create the table
        $create_table_query = "CREATE TABLE IF NOT EXISTS contact (
            name varchar(30),
            email varchar(30),
            phone varchar(10),
            city varchar(15)
        )";

        mysqli_query($conn, $create_table_query);
        
    } else {
        echo "Error creating database: " . mysqli_error($conn);
    }
}
?>
