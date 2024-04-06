    <!--Mise en place de l'encode des caractères pour les navigateurs-->
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <!--Titre de notre Site-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Pour la compatibilité du site -->
    <?php
    if (strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) { ?>
        <!--Description de la page-->
        <meta name="description" content="Page de note Sirius"> <?php
                                                            } else { ?>
        <meta name="description" content="Page d'Accueil Sirius"> <?php
                                                                }
                                                                    ?>
    <title>Sirius Portail</title>

    <!--Mots clé de la page-->
    <meta name="keywords" content="relevé de note, moyenne, Accueil">
    <!--Mise en place de zone de visibilité de la page web pour l'utilisateur-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!--Chargement de la librairie d'image pour les réseaux dans le footer-->
    <script src="https://kit.fontawesome.com/0e1c95535d.js" crossorigin="anonymous"></script>
    <!--Auteurs de la page-->
    <meta name="autors" content="Tassin, Demeulemeester, Lamour">
    <?php
    if (strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) {
        echo "<link rel=\"alternate icon\" href=\"public/Images/Icons/Sirius.png\">";
        echo "<link rel=\"stylesheet\" href=\"public/Css_Pages/root.css \">";
    } else {
        echo "<link rel=\"alternate icon\" href=\"../../public/Images/Icons/Sirius.png\">";
        echo "<link rel=\"stylesheet\" href=\"../../public/Css_Pages/root.css \">";
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />