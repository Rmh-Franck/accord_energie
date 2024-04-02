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


if(isset($_POST['intervention_id'])){
    $_SESSION['intervention_id'] = $_POST['intervention_id'];
}

if(isset($_POST['status'])){
    $intervention_id = $_SESSION['intervention_id'];
    $new_status = $_POST['status'];

    $insert_query = "UPDATE interventions SET status = '$new_status' WHERE id= '$intervention_id'";
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
                    header("Location: interventions_admin.php");
                    break;
            }
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    
}
$conn->close();
?>