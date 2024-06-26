<?php
// Paramètres de connexion à la base de données
//Ici on utilse un autre formulaire de connection car on ne se connecte pas a la base de données
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "jreuttus_projet_web_s4";

// Connexion à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}


$file = "SQL_FILE/clearALL.sql";
$sql = file_get_contents($file);
if ($conn->multi_query($sql)) {
    header('Location:index.php');
    /* echo "Les tables ont été vidé avec succès";
    echo"<br><button><a href='index.php'>Accueil</a></button>"; */
} else {
    echo "Erreur lors du vidage des tables : " . $conn->error;
}
// Fermeture de la connexion
$conn->close();
