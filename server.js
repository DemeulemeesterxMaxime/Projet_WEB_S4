const express = require("express");
const bodyParser = require("body-parser");

const app = express();
app.use(express.static("public"));

// Middleware pour parser les requêtes POST
app.use(bodyParser.urlencoded({ extended: true }));


// Port d'écoute du serveur
const port = 80;
app.listen(port, () => {
  console.log(`Serveur démarré sur le port ${port}`);
});
