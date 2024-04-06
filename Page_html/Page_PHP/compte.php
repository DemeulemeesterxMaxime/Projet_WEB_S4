<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <?php
  require_once("../Page_Structuration/meta.php");
  include "../../SQL_Traitement/DB_connect.php";
  require_once("../Page_Structuration/header.php");
  ?>
  <?php
  if (empty($_COOKIE['themechoisi'])) {
    echo "<link rel='stylesheet' href='../../public/Css_Pages/compte.css'>";
  } else {

    if ($_COOKIE['themechoisi'] == 'rootfonce') {
      echo ("<link rel='stylesheet' href='../../public/Css_Pages/fonce.css'>");
      echo ("<link rel='stylesheet' href='../../public/Css_Pages/compte.css'>");
    } else {
      echo ("<link rel='stylesheet' href='../../public/Css_Pages/compte.css'>");
    }
  } ?>
  <!-- affichage des icones pour le footer -->

</head>

<body>
  <?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  if (isset($_SESSION["id"]) == false) {
    header("Location: sign_in_up.php");
  }
  ?>
  <!-- on fait la page pour que l'utilisateur puisse voir les informations de son compte. il va pouvoir voir sa photo de profil, son nom, prénom, mail et le bouton pour changer de mdp. chaque caractéristique est cliquable pour rediriger vers une page pour changer ces attributs -->
  <?php
  // Récupération du nom de la photo de profil dans la base de données
  $user_id =  $_SESSION['id'];
  $sql = "SELECT `photo_profil` FROM `eleve` WHERE `id_eleve` = :user_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_id', $user_id);
  $stmt->execute();
  $photo_filename = $stmt->fetchColumn();
  ?>
  <!-- Affichage de la photo de profil -->
  <div class="profile-card">
    <img src="<?php echo $photo_filename; ?>" alt="Photo de profil" class="profile-picture">
    <div class="changer-photo">
      <a href="changement_photo.php">Changer de photo de profil</a>
    </div>
    <div class="info">
      <div class="nom">
        <p>Nom :
          <?php echo $_SESSION['nom']; ?> </p>
      </div>
      <div class="prenom">
        <p>Prénom :
          <?php echo $_SESSION['prenom']; ?> </p>
      </div>
      <div class="mail">
        <p>Mail :
          <?php echo $_SESSION['email']; ?> </p>
      </div>
      <div class="theme">
        <p>Thème :
          <?php
          if (isset($_COOKIE['themechoisi'])) {
            if ($_COOKIE['themechoisi'] == 'root') {
              echo ("Clair");
            } else {
              echo ("Sombre");
            }
          } else {
            echo ("Clair (Défaut)");
          }
          ?> </p>
      </div>
      <div class="bouton">
        <a href="theme.php">Changer le thème du site</a>
      </div>
      <div class="mdp" class="bouton">
        <a href="../../SQL_Traitement/mail_code_confirmation.php?p=1">Changer de mot de passe</a>
      </div>
      <div class="bouton">
        <a href="changement_info.php">Changer mes informations</a>
      </div>

      <div class="logout">
        <a href="logout.php">Déconnexion</a>
      </div>
    </div>
  </div>
  <?php require_once("../Page_Structuration/footer.php"); ?>
</body>

</html>