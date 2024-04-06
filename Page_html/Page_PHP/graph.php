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
        }
    } else {
    ?>
        <link rel="stylesheet" href="../../public/Css_Pages/root.css">
        <link rel="stylesheet" href="../../public/Css_Pages/accueil.css">
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
        <h2 class="h2-titre-acc">Découvre tes moyennes dans les différents modules </h2>
        <div class="graph">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../public/Js_Pages/graph.js"></script>
    <?php include_once("../Page_Structuration/footer.php"); ?>
</body>