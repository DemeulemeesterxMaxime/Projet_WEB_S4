<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="../../public/Css_Pages/help.css">
    <?php require_once("../Page_Structuration/meta.php"); ?>

</head>

<body>
    <?php require_once("../Page_Structuration/header.php"); ?>
    <div class="head">
        <h2 data-text="Comment ajouter mes notes ?">Comment ajouter mes notes ?</h2>
    </div>
    <div class="content">
        <video width="640" height="360" controls>
            <source src="../../public/Images/Images.jpg/tuto-sirius.mp4" type="video/mp4">
            Votre navigateur ne prend pas en charge la lecture de vidéos.
        </video>
        <h2 data-text="Comment ajouter une seule note ?">Comment ajouter une seule note ?</h2>
        <!-- on insere une image -->
        <img id="screen" src="../../public/Images/Images.png/bangerang.png" alt="Ajout d'une note" width="640" height="360">
        <h2 data-text="Il suffit de copier ce qui est surligné en bleu !">Il suffit de copier ce qui est surligné en bleu !</h2>
    </div>
    <div class="btn-item">
        <a href="add_note.php" class="cta horizontale-slide">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Retour à l'ajout de notes</span>
        </a>
    </div>
    <?php require_once("../Page_Structuration/footer.php"); ?>
</body>

</html>