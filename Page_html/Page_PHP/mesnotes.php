<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once("../Page_Structuration/meta.php");
    if (isset($_COOKIE['themechoisi'])) {
        if ($_COOKIE['themechoisi'] == 'rootfonce') {
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/root.css '>");
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/fonce.css'>");
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/mesnotes.css'>");
        } else {
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/mesnotes.css'>");
            echo ("<link rel='stylesheet' href='../../public/Css_Pages/root.css '>");
        }
    } else {
    ?>
        <link rel="stylesheet" href="../../public/Css_Pages/mesnotes.css">
    <?php } ?>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
</head>

<body>
    <?php
    session_start();
    include_once("../Page_Structuration/header.php");
    if (empty($_SESSION['id'])) {
        header('Location: sign_in_up.php');
    } else {
    ?>
        <div class="page_no_header">
            <div class="filtre">
                <h3>Filtre :</h3>
                <form action="" method="post">
                    <label>Matière :</label>
                    <select name="Matiere">
                        <option value="tous">Tous</option>
                        <option value="1">Maths</option>
                        <option value="2">Physique</option>
                        <option value="3">Informatique</option>
                        <option value="4">Management et Développement Personnel</option>
                    </select>
                    <label>Date :</label>
                    <select name="date">
                        <option value="Croissant">De la plus récente</option>
                        <option value="Decroissant">De la plus vieille</option>
                    </select>
                    <input Type="submit" class="appliquer" name="Appliquer" value="Appliquer">
                </form>
                <h3>Modifier :</h3>
                <form action="mesnotes.php" method="get">
                    <input type="hidden" name="modif" value="1">

                    <input type="submit" class="modifier-note" name="modif" value="Cliquer pour modifier">
                </form>


            </div>

            <?php

            /* Pour le fichier mesnote.php  */
            require_once("../../SQL_Traitement/DB_connect.php");
            /* Pour le index */
            //require("SQL_Traitement/DB_connect.php");
            try {
                $id = $_SESSION['id'];
                if (isset($_POST["Appliquer"])) {
                    if ($_POST["date"] == "Croissant") {
                        $reqPrep = "SELECT * FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval WHERE id_eleve = :id ORDER BY date_eval DESC";
                    }
                    if ($_POST["date"] == "Decroissant") {
                        $reqPrep = "SELECT * FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval WHERE id_eleve = :id ORDER BY date_eval";
                    }
                } else {
                    //La requete SQL
                    $reqPrep = "SELECT * FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval WHERE id_eleve = :id ORDER BY date_eval DESC";
                }
                $req = $conn->prepare($reqPrep); //Préparer la requete
                $req->execute(array(':id' => $id)); //Executer la requete
                $resultat = $req->fetchAll(PDO::FETCH_ASSOC); //récupération du résultat 
                //$nombre=count($resultat);
                //Requete sql pour récuperer les noms des produits et leurs références de la table produit pour la catégorie boisson (CodeCategorie =1)
                //préparer, exécuter la requête et récuperer le résultat
                $conn = NULL; // On ferme la connexion
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
            ?>


            <div class="classement-table">
                <?php
                $x = isset($_GET['x']) ? intval($_GET['x']) : 10;
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nom de la note</th>
                            <th>Matière</th>
                            <th>Date</th>
                            <?php
                            if (isset($_GET['modif'])) {
                                echo '<th>';
                            } else {
                                echo '<th id="thtab">';
                            }
                            ?>

                            <div class="ctn">
                                <div>Mes notes - Index<i class="fa-solid fa-address-book fa-fade fa-lg" style="color: #f06b42; margin-left:5px;"></i></div>
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
                                    </form>
                                </div>
                            </div>

                            </th>
                            <?php
                            if (isset($_GET['modif'])) {
                                echo "<th id='thta'>Modifier</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="modification_note.php" method="post">
                            <?php
                            $counter = 0;
                            foreach ($resultat as $row) {
                                if ($counter >= $x) {
                                    break;
                                }
                                // Reste du code...
                                require_once("../../SQL_Traitement/fonctions.php");
                                $code = $row['code'];
                                $ton_module = id_module($code);
                                $CodeString = affichage_note($code);

                                // Ajouter un attribut id="err" si "ERREUR DANS PDF" est détecté
                                if ($row['epreuve'] == "ERREUR DANS PDF") {
                                    echo '<tr id="err">';
                                } else {
                                    echo '<tr>';
                                }

                                if (isset($_POST["Appliquer"])) {
                                    if ($ton_module == $_POST["Matiere"]) {
                                        echo "<td>$row[epreuve]</td><td>$CodeString</td><td>$row[date_eval]</td><td>$row[note]</td></tr>";
                                    }
                                    if (($_POST["Matiere"] == "tous")) {
                                        echo "<td>$row[epreuve]</td><td>$CodeString</td><td>$row[date_eval]</td><td>$row[note]</td></tr>";
                                    }
                                } else {
                                    if (isset($_GET['modif'])) {
                                        echo "<td>$row[epreuve]</td><td>$CodeString</td><td>$row[date_eval]</td><td>$row[note]</td><td><input type='radio' name='choix' id='option1' value='$row[id_eval]'></td></tr>";
                                    } else {
                                        echo "<td>$row[epreuve]</td><td>$CodeString</td><td>$row[date_eval]</td><td>$row[note]</td></tr>";
                                    }
                                }
                                $counter++;
                            }
                            ?>
                    </tbody>
                </table>
                <?php
                if (isset($_GET['modif'])) {
                ?>
                    <button type="submit" id="Appliquer-modif" name="Appliquer-modif" value="Appliquer-modif"><span id="span-but">Appliquer les modifications</span></button>
                <?php
                }
                ?>
                </form>
            </div>
        <?php
    }
    require_once("../Page_Structuration/footer.php");
        ?>

        <div class="button_container">
            <button class="btn">
                <a href="add_note.php">
                    <span id="col"><i class="fa-solid fa-plus"></i>Ajouter note</span></a>
            </button>
        </div>
        </div>
</body>

</html>