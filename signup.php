<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "accordenergie"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    // Check if the username is available
    $check_mail_query = "SELECT * FROM users WHERE mail='$mail'";
    $check_mail_result = $conn->query($check_mail_query);

    if ($check_mail_result->num_rows > 0) {
        echo "Email already exists. Please use another one.";
    } else {
        // Insert user into database
        $insert_query = "INSERT INTO users (nom, prenom, mail, password) VALUES ('$nom', '$prenom', '$mail', '$password')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Account created successfully. You can now <a href='login.html'>login</a>.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
