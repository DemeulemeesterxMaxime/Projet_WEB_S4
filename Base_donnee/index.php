<!DOCTYPE html>
<?php
session_start();
?>
<html>

<head>
    <?php
    //include "Page_html/Page_Structuration/meta.php";
    ?>
    <title>Gestion BD</title>
    <script src="https://kit.fontawesome.com/0e1c95535d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../public/Css_Pages/bdd.css">
</head>

<body>
    <div class="Container_grid">

        <h3 style="text-align:center;">Gestion de la base données : </h3>
        <div class="btn-container"><button><a href="../Page_html/Page_PHP/admin.php">Admin</a></button></div>

        <div class="btn-container"><button><a href="setupBD.php">Créer la base de données</a></button></div>

        <div class="btn-container"><button><a href="reload.php">Réinitialiser la base de données</a></button></div>

        <div class="btn-container"><button><a href="drop.php">Supprimer la base de données</a></button></div>

        <div class="btn-container"><button><a href="clearALL.php">Vider toute la base de données</a></button></div>

        <div class="btn-container"><button><a href="clear.php">Vider les notes</a></button></div>
        <div>
</body>

</html>