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

    if(isset($_POST['content'])){
        $intervention_id = $_SESSION['intervention_id'];
        $comment_content = $_POST['content'];

        $insert_query = "INSERT INTO comments (interventionid, userid, content) VALUES ('$intervention_id', '$userid', '$comment_content')";
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

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Bungee+Outline&family=League+Spartan:wght@900&family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font.css">
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
        <ul class="flex-column space-y space-y-4 text-sm font-medium text-gray-600 md:me-4 mb-4 md:mb-0">
            <li>
                <a href="interventions.php" id="interventions" class=" inline-flex items-center px-4 py-3 text-white bg-cyan-400 rounded-lg active w-full" aria-current="page">
                    <svg class="w-4 h-4 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                    Interventions
                </a>
            </li>
            <li>
                <a href="#" class="category inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-100 hover:bg-gray-200 w-full">
                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.415 1.413a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.415-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18a1.5 1.5 0 0 0 1.5-1.5V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>
                    </svg>
                    Settings
                </a>
            </li>
            <li>
                <a href="#" class="category inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-100 hover:bg-gray-200 w-full">
                    <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7.824 5.937a1 1 0 0 0 .726-.312 2.042 2.042 0 0 1 2.835-.065 1 1 0 0 0 1.388-1.441 3.994 3.994 0 0 0-5.674.13 1 1 0 0 0 .725 1.688Z"/>
                        <path d="M17 7A7 7 0 1 0 3 7a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V7a5 5 0 1 1 10 0v7.083A2.92 2.92 0 0 1 12.083 17H12a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a1.993 1.993 0 0 0 1.722-1h.361a4.92 4.92 0 0 0 4.824-4H17a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3Z"/>
                    </svg>
                    Contact
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
                        Laissez un commentaire !
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="comment_managing.php" method="post">
                        <div>
                            <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Votre commentaire: </label>
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