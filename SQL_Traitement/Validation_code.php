<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include "../Page_html/Page_Structuration/meta.php"; ?>
    <link rel="stylesheet" href="../public/Css_Pages/sign_in_up.css">
</head>

<body>
    <?php
    //on traite le code de confirmation
    //on verifie que le code est bon grace a la session 

    $var = 12345; //Pour le local $_SESSION["code"]
    if ($var == $_POST['code']) {
        //appel de la base de donnée pour modifier la valeur de confirmed
        require_once("DB_connect.php");
        //on récupère l'id de l'utilisateur grace a son email stocké en session
        $email = $_SESSION['email'];
        $requete = $conn->prepare("SELECT `id_eleve` FROM `eleve` WHERE `email` = '$email'");
        $requete->execute();
        $donnees = $requete->fetch();
        $id = $donnees['id_eleve'];
        /* $_SESSION["id"] = $id; */ //On associe l'id de la session à l'id des tables
        //on modifie la valeur de confirmed
        $requete = $conn->prepare("UPDATE `eleve` SET `confirmed` = 1 WHERE `id_eleve` = '$id'");
        $requete->execute();
        //on redirige vers la page de connexion
        header("Location: ../Page_html/Page_PHP/sign_in_up.php?state=end");/* ?id=$id */
    } else {
        header("Location:../Page_html/Page_PHP/sign_in_up.php?state=noconfirm&fail=1");
        return;
    }
    ?>
</body>

</html>