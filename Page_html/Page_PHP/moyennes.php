<?php
session_start();
if (empty($_SESSION['id'])) {
    header('Location: sign_in_up.php');
    exit();
}

require_once("../Page_Structuration/meta.php");
require_once("../Page_Structuration/header.php");
require_once("../../SQL_Traitement/fonctions.php");
require_once("../../SQL_Traitement/DB_connect.php");

if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];

    $req = "SELECT * FROM eleve_module WHERE id_eleve=:id AND moyenne_module!='NULL'";
    $reqPrep = $conn->prepare($req);
    $reqPrep->execute(array(':id' => $id));
    $resultat = $reqPrep->fetchAll(PDO::FETCH_ASSOC);

    $req2 = "SELECT * FROM module";
    $reqPrep2 = $conn->prepare($req2);
    $reqPrep2->execute();
    $resultat2 = $reqPrep2->fetchAll(PDO::FETCH_ASSOC);
}
/********************* */

if (isset($_SESSION["id"])) {
    $req3 = "SELECT * FROM eleve_matiere WHERE id_eleve=:id AND moyenne_matiere!='NULL'";
    $reqPrep3 = $conn->prepare($req3);
    $reqPrep3->execute(array(':id' => $id));
    $resultat3 = $reqPrep3->fetchAll(PDO::FETCH_ASSOC);

    $req4 = "SELECT * FROM matiere";
    $reqPrep4 = $conn->prepare($req4);
    $reqPrep4->execute();
    $resultat4 = $reqPrep4->fetchAll(PDO::FETCH_ASSOC);
}

// Il n'est pas nécessaire de dupliquer l'exemple suivant, c'était juste pour l'illustration.
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel='stylesheet' href='../../public/Css_Pages/moyennes.css'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>

        // Placez ce script juste avant la fermeture de votre balise </body> pour vous assurer que le DOM est chargé.
        document.addEventListener('DOMContentLoaded', function() {
            var resultat = <?php echo json_encode($resultat) ?: '[]'; ?>;
            var resultat2 = <?php echo json_encode($resultat2) ?: '[]'; ?>;
            console.log(resultat, resultat2);

            let correspondances = [];

            resultat.forEach(row => {
                resultat2.forEach(ligne => {
                    if (ligne.id_module === row.id_module) {
                        correspondances.push({ matiere: ligne.matiere, moyenne_module: row.moyenne_module });
                    }
                });
            });

            const tableauHTML = document.createElement('table');
            correspondances.forEach(c => {
                const tr = document.createElement('tr');
                const tdMatiere = document.createElement('td');
                tdMatiere.textContent = c.matiere;
                const tdMoyenne = document.createElement('td');
                tdMoyenne.textContent = c.moyenne_module;
                
                tr.appendChild(tdMatiere);
                tr.appendChild(tdMoyenne);
                tableauHTML.appendChild(tr);
            });

            document.getElementById('classement-table').appendChild(tableauHTML);
        });
                //*************************************************************************** */
        document.addEventListener('DOMContentLoaded', function() {
            var resultat3 = <?php echo json_encode($resultat3) ?: '[]'; ?>;
            var resultat4 = <?php echo json_encode($resultat4) ?: '[]'; ?>;
            console.log(resultat3, resultat4);

            let correspondances = [];

            resultat3.forEach(row => {
                resultat4.forEach(ligne => {
                    if (ligne.id_matiere === row.id_matiere) {
                        correspondances.push({ matiere: ligne.matiere, moyenne_matiere: row.moyenne_matiere });
                    }
                });
            });

            const tableauHTML = document.createElement('table');
            correspondances.forEach(c => {
                const tr = document.createElement('tr');
                const tdMatiere = document.createElement('td');
                tdMatiere.textContent = c.matiere;
                const tdMoyenne = document.createElement('td');
                tdMoyenne.textContent = c.moyenne_matiere;
                
                tr.appendChild(tdMatiere);
                tr.appendChild(tdMoyenne);
                tableauHTML.appendChild(tr);
            });

            document.getElementById('matiere-table').appendChild(tableauHTML);
        });
    document.addEventListener('DOMContentLoaded', function() {
        // Données pour le premier graphique (Notes des modules)
        var resultat = <?php echo json_encode($resultat) ?: '[]'; ?>;
        var resultat2 = <?php echo json_encode($resultat2) ?: '[]'; ?>;
        let labelsModule = [];
        let dataModule = [];
        resultat.forEach(row => {
            resultat2.forEach(ligne => {
                if (ligne.id_module === row.id_module) {
                    labelsModule.push(ligne.matiere);
                    dataModule.push(row.moyenne_module);
                }
            });
        });

        // Création du graphique pour les modules
        const ctxModule = document.getElementById('moduleChart').getContext('2d');
        const moduleChart = new Chart(ctxModule, {
            type: 'bar',
            data: {
                labels: labelsModule,
                datasets: [{
                    label: 'Moyenne par module',
                    data: dataModule,
                    backgroundColor: '#F9A88C',
                    borderColor: '#F9A88C',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Données pour le deuxième graphique (Notes des matières)
        var resultat3 = <?php echo json_encode($resultat3) ?: '[]'; ?>;
        var resultat4 = <?php echo json_encode($resultat4) ?: '[]'; ?>;
        let labelsMatiere = [];
        let dataMatiere = [];
        resultat3.forEach(row => {
            resultat4.forEach(ligne => {
                if (ligne.id_matiere === row.id_matiere) {
                    labelsMatiere.push(ligne.matiere);
                    dataMatiere.push(row.moyenne_matiere);
                }
            });
        });

        // Création du graphique pour les matières
        const ctxMatiere = document.getElementById('matiereChart').getContext('2d');
        const matiereChart = new Chart(ctxMatiere, {
            type: 'bar',
            data: {
                labels: labelsMatiere,
                datasets: [{
                    label: 'Moyenne par matière',
                    data: dataMatiere,
                    backgroundColor: '#F9A88C',
                    borderColor: '#F9A88C',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

</head>
<body>
<div id="classement-table">
    <h2 class="titreClassement">Notes du Module</h2>
    <div class="conteneurCanva">
        <canvas id="moduleChart"></canvas>
    </div>
</div>
<div id="matiere-table">
    <h2 class="titreClassement">Notes des matières</h2>
    <div class="conteneurCanva">
        <canvas id="matiereChart"></canvas>
    </div>
</div>





<!-- Le reste de votre code HTML ici -->
<?php require_once("../Page_Structuration/footer.php"); ?>
</body>
</html>
