<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    
    <body>

    <?php 
//on traite les données du formulaire de changement d'info 
//on vérifie qu'au moins un des champs a été rempli
if (
    (!isset($_POST['nom']) || empty($_POST['nom']))
    && (!isset($_POST['prenom']) || empty($_POST['prenom']))
    && (!isset($_POST['email']) || empty($_POST['email']))
    )
{
    echo('Il faut au moins un champ rempli pour changer les informations.');
    return;
}
//on met les nouvelles informations dans la base de donnée
        //appel de la base de donnée
        require_once("DB_connect.php");
//on récupère les données de la page connection et on verifie la cohérence avec la bdd
$id = $_SESSION['id'];
//on verifie quelles données ont été modifiées
if (isset($_POST['nom']) && !empty($_POST['nom'])){
    $new_nom = $_POST['nom'];
    $requete = $conn->prepare("UPDATE `eleve` SET `nom` = '$new_nom' WHERE `id_eleve` = '$id'");
    $requete->execute();
    //on met le nouveau nom dans la session
    $_SESSION['nom'] = $new_nom;
}
if (isset($_POST['prenom']) && !empty($_POST['prenom'])){
    $new_prenom = $_POST['prenom'];
    $requete = $conn->prepare("UPDATE `eleve` SET `prenom` = '$new_prenom' WHERE `id_eleve` = '$id'");
    $requete->execute();
    //on met le nouveau prenom dans la session
    $_SESSION['prenom'] = $new_prenom;
}
if (isset($_POST['email']) && !empty($_POST['email'])){
    $new_email = $_POST['email'];
    $requete = $conn->prepare("UPDATE `eleve` SET `email` = '$new_email' WHERE `id_eleve` = '$id'");
    $requete->execute();
    //on met le nouveau email dans la session
    $_SESSION['email'] = $new_email;
}
//on redirige vers la page de profil
header("Location: ../Page_html/Page_PHP/compte.php");
    ?>
   
    </body>
</html>