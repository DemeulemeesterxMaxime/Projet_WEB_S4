<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once("../Page_Structuration/meta.php"); ?>
    <link rel="stylesheet" href="../../public/Css_Pages/admin.css">

</head>

<body>
    <h1>Administration</h1>
    <form action="../../Base_donnee/index.php" method="post" id="gestion">
        <button type="submit" name="supprimer" formaction="../../Base_donnee/index.php">Gestion BDD</button>
    </form>
    <form action="logout.php" method="post" id="gestion">
        <button type="submit" name="supprimer" formaction="logout.php">Deconnexion</button>
    </form>

    <?php

    session_start();
    require_once("../../SQL_Traitement/DB_connect.php");
    require_once("../../SQL_Traitement/fonctions.php");
    //require_once("../Page_Structuration/header.php");
    //on verifie si c'est bien un admin qui est ici
    if ($_SESSION['id'] != 0) {
        header("Location: ../../index.php");
    }

    echo "<form method=\"POST\" id=\"form\">
        <div>
            <label for=\"message\">Message :</label>
            <input type=\"text\" name=\"message\" id=\"message\" value=\"\">
        </div>
        <div>
            <button type=\"submit\" name=\"modifimess\">Modifier</button>
        </div>
    </form>";
    //on upload le message dans la bdd
    if (isset($_POST['modifimess'])) {
        $message = $_POST['message'];
        $sql = "UPDATE `admin` SET mess=:mess";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":mess", $message);
        if ($stmt->execute()) {
            //on redirige vers la page admin sans les parametres get 
            header("Location: admin.php");
        } else {
            echo "Erreur lors de la modification du message";
        }
    }



    // Récupération des utilisateurs
    $stmt = $conn->prepare("SELECT * FROM eleve");
    $stmt->execute();
    if (isset($_POST['supprimer'])) {
        $id = $_POST['id'];

        // Supprimer les modules de l'élève
        $query = "DELETE FROM eleve_module WHERE id_eleve = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Supprimer l'élève
        $query = "DELETE FROM eleve WHERE id_eleve = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        //on redirige vers la page admin
        header("Location: admin.php");
    }
    // Affichage des utilisateurs dans un tableau
    echo "<table>";
    echo "<tr><th>id</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Action</th><th></th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id_eleve'] . "</td>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['prenom'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><a href=\"admin.php?id=" . $row['id_eleve'] . "\">Modifier</a></td>";
        echo "<td>
        <form method=\"POST\">
            <input type=\"hidden\" name=\"id\" value=\"" . $row['id_eleve'] . "\">
            <button type=\"submit\" name=\"supprimer\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');\">Supprimer</button>
        </form>
    </td>";
        echo "</tr>";
    }
    echo "</table>";

    // Récupération de l'identifiant de l'utilisateur à modifier
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Récupération des informations de l'utilisateur à modifier
        $stmt = $conn->prepare("SELECT * FROM eleve WHERE id_eleve = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Vérification que l'utilisateur existe
        if (!$row) {
            exit;
        }
        // Modification de l'utilisateur
        if (isset($_POST['modifier'])) {
            $id = $_GET['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];

            $sql = "UPDATE eleve SET nom=:nom, prenom=:prenom, email=:email WHERE id_eleve=:id_eleve";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":nom", $nom);
            $stmt->bindParam(":prenom", $prenom);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id_eleve", $id);

            if ($stmt->execute()) {
                //on redirige vers la page admin sans les parametres get 
                header("Location: admin.php");
            } else {
                echo "Erreur lors de la modification de l'utilisateur";
            }
        }

        // Affichage du formulaire de modification
    ?>
        <form method="POST" id="form">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" value="<?= $row['nom'] ?>">
            </div>
            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" value="<?= $row['prenom'] ?>">
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" value="<?= $row['email'] ?>">
            </div>
            <div>
                <button type="submit" name="modifier">Modifier</button>
                <button type="button" onclick="window.location.href='admin.php'">Retour</button>
            </div>
        </form>

    <?php

    }


    // Fermeture de la connexion
    $conn = null;
    ?>


</body>

</html>