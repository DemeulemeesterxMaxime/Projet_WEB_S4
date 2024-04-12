const express = require("express");
const bodyParser = require("body-parser");
const mysql = require("mysql");
const cors = require("cors"); // Add cors library
const cookieParser = require("cookie-parser");
const app = express(); // Enable CORS for all origins during development (not recommended for production)
const { affichage_note } = require("./public/JS/fonction.js");

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

app.use(cors());
app.use(express.static("public"));
app.use(cookieParser());

app.get("/", (req, res) => {
  console.log("Requête GET sur /");
});
// Middleware pour parser les requêtes POST
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json()); // Ajouter cette ligne pour analyser les requêtes au format JSON

//Route pour la requête de recherche

app.post("/mesnotes", (req, res) => {
  // On va récupérer dans le cookie l'id de l'utilisateur
  //console.log("Requête POST sur /mesnotes avec la req : ", req.body);
  const searchQuery = req.body.searchQuery;
  const id_use = req.body.id;
  //console.log("Recherche de :", searchQuery, "pour l'utilisateur :", id_use);
  let reqPrep =
    "SELECT * FROM eval WHERE code LIKE ? AND id_eval IN (SELECT id_eval FROM eval_eleve WHERE id_eleve = ?)";
  // La syntaxe de la requête préparée doit être comme suit : 
  // "SELECT * FROM eval WHERE code LIKE ? AND id_eval IN (SELECT id_eval FROM eval_eleve WHERE id_eleve = ?)";
  
  conn.query(reqPrep, [`%${searchQuery}%`, id_use], (err, resultat) => {
    if (err) {
      console.error("Erreur lors de l'exécution de la requête serveur :", err);
      return;
    }
    //console.log("Résultat de la requête :", resultat);
    Promise.all(resultat.map((row) => 
      affichage_note(row.code, conn).then((code) => ({
        epreuve: row.epreuve,
        code: code,
        date_eval: row.date_eval,
        note: row.note,
        id_eval: row.id_eval,
      }))
    )).then((resultsToSend) => {
      console.log("Résultats de la recherche :", resultsToSend);
      res.json({ resultsToSend });
    }).catch((err) => {
      console.error("Erreur lors de l'exécution de la requête serveur :", err);
    });
      });
});

// Port d'écoute du serveur
const port = 3000;
app.listen(port, () => {
  console.log(`Serveur démarré sur le port ${port}`);
});

