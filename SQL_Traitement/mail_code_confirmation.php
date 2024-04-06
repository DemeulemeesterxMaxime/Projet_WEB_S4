<?php
session_start();

//mail de confirmation : on envoie un code pour confirmer l'inscription, on traite le code dans une page séparée (confirmation.php)
// Générer un code aléatoire
$code = rand(10000, 99999);

// Stocker le code dans une session pour le comparer plus tard avec celui de la page confirmation.php
$_SESSION['code'] = $code;

// Récupérer l'adresse e-mail de l'utilisateur
$to = $_SESSION['email'];

// Définir l'objet de l'email
$subject = 'Confirmation de votre inscription';
if(isset($_GET["p"]) && $_GET["p"] == 1){
    $link = 'http://sirius.go.yo.fr/Page_html/Page_PHP/change_mdp.php';
}
if(isset($_GET["reset"]) && $_GET["reset"] == 2){
    $link = 'http://sirius.go.yo.fr/Page_html/Page_PHP/sign_in_up.php?reset=2';
} else {
// Créer le lien avec le mot "lien"
    $link = 'http://sirius.go.yo.fr/Page_html/Page_PHP/sign_in_up.php?state=noconfirm';
}
// email=' . urlencode($email);

// Créer le message contenant le lien et le code
if(isset($_GET["reset"]) && $_GET["reset"] == 2){
    $message = 'Voici votre nouveaux code de confirmation pour changer votre mot de passe, cliquer sur le ' . '<a href="' . $link . '">lien</a>' . ' suivant et saisir le code suivant ' . $code;
} else {
    $message = 'Bienvenue sur Sirius, pour confirmer votre inscription, veuillez cliquer sur le ' . '<a href="' . $link . '">lien</a>' . ' suivant et saisir le code suivant ' . $code;
}


// Définir les en-têtes pour le format HTML
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";

// Envoyer l'email
mail($to, $subject, $message, $headers);
if (isset($_GET["p"]) && $_GET["p"] == 1) {
    header("Location: ../Page_html/Page_PHP/change_mdp.php");
} else {
   header("Location: ../Page_html/Page_PHP/sign_in_up.php?state=noconfirm"); 
}

?>

<!-- on invite l'utilisateur à aller voir son mail pour confirmer son inscription -->
<!-- <p>Un mail de confirmation vous a été envoyé. Veuillez cliquer sur le lien pour confirmer votre inscription.</p>
<p><a href="../Page_html/Page_PHP/sign_in_up.php">Retour à la page de connexion</a></p>
 -->
</body>
</html>