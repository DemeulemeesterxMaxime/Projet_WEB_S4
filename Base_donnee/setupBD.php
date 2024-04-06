<?php
// Paramètres de connexion à la base de données
//Ici on utilse un autre formulaire de connection car on ne se connecte pas a la base de données
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

// Exécution des lignes SQL
$file = "SQL_FILE/_DATABASEV10.sql";
$sql = file_get_contents($file);
if ($conn->multi_query($sql)) {
    header('Location:index.php');
    /* echo "La base de données jreuttus_projet_web_s4 à été crée avec succès";
    echo"<br><button><a href='index.php'>Découvrir le site</a></button>"; */
} else {
    echo "Erreur lors de la création de votre base de données : " . $conn->error;
}
// Fermeture de la connexion
$conn->close();
