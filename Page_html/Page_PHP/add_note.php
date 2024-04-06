<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="../../public/Css_Pages/add_note.css">
  <?php require_once("../Page_Structuration/meta.php"); ?>
</head>

<body>
  <?php
  session_start();
  require_once("../../SQL_Traitement/DB_connect.php");
  require_once("../../SQL_Traitement/fonctions.php");
  require_once("../Page_Structuration/header.php");
  //require_once("../Page_Structuration/header.php");
  if (empty($_SESSION["id"])) {
    header("Location: sign_in_up.php");
  }
  $addClass = false;
  $success = true;

  // Vérifiez si l'insertion du fichier a réussi et définissez $addClass sur true
  if (isset($_GET['format']) && $_GET['format'] == 2) {
    $addClass = true;
  }

  ?>
  <div class="head">
    <h1 data-text="Ajoutez rapidement vos notes ici !">Ajoutez rapidement vos notes ici !</h1>
  </div>
  <div class="container">
    <div class="item1">
      <div class="form-flex">
        <form action="../../SQL_Traitement/note_traitement.php" method="post" enctype="multipart/form-data" class="<?php echo $addClass ? 'success' : ''; ?>">
          <div class="form-input">
            <label for="pdf_file">
              <?php
              if (isset($_GET["format"]) && $_GET["format"] == 0) {
                echo 'Format de fichier incorrecte';
              } else echo 'Fichier PDF';
              ?>
            </label>
            <input type="file" name="pdf_file" placeholder="Sélectionne un fichier PDF" required>
          </div>
          <input type="submit" name="submit" class="btn" value="Envoyer mes notes">
        </form>
      </div>
    </div>
    <div>
      <form method="POST" id="form">
        <div>
          <label for="message">Ajout de ta note</label>
          <input type="text" placeholder="Date 15/03/2023 Code 2223_ISEN_CIR1_S2_INFO_ARDUINO_PROJET Épreuve Mini-Projet Note 19.00 Coefficient 25" name="message" id="message">
        </div>
        <div>
          <br>
          <input class="btn" type="submit" name="ADD1" value="Ajouter ma note"></input>
        </div>
      </form>
      <?php
      $id1 = $_SESSION["id"];
      if (isset($_POST["ADD1"])) {
        $test = valider_donnees($_POST["message"]);

        add_note_line($test); //echo $test;
        for ($i = 1; $i < 25; $i++) {
          UpdateMoyenne($id1, $i);
        }
        Moyenne_module($id1);
        Moyenne_generale($id1);
        sleep(1);
      }
      ?>
    </div>
  </div>
  <div class="btn-item">
    <a href="mesnotes.php" class="cta horizontale-slide">
      <i class="fa-solid fa-arrow-left"></i>
      <span>Retour aux notes</span>
    </a>
  </div>
  <div class="footitem">
    <input type="checkbox" id="checkbox" class="hidden-checkbox">
    <label for="checkbox" class="label-text">
      <a href="help.php"><i class="fa-solid fa-question fa-shake fa-2xl" style="color: #f06b42;"></i></label></a>
  </div>
  <!-- Début du scapping du pdf -->

  <?php

  //On  ajoute une note seule 
  if (isset($_POST["Envoyer"])) {
    //On prend l'id de l'url
    //On met la date au bon format
    $Cdate = valider_donnees($_POST["date"]);
    $code = valider_donnees($_POST["code"]);
    $epreuve = valider_donnees($_POST["epreuve"]);
    $note = valider_donnees($_POST["note"]);
    $coefficient = valider_donnees($_POST["coef"]);
    //Chammps bonus 
    if ($_POST["matiere"] != "notdefine") {
      $id_matiere = valider_donnees($_POST["matiere"]);
    } else {
      $id_matiere = id_matiere($code);
    }
    //id_eval || :id_eval || ':id_eval'=> $var,
    $requete = "INSERT INTO `eval` (`date_eval`,`code`,`epreuve`,`note`,`coef_eval`,`id_matiere`)VALUES(:date_eval, :code, :epreuve,:note, :coef_eval, :id_matiere)";
    $req = $conn->prepare($requete);
    $tabdesVals = array(':date_eval' => $Cdate, ':code' => $code, ':epreuve' => $epreuve, ':note' => $note, ':coef_eval' => $coefficient, ':id_matiere' => $id_matiere);
    $req->execute($tabdesVals);

    //Ici on va remplir la table eval_eleve avec les id
    $id_eval = id_evaluation($code);
    $requete = "INSERT INTO `eval_eleve`(`id_eval`, `id_eleve`)VALUES(:id_eval, :id_eleve)";
    $req = $conn->prepare($requete);
    $tabdesID = array(':id_eval' => $id_eval, ':id_eleve' => $id1);
    $req->execute($tabdesID);
    // Appel de la fonction qui permet de supprimer les doubles
    deleteDouble();
    UpdateMoyenne($id1, $id_matiere);
    //pour l'ajout des moyennes modules 
    Moyenne_module($id1);
    Moyenne_generale($id1);
    sleep(1);
  }

  ?>
</body>

</html>