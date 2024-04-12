<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="../../public/Css_Pages/modification_note.css">
    <?php require_once("../Page_Structuration/meta.php"); ?>

</head>

<body>
    <?php
    session_start();
    include_once("../Page_Structuration/header.php");
    if (empty($_SESSION['id'])) {
        header('Location: sign_in_up.php');
    } else {
        if (isset($_GET['id_modif'])) {
            try {
                require_once("../../SQL_Traitement/DB_connect.php");
                $id = $_GET['id_modif'];
                $reqPrep = "SELECT * FROM eval WHERE id_eval=:id"; //La requere SQL
                $req = $conn->prepare($reqPrep); //Préparer la requete
                $reqTAb = array(':id' => $id);

                $req->execute($reqTAb); //Executer la requete
                $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultat as $row) {
                    $ids = $row['date_eval'];
                    $nom = $row['epreuve'];
                    $note = $row['note'];
                }
                $conn = NULL;
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
        }
        //ETAPE 2: Mettre à jours les données de la BD selon les valeurs modifiées envoyées par le formulaire ci-dessous
        if (isset($_POST["Modifier"])) {
            try {
                require_once("../../SQL_Traitement/DB_connect.php");
                $reqPrep = "UPDATE  eval  SET epreuve=:nom , date_eval=:datenote , note=:note WHERE id_eval=:id";
                $req = $conn->prepare($reqPrep); //Préparer la requete
                $id = $_POST["id"];
                $nom = $_POST["nom"];
                $date = $_POST["date"];
                $manote = $_POST["note"];

                $reqTAb = array(':id' => $id, ':nom' => $nom, ':datenote' => $date, ':note' => $manote);
                $req->execute($reqTAb); //Executer la requete
                $conn = NULL;
                header("Location:mesnotes.php");
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
        }








    ?>




        <div class="login-box">
            <h2>Modifier une note</h2>
            <form action="modification_note.php" method="post">
                <input type="hidden" id="id" name="id" value="<?php if (isset($id)) {
                                                                    echo $id;
                                                                } ?>"><br />

                <div class="user-box">

                    <input type="date" id="date" name="date" value="<?php if (isset($ids)) {
                                                                        echo $ids;
                                                                    } ?>"><br />
                    <label>Date de la note : </label>
                </div>
                <div class="user-box">
                    <input type="text" id="nom" name="nom" value="<?php if (isset($nom)) {
                                                                        echo $nom;
                                                                    } ?>"><br />
                    <label>Nom de la note : </label>
                </div>
                <div class="user-box">

                    <input type="text" id="note" name="note" value="<?php if (isset($note)) {
                                                                        echo $note;
                                                                    } ?>"><br />
                    <label>Note : </label>
                </div>
                <div class="button-form">
                    <input Type="submit" name="Modifier" value="Modifier">
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