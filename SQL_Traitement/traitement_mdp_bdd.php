<?php 
    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    if(isset($_POST["Changer_code_reset"])){
        if (empty($_POST['pass'])){
            header("Loaction: ../Page_html/Page_PHP/sign_in_up.php?reset=3&fail=3");
            return;
        }
        //on met le nouveau mot de passe dans la base de donnée
        //appel de la base de donnée
        require_once("DB_connect.php");
        $new_mdp = $_POST['pass'];
        //On hash le mot de passe
        $new_mdp = password_hash($new_mdp, PASSWORD_DEFAULT);
        $email = $_SESSION['email'];
        $requete = $conn->prepare("UPDATE `eleve` SET `password` = '$new_mdp' WHERE `email` = '$email'");
        $requete->execute();
        if(isset($_GET["in"]) && $_GET["in"] == 1){
            header("Location: ../index.php");
        } else {
            header("Location: ../Page_html/Page_PHP/sign_in_up.php?mdp=reset");
        }
    }
?>