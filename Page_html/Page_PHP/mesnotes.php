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
        <div class="notePopup">
            <h2>Information de la Note : </h2>
            <div id="info_note">
                <span id="nom_note"></span> <br>
                <span id="note_actu"></span> <br>
                <span id="moyenne_classe"></span> <br>
                <span id="note_min"></span> <br>
                <span id="note_max"></span> <br>
            </div>
        </div>
        <div class="page_no_header">
            <div class="filtre">
                <h3>Filtre :</h3>
                <form action="" method="post" id="form">
                    <label>Matière :</label>
                    <select name="matiere" id="matiere">
                        <option value="Tous">Tous</option>
                        <option value="1">Maths</option>
                        <option value="2">Physique</option>
                        <option value="3">Informatique</option>
                        <option value="4">Management et Développement Personnel</option>
                    </select>
                    <label>Date :</label>
                    <select name="date" id="date">
                        <option value="none">Défaut</option>
                        <option value="Croissant">De la plus récente</option>
                        <option value="Decroissant">De la plus vieille</option>
                    </select>
                </form>
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="Rechercher votre note ! ">
                </div>
            </div>
        </div>
        <?php

        /* Pour le fichier mesnote.php  */
        require_once("../../SQL_Traitement/DB_connect.php");
        /* Pour le index */
        //require("SQL_Traitement/DB_connect.php");
        try {
            $id = $_SESSION['id'];
            if ($_COOKIE["search_query"] != 1) {
                if (isset($_POST["date"]) && $_POST["date"] != "none") {
                    if ($_POST["date"] == "Croissant") {
                        $reqPrep = "SELECT * FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval WHERE id_eleve = :id ORDER BY date_eval DESC";
                    }
                    if ($_POST["date"] == "Decroissant") {
                        $reqPrep = "SELECT * FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval WHERE id_eleve = :id ORDER BY date_eval";
                    }
                }
                if (isset($_POST["matiere"]) && $_POST["matiere"] != "tous") {
                    if ($_POST["matiere"] == "1") {
                        $reqPrep = "SELECT eval.* FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval JOIN matiere ON eval.id_matiere = matiere.id_matiere WHERE eval_eleve.id_eleve = :id AND matiere.id_module = 1;";
                    } else if ($_POST["matiere"] == "2") {
                        $reqPrep = "SELECT eval.* FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval JOIN matiere ON eval.id_matiere = matiere.id_matiere WHERE eval_eleve.id_eleve = :id AND matiere.id_module = 2;";
                    } else if ($_POST["matiere"] == "3") {
                        $reqPrep = "SELECT eval.* FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval JOIN matiere ON eval.id_matiere = matiere.id_matiere WHERE eval_eleve.id_eleve = :id AND matiere.id_module = 3;";
                    } else if ($_POST["matiere"] == "4") {
                        $reqPrep = "SELECT eval.* FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval JOIN matiere ON eval.id_matiere = matiere.id_matiere WHERE eval_eleve.id_eleve = :id AND matiere.id_module = 4;";
                    }
                }
                if (!isset($_POST["matiere"]) || $_POST["matiere"] == "Tous" && !isset($_POST["date"]) || $_POST["date"] == "none") {
                    //La requete SQL
                    $reqPrep = "SELECT * FROM eval JOIN eval_eleve ON eval.id_eval = eval_eleve.id_eval WHERE id_eleve = :id ORDER BY date_eval ";
                }
                $req = $conn->prepare($reqPrep); //Préparer la requete
                $req->execute(array(':id' => $id)); //Executer la requete
                $resultat = $req->fetchAll(PDO::FETCH_ASSOC); //récupération du résultat 
                //$nombre=count($resultat);
                //Requete sql pour récuperer les noms des produits et leurs références de la table produit pour la catégorie boisson (CodeCategorie =1)
                //préparer, exécuter la requête et récuperer le résultat
                $conn = NULL; // On ferme la connexion
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        ?>
        <div class="classement-table">
            <table class="tableau_verif" id="tab_1">
                <thead>
                    <tr>
                        <th>Nom de la note</th>
                        <th>Matière</th>
                        <th>Date</th>
                        <th class="thtab">Mes notes</th>
                        <th class="thta">Modifier</th>
                    </tr>
                </thead>
                <tbody id="results">
                    <!-- <span id="results"></span> -->
                </tbody>
            </table>
            <table class="tableau_verif" id="tab_2">
                <thead>
                    <tr>
                        <th>Nom de la note</th>
                        <th>Matière</th>
                        <th>Date</th>
                        <th class="thtab">Mes notes</th>
                        <th class="thta">Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($resultat as $row) {
                        require_once("../../SQL_Traitement/fonctions.php");
                        $code = $row['code'];
                        $ton_module = id_module($code);
                        $CodeString = affichage_note($code);

                        // Ajouter un attribut id="err" si "ERREUR DANS PDF" est détecté
                        if ($row['epreuve'] == "ERREUR DANS PDF") {
                            echo '<tr class="err">';
                        } else {
                            echo '<tr class="' . $row['note'] . "?" . $row['epreuve'] . "?" . $row['code'] . '">';
                        }
                        echo "<td>$row[epreuve]</td>
                            <td>$CodeString</td>
                            <td>$row[date_eval]</td>
                            <td>$row[note]</td>
                            <td><a href='modification_note.php?id_modif=" . $row['id_eval'] . "'><i class='fa-regular fa-pen-to-square color'></i></a></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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

    <div id="div_pasnote">
        <div id="div_pasnote_flex">
            <div id="i_pasnote"><i class="fa-solid fa-xmark"></i></div>
            <h2>Il n'y a aucune "Note" rentré, veuillez rentrer des notes</h2>
            <button id="btn_pasnote" onclick="redirection()"> Ajouter des notes</button>
        </div>
    </div>


    <script  src="../../public/JS/note.js"></script>
</body>

</html>