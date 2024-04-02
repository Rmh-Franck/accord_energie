<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}
$userid = $_SESSION['userid'];

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


if(isset($_POST['user_id'])){
    $_SESSION['user_id'] = $_POST['user_id'];
}

if(isset($_POST['role'])){
    $user_id = $_SESSION['user_id'];
    $new_role = $_POST['role'];

    $insert_query = "UPDATE users SET role = '$new_role' WHERE id= '$user_id'";
        if ($conn->query($insert_query) === TRUE) {
            switch ($_SESSION['role']){
                case 'Client':
                    header("Location: interventions.php");
                    break;
                case 'Intervenant':
                    header("Location: interventions_intervenant.php");
                    break;
                case 'Standardiste':
                    header("Location: interventions_standardiste.php");
                    break;
                case 'Admin':
                    header("Location: utilisateurs_admin.php");
                    break;
            }
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    
}
$conn->close();
?>