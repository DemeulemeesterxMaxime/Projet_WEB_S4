<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php include "../Page_html/Page_Structuration/meta.php"; ?>
    <link rel="stylesheet" href="../public/Css_Pages/connection.css">
</head>

<body>
    <?php
    //appel de la base de donnée 
    require_once("DB_connect.php");
    require_once("fonctions.php");



    //detection pb mot de passe ou email
    if (isset($_POST["Connexion"])) {
        if ((!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            || (!isset($_POST['password']) || empty($_POST['password'])) || !verificationEmail($_POST["email"])
        ) {
            echo ('il faut un email et un mot de passe valides pour se connecter.');
            return;
        } else {
            $email = valider_donnees($_POST["email"]);
            $password = valider_donnees($_POST["password"]);

            //on récupère les données de la page connection et on verifie la cohérence avec la bdd
            $req = "SELECT * FROM `eleve` WHERE `email` = '$email'";
            $requete = $conn->prepare($req);
            $requete->execute();
            $donnees = $requete->fetch();
            //on regarde si l'utilisateur est admin : mail admin = admin.admin@student.junia.com et mdp = admin
            if ($email == "admin.admin@student.junia.com" && password_verify($password, $donnees['password'])) {
                $_SESSION['id'] = 0;
                $_SESSION['email'] = $email;
                header("Location: ../Page_html/Page_PHP/admin.php");
                return;
            }
            $requete = $conn->prepare('SELECT COUNT(*) AS `nb_email` FROM `eleve` WHERE `email` = ?');
            $requete->execute(array($email));
            $res = $requete->fetch();
            $nombre_email = $res['nb_email'];
            $conn = NULL;
            if ($nombre_email != 1) {
                header("Location: ../Page_html/Page_PHP/sign_in_up.php?fail=0");
                return;
            }
        }
        if (password_verify($password, $donnees['password'])) {
            //on met l'id de l'utilisateur dans une session pour pouvoir l'utiliser dans les autres pages
            $_SESSION['id'] = $donnees['id_eleve'];
            $_SESSION['email'] = $email;
            $user_id = $_SESSION['id'];
            //set cookies 
            if (isset($_POST['remember-me'])) {
                // L'utilisateur a coché "Se souvenir de moi"
                setcookie('user_id', $user_id, time() + (86400 * 30), "/"); // 86400 = 1 jour, 30 jours de durée de vie du cookie
            } else {
                // L'utilisateur n'a pas coché "Se souvenir de moi"
                setcookie('user_id', $user_id, time() + (60 * 45), "/"); // Le cookie expirera à la fermeture du navigateur
            }
            //on redirige l'utilisateur vers la page d'accueil
            if ($donnees['confirmed'] == 0) {
                $_SESSION['email'] = $email;
                header("Location: ../Page_html/Page_PHP/sign_in_up.php?state=noconfirm");
                return;
            } else {
                require("DB_connect.php");
                $id = $_SESSION['id'];
                $req = "SELECT `nom`, `prenom`, `photo_profil` FROM `eleve` WHERE `id_eleve` = '$id'";
                $reqPrep = $conn->prepare($req);
                $reqPrep->execute();
                $donnees = $reqPrep->fetch();
                $nom = $donnees['nom'];
                $prenom = $donnees['prenom'];
                $photo_profil = $donnees['photo_profil'];
                //on stocke en session
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['photo_profil'] = $photo_profil;
                header('Location:../index.php');
                return;
            }
        } else {
            header("Location: ../Page_html/Page_PHP/sign_in_up.php?fail=2");
            return;
        }
    }
    ?>
</body>

</html>