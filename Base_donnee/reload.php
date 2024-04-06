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
$file2 = "SQL_FILE/_DATABASEV10.sql";
$sql = file_get_contents($file);
$sql . file_get_contents($file2);
if ($conn->multi_query($sql)) {
    header('Location:setupBD.php');
    /* echo"Suppresion des tables de la base de donnée effectuté avec succès ! ";
        echo"<br><button><a href='index.php'>Accueil</a></button>"; */
} else {
    echo "Erreur lors de l'installation : " . $conn->error;
}
/* 
    $file = "SQL_FILE/_DATABASEV10.sql";
    $sql = file_get_contents($file);
    if ($conn->multi_query($sql)) {
        header('Location:index.php');
        //echo"Rénitialisation de base de donnée effectuté avec succès ! ";
        //echo"<br><button><a href='index.php'>Accueil</a></button>"; 
    } else {
    echo "Erreur lors de l'installation : " . $conn->error;
    } */
