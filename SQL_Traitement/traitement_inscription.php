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
    require_once("fonctions.php");
    //detection pb mot de passe ou email
    if (
        (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        || (!isset($_POST['password']) || empty($_POST['password']))
    ) {
        echo ('Il faut un email et un mot de passe valides pour se connecter.');
        return;
    }
    //on verifie si le mot de passe correspond a la confirmation mot de passe (on verifie que password == pass)
    if ($_POST['password'] != $_POST['pass']) {
        //on propose a l'utilisateur de s'inscrire a nouveau
        header("Location: ../Page_html/Page_PHP/sign_in_up.php?inscrip=1");
        return;
    }
    //appel de la base de donnée 
    require_once("DB_connect.php");
    //on récupère les données du formulaire d'inscritpion : on hash le mot de passe et on valide les données
    $email = valider_donnees($_POST['email']);
    $password = password_hash(valider_donnees($_POST['password']), PASSWORD_DEFAULT);
    //on vérifie que l'email n'est pas déjà utilisé
    $requete = $conn->prepare('SELECT COUNT(*) AS `nb_email` FROM `eleve` WHERE `email` = ?');
    $requete->execute(array($email));
    $donnees = $requete->fetch();
    if ($donnees['nb_email'] > 0) {
        header("Location: ../Page_html/Page_PHP/sign_in_up.php?inscrip=2");
        return;
    }
    if ($donnees['nb_email'] == 0) {
        //on insère les données dans la base de données: mail, mdp, nom et prénom et la classe on met confirmed à 0
        $tab = extrairePrenomNom($email);
        $prenom = $tab["prenom"];
        $nom = $tab["nom"];

        $requete = $conn->prepare('INSERT INTO `eleve`(`email`, `password`, `nom`, `prenom`, `classe`, `confirmed`) VALUES(?, ?, ?, ?, ?, 0)');
        $requete->execute(array($email, $password, $nom, $prenom, $_POST["classe"]));
        //on met dans la colonne photo_profil le chemin vers l'image par défaut
        $requete = $conn->prepare('UPDATE `eleve` SET `photo_profil` = "../../public/Images/Images_profile/default_photo.png" WHERE `email` = ?');
        $requete->execute(array($email));


        //on met le mail dans une session pour pouvoir l'utiliser dans la page confirmation.php
        $_SESSION['email'] = $email;
        //on récupère l'id de l'utilisateur
        /* 
                $requete = $conn->prepare('SELECT id_eleve FROM eleve WHERE email = ?');
                $requete->execute(array($email));
                $donnees = $requete->fetch();
                $id = $donnees['id_eleve'];
                $_SESSION["id"] = $id; */
        //mail de confirmation : on envoie un code pour confirmer l'inscription, on traite le code dans une page séparée (confirmation.php)
        // Générer un code aléatoire
        $code = rand(10000, 99999);

        // Stocker le code dans une session pour le comparer plus tard avec celui de la page confirmation.php
        $_SESSION['code'] = $code;

        // Récupérer l'adresse e-mail de l'utilisateur
        $to = $_SESSION['email'];

        // Définir l'objet de l'email
        $subject = 'Confirmation de votre inscription';
        // Créer le lien avec le mot "lien"
        $link = 'http://sirius.go.yo.fr/Page_html/Page_PHP/sign_in_up.php?state=noconfirm';
    }
    // email=' . urlencode($email);

    // Créer le message contenant le lien et le code
    $message = 'Bienvenue sur Sirius, pour confirmer votre inscription, veuillez cliquer sur le ' . '<a href="' . $link . '">lien</a>' . ' suivant et saisir le code suivant ' . $code;

    // Définir les en-têtes pour le format HTML
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";

    // Envoyer l'email
    mail($to, $subject, $message, $headers);

    header("Location: ../Page_html/Page_PHP/sign_in_up.php?state=noconfirm");
    ?>
</body>

</html>