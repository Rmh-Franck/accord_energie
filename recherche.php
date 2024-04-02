<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}
$userid = $_SESSION['userid'];


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
                <a href="interventions.php" id="interventions" class=" inline-flex items-center px-4 py-3 text-white bg-cyan-400 hover:bg-cyan-800 active rounded-lg w-full" aria-current="page">
                    <svg class="w-4 h-4 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                    Interventions
                </a>
            </li>
            <li>
                <a href="historique.php" class="category gap-1 inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-100 hover:bg-gray-200 w-full">
                <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z"/>
                </svg>
                    Historique
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
        <div id="interventionDisplay" class="flex-col p-2 bg-gray-200 text-medium text-gray-700 rounded-lg w-full">
            
        <form class="max-w-md mx-auto" action="recherche.php" method="post">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 " placeholder="Recherchez une intervention..." required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-cyan-400 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Rechercher</button>
            </div>
        </form>

        <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "accordenergie";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

                $titre_recherche = $_POST['search'];
            
                $sql = "SELECT i.*
                        FROM interventions i
                        WHERE i.title LIKE '%$titre_recherche%' OR i.id='$titre_recherche'
                        AND '$userid'= user_id
                        ";

                $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Afficher les données dans une liste
                echo "<ul>";
                while($row = $result->fetch_assoc()) {
                    if($row["status"]!= "Terminé" and $row["status"]!= "Annulé"){
                        echo "
                            <div class='bg-cyan-300 rounded m-4 p-4'>
                                <div class='flex p-4 justify-between font-bold items-start text-medium'>
                                    <div class='flex-col gap-1'>
                                        <h1 class='text-2xl mb-1'>
                                            ",$row["title"],"
                                        </h1>
                                        <div class='flex gap-4'>
                                            <h2>
                                                ",$row["dateint"],"
                                            </h2>
                                            <h2 >
                                                ",$row["heure"],"
                                            </h2>
                                        </div>
                                        <h2 >
                                            ", "Id: ", $row["id"],"
                                        </h2>
                                    </div>
                                    <div class='flex gap-5'>
                                        <form action='comment_managing.php' method='post' class='flex-col'>
                                            <input type='hidden' name='intervention_id' value='", $row["id"],"'>
                                            <button type='submit' href='comment_managing.php' class='inline-flex items-center bg-white border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 hover:text-gray-900 rounded text-base mt-4 md:mt-0 mx-4'>
                                                Commenter
                                            </button>
                                        </form>
                                        <div class='inline-flex items-center bg-white border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 hover:text-gray-900 rounded text-base mt-4 md:mt-0 mx-4'>
                                            ",$row["status"],"
                                        </div>
                                    </div>
                                </div>
                                <div class='flex-col p-6'>
                                    <p>
                                        ",$row["content"],"
                                    </p>
                                </div>";
                                $interventionid= $row["id"];

                                $sql = "SELECT c.*, u.nom AS nom_auteur, u.prenom AS prenom_auteur
                                        FROM comments c, users u
                                        WHERE c.interventionid = $interventionid
                                        AND c.userid = '$userid'";
                                $resultcom = $conn->query($sql);

                                if ($resultcom->num_rows > 0) {
                                    echo "  <p class='text-xl font-bold ml-5'>
                                                Commentaires:
                                            </p>";
                                }

                                while($rowcom = $resultcom->fetch_assoc()) {
                                    if (!empty($rowcom['content'])) {
                                        echo"
                                            <div class='bg-white rounded m-4'>
                                                <div class='flex p-4 justify-between items-start'>
                                                    <div class='flex-col p-4 items-start text-medium text-gray-500'>
                                                        <div class='flex-col gap-1'>
                                                            <h1 class='text-xl mb-1 font-bold'>
                                                                ",$rowcom["nom_auteur"]," ",$rowcom["prenom_auteur"],"
                                                            </h1>
                                                            <h2>
                                                                ",$rowcom["created_at"],"
                                                            </h2>
                                                        </div>
                                                        <div class='flex-col p-6'>
                                                            <p>
                                                                ",$rowcom["content"],"
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <form action='comment_managing.php' method='post' class='flex-col'>
                                                        <input type='hidden' name='comment_id' value='", $rowcom["id"],"'>
                                                        <button type='submit' class='inline-flex items-center text-white bg-cyan-400 hover:bg-cyan-800 border-0 py-1 px-3 focus:outline-none rounded text-base mt-4 md:mt-0 mx-4'>
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                    ";
                                    }
                                }
                        echo "</div>";
                    }
                    echo "</ul>";
            }
            } else {
                echo "0 résultats";
            }

            $conn->close();
        ?>
        </div>
    </div>


</body>
</html>
