<!DOCTYPE html>
<html>

<head>

    <?php
    if (isset($_COOKIE['themechoisi'])) {
        if ($_COOKIE['themechoisi'] == 'rootfonce') {
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/rootfonce.css'>");
        } else {
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/root.css'>");
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/accueil.css'>");
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/graph.css'>");
        }
    } else {
    ?>
        <link rel="stylesheet" href="../../public/Css_Pages/root.css">
        <link rel="stylesheet" href="../../public/Css_Pages/accueil.css">
        <link rel="stylesheet" href="../../public/Css_Pages/graph.css">
    <?php } ?>

    <!--Lien permettant d'accéder au code CSS-->
    <?php
    session_start();
    require_once("../Page_Structuration/meta.php");
    //Afin de mieux débugguer
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
    <script src="https://kit.fontawesome.com/0e1c95535d.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once("../Page_Structuration/header.php");
    if (empty($_SESSION["id"])) {
    header("Location: sign_in_up.php");
    } ?>
<div class="graphique">
    <h2 class="h2-titre-acc">Découvre tes moyennes dans les différents modules</h2>

    <div id="requete">
        <?php 
        try {
            $id = $_SESSION['id'];
            require_once("../../SQL_Traitement/fonctions.php");
            require_once("../../SQL_Traitement/DB_connect.php");
            $req = "SELECT * FROM eleve_module WHERE id_eleve=:id AND moyenne_module IS NOT NULL"; // Correction : Utiliser IS NOT NULL pour tester la nullité
            $reqPrep = $conn->prepare($req);
            $reqPrep->execute(array(':id' => $id));
            $resultat = $reqPrep->fetchAll(PDO::FETCH_ASSOC);
            // Convertir en JSON
            $json = json_encode($resultat);
            
            // Afficher le JSON
            ?><p id="para_requete" style="display: none;"><?php echo $json ?></p><?php // Correction : Utiliser display: none; pour cacher l'élément
            $conn = NULL; // On ferme la connexion
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
        ?>
    </div>    

    <div class="graph"><canvas id="linec" aria-label="chart" role="img"></canvas></div>
    
    <div id="matières">
        <h2>Découvre tes moyennes dans les différentes matières</h2>
        
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../public/JS/graph.js"></script>
    <?php include_once("../Page_Structuration/footer.php"); ?>
</body>