//fichier route pour les notes
const { Router } = require("express"); // Importer la classe Router d'express

const mysql = require("mysql");
const router = Router(); // Créer un routeur Express
const cors = require("cors"); // Add cors library
const bodyParser = require("body-parser");

// Enable CORS for all origins during development (not recommended for production)
router.use(cors());

// Middleware pour parser les requêtes POST
router.use(bodyParser.urlencoded({ extended: true }));
router.use(bodyParser.json()); // Ajouter cette ligne pour analyser les requêtes au format JSON

const { affichage_note } = require("../public/JS/fonction.js"); // Importer la fonction d'affichage des notes

// Connexion à la base de données
let conn = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "root",
  database: "jreuttus_projet_web_s4",
});

// Vérification de la connexion à la base de données
conn.connect((err) => {
  if (err) {
    console.error("Erreur de connexion à la base de données :", err);
    return;
  }
  console.log("Connecté à la base de données");
});

//Route pour la requête de recherche
router.post("/mesnotes", (req, res) => {
  // On va récupérer les valeurs de la requête POST
  const searchQuery = req.body.searchQuery;
  const id_use = req.body.id;

    // Requête préparée pour récupérer les notes de l'élève en liens avec la recherche
  let reqPrep =
    "SELECT * FROM eval WHERE code LIKE ? AND id_eval IN (SELECT id_eval FROM eval_eleve WHERE id_eleve = ?)";

  conn.query(reqPrep, [`%${searchQuery}%`, id_use], (err, resultat) => {
    if (err) {
      console.error("Erreur lors de l'exécution de la requête serveur :", err);
      return;
    }
    // On va attentdre que toutes les promesses soient résolues avant d'envoyer les résultats
    Promise.all(
      resultat.map((row) =>
        affichage_note(row.code, conn).then((code) => ({
          epreuve: row.epreuve,
          code: code,
          date_eval: row.date_eval,
          note: row.note,
          id_eval: row.id_eval,
        }))
      )
    )
      .then((resultsToSend) => {
        console.log("Résultats de la recherche :", resultsToSend);
        res.json({ resultsToSend });
      })
      .catch((err) => {
        console.error(
          "Erreur lors de l'exécution de la requête serveur :",
          err
        );
      });
  });
});

// Route pour la requête de moyenne des notes d'une épreuve
router.post("/mesnotes/code", (req, res) => {
  const code = req.body.code;
  let reqPrep = "SELECT * FROM eval WHERE code = ? ";
  conn.query(reqPrep, [code], (err, resultat) => {
    if (err) {
      console.error("Erreur lors de l'exécution de la requête serveur :", err);
      return;
    }
    // On va calculer la moyenne de toutes les notes qui ont le même code
    let moyenne = 0;
    let somme_notes = 0;
    let nbNotes = 0;
    let note_min = null;
    let note_max = null;
    resultat.forEach((row) => {
      if (row.note != null && row.code == code) {
        somme_notes += row.note;
        nbNotes++;
      }
      if (note_min == null || row.note < note_min) {
        note_min = row.note;
      }
      if (note_max == null || row.note > note_max) {
        note_max = row.note;
      }
    });
    moyenne = somme_notes / nbNotes;
    console.log(
      "Moyenne :",
      moyenne,
      "Note minimale :",
      note_min,
      "Note maximale :",
      note_max
    );
    res.json({ moyenne, note_min, note_max });
  });
});


module.exports = router; // Exporter le routeur