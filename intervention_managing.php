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


    /*if(isset($_POST['userid'])){
        
    }*/

    if(isset($_POST['userid'])){
        $client_id = $_POST['userid'];
        $intervenant_id = $_POST['intervenantid'];
        $title = $_POST['title'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $status = $_POST['status'];
        $intervention_content = $_POST['content'];

        $insert_query = "INSERT INTO interventions (user_id, intervenant_id, title, dateint, heure, status, content) VALUES ('$client_id', '$intervenant_id', '$title', '$date', '$time', '$status', '$intervention_content')";
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
                        header("Location: interventions.php");
                        break;
                }
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        
    }

    if(isset($_POST['comment_id'])){
        $comment_id = $_POST['comment_id'];

        $delete_comment_query = "DELETE FROM comments WHERE id = '$comment_id'";

        if (mysqli_query($conn, $delete_comment_query)) {
            echo "Comment deleted successfully";
            switch ($_SESSION['role']){
                case 'Client':
                    header("Location: interventions.php");
                    break;
                case 'Intervenant':
                    header("Location: interventions_intervenant.php");
                    break;
                case 'Standardiste':
                    header("Location: interventions.php");
                    break;
                case 'Admin':
                    header("Location: interventions.php");
                    break;
            }
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }

    }

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Bungee+Outline&family=League+Spartan:wght@900&family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font.css">
    <title>Interventions</title>
    <link rel="icon" href="images/Icon.ico" class="rounded">
</head>
<body>
    <header class="text-gray-600 body-font bg-gradient-to-br from-slate-200 to-cyan-400">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
          <a href="#" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img class="w-10 h-10 mr-2" src="images/Icon.png" alt="logo">
            <span class="ml-3 text-3xl league-spartan text-sky-800">Accord Energie</span>
          </a>
          <div class="md:ml-auto flex-wrap items-center text-base justify-center gap-x-10 text-sky-800">
                <a href="contact.html">
                    <button class="inline-flex items-center bg-white border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 hover:text-gray-900 rounded text-base mt-4 md:mt-0 mx-4">
                        Contact
                    </button>
                </a>
                <a href="logout.php">
                    <button class="inline-flex items-center bg-white border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 hover:text-gray-900 rounded text-base mt-4 md:mt-0 mx-4">
                        Deconnexion
                    </button>
                </a>
                <a href="profile.php">
                    <span class="ml-3 text-xl league-spartan text-sky-900">
                        <?php echo $_SESSION['prenom']," ", $_SESSION['nom'];?>
                    </span>
                </a>
            </div>
        </div>
    </header>
        
    <div class="md:flex m-4">
    <ul class="flex-column space-y space-y-4 text-sm font-medium text-gray-600  md:me-4 mb-4 md:mb-0">
            <li>
                <a href="interventions_standardiste.php" id="interventions" class=" inline-flex items-center px-4 py-3 text-white bg-cyan-400 hover:bg-cyan-800 active rounded-lg w-full" aria-current="page">
                    <svg class="w-4 h-4 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                    Interventions
                </a>
            </li>
            <li>
                <a href="historique_standardiste.php" class="category gap-1 inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-100 hover:bg-gray-200 w-full">
                <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z"/>
                </svg>
                    Historique
                </a>
            </li>
            <li>
                <a href="clients_standardiste.php" class="category gap-1 inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-100 hover:bg-gray-200 w-full">
                <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                </svg>
                    Clients
                </a>
            </li>
            <li>
                <a class="category inline-flex items-center px-4 py-3 text-gray-400 rounded-lg cursor-not-allowed bg-gray-100 w-full">
                    <svg class="w-4 h-4 me-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                    </svg>
                Disabled
                </a>
            </li>
        </ul>
        <div id="interventionDisplay" class="flex flex-col justify-center p-2 bg-gray-200 text-medium text-gray-700 rounded-lg w-full">

            <div class="bg-white justify-center mx-auto rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 w-full">
                <div class="w-full justify-center p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Nouvelle Intervention
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="intervention_managing.php" method="post">
                        <div>
                            <label for="userid" class="block mb-2 text-sm font-medium text-gray-900">Identifiant du client</label>
                            <input type="number" name="userid" id="userid" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="" required="">
                        </div>
                        <div>
                            <label for="intervenantid" class="block mb-2 text-sm font-medium text-gray-900">Identifiant de l'intervenant</label>
                            <input type="number" name="intervenantid" id="intervenantid" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                        </div>
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Titre de l'intervention</label>
                            <input type="text" name="title" id="title" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                        </div>
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date de l'intervention</label>
                            <input type="date" name="date" id="date" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                        </div>
                        <div>
                            <label for="time" class="block mb-2 text-sm font-medium text-gray-900">Heure de l'intervention</label>
                            <input type="time" name="time" id="time" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                        </div>
                        <div>
                            <label for="select" class="block mb-2 text-sm font-medium text-gray-900">Statut de l'intervention</label>
                            <select class='border border-gray-400 p-2 rounded w-full' name='status' id='status'>
                                <option value='' disabled selected>Status</option>
                                <option value='En attente'>En attente</option>
                                <option value='En cours'>En cours</option>
                                <option value='En attente (Urgent)'>En attente (Urgent)</option>
                                <option value='Terminé'>Terminé</option>
                                <option value='Annulé'>Annulé</option>
                            </select>
                        </div>
                    
                        <div>
                            <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Description </label>
                            <textarea type="text" name="content" id="content" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                            </textarea>
                        </div>
                        <button type="submit" class="w-full text-white bg-cyan-400 hover:bg-cyan-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>