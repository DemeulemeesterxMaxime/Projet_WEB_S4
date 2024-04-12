//On obtient les éléments du DOM
const searchInput = document.getElementById("search-input");
const searchResults = document.getElementById("results");
const userId = document.cookie.match(/user_id=([^;]+)/)?.[1];
const tab_2 = document.getElementById("tab_2");
const tab_1 = document.getElementById("tab_1");

//on masque par défaut le tableau de la barre de recherche
tab_1.style.display = "none";

//on va crée un cookie avec une valeur par défault, le cookie dure 1 ans 
let date = new Date();
date.setTime(date.getTime() + 365 * 24 * 60 * 60 * 1000); // Ajoute 24 heures
let expires = "; expires=" + date.toUTCString();
document.cookie = "search_query=0" + expires + "; path=/";

//lorsque l'on change la valeur de l'input de recherche
searchInput.addEventListener("input", function () {
  const searchText = this.value.trim();
  if (searchText === "") {
    //si la recherche est vide, on affiche le tableau normal
    tab_1.style.display = "none";
    tab_2.style.display = "block";
    searchResults.innerHTML = "";
    searchResults.style.display = "none";
    return;
  } else {
    //sinon on affiche le tableau de recherche
    tab_2.style.display = "none";
    tab_1.style.display = "block";
  }
  //on va envoyer une requête POST pour récupérer les résultats de recherche
  fetch("http://localhost:3000/mesnotes", {
    method: "POST",
    headers: {
      //on va autoriser les CORS
      "Access-Control-Allow-Origin": "*",

      "Content-Type": "application/json",
    },
    body: JSON.stringify({ searchQuery: searchText, id: userId}),
  })
    .then((response) => response.json())
    .then((data) => {
      //on va traiter les résultats de recherche
      const results = data.resultsToSend;
      let resultHtml = ``;

      results.forEach((result) => {
        //on va traiter la date pour seulement afficher la date sans l'heure
        let date = result.date_eval;
        let date_split = date.split('T');
        result.date_eval = date_split[0];

        resultHtml += `<tr>
        <td>${result.epreuve}</td>
        <td>${result.code}</td>
        <td>${result.date_eval}</td>
        <td>${result.note}</td>
        <td><a href='modification_note.php?id_modif=${result.id_eval}'><i class='fa-regular fa-pen-to-square color'></i></a></td>
      </tr>`;
      });
      //on va afficher les résultats de recherche
      searchResults.innerHTML = resultHtml;
      searchResults.style.display = "block";
    })
    .catch((error) => {
      console.error(
        "Erreur lors de la récupération des résultats de recherche :",
        error
      );
      searchResults.innerHTML = "";
      searchResults.style.display = "none";
    });
});

// Fonction pour détecter les changements d'options dans le formulaire filtre
document.getElementById('matiere').addEventListener('change', function() {
    // On va placer la valeur de l'option sélectionnée dans le localStorage
    localStorage.setItem("mat", this.value);
    // Actualiser le formulaire sans rechargement de page
    document.getElementById('form').submit();        
});

document.getElementById('date').addEventListener('change', function() {
    localStorage.setItem("dat", this.value);
    document.getElementById('form').submit();
});

// Fonction pour récupérer les valeurs du localStorage et les placer dans les champs du formulaire après le chargement de la page
window.onload = function () {
  var matiereSelect = localStorage.getItem("mat");
  if (matiereSelect) {
    document.getElementById("matiere").value = matiereSelect;
  }

  var dateSelect = localStorage.getItem("dat");
  if (dateSelect) {
    document.getElementById("date").value = dateSelect;
  }
};

//Quand il n'y a pas de note affiché : 
var tbody = document.querySelector('.tableau_verif td');
var div_pasnote = document.getElementById('div_pasnote');

if (!tbody) {
    console.log("Pas de note");
    div_pasnote.style.display = 'block';
    //alert("Il n'y a pas de note entrée");
}
else{
  div_pasnote.style.display = 'none';
}

document.getElementById('i_pasnote').addEventListener('click', function() {
    div_pasnote.style.display = 'none';
});


function redirection(){
  document.location.href="add_note.php"; 
}