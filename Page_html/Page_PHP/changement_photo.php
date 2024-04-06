<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    include "../../SQL_Traitement/DB_connect.php";
    require_once("../Page_Structuration/header.php");
    ?>





    <?php require_once("../Page_Structuration/meta.php"); ?>

    <link rel="stylesheet" href="../../public/Css_Pages/change_photo.css">
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
    <?php
    if (isset($_POST["submit"])) {
        // Chemin de stockage des photos de profil
        $target_dir = "../../public/Images/Images_profile/";
        // Nom du fichier de la photo de profil avec un iden    tifiant unique
        $target_file = $target_dir . uniqid() . "_" . basename($_FILES["photo"]["name"]);
        // Vérification du type de fichier
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_types)) {
            echo '<p class="error">Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.</p>';
        } else {
            // Vérification de la taille du fichier
            if ($_FILES["photo"]["size"] > 500000) {
                echo '<p class="error">La taille de la photo de profil ne doit pas dépasser 500KB</p>';
            } else {
                // Téléchargement de la photo de profil
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    echo '<p class="error">La photo de profil a été téléchargée avec succès.</p>';
                    // Connexion à la base de données
                    require_once("../../SQL_Traitement/DB_connect.php");
                    // Récupération de l'id de l'élève
                    $id_eleve = $_SESSION['id'];
                    // Stockage du nom de fichier dans la base de données
                    $query = "UPDATE `eleve` SET `photo_profil` = '$target_file' WHERE `id_eleve` = $id_eleve";
                    //on prepare la requete
                    $requete = $conn->prepare($query);
                    //on execute la requete
                    $requete->execute();
                    $conn = NULL;
                } else {
    ?> <p class="error">Une erreur s'est produite lors du téléchargement de la photo de profil.</p> <?php
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                                    ?>
    <div class="container">
        <div class="container_photo">
            <div class="card">
                <div class="card-header">
                    <h2>Changer la photo de profil</h2>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="photo">Télécharger une photo de profil :</label>
                            <input type="file" name="photo" id="photo">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="btn_item">
        <a href="compte.php" class="ct horizontal-slide">
            <i class="fa-solid fa-arrow-left fa-fade fa-xl" style="color: var(--orange_isen);"></i>
            <span> Retour</span>
        </a>
    </div>
    <?php require_once("../Page_Structuration/footer.php"); ?>
</body>

</html>