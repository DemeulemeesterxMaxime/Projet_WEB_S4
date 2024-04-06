<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <link rel="stylesheet" href="../../public/Css_Pages/sign_in_up.css">
    <?php
    require_once("../Page_Structuration/meta.php");
    ?>
</head>

<body>
    <?php
    if (isset($_COOKIE["user_id"]) == false) {
        header("Location: sign_in_up.php");
    }
    ?>
    <div class="container">
        <div class="login-container">
            <div class="login-form">
                <div class="group">
                    <form action="../../SQL_Traitement/traitement_mdp_bdd.php?in=1" method="post">
                        <h3 class="comment">Changement du mot de passe</h3>
                        <?php
                        if (isset($_GET["fail"]) && $_GET["fail"] == 3) {
                            echo ('Il faut un mot de passe valide pour se connecter.');
                        }
                        ?>
                        <div class="group">
                            <input placeholder="Saissisez votre nouveaux mot de passe" id="user" name="pass" type="password" class="input" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" placeholder="Changer le mot de passe" name="Changer_code_reset">
                        </div>
                        <div class="hr"></div>
                        <div class="footer">
                            <h3>C'est presque finit !</h3>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>