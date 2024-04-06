<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once("../Page_Structuration/meta.php");
    if (isset($_COOKIE['themechoisi'])) {
        if ($_COOKIE['themechoisi'] == 'rootfonce') {
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/root.css '>");
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/fonce.css'>");
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/classement.css'>");
        } else {
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/classement.css'>");
        }
    } else {
    ?>
        <link rel="stylesheet" href="../../public/Css_Pages/classement.css">
    <?php } ?>
</head>

<body>
    <?php
    session_start();
    require_once("../../SQL_Traitement/DB_connect.php");
    require_once("../../SQL_Traitement/fonctions.php");
    require_once("../Page_Structuration/header.php");
    if (empty($_COOKIE["filtre_mod"]) && empty($_COOKIE["filtre_mat"])) {
        setcookie("filtre_mod", "null", time() + (365 * 24 * 3600), '/', "", false, true); // Le cookie sera inaccessible via JavaScript (HttpOnly)
        setcookie("filtre_mat", "null", time() + (365 * 24 * 3600), '/', "", false, true); // Le cookie sera inaccessible via JavaScript (HttpOnly)
    }

    //require_once("../Page_Structuration/header.php");
    if (empty($_SESSION["id"])) {
        header("Location: sign_in_up.php");
    }
    ?>
    <div class="container_classement">
        <?php
        $x = isset($_GET['x']) ? intval($_GET['x']) : 5;
        ?>
        <div class="classement-gen">
            <h2 class="titre-moyenne">Classement des élèves</h2>
            <table>
                <thead>
                    <tr>
                        <th class="nom-gen">Elève</th>
                        <th>Moyenne Générale</th>
                        <th>
                            <div class="ctn">
                                <div>Mon rang - Index<i class="fa-solid fa-address-book fa-fade fa-lg" style="color: #f06b42; margin-left:5px;"></i></div>
                                <div>
                                    <form id="selectx" method="get">
                                        <select name="x" id="var" onchange="this.form.submit()">
                                            <option value="1" <?php echo ($x == 1) ? 'selected' : ''; ?>>1</option>
                                            <option value="2" <?php echo ($x == 2) ? 'selected' : ''; ?>>2</option>
                                            <option value="5" <?php echo ($x == 5) ? 'selected' : ''; ?>>5</option>
                                            <option value="10" <?php echo ($x == 10) ? 'selected' : ''; ?>>10</option>
                                            <option value="20" <?php echo ($x == 20) ? 'selected' : ''; ?>>20</option>
                                            <option value="25" <?php echo ($x == 25) ? 'selected' : ''; ?>>25</option>
                                            <option value="50" <?php echo ($x == 50) ? 'selected' : ''; ?>>50</option>
                                            <option value="75" <?php echo ($x == 75) ? 'selected' : ''; ?>>75</option>
                                            <option value="100" <?php echo ($x == 100) ? 'selected' : ''; ?>>100</option>
                                        </select>
                                        <?php if (isset($_GET["y"])) {
                                            $y = $_GET['y'];
                                            echo "<input type='hidden' name='y' value=$y>";
                                        } else {
                                            $y = 3;
                                            echo "<input type='hidden' name='y' value=$y>";
                                        } ?>

                                    </form>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION["id"])) {
                        $id = $_SESSION["id"];
                        require_once("../../SQL_Traitement/fonctions.php");
                        require_once("../../SQL_Traitement/DB_connect.php");
                        $req = "SELECT nom, prenom,moyenne_generale FROM `eleve` WHERE `moyenne_generale` IS NOT NULL AND `profil_mode` = 1 ORDER BY moyenne_generale DESC ;";
                        $reqPrep = $conn->prepare($req);
                        $reqPrep->execute();
                        $resultat = $reqPrep->fetchAll();
                        //print_r($resultat);
                        $taille = count($resultat);
                        $i = 0;
                        $counter = 0;
                        foreach ($resultat as $row) {
                            $i++;
                            if ($counter >= $x) {
                                break;
                            }
                            $nom = $row['nom'];
                            $nom = ucfirst($nom);
                            $prenom = $row['prenom'];
                            $prenom = ucfirst($prenom);
                            echo "<tr><td>$nom $prenom</td><td>$row[moyenne_generale]</td><td>$i sur $taille</td></tr>";
                            $counter++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container_classement">
        <div class="classement-mod">
            <?php
            $y = isset($_GET['y']) ? intval($_GET['y']) : 5;
            if (isset($_COOKIE["filtre_mod"])) {
                $nomdumodule = $_COOKIE["filtre_mod"];
                echo "<h2 class='titre-moyenne'>Classement $nomdumodule</h2>";
            } else {
                $nomdumodule = "Mathématique";
                echo "<h2 class='titre-moyenne'>Classement $nomdumodule</h2>";
            }
            ?>
            <table>
                <thead>
                    <tr>
                        <th class="nom-mod">Elève</th>
                        <th class="moy-mod">Moyenne Générale</th>
                        <th>Rang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION["id"])) {
                        $id = $_SESSION["id"];
                        require_once("../../SQL_Traitement/fonctions.php");
                        require_once("../../SQL_Traitement/DB_connect.php");
                        if (isset($_COOKIE["filtre_mod"])) {
                            $mod = fetch_module();
                        } else {
                            $mod = 1;
                        }
                        //Sélection des élèves ayant un profil_mode = 1 et un id_module = $, puis classement des moyennes des modules par ordre décroissant, en excluant les moyennes nulles

                        //Sélection des élèves ayant un profil_mode = 1 et un id_module = 1, puis classement des moyennes des modules par ordre décroissant
                        $req = "SELECT eleve.id_eleve, eleve.prenom, eleve.nom, eleve_module.moyenne_module
                                FROM eleve
                                JOIN eleve_module ON eleve.id_eleve = eleve_module.id_eleve
                                WHERE eleve.profil_mode = 1 AND eleve_module.id_module = :mod AND eleve_module.moyenne_module IS NOT NULL
                                ORDER BY eleve_module.moyenne_module DESC";
                        $reqPrep = $conn->prepare($req);
                        $reqPrep->execute(array(':mod' => $mod));
                        $resultat = $reqPrep->fetchAll();
                        $taille = count($resultat);
                        //print_r($resultat);
                        $i = 0;
                        $counter = 0;
                        foreach ($resultat as $row) {
                            if ($counter >= $y) {
                                break;
                            }
                            $i++;
                            $nom = $row['nom'];
                            $nom = ucfirst($nom);
                            $prenom = $row['prenom'];
                            $prenom = ucfirst($prenom);
                            echo "<tr><td>$nom $prenom</td><td>$row[moyenne_module]</td><td>$i sur $taille</td></tr>";
                            $counter++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="filtre">
            <div class="miniflex">
                <div>
                    <h3>Choisis un classement !</h3>
                </div>

                <div>
                    <form method="get" id="form">
                        <form method="get">
                            <label for="module">Sélectionnez vos classements :</label>
                            <select id="module" name="module">
                                <option value="Mathematique" <?php echo ($_COOKIE['filtre_mod'] == 'Mathematique' || $_COOKIE['filtre_mod'] == 'null') ? 'selected' : ''; ?>>Mathématique</option>
                                <option value="Physique" <?php echo ($_COOKIE['filtre_mod'] == 'Physique') ? 'selected' : ''; ?>>Physique</option>
                                <option value="Informatique" <?php echo ($_COOKIE['filtre_mod'] == 'Informatique') ? 'selected' : ''; ?>>Informatique</option>
                                <option value="Management et Développement Personnel" <?php echo ($_COOKIE['filtre_mod'] == 'Management et Développement Personnel') ? 'selected' : ''; ?>>Management et Développement Personnel</option>
                            </select>
                            <select name="matiere" id="matiere">
                                <option value="Fondamentaux" <?php echo ($_COOKIE['filtre_mat'] == 'Fondamentaux' || $_COOKIE['filtre_mat'] == 'null') ? 'selected' : ''; ?>>Fondamentaux MATH</option>
                                <option value="Analyse" <?php echo ($_COOKIE['filtre_mat'] == 'Analyse') ? 'selected' : ''; ?>>Analyse</option>
                                <option value="Tp Maths" <?php echo ($_COOKIE['filtre_mat'] == 'Tp Maths') ? 'selected' : ''; ?>>TP Maths</option>
                                <option value="Algebre Lineaire" <?php echo ($_COOKIE['filtre_mat'] == 'Algebre Lineaire') ? 'selected' : ''; ?>>Algèbre linéaire</option>
                                <option value="Arithmetique" <?php echo ($_COOKIE['filtre_mat'] == 'Arithmetique') ? 'selected' : ''; ?>>Arithmétique</option>
                                <option value="Tp Maths_2" <?php echo ($_COOKIE['filtre_mat'] == 'Tp Maths S2') ? 'selected' : ''; ?>>TP Maths S2</option>
                                <option value="Optique" <?php echo ($_COOKIE['filtre_mat'] == 'Optique') ? 'selected' : ''; ?>>Optique</option>
                                <option value="Electronique" <?php echo ($_COOKIE['filtre_mat'] == 'Electronique') ? 'selected' : ''; ?>>Electronique</option>
                                <option value="Tp Electronique" <?php echo ($_COOKIE['filtre_mat'] == 'Tp Electronique') ? 'selected' : ''; ?>>TP Electronique</option>
                                <option value="Mecanique De Point" <?php echo ($_COOKIE['filtre_mat'] == 'Mecanique De Point') ? 'selected' : ''; ?>>Mécanique de point</option>
                                <option value="Thermodynamique" <?php echo ($_COOKIE['filtre_mat'] == 'Thermodynamique') ? 'selected' : ''; ?>>Thermodynamique</option>
                                <option value="Fondamentaux Prog" <?php echo ($_COOKIE['filtre_mat'] == 'Fondamentaux Prog') ? 'selected' : ''; ?>>Fondamentaux Prog</option>
                                <option value="Tp Programmation" <?php echo ($_COOKIE['filtre_mat'] == 'Tp Programmation') ? 'selected' : ''; ?>>TP Programmation</option>
                                <option value="Technologies Web" <?php echo ($_COOKIE['filtre_mat'] == 'Technologies Web') ? 'selected' : ''; ?>>Technologies Web</option>
                                <option value="Approfondissement" <?php echo ($_COOKIE['filtre_mat'] == 'Approfondissement') ? 'selected' : ''; ?>>Approfondissement</option>
                                <option value="Tp Programmation S2" <?php echo ($_COOKIE['filtre_mat'] == 'Tp Programmation S2') ? 'selected' : ''; ?>>TP Programmation S2</option>
                                <option value="Technologies Web S2" <?php echo ($_COOKIE['filtre_mat'] == 'Technologie Web S2') ? 'selected' : ''; ?>> Techologies Web S2</option>
                                <option value="Informatique Embarque" <?php echo ($_COOKIE['filtre_mat'] == 'Informatique Embarque') ? 'selected' : ''; ?>>Informatique Embarquée</option>
                                <option value="Projet fin d'année" <?php echo ($_COOKIE['filtre_mat'] == 'Projet fin d\'année') ? 'selected' : ''; ?>>Projet de fin d'année</option>
                                <option value="Anglais" <?php echo ($_COOKIE['filtre_mat'] == 'Anglais') ? 'selected' : ''; ?>>Anglais</option>
                                <option value="Competence Relationnelles" <?php echo ($_COOKIE['filtre_mat'] == 'Compétence Relationnelles') ? 'selected' : ''; ?>>Compétence relationnelles</option>
                                <option value="Sport" <?php echo ($_COOKIE['filtre_mat'] == 'Sport') ? 'selected' : ''; ?>>Sport</option>
                                <option value="Anglais S2" <?php echo ($_COOKIE['filtre_mat'] == 'Anglais S2') ? 'selected' : ''; ?>>Anglais</option>
                                <option value="Epistemimologie" <?php echo ($_COOKIE['filtre_mat'] == 'Epistemimologie') ? 'selected' : ''; ?>>Epistemimologie</option>
                                <option value="Sport S2" <?php echo ($_COOKIE['filtre_mat'] == 'Sport S2') ? 'selected' : ''; ?>>Sport S2</option>
                                <option value="Volaire" <?php echo ($_COOKIE['filtre_mat'] == 'Volaire') ? 'selected' : ''; ?>>Voltaire</option>
                            </select>
                            <button class="submit-btn" type="submit" name="filtrer">Filtrer</button>
                        </form>
                        <?php
                        if (isset($_GET["module"]) && isset($_GET["matiere"])) {
                            setcookie("filtre_mod", $_GET["module"], time() + (365 * 24 * 3600), '/', "", false, true); // Le cookie sera inaccessible via JavaScript (HttpOnly)
                            setcookie("filtre_mat", $_GET["matiere"], time() + (365 * 24 * 3600), '/', "", false, true); // Le cookie sera inaccessible via JavaScript (HttpOnly)
                            header("Location: classement.php?x=$x&y=$y");
                        }
                        ?>
                </div>

                <?php
                $y = isset($_GET['y']) ? intval($_GET['y']) : 5;
                ?>
                <div class="index-form-container">
                    Index<i class="fa-solid fa-address-book fa-fade fa-lg" style="color: #f06b42;"></i>:
                    <form id="selecty" method="get">
                        <select name="y" id="var" onchange="this.form.submit()">
                            <option value="1" <?php echo ($y == 1) ? 'selected' : ''; ?>>1</option>
                            <option value="2" <?php echo ($y == 2) ? 'selected' : ''; ?>>2</option>
                            <option value="5" <?php echo ($y == 5) ? 'selected' : ''; ?>>5</option>
                            <option value="10" <?php echo ($y == 10) ? 'selected' : ''; ?>>10</option>
                            <option value="20" <?php echo ($y == 20) ? 'selected' : ''; ?>>20</option>
                            <option value="25" <?php echo ($y == 25) ? 'selected' : ''; ?>>25</option>
                            <option value="50" <?php echo ($y == 50) ? 'selected' : ''; ?>>50</option>
                            <option value="75" <?php echo ($y == 75) ? 'selected' : ''; ?>>75</option>
                            <option value="100" <?php echo ($y == 100) ? 'selected' : ''; ?>>100</option>
                            <?php if (isset($_GET["x"])) {
                                $x = $_GET['x'];
                                echo "<input type='hidden' name='x' value=$x>";
                            } else {
                                echo "<input type='hidden' name='x' value=$x=3>";
                            } ?>
                        </select>
                    </form>

                </div>
            </div>
        </div>
        <div class="classement-mat">
            <?php
            if (isset($_COOKIE["filtre_mat"])) {
                $nomdumodule = $_COOKIE["filtre_mat"];
                echo "<h2 class='titre-moyenne'>Classement $nomdumodule</h2>";
            } else {
                $nomdumodule = "Fondamentaux";
                echo "<h2 class='titre-moyenne'>Classement $nomdumodule</h2>";
            }
            ?>

            <table>
                <thead>
                    <tr>
                        <th class="nom-mat">Elève</th>
                        <th>Moyenne Générale</th>
                        <th>Rang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION["id"])) {
                        $id = $_SESSION["id"];
                        $mat = fetch_matiere();
                        require_once("../../SQL_Traitement/fonctions.php");
                        require_once("../../SQL_Traitement/DB_connect.php");
                        $req = "SELECT eleve.id_eleve, eleve.prenom, eleve.nom, eleve_matiere.moyenne_matiere
                                FROM eleve
                                JOIN eleve_matiere ON eleve.id_eleve = eleve_matiere.id_eleve
                                WHERE eleve.profil_mode = 1 AND eleve_matiere.id_matiere = :mat AND eleve_matiere.moyenne_matiere IS NOT NULL
                                ORDER BY eleve_matiere.moyenne_matiere DESC";
                        $reqPrep = $conn->prepare($req);
                        $reqPrep->execute(array(':mat' => $mat));
                        $resultat = $reqPrep->fetchAll();
                        $taille = count($resultat);
                        //print_r($resultat);
                        $i = 0;
                        $counter = 0;
                        foreach ($resultat as $row) {
                            if ($counter >= $y) {
                                break;
                            }
                            $i++;
                            $nom = $row['nom'];
                            $nom = ucfirst($nom);
                            $prenom = $row['prenom'];
                            $prenom = ucfirst($prenom);
                            echo "<tr><td>$nom $prenom</td><td>$row[moyenne_matiere]</td><td>$i sur $taille</td></tr>";
                            $counter++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php
    require_once("../Page_Structuration/footer.php");
    ?>
</body>

</html>