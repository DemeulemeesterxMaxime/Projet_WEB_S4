<!DOCTYPE html>
<?php
echo ("<link rel='stylesheet' href='../../public/Css_Pages/theme.css'>");
session_start();
if (isset($_POST['theme'])) {
    //Créer le cookie pour y enregistrer le thème choisi par l'utilisateur
    setcookie("themechoisi", $_POST['Choixtheme'], time() + (365 * 24 * 3600), '/', '', false, true);
    header("Location: compte.php");
}
include_once("../Page_Structuration/header.php");
if (empty($_SESSION['id'])) {
    header('Location:sign_in_up.php');
} else {
?>
    <html lang="fr">

    <head>
        <?php require_once("../Page_Structuration/meta.php"); ?>
        <?php
        if (isset($_COOKIE['themechoisi'])) {
            if ($_COOKIE['themechoisi'] == 'rootfonce') {
                echo ("<link rel='stylesheet' href='../../public/Css_Pages/fonce.css'>");
            }
        }
        require_once("../Page_Structuration/meta.php"); ?>

    </head>

    <body>
        <div class="container">
            <form style="<?php if (isset($_COOKIE['themechoisi']) && ($_COOKIE['themechoisi'] == 'rootfonce')) {
                                echo ("background-color:black;");
                            } else {
                                echo ("background-color:white;");
                            } ?> padding: 100px 50px 100px 50px;" method="post" action="theme.php">
                <label>Choisir votre thème préféré : </label>
                <select name="Choixtheme">
                    <option value="rootfonce">Sombre</option>
                    <option value="root">Clair </option>
                </select>
                <input type="submit" name="theme" Value="Envoyer" />
            </form>
        </div>
    <?php


}
include_once("../Page_Structuration/footer.php");
    ?>
    </body>

    </html>