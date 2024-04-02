<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "accordenergie";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE mail='$mail' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION['nom'] = $row['nom'];
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
    } 
    else {
        echo "Invalid username or password";
    }
}
$conn->close();
?>
