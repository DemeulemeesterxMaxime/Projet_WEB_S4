<!DOCTYPE html>
<?php
session_start();
include_once("../Page_Structuration/meta.php");
include_once("../Page_Structuration/header.php");
if (empty($_SESSION['id'])) {
    header('Location:sign_in_up.php');
} else {
?>
    <html lang="fr">

    <head>






        <?php
        if (isset($_COOKIE['themechoisi'])) {
            if ($_COOKIE['themechoisi'] == 'rootfonce') {
                echo ("<link rel='stylesheet' href='../../public/Css_Pages/root.css '>");
                echo ("<link rel='stylesheet' href='../../public/Css_Pages/fonce.css'>");
                echo ("<link rel='stylesheet' href='../../public/Css_Pages/moyennes.css'>");
            } else {
                echo ("<link rel='stylesheet' href='../../public/Css_Pages/moyennes.css'>");
            }
        } else {
        ?>
            <link rel="stylesheet" href="../../public/Css_Pages/moyennes.css">
            <?php require_once("../Page_Structuration/meta.php"); ?>
        <?php } ?>



    </head>

    <body>
        <div class="classement-table">
            <h2 class="titre-moyenne">Moyenne Modules</h2>
            <table>
                <thead>
                    <tr>
                        <th class="nom-matiere">Nom de la matière</th>
                        <th>Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_SESSION["id"])) {
                    $id = $_SESSION["id"];
                    require_once("../../SQL_Traitement/fonctions.php");
                    require_once("../../SQL_Traitement/DB_connect.php");
                    $req = "SELECT * FROM eleve_module WHERE id_eleve=:id AND moyenne_module!='NULL'";
                    $reqPrep = $conn->prepare($req);
                    $reqPrep->execute(array(':id' => $id));
                    $resultat = $reqPrep->fetchAll(PDO::FETCH_ASSOC);
                    //print_r($resultat);
                    $req2 = "SELECT * FROM module";
                    $reqPrep2 = $conn->prepare($req2);
                    $reqPrep2->execute();
                    $resultat2 = $reqPrep2->fetchAll(PDO::FETCH_ASSOC);
                    //print_r($resultat2);
                    foreach ($resultat as $row) {
                        foreach ($resultat2 as $ligne) {
                            if ($ligne['id_module'] == $row['id_module']) {
                                echo "<tr><td>$ligne[matiere]</td><td>$row[moyenne_module]</td></tr>";
                            }
                        }
                    }
                }
            }
                ?>
                </tbody>
            </table>
        </div>
        <div class="classement-table">
            <h2 class="titre-moyenne">Moyenne Matières</h2>
            <table>
                <thead>
                    <tr>
                        <th class="nom-matiere">Nom de la matière</th>
                        <th>Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION["id"])) {
                        $req3 = "SELECT * FROM eleve_matiere WHERE id_eleve=:id AND moyenne_matiere!='NULL'";
                        $reqPrep3 = $conn->prepare($req3);
                        $reqPrep3->execute(array(':id' => $id));
                        $resultat3 = $reqPrep3->fetchAll(PDO::FETCH_ASSOC);
                        //print_r($resultat);
                        $req4 = "SELECT * FROM matiere";
                        $reqPrep4 = $conn->prepare($req4);
                        $reqPrep4->execute();
                        $resultat4 = $reqPrep4->fetchAll(PDO::FETCH_ASSOC);
                        //print_r($resultat2);

                        foreach ($resultat3 as $row) {
                            foreach ($resultat4 as $ligne) {
                                if ($ligne['id_matiere'] == $row['id_matiere']) {
                                    echo "<tr><td>$ligne[matiere]</td><td>$row[moyenne_matiere]</td></tr>";
                                }
                            }
                        }
                        $conn = NULL; // On ferme la connexion
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <?php
        require_once("../Page_Structuration/footer.php");
        ?>
    </body>

    </html>