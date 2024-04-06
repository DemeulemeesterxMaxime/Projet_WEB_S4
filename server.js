const express = require("express");
const bodyParser = require("body-parser");

const app = express();
app.use(express.static("public"));


// Middleware pour parser les requêtes POST
app.use(bodyParser.urlencoded({ extended: true }));

app.get("/", (req, res) => {
  console.log("test");
  res.status(200).render("index");
});

// Port d'écoute du serveur
const port = 3002;
app.listen(port, () => {
  console.log(`Serveur démarré sur le port ${port}`);
});
