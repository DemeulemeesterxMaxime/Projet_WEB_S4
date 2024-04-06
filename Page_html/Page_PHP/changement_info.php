<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>







    <?php require_once("../Page_Structuration/meta.php"); ?>

    <link rel="stylesheet" href="../../public/Css_Pages/change_info.css">

</head>

<body>
    <?php
    include_once("../Page_Structuration/header.php");

    if (empty($_SESSION['id'])) {
        header('Location:sign_in_up.php');
    } else { ?>
        <!-- on va proposer plusieurs champs pour modifier les informations de l'utilisateur -->
        <!-- on demande a l'utilisateur de mettre son mot de passe pour valider les changements -->
        <div class="login-box">
            <h2>Changement des informations</h2>
            <form name="changement_info" method="post" action="../../SQL_Traitement/traitement_changement_info.php">
                <div class="user-box">
                    <input type="text" name="nom">
                    <label>Nom</label>
                </div>
                <div class="user-box">
                    <input type="text" name="prenom">
                    <label>Prénom</label>
                </div>
                <div class="user-box">
                    <input type="email" name="email" pattern="[a-zA-Z.-]+@([a-z.A-Z]*)(junia.com)$">
                    <label>Email</label>
                </div>
                <div class="button-form">
                    <input type="submit" id="submit" name="Envoyer" value="Envoyer">
                    </input>

                </div>
            </form>

        </div>
        <div class="btn_item">
            <a href="compte.php" class="ct horizontal-slide">
                <i class="fa-solid fa-arrow-left fa-fade fa-xl" style="color: var(--orange_isen);"></i>
                <span> Retour</span>
            </a>
        </div>
    <?php
    }
    include_once("../Page_Structuration/footer.php"); ?>
</body>

</html>