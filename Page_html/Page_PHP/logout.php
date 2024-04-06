<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once "../Page_Structuration/meta.php";?>
        <link rel="stylesheet" href="Css_Pages/logout.css">
    </head>
    <body>
        <?php
            if(isset($_SESSION["id"]) == false){
                header("Location: sign_in_up.php");
            }
            //On supprime les variables de session et on détruit la session
            unset($_SESSION['id']);
            unset($_SESSION['email']);
            session_destroy();
            //On supprime les cookies
            setcookie('user_id', '', time() - 3600, "/");
            setcookie('debug', '', time() - 3600, "/");
            //On redirige l'utilisateur vers la page de connexion
            //On utilise sleep pour attendre 1 seconde
            sleep(1);
            header('Location: sign_in_up.php');
        ?>
    </body>
</html>