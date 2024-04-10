const searchInput = document.getElementById("search-input");
const searchResults = document.getElementById("search-results");
const userId = document.cookie.match(/user_id=([^;]+)/)?.[1];

if (userId) {
  console.log(`Identifiant utilisateur : ${userId}`);
} else {
  console.log("Aucun cookie 'user_id' trouvé");
}

searchInput.addEventListener("input", function () {
  const searchText = this.value.trim();
  console.log("Recherche futur de :", searchText);
  if (searchText === "") {
    searchResults.innerHTML = "";
    searchResults.style.display = "none";
    return;
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
      console.log(data.results);
      const results = data.results;
      let resultHtml = "";
      
      results.forEach((result) => {
        resultHtml += `<div class="result-item">${result}</div>`;
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
