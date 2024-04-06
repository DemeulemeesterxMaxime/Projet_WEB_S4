<?php
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "";

// Connexion à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$file = "SQL_FILE/drop.sql";
$sql = file_get_contents($file);
if ($conn->multi_query($sql)) {
    header('Location:index.php');
    /* echo"Suppresion des tables de la base de donnée effectuté avec succès ! ";
        echo"<br><button><a href='index.php'>Accueil</a></button>"; */
} else {
    echo "Erreur lors de la suppresion : " . $conn->error;
}
?>