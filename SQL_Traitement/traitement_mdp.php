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
    //on verifie si l'utilisateur est bien inscrit 
    //on se connecte a la base de donnée
    require_once("DB_connect.php");
    if (isset($_POST['reset-email'])) {
        //on récupère l'email de l'utilisateur
        $email = $_POST['reset-email'];
        $_SESSION['email'] = $email;
        //on vérifie que l'email est bien dans la base de donnée
        $requete = $conn->prepare("SELECT * FROM `eleve` WHERE `email` = '$email'");
        $requete->execute();
        $donnees = $requete->fetch();
        //si l'email n'est pas dans la base de donnée
        if (!$donnees) {
            header("Location: ../Page_html/Page_PHP/sign_in_up.php?fail=4");
            return;
        }
        //mail de confirmation : on envoie un code pour confirmer l'inscription, on traite le code dans une page séparée (confirmation.php)
        // Générer un code aléatoire
        $code = rand(10000, 99999);

        // Stocker le code dans une session pour le comparer plus tard avec celui de la page confirmation.php
        $_SESSION['code'] = $code;

        // Récupérer l'adresse e-mail de l'utilisateur
        $to = $_SESSION['email'];

        // Définir l'objet de l'email
        $subject = 'Rénitialisation de votre mot de passe';

        // Créer le lien avec le mot "lien"
        $link = 'http://sirius.go.yo.fr/Page_html/Page_PHP/sign_in_up.php?reset=2';
        // email=' . urlencode($email);

        // Créer le message contenant le lien et le code
        $message = 'Bienvenue sur Sirius, pour confirmer la rénitialisation de votre mot de passe, veuillez cliquer sur le ' . '<a href="' . $link . '">lien</a>' . ' suivant et saisir le code suivant ' . $code;

        // Définir les en-têtes pour le format HTML
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";

        // Envoyer l'email
        mail($to, $subject, $message, $headers);
        header("Location: ../Page_html/Page_PHP/sign_in_up.php?reset=2");
    }
    ?>
</body>

</html>