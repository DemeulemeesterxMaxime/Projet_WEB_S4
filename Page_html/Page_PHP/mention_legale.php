<!DOCTYPE html>
<html>

<head>
    <?php
    if (isset($_COOKIE['themechoisi'])) {
        if ($_COOKIE['themechoisi'] == 'rootfonce') {

            echo ("<link rel='stylesheet' href='../../public/Css_Pages/fonce.css'>");
        }
    }
    require_once("../Page_Structuration/meta.php"); ?>


</head>

<body>
    <?php
    session_start();
    include_once("../Page_Structuration/header.php");
    if (empty($_SESSION['id'])) {
        header('Location: sign_in_up.php');
    } else {



    ?>
        <div style="width: 60%; margin: 5% 20% 5% 20%; line-height: 30px; ">
            <strong>Informations sur l'éditeur </strong><br>
            <br>Le site sirius.go.yo.fr est édité par Sirius Junia, une [forme juridique de l'entreprise, par exemple : société à responsabilité limitée] au capital de 3 000 000 euros, dont le siège social est situé 13 rue de Toul 59046 Lille Cedex France.

            <br>Numéro d'immatriculation au RCS : RCS-123456789

            <br>Numéro de TVA intracommunautaire : FR00123456789

            <br>Téléphone : 0784683995

            <br>Email : maxime.demeulemeester@student.junia.com

            <br>Directeur de la publication
            <br>Le directeur de la publication du site sirius.go.yo.fr est Demeulemeetest Maxime.

            <br>Hébergement du site
            <br>L'hébergement du site sirius.go.yo.fr est assuré par planethoster, dont le siège social est situé à 4416 Louis B. Mayer Laval (Québec) H7P 0G1 Canada.

            <br>Téléphone : +33 1 76 60 05 10

            <br><strong>Propriété intellectuelle</strong>
            <br>L'ensemble des éléments présents sur le site sirius.go.yo.fr, incluant notamment les textes, images, graphismes, logos, icônes, sons et logiciels, est protégé par les lois françaises et internationales sur la propriété intellectuelle. Tous les droits de reproduction sont réservés, y compris pour les documents téléchargeables et les représentations iconographiques et photographiques.

            <br>Toute reproduction, représentation, modification, publication, adaptation ou utilisation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de Sirius Junia.

            <br>Responsabilité
            <br>Sirius Junia ne pourra être tenu responsable des dommages directs ou indirects causés au matériel de l'utilisateur, lors de l'accès au site sirius.go.yo.fr, et résultant soit de l'utilisation d'un matériel ne répondant pas aux spécifications indiquées dans les présentes, soit de l'apparition d'un bug ou d'une incompatibilité.

            <br>Sirius Junia ne pourra également être tenu responsable des dommages indirects (tels que par exemple une perte de marché ou une perte d'opportunité) consécutifs à l'utilisation du site sirius.go.yo.fr.

            <br><strong>Liens hypertextes</strong>
            <br>Le site sirius.go.yo.fr contient des liens hypertextes vers d'autres sites, mis en place avec l'autorisation de Sirius Junia. Cependant, Sirius Junia n'a pas la possibilité de vérifier le contenu des sites ainsi visités, et n'assumera en conséquence aucune responsabilité de ce fait.
            <br>Sirius Junia s'engage à préserver la confidentialité des informations fournies en ligne par l'utilisateur et à protéger ses données personnelles. Conformément à la loi "informatique et libertés" du 6 janvier 1978 modifiée en 2004, l'utilisateur dispose d'un droit d'accès, de rectification et de suppression des informations le concernant, qu'il peut exercer en s'adressant à Sirius Junia à l'adresse maxime.demeulemeester@student.junia.com ou par courrier à l'adresse 4416 Louis B. Mayer Laval (Québec) H7P 0G1 Canada.

            <br>Les informations recueillies sur le site sirius.go.yo.fr sont collectées et traitées pour les finalités suivantes : Gestion des notes fourni par nos utilisateurs

            <br>Les données personnelles collectées sur le site sirius.go.yo.fr sont conservées pour une durée qui ne saurait excéder la durée nécessaire aux finalités pour lesquelles elles ont été collectées.

            <br>Le site sirius.go.yo.fr utilise des cookies pour améliorer l'expérience utilisateur et réaliser des statistiques de visites. En naviguant sur le site, l'utilisateur accepte l'utilisation de ces cookies. L'utilisateur peut désactiver les cookies en suivant les instructions fournies par son navigateur.

            <br>Sécurité
            <br>Sirius Junia s'engage à mettre en œuvre toutes les mesures techniques et organisationnelles nécessaires pour assurer la sécurité et la confidentialité des données personnelles collectées et traitées sur le site sirius.go.yo.fr. Toutefois, Sirius Junia ne peut garantir une sécurité absolue et décline toute responsabilité en cas de violation de la sécurité des données.

            <br><strong>Modifications des mentions légales</strong>
            <br>Sirius Junia se réserve le droit de modifier les présentes mentions légales à tout moment. L'utilisateur est invité à les consulter régulièrement pour prendre connaissance de toute modification.

            <br>Loi applicable et juridiction
            <br>Les présentes mentions légales sont soumises au droit français. En cas de litige, les tribunaux français seront seuls compétents.

            <br>Dernière mise à jour : 08/05/2023
        </div>
    <?php
    }
    require_once("../Page_Structuration/footer.php");
    ?>
</body>

</html>