<!DOCTYPE html>
<html>

<head>

    <?php
    if (isset($_COOKIE['themechoisi'])) {
        if ($_COOKIE['themechoisi'] == 'rootfonce') {
            echo ("<link rel='stylesheet' href='public/Css_Pages/rootfonce.css'>");
        } else {
            echo ("<link rel='stylesheet' href='public/Css_Pages/root.css'>");
            echo ("<link rel='stylesheet' href='public/Css_Pages/accueil.css'>");
        }
    } else {
    ?>
        <link rel="stylesheet" href="public/Css_Pages/root.css">
        <link rel="stylesheet" href="public/Css_Pages/accueil.css">
    <?php } ?>

    <!--Lien permettant d'accéder au code CSS-->
    <?php
    session_start();
    require_once("Page_html/Page_Structuration/meta.php");
    //Afin de mieux débugguer
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
    <script src="https://kit.fontawesome.com/0e1c95535d.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once("Page_html/Page_Structuration/header.php"); ?>
    <div class="grid-acc">
        <div class="titre-flex">
            <h2 class="acc-titre">Meilleur qu'Aurion, découvez vos moyennes, et faites des estimations !</h2>
            <a class="acc-titre" id="lien-acc" href="Page_html/Page_PHP/mesnotes.php">Découvrir</a>
        </div>
        <div class="img-flex">
            <img class="acc-img" src="public/Images/Images.png/img-acc.png">
            <img class="acc-img" src="public/Images/Images.png/img-acc2.png">
        </div>
    </div>
    <div class="box-acc">
        <h3 id="titre-box-acc">Les différentes fonctionnalités </h3>
        <div class="box1">
            <a href="Page_html/Page_PHP/mesnotes.php">Mes notes</a>
            <i class="fa-solid fa-pen"></i>
        </div>
        <div class="box2">
            <a href="Page_html/Page_PHP/moyennes.php">Mon classement</a>
            <i class="fa-solid fa-ranking-star"></i>
        </div>
        <div class="box3">
            <a href="Page_html/Page_PHP/compte.php">Mon Profil</a>
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="lien-box"><a href="Page_html/Page_PHP/mesnotes.php">Voir plus</a></div>
    </div>
    <div class="graphique">
        <h2 class="h2-titre-acc">Découvre tes moyennes dans les différents modules </h2>
        <div class="graphique-box">
            <img src="public/Images/Images.png/img-acc3.png">
        </div>
        <div class="lien-box"><a href="Page_html/Page_PHP/moyennes.php">Voir plus</a></div>

    </div>
    <div class="classement">
        <h2 class="h2-titre-acc">Découvre le classement de ta promo</h2>
        <div class="classement-table">
            <table>
                <thead>
                    <tr>
                        <th>Classement Général</th>
                        <th>Nom</th>
                        <th>Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>17.5</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>15.2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Bob Johnson</td>
                        <td>13.8</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="lien-box"><a href="Page_html/Page_PHP/moyenne.php">Voir plus</a></div>

    </div>

    <?php
    //on récupere le prénom de l'utilisateur grace à la session
    if (isset($_SESSION["id"])) {
        $prenom = $_SESSION["prenom"];
    ?>
        <div class="notification">
            <p>Welcome back, <?php echo $prenom ?>👋</p>
            <span class="notification__progress"></span>
        </div>

    <?php
    }
    include_once "Page_html/Page_Structuration/footer.php";
    ?>
    <script src="script.js" async defer></script>
</body>

</html>