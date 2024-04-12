const searchInput = document.getElementById("search-input");
const searchResults = document.getElementById("results");
const userId = document.cookie.match(/user_id=([^;]+)/)?.[1];
const tab_2 = document.getElementById("tab_2");
const tab_1 = document.getElementById("tab_1");

tab_1.style.display = "none";


if (userId) {
  console.log(`Identifiant utilisateur : ${userId}`);
} else {
  console.log("Aucun cookie 'user_id' trouvé");
}

document.cookie = "search_query=0; expires=Fri, 31 Dec 2026 23:59:59 GMT; path=/";


searchInput.addEventListener("input", function () {
  const searchText = this.value.trim();
  if (searchText === "") {
    tab_1.style.display = "none";
    tab_2.style.display = "block";
    searchResults.innerHTML = "";
    searchResults.style.display = "none";
    return;
  } else {
    tab_2.style.display = "none";
    tab_1.style.display = "block";
  }
  console.log("Recherche de :", searchText);
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

      console.log("Résultats de la recherche :", data.resultsToSend);
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

// Fonction pour détecter les changements d'options
document.getElementById('matiere').addEventListener('change', function() {
    // Actualiser le formulaire sans rechargement de page
    localStorage.setItem("mat", this.value);
    document.getElementById('form').submit();        
});

document.getElementById('date').addEventListener('change', function() {
    // Actualiser le formulaire sans rechargement de page
    localStorage.setItem("dat", this.value);
    document.getElementById('form').submit();
});

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