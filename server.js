const express = require("express");
const app = express(); 
const cookieParser = require("cookie-parser");
const note_route = require("./routes/mes_notes"); // Import the route

app.use(note_route); // Use the route
app.use(express.static("public"));
app.use(cookieParser());

// Port d'écoute du serveur
const port = 3000;
app.listen(port, () => {
  console.log(`Serveur démarré sur le port ${port}`);
});
